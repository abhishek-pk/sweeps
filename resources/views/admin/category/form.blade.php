
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
                                      @if (isset($category))
                                      Update Category
                                      @else
                                      Create Category
                                      @endif 
                                    </h4>
                                    @if ($errors->has('error'))
                                        <div class="alert alert-danger">
                                            <strong>Error:</strong> {{ $errors->first('error') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>  
                        <div class="m-portlet__body"> 
                            <form
                            @if (isset($category))
                             action="{{route('categories.update',$category) }} "
                            @else
                            action="{{route('categories.store') }} " 
                            @endif
                            method="POST" class="form" >
                                @csrf
                                @if (isset($category))
                                   @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="name" class="form-label text-capitalize">Name</label>
                                        <input type="text" class="form-control" value="{{ isset($category)?$category->name:'' }}" required name="name" id="name" placeholder="Enter name.." />
                                      </div>
                                      <div class="mb-3 col-6">
                                        <label for="min_wage" class="form-label text-capitalize">Minimum wage</label>
                                        <input type="number" class="form-control" required  value="{{ isset($category)?$category->min_wage:'' }}" name="min_wage" id="name" placeholder="Enter minimum wage.. " />
                                      </div>
                                      <div class="mb-3 col-6">
                                        <label for="max_wage" class="form-label text-capitalize">Maximum wage</label>
                                        <input type="number" class="form-control" required  value="{{ isset($category)?$category->max_wage:'' }}" name="max_wage" id="name" placeholder="Enter maximum wage.." />
                                      </div>
                                      <div class="mb-3 col-6">
                                        <label for="wage_type" class="form-label text-capitalize">Wage type</label>
                                       <select  class="form-select" required name="wage_type" id="wage_type">
                                        <option {{ isset($category)&&$category->wage_type=='hourly'?'selected':'' }} value="hourly">Hourly</option>
                                        <option {{ isset($category)&&$category->wage_type=='daily'?'selected':'' }} value="daily">Daily</option>
                                       </select>
                                      </div>
                                      <div class="col-12 mb-3 d-flex justify-content-end">
                                        
                                        <button class="btn btn-primary d-grid w-25" type="submit">Save</button>
                                      </div>
                                      {{-- <div class="col-6">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Save</button>
                                      </div> --}}
                                </div>
                            </form>
                           
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
