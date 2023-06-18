@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" class="col-md-6">
                    <h4 class="card-title">Table of Bus Schedules</h4>
                    <a class="btn btn-rounded btn-primary" href="{{ route('admin_bus_schedule.create') }}" role="button"><span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                    </span>Add</a>
                </div>
                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show">
                            <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                            <strong>{{session()->get('message')[1]}}</strong>
                            
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>Bus Name</strong></th>
                                    <th><strong>Driver Name</strong></th>
                                    <th><strong>Region</strong></th>
                                    <th><strong>Destination</strong></th>
                                    <th><strong>Schedule Date</strong></th>
                                    <th><strong>Departure Time</strong></th>
                                    <th><strong>Estimated Arrival Time</strong></th>
                                    <th><strong>Fee ($)</strong></th>
                                    <th><strong>Remark</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $item)
                                <tr>
                                    <td><strong>{{ $item->id }}</strong></td>
                                    <td>{{ $item->bus_id }}</td>
                                    <td>{{ $item->driver_id }}</td>
                                    <td>{{ $item->region_id }}</td>
                                    <td>{{ $item->destination_id }}</td>
                                    <td>{{ $item->schedule_date }}</td>
                                    <td>{{ $item->departure_time }}</td>
                                    <td>{{ $item->estimated_arrival_time }}</td>
                                    <td>{{ $item->fee }}</td>
                                    <td>{{ $item->remarks }}</td>
                                    <td>
                                        <div class="d-flex">
                                            
                                            <a href="{{ url('admin/admins_schedule/edit/'.$item->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ url('admin/admins_schedule/delete/'.$item->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <footer>
                            <div class="row">
                                <div class="col-7">
                                    <p>showing {{ $schedules->firstItem() }} - {{ $schedules->lastItem() }} of {{ $schedules->total() }}</p>
                                </div>

                                <div class="col-5">
                                    <div class="float-end">
                                        <ul class="pagination pagination-xs pagination-gutter">
                                            {{$schedules->links()}}
                                            
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