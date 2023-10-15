
@extends('layouts/contentNavbarLayout')

@section('title', 'Category')
@section('page-style')

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
                                     Category detail
                                    </h4>
                                   
                                </div>
                            </div>
                        </div>  
                        <div class="m-portlet__body"> 
                                <table class="table table-bordered">
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td>{{ $category->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Minimum Wage</strong></td>
                                        <td>${{ $category->min_wage }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Maximum Wage</strong></td>
                                        <td>${{ $category->max_wage }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Wage Type</strong></td>
                                        <td>{{ $category->wage_type }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>{{ $category->status_id == 1 ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                </table>
                                <a href="{{route('categories.index') }}" class="btn btn-primary mt-3">Back to Categories</a>
                            </div> 
                    </div>		 
                </div>	 
            </div>
        </div> 
    </div>
  </div>
@endsection
@section('page-script')

@endsection
