@extends('layouts.master')
@section('content')

<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Bus</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('admin_bus.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_id">Bus Driver</label>
                                <div class="col-sm-9">
                                    <select class="default-select form-control wide mb-3" id="user_id" name="user_id">
                                        <option value="0" selected="true" disabled="true">Select Bus Driver</option>
                                        @foreach ($new_users as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="plate_number">Plate Numbers</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="plate_number" id="plate_number">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_type">Bus Type</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bus_type" class="form-control" id="bus_type">
                                </div>
                            </div>
                    
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="capacity">Capacity</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="capacity" id="capacity">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="bus_status">Bus Status</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="bus_status" id="bus_status">
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
    $('#user_id').on('change', function (e) {
        var bus_id = $(this).val();
        
        $.get("{{ route('admin.user') }}", {user_id:user_id}, function (data) { 
            $.each(data, function (i, l) { 
                $(user_id).append($('<option/>',{
                        value : l.id,
                        text : l.name
                    }))
             })
         })
    });

</script>

@endsection
@endsection