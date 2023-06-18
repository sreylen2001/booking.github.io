@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                       
                        <div class="card-header">
                            <h4 class="card-title">Update Driver</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" novalidate="" action="{{url('admin/admins_driver/update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <input type="hidden" name="id" value="{{$drivers->id}}">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="name">Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="name" id="name" value="{{$drivers->name}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="contact">Contact</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="contact" id="contact" value="{{$drivers->contact}}">
                                                </div>
                                            </div>

                                            </div>
                                                <div class="col-xl-6">
                                                    
                                                    <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                                    <a href="{{ route('admin.admin_driver') }}" class="btn btn-light">Cancel</a>
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