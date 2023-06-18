@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Bus Schedule</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate="" action="{{url('admin/admins_schedule/update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <input type="hidden" name="id" value="{{$schedules->id}}">

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="bus_id">Bus</label>
                                        <div class="col-sm-12">
                                            <select class="default-select form-control wide mb-3" id="bus_id" name="bus_id">
                                                {{-- <option selected="true" disabled="true">Select Bus</option> --}}
                                                @foreach($buses as $data)
                                                <option value="{{$data->id}}" @selected(old('bus_id')==$data->id)>{{$data->bus_number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
        
                                        <label class="col-sm-3 col-form-label" for="driver_id">Driver</label>
                                        <div class="col-sm-12">
                                            <select class="default-select form-control wide mb-3" id="driver_id" name="driver_id">
                                                @foreach ($drivers as $data)
                                                    <option value="{{$data->id}}" @selected(old('driver_id')==$data->id)>{{$data->name}}</option>
        
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <label class="col-sm-3 col-form-label" for="region_id">Region</label>
                                        <div class="col-sm-12">
                                            <select class="default-select form-control wide mb-3" id="region_id" name="region_id">
                                                @foreach ($regions as $data)
                                                    <option value="{{$data->id}}" @selected(old('region_id')==$data->id)>{{$data->region_name}}</option>
        
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        
                                        <label class="col-sm-3 col-form-label" for="destination_id">Destination</label>
                                        <div class="col-sm-12">
                                            <select class="default-select form-control wide mb-3" id="destination_id" name="destination_id">
                                                @foreach ($destinations as $data)
                                                    <option value="{{$data->id}}" @selected(old('destination_id')==$data->id)>{{$data->destination_name}}</option>
            
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <p class="mt-2 mb-2 wide">Schedule Date</p>
                                            <input type="text" class="form-control" name="schedule_date" id="schedule_date" value="{{$schedules->schedule_date}}">
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <label class="form-label mt-2 dmb-2 wide">Departure Time</label>
                                            <input class="form-control" id="timepicker" name="departure_time" id="departure_time" value="{{$schedules->departure_time}}">
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <label class="form-label mt-2 dmb-2 wide">Estimated Arrival Time</label>
                                            <input class="form-control" id="timepicker" name="estimated_arrival_time" id="estimated_arrival_time" value="{{$schedules->estimated_arrival_time}}">
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <p class="mt-2 mb-2 wide">Fee ($) </p>
                                            <input type="text" class="form-control" name="fee" id="fee" value="{{$schedules->fee}}">
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <p class="mt-2 mb-2 wide">Remark</p>
                                            <input type="text" class="form-control" name="remarks" id="remarks" value="{{$schedules->remarks}}">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                    <a href="{{ route('admin.bus_schedule') }}" class="btn btn-light">Cancel</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $('#bus_id').on('change', function (e) {
        var bus_id = $(this).val();
        
        $.get("{{ route('admin.bus_schedule.bus') }}", {bus_id:bus_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(bus_id).append($('<option/>',{
                        value : l.id,
                        text : l.bus_name
                    }))
             })
         })
    });

    $('#driver_id').on('change', function (e) {
        var driver_id = $(this).val();
        
        $.get("{{ route('admin.bus_schedule.driver') }}", {driver_id:driver_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(driver_id).append($('<option/>',{
                        value : l.id,
                        text : l.name
                    }))
             })
         })
    });

    $('#region_id').on('change', function (e) {
        var region_id = $(this).val();
        
        $.get("{{ route('admin.bus_schedule.region') }}", {region_id:region_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(region_id).append($('<option/>',{
                        value : l.id,
                        text : l.region_name
                    }))
             })
         })
    });

    $('#destination_id').on('change', function (e) {
        var destination_id = $(this).val();
        
        $.get("{{ route('admin.bus_schedule.destination') }}", {destination_id:destination_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(destination_id).append($('<option/>',{
                        value : l.id,
                        text : l.destination_name
                    }))
             })
         })
    });
</script>
{{-- <script type="text/javascript">
    $('#')
</script> --}}
@endsection

@endsection