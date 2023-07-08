@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if(\Session::has('update'))
                            <div id="hide" class="alert alert-success" style="width: 20%;">
                            <h4 class="alert-heading"></h4>
                            <p>
                                {!! \Session::get('update')!!}
                            </p>
                            </div>
                        @endif
                        <div class="card-header">
                            <h4 class="card-title">Update Role</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" novalidate="" action="{{url('admin/user_role/update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <input type="hidden" name="id" value="{{$new_roles->id}}">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="name">Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="name" id="name" value="{{$new_roles->name}}">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="description">Description</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="description" id="description" value="{{$new_roles->description}}">
                                                </div>
                                            </div> 
                                        </div>

                                        <div class="col-xl-6">
                                            <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                            <a href="{{ route('admin.user_role') }}" class="btn btn-light">Cancel</a>
                                        </div>
                                                
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