@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
    Faq view
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>
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
          <div class="box-header">
            <h3 class="box-title">Info</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-condensed">
            <tbody>
                <tr>
                  <th>ID</th>
                  <td>{{ $faq->id }}</td>
                </tr>
                <tr>
                  <th>Title</th>
                  <td>{{ ucwords($faq->title) }}</td>
                </tr>

                <tr>
                  <th>Content</th>
                  <td>{{ ucwords($faq->content) }}</td>
                </tr>

                <tr>
                  <th>Created on</th>
                  <td>{{ $faq->created_at }}</td>
                </tr>
                <tr>
                  <td>
                  <a href="{{url('admin/faq/edit/'.$faq->id) }}" class="btn btn-success">Edit</a>
                  </td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>


    </div>
</section>  
@endsection     