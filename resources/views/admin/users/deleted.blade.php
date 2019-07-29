@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Deleted Users</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{ ucwords($data->role) }}</td>
                                <td>{{ ucwords($data->name) }} {!! $data->featured == 1 ? '<span class="label label-info">Featured</span>' : '' !!}</td>
                                <td>{{$data->email}}</td>

                                <td>
                                    <a href="{{url('admin/users/gprestore/'.$data->id)}}" class="btn btn-xs btn-info" onclick = "if (! confirm('Do you want to restore this {{$data->role}}?')) { return false; }">Restore</a>
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