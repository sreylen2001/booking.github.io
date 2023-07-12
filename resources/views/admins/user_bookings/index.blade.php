@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table of Booking Information</h4>
                    {{-- <a class="btn btn-rounded btn-primary" href="{{ route('user_booking.create') }}" role="button"><span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                    </span>Booking</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>User ID</strong></th>
                                    <th><strong>Bus ID</strong></th>
                                    <th><strong>Number of seats</strong></th>
                                    <th><strong>Total Amount</strong></th>
                                    <th><strong>Payment Amount</strong></th>
                                    <th><strong>Payment By</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Create At</strong></th>

                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_bookings as $item)
                                <tr>
                                    <td><strong>{{ $item->id }}</strong></td>
                                    <td>{{ $item->user_id }}</td>
                                    {{-- @if ($role = $item->role_id = 1)
                                        @php
                                            $role = 'Customer';
                                        @endphp
                                        @else
                                        @php
                                            $value = 'Driver';
                                        @endphp
                                    @endif --}}
                                    <td>{{ $item->bus_id }}</td>
                                    <td>{{ $item->number_of_seats }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ $item->payment_amount }}</td>
                                    <td>{{ $item->payment_by }}</td>
                                    <td>{{ $item->status }}</td> 
                                    <td>{{ $item->created_at }}</td> 
                                    <td></td>
                                </tr>
                                @endforeach

                            </tbody>
                             
                        </table>
                        <footer>
                            <div class="row">
                                <div class="col-7">
                                    <p>showing {{ $new_bookings->firstItem() }} - {{ $new_bookings->lastItem() }} of {{ $new_bookings->total() }}</p>
                                </div>

                                <div class="col-5">
                                    <div class="float-end">
                                        <ul class="pagination pagination-xs pagination-gutter">
                                            {{$new_bookings->links()}}
                                          
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


@endsection