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
                            <h4 class="card-title">Update Bus Ticket</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" novalidate="" action="{{url('admin/user_ticket/update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <input type="hidden" name="id" value="{{$new_bus_tickets->id}}">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="name">Bus Type</label>
                                                <select class="default-select form-control wide mb-3" id="bus_id" name="bus_id">
                                                    @foreach($new_buses as $data)
                                                        <option value="{{$data->id}}" @selected(old('bus_id')==$data->id)>{{$data->bus_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="from">From</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="from" id="from" value="{{$new_bus_tickets->from}}">
                                                </div>
                                            </div> 
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="to">To</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="to" id="to" value="{{$new_bus_tickets->to}}">
                                                </div>
                                            </div> 
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="fare_amount">Fare Amount ($)</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="fare_amount" id="fare_amount" value="{{$new_bus_tickets->fare_amount}}">
                                                </div>
                                            </div> 
                                            
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="departure_time">Departure Time</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="departure_time" id="departure_time" value="{{$new_bus_tickets->departure_time}}">
                                                </div>
                                            </div> 
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="estimated_arrival_time">Estimated Arrival Time</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="estimated_arrival_time" id="estimated_arrival_time" value="{{$new_bus_tickets->estimated_arrival_time}}">
                                                </div>
                                            </div> 
                                        </div>

                                        <div class="col-xl-6">
                                            <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                            <a href="{{ route('admin.user_ticket') }}" class="btn btn-light">Cancel</a>
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