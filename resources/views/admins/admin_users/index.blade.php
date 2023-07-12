@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table of Users</h4>
                    <li class="nav-item d-flex align-items-center">
                        <div class="input-group search-area">
                            <input type="search" name="search" class="form-control" placeholder="Search here..." value="{{$search}}">
                            {{-- <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span> --}}
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </li>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Role</strong></th>
                                    <th><strong>Gender</strong></th>
                                    <th><strong>Profession</strong></th>
                                    <th><strong>Profile</strong></th>
                                    <th><strong>Email</strong></th>
                                    <th><strong>Contact</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Action</strong></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
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
                                    <td>{{ $item->profession }}</td>
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
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ url('admin/admins_user/edit/'.$item->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ url('admin/admins_user/delete/'.$item->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
                                    <p>showing {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }}</p>
                                </div>

                                <div class="col-5">
                                    <div class="float-end">
                                        <ul class="pagination pagination-xs pagination-gutter">
                                            {{$users->links()}}
                                            {{-- <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{$users->links()}}</a>
                                            </li> --}}
                                        
                                            
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