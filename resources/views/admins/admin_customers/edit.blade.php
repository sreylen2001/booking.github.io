@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                       
                        <div class="card-header">
                            <h4 class="card-title">Update Customer</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" novalidate="" action="{{url('admin/admins_customer/update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <input type="hidden" name="id" value="{{$customers->id}}">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="name">Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="name" id="name" value="{{$customers->name}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="contact">Contact</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="contact" id="contact" value="{{$customers->contact}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="contact">Email</span></label>
                                                <div class="col-lg-6">
                                                    <input type="email" class="form-control" name="email" id="email" value="{{$customers->email}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="username">Username</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="username" id="username" value="{{$customers->username}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="gender">Gender</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="gender" id="gender" value="{{$customers->gender}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="nationality">Nationality</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="nationality" id="nationality" value="{{$customers->nationality}}">
                                                </div>
                                            </div>

                                            </div>
                                                <div class="col-xl-6">
                                                    
                                                    <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                                    <a href="{{ route('admin.admin_customer') }}" class="btn btn-light">Cancel</a>
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