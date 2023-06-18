@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Customer</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('admin_customer.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="name">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="contact">Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contact" id="contact">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="email">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="username">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" id="username">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="gender">Gender</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="gender" id="gender">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="nationality">Nationalty</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nationality" id="nationality">
                                </div>
                            </div>
                    
                            <br>
                            <div class="mb-3 row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection