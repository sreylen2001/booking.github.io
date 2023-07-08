@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table of Booking Information</h4>
                    <a class="btn btn-rounded btn-primary" href="{{ route('user_booking.create') }}" role="button"><span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                    </span>Booking</a>
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
                                    <th><strong>Status</strong></th>
                                    
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($new_users as $item)
                                <tr>
                                    <td><strong>{{ $item->id }}</strong></td>
                                    <td>{{ $item->name }}</td>
                                    @if ($role = $item->role_id = 1)
                                        @php
                                            $role = 'Customer';
                                        @endphp
                                        @else
                                        @php
                                            $value = 'Driver';
                                        @endphp
                                    @endif
                                    <td>{{ $role }}</td>

                                    <td>{{ $item->gender }}</td>
                                    {{-- <td>{{ $item->dob }}</td> --}}
                                    {{-- <td>{{ $item->profession }}</td>
                                    <td>{{ $item->profile_photo }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    @if ($value = $item->status = 1)
                                        @php
                                            $value = 'Active';
                                        @endphp
                                        @else
                                        @php
                                            $value = 'Inactive';
                                        @endphp
                                    @endif
                                    <td>{{ $value }}</td>
                                    
                                    <td></td>
                                </tr>
                                @endforeach

                                
                            </tbody> --}}
                             
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