@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table of bus tickets</h4>
                    <a class="btn btn-rounded btn-primary" href="{{ route('user_ticket.create') }}" role="button"><span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                    </span>Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>Bus Name</strong></th>
                                    <th><strong>From</strong></th>
                                    <th><strong>To</strong></th>
                                    <th><strong>Fare Amount</strong></th>
                                    <th><strong>Departure Time</strong></th>
                                    <th><strong>Estimated Arrival Time</strong></th>
                                    <th><strong>Action</strong></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_bus_tickets as $item)
                                <tr>
                                    <td><strong>{{ $item->id }}</strong></td>
                                    <td><strong>{{ $item->bus_id }}</strong></td>

                                    {{-- <td>
                                        @if ($new_buses as $key => $data)
                                            <strong value="{{$data->id}}">{{$data->bus_type}}</strong>
                                        @endif
                                        
                                    </td> --}}
                                    <td>{{ $item->from }}</td>
                                    <td>{{ $item->to }}</td>
                                    <td>{{ $item->fare_amount }}</td>
                                    <td>{{ $item->departure_time }}</td>
                                    <td>{{ $item->estimated_arrival_time }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ url('admin/user_ticket/edit/'.$item->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ url('admin/user_ticket/delete/'.$item->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                   
                                    <td></td>
                                </tr>
                                @endforeach

                                
                            </tbody>
                            
                        </table>
                        <footer>
                            <div class="row">
                                <div class="col-7">
                                    <p>showing {{ $new_bus_tickets->firstItem() }} - {{ $new_bus_tickets->lastItem() }} of {{ $new_bus_tickets->total() }}</p>
                                </div>

                                <div class="col-5">
                                    <div class="float-end">
                                        <ul class="pagination pagination-xs pagination-gutter">
                                            {{$new_bus_tickets->links()}}
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                             
                        </footer>
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