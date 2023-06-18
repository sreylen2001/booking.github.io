@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                       
                        <div class="card-header">
                            <h4 class="card-title">Update Region</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" novalidate="" action="{{url('admin/admins_region/update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <input type="hidden" name="id" value="{{$regions->id}}">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="region_name">Region Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="region_name" id="region_name" value="{{$regions->region_name}}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                            <a href="{{ route('admin.admin_region') }}" class="btn btn-light">Cancel</a>
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
</div>

@endsection