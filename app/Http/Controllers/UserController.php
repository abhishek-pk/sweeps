<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        if($request->ajax()) {

             $query = User::query();
            return $datatables->eloquent($query)  
              ->addColumn('action', function (User $user) {
                return 
                '<a href="'.route('user.show',$user->id).'" class="datatable-button m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
                    <i class="la la-eye"></i>
                </a>
                <a href="'.route('user.edit',$user->id).'" class="datatable-button m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
                    <i class="la la-edit"></i>
                </a>
                <a href="'.route('user.destroy',$user->id ).'" class="datatable-button m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill report-delete" title="Delete">
                    <i class="la la-trash"></i>
                </a>';
              }) 

            ->rawColumns(['action'])
            ->make(true);
        }

        return view('datatable');
    }
}
