@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table of Roles</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Description</strong></th>
                                    <th><strong>Action</strong></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_roles as $item)
                                <tr>
                                    <td><strong>{{ $item->id }}</strong></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ url('admin/user_role/edit/'.$item->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
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
                                    <p>showing {{ $new_roles->firstItem() }} - {{ $new_roles->lastItem() }} of {{ $new_roles->total() }}</p>
                                </div>

                                <div class="col-5">
                                    <div class="float-end">
                                        <ul class="pagination pagination-xs pagination-gutter">
                                            {{$new_roles->links()}}
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