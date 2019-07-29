@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>All Users  <a href="{{url('admin/users/add')}}" class="btn btn-warning">Add User</a></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{ ucwords($data->role) }}</td>
                                <td>{{ ucwords($data->name) }}</td>
                                <td>{{$data->email}}</td>
                                <td>
                                @if($data->status == 1)
                                <span class="label label-success">Active</span>
                                @else
                                <span class="label label-danger">Inactive</span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/users/view/'.$data->id)}}" class="btn btn-xs btn-info">View</a>
                                    <a href="{{ route('edituser', $data->id) }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="{{route('cpuser', $data->id)}}" class="btn btn-xs btn-warning">Change Password</a>
                                    @if($data->role == 'doctor')
                                    <a href="{{route('admin.company', $data->id)}}" class="btn btn-xs btn-info">Company</a>
                                    @endif
                                    @if($data->role != 'admin')
                                    <a href="{{ route('deleteuser', $data->id) }}" class="btn btn-xs btn-danger" onclick = "if (! confirm('Do you want to delete this {{$data->role}}?')) { return false; }">Delete</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>   

@endsection