@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Destination</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('admin_destination.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="destination_name">Destination Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="destination_name" id="destination_name">
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