@extends('layouts/contentNavbarLayout')

@section('title', 'Agent')
@section('page-style')
<style>
    .input-sm{
        height: 35px !important;
        line-height:15px !important;
    }
</style>
@endsection
@section('content')

  <div class="card">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet">
                    <div class=" mb-4 mb-4"> 
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h4 class="m-portlet__head-text mt-3">
                                       Agent list
                                    </h5>
                                </div>
                            </div>
                        </div>  
                        <div class="m-portlet__body"> 
                            <table id="agent-table" class="table table-bordered" data-server-side="true" data-processing="true">
                                <thead>
                                    <tr>  
                                        <th data-data="name" data-name="name">Name</th> 
                                        <th data-data="email" data-name="email">Email</th>
                                        <th data-data="phone" data-name="phone">Phone</th>
                                        <th data-data="is_approved" data-name="is_approved">Is approved</th>
                                        <th data-data="commission" data-name="commission">Commision</th>
                                        <th data-data="status_id"  data-orderable="false" data-name="status_id">Status</th>
                                        <th data-data="action" data-orderable="false" data-searchable="false">Action</th>
                                    </tr>
                                </thead>
                            </table> 
                        </div>  
                    </div>		 
                </div>	 
            </div>
        </div> 
    </div>
  </div>
@endsection
@section('page-script')
<script>
    var agent_list =  $('#agent-table').DataTable({
        ajax: {
                url:"{!!route('agents.index') !!}",
    
                }
    
    });
    
    </script>
@endsection
