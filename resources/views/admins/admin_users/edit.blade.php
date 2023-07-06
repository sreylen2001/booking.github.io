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
                            <h4 class="card-title">Update User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" novalidate="" action="{{url('admin/admins_user/update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <input type="hidden" name="id" value="{{$new_users->id}}">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="name">Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="name" id="name" value="{{$new_users->name}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="gender">Gender</span></label>
                                                {{-- <select class="select2-with-label-single js-states d-block" id="gender" name="gender">
                                                    <option value="{{$new_users->gender ?? ''}}"></option>
                                                    
                                                </select> --}}
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="gender" id="gender" value="{{$new_users->gender}}">
                                                </div>
                                            </div>

                                            {{-- <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="email">DOB</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="dob" id="dob" value="{{$new_users->dob}}">
                                                </div>
                                            </div> --}}

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="profession">Profession</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="profession" id="profession" value="{{$new_users->profession}}">
                                                </div>
                                        </div> 
                                        </div>
                                            <div class="col-xl-6">
                                                
                                                <div class="mb-3 input-group">
                                                    <label class="col-lg-4 col-form-label" for="profile_photo">Profile</span>
                                                    </label>
                                                    <div class="col-lg-6" class="form-file" textalign="center">
                                                        <input type="file" class="form-file-input form-control" name="profile_photo" id="profile_photo" value="{{$new_users->profile_photo}}">
                                                    </div>
                                                </div>
    
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="email">Email</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="email" id="email" value="{{$new_users->email}}">
                                                    </div>
                                                </div>
    
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="phone">Contact</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="phone" id="phone" value="{{$new_users->phone}}">
                                                    </div>
                                                </div>
    
                                                {{-- <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="status">Status</span>
                                                    </label>
                                                    @if ($value = $new_users->status = 1)
                                                        @php
                                                            $value = 'Active';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $value = 'Inactive';
                                                        @endphp
                                                    @endif
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="status" id="status" value="{{$value}}">
                                                    </div>
                                                </div>  --}}
                                                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                                <a href="{{ route('admin.admin_user') }}" class="btn btn-light">Cancel</a>
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