@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Bus Ticket</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('user_ticket.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_id">Bus Type</label>
                                <div class="col-sm-9">
                                    <select class="default-select form-control wide mb-3" id="bus_id" name="bus_id">
                                        <option value="0" selected="true" disabled="true">Select Bus Type</option>
                                        @foreach ($new_buses as $data)
                                            <option value="{{$data->id}}">{{$data->bus_type}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="from">From</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="from" id="from">
                                </div>
                            </div>
                    
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="to">To</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="to" id="to">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="fare_amount">Fare Amount ($)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="fare_amount" id="fare_amount">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="departure_time">Departure Time</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="departure_time" id="departure_time">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="estimated_arrival_time">Estimated Arrival Time</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="timepicker" name="estimated_arrival_time" id="estimated_arrival_time">
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

@section('scripts')
<script type="text/javascript">
    $('#bus_id').on('change', function (e) {
        var bus_id = $(this).val();
        
        $.get("{{ route('user_ticket.bus') }}", {bus_id:bus_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(bus_id).append($('<option/>',{
                        value : l.id,
                        text : l.bus_type
                    }))
             })
         })
    });

</script>

@endsection

@endsection