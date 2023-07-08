@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Booking</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('user_booking.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_id">Bus Information</label>
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
                                <label class="col-sm-3 col-form-label" for="number_of_seats">Number Of Seats</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="number_of_seats" id="number_of_seats">
                                </div>
                            </div>
                    
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="total_amount">Total Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="total_amount" id="total_amount" disabled>
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