@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Blog <a href="{{url('admin/blog/add')}}" class="btn btn-warning">Add Blog</a></h1>
    
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

            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td>{{$blog->id}}</td>
                                <td>
                                    <img src="{{ \App\Hash::image('/images/blog/', $blog->image) }}" width="100px">
                                </td>
                                <td>{{ucwords($blog->title)}}</td>
                                <td>
                                @if($blog->status == 1)
                                <span class="label label-success">Active</span>
                                @else
                                <span class="label label-danger">Inactive</span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/blog/edit/'.$blog->id)}}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="{{url('admin/blog/delete/'.$blog->id)}}" class="btn btn-xs btn-danger" onclick = "if (! confirm('Do you want to delete this blog?')) { return false; }">Delete</a>
                                    <a href="{{url('admin/blog/change-status/'.$blog->id)}}" class="btn btn-xs btn-warning">
                                    @if($blog->status == 1)
                                    <i class="fa fa-thumbs-down"></i> Disable
                                    @else
                                    <i class="fa fa-thumbs-up"></i> Enable
                                    @endif
                                    </a>
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