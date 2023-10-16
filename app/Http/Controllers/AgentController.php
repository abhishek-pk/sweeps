<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;

class AgentController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Datatables $datatables)
    {
        if($request->ajax()) {

            $query = User::query();
           return $datatables->eloquent($query)  
           ->editColumn('is_approved', function (User $user) {
                if($user->agent_data->is_approved==1){
                    return '<span class="badge bg-success">Approved</span>';
                }elseif($user->agent_data->is_approved==2){
                    return '  <span class="badge bg-danger">Pending</span>';
                }else{
                    return '  <span class="badge bg-danger">Rejected</span>';
                }
           })
           ->editColumn('commission', function (User $user) {
            return $user->agent_data->commission;
           })
           ->editColumn('status_id', function (User $user) {
                if($user->status_id==1){
                    return '<span class="badge bg-success">Active</span>';
                }else{
                    return '  <span class="badge bg-danger">Inactive</span>';
                }
           })
             ->addColumn('action', function (User $user) {
               return 
               '<div class="dropdown text-center">
               <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
               <div class="dropdown-menu">
               <a class="dropdown-item" href="'.route('agents.show',$user).'"><i class="bx bx-edit-alt me-1"></i> Show</a>
                 <a class="dropdown-item" href="'.route('agents.edit',$user).'"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                 <a class="dropdown-item" href="'.route('agents.destroy',$user ).'"><i class="bx bx-trash me-1"></i> Delete</a>
               </div>
             </div>';

             }) 

           ->rawColumns(['action','status_id','is_approved'])
           ->make(true);
       }

       return view('admin.agent.index');
    }
}
