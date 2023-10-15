<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Datatables $datatables)
    {
        if($request->ajax()) {

            $query = Category::query();
           return $datatables->eloquent($query)  
           ->editColumn('status_id', function (Category $category) {
                if($category->status_id==1){
                    return '<span class="badge bg-success">Active</span>';
                }else{
                    return '  <span class="badge bg-danger">Inactive</span>';
                }
           })
             ->addColumn('action', function (Category $category) {
               return 
               '<div class="dropdown text-center">
               <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
               <div class="dropdown-menu">
               <a class="dropdown-item" href="'.route('categories.show',$category).'"><i class="bx bx-edit-alt me-1"></i> Show</a>
                 <a class="dropdown-item" href="'.route('categories.edit',$category).'"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                 <a class="dropdown-item" href="'.route('categories.destroy',$category ).'"><i class="bx bx-trash me-1"></i> Delete</a>
               </div>
             </div>';

             }) 

           ->rawColumns(['action','status_id'])
           ->make(true);
       }

       return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); 
        
            $data = $request->validate([
                'name' => 'required',
                'min_wage' => 'required|numeric',
                'max_wage' => 'required|numeric|gt:min_wage',
                'wage_type' => 'required',
            ], [
                'max_wage.gt' => 'The max wage must be greater than the min wage.',
            ]);
        
            $data['status_id'] = 1;
           $category= Category::create($data);
        
            DB::commit(); 
        
            return redirect()->route('categories.show',$category)->with('success', 'Category created successfully');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors());
        } catch (QueryException $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while creating the category. Please try again later.');
        } 
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       return view('admin.category.form',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
    
            $data = $request->validate([
                'name' => 'required',
                'min_wage' => 'required|numeric',
                'max_wage' => 'required|numeric|gt:min_wage',
                'wage_type' => 'required',
            ], [
                'max_wage.gt' => 'The max wage must be greater than the min wage.',
            ]);
    
            $data['status_id'] = 1;
            
            $category = Category::findOrFail($id);
            $category->update($data);
    
            DB::commit();
    
            return redirect()->route('categories.show',$category)->with('success', 'Category updated successfully');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors());
        } catch (QueryException $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while updating the category. Please try again later.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
    
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the category. Please try again later.');
        }
    }
    
}
