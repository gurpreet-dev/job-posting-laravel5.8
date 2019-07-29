@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>All Pages  <a href="{{ route('addpage') }}" class="btn btn-warning">Add Page</a></h1>
    
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol> -->
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
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->title}}</td>
                                <td>{{$data->slug}}</td>
                                <td>
                                    @if($data->status == 1)
                                    <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/pages/edit/'.$data->id)}}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="{{url('admin/pages/delete/'.$data->id)}}" class="btn btn-xs btn-danger" onclick="if (confirm('Are you sure you want to delete this page?')) { return true; } return false;">Delete</a>
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