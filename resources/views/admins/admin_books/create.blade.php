@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Booking Information</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('admin_bookbus.save')}}" method="POST" enctype="multipart/form-data">
                            @csrf  

                            @method('PUT')
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="schedule_id">Schedule</label>
                                <div class="col-sm-12">
                                    <select class="default-select form-control wide mb-3" id="schedule_id" name="schedule_id">
                                        <option value="0" selected="true" disabled="true">Select Schedule</option>
                                        @foreach ($schedules as $data)
                                            <option value="{{$data->id}}">{{$data->schedule_date}}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-3 col-form-label" for="customer_id">Customer</label>
                                <div class="col-sm-12">
                                    <select class="default-select form-control wide mb-3" id="customer_id" name="customer_id">
                                        <option value="0" selected="true" disabled="true">Select Customer</option>
                                        @foreach ($customers as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>

                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="col-sm-12">
                                    <p class="mt-2 mb-2 wide">Number of Seats</p>
                                    <input type="text" class="form-control" name="number_of_seats" id="number_of_seats">
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <p class="mt-2 mb-2 wide">Fare Amount ($)</p>
                                    <input type="text" class="form-control" name="fare_amount" id="fare_amount">
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <p class="mt-2 mb-2 wide">Total Amount ($)</p>
                                    <input type="text" class="form-control" name="total_amount" id="total_amount">
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
    $('#schedule_id').on('change', function (e) {
        var schedule_id = $(this).val();
        
        $.get("{{ route('admin.bookbus.schedule') }}", {schedule_id:schedule_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(schedule_id).append($('<option/>',{
                        value : l.id,
                        text : l.schedule_date
                    }))
             })
         })
    });

    $('#customer_id').on('change', function (e) {
        var customer_id = $(this).val();
        
        $.get("{{ route('admin.bookbus.customer') }}", {customer_id:customer_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(customer_id).append($('<option/>',{
                        value : l.id,
                        text : l.name
                    }))
             })
         })
    });

</script>

@endsection


@endsection