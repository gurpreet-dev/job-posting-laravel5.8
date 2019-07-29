@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Faq's  <a href="{{url('admin/faq/add')}}" class="btn btn-warning">Add Faq</a></h1>
    
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
                                <th>Title</th>
                                <th>Status</th>
                                <th>Added on</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $faq)
                            <tr>
                                <td>{{$faq->id}}</td>
                                <td>{{$faq->title}}</td>
                                <td>
                                    @if($faq->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$faq->created_at}}</td>
                                <td>
                                    <a href="{{url('admin/faq/view/'.$faq->id)}}" class="btn btn-xs btn-info">View</a>
                                    <a href="{{url('admin/faq/edit/'.$faq->id)}}" class="btn btn-xs btn-success">Edit</a>

                                    <a href="{{url('admin/faq/change-status/'.$faq->id)}}" class="btn btn-xs btn-warning">
                                    @if($faq->status == 1)
                                    <i class="fa fa-thumbs-down"></i> Disable
                                    @else
                                    <i class="fa fa-thumbs-up"></i> Enable
                                    @endif
                                    </a>
                                    <a href="{{url('admin/faq/delete/'.$faq->id)}}" class="btn btn-xs btn-danger" onclick = "if (! confirm('Do you want to delete this faq?')) { return false; }">Delete</a>
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