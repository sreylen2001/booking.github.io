@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Bus</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('admin_bus.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_number">Bus Numbers</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="bus_number" id="bus_number">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_plate_number">Plate Numbers</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="bus_plate_number" id="bus_plate_number">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_type">Bus Type</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bus_type" class="form-control" id="bus_type">
                                </div>
                            </div>
                    
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="capacity">Capacity</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="capacity" id="capacity">
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