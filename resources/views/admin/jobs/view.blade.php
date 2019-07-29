@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>
    Job view
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
        
@php //dd($job); @endphp
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
                  <td>{{ $job->id }}</td>
                </tr>
                <tr>
                  <th>Title</th>
                  <td>{{ ucwords($job->title) }}</td>
                </tr>
                <tr>
                  <th>Uploaded By</th>
                  <td><a href="{{ route('viewuser', $job->user->id) }}" target="_blank">{{ ucwords($job->user->name) }}</a></td>
                </tr>
                <tr>
                  <th>Hired User</th>
                  @if(!empty($job->hiredUser))
                  <td><a href="{{ route('viewuser', [$job->hiredUser->id]) }}" target="_blank">{{ ucwords($job->hiredUser->name) }}</a></td>
                  @else
                  <td><span class="label label-info">No User Hired!</span></td>
                  @endif
                </tr>
                <tr>
                  <th>Address</th>
                  <td>{{ $job->location != '' ? $job->location.',' : '' }} {{ $job->state != '' ? $job->state.',' : '' }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><a href="mailto:{{ $job->email }}">{{ $job->email }}</a></td>
                </tr>
                <tr>
                  <th>Vacancies</th>
                  <td>{{ $job->vacancies }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>{{ $job->description }}</td>
                </tr>
                <tr>
                  <th>Featured Image</th>
                  <td><img src="{{ \App\Hash::image('/images/jobs/', $job->featured_image) }}" width="200px"></td>
                </tr>
                <tr>
                  <th>Form View Image</th>
                  <td><img src="{{ \App\Hash::image('/images/jobs/', $job->view_image) }}" width="200px"></td>
                </tr>
                <tr>
                  <th>Interview Thumbnail</th>
                  <td><img src="{{ \App\Hash::image('/images/jobs/', $job->interview_thumbnail) }}" width="200px"></td>
                </tr>
                <tr>
                  <th>Interview Video</th>
                  <td>
                  <video controls>
                    <source src="{{ \App\Hash::image('/images/jobs/', $job->interview_video) }}" type="video/mp4">
                  </video>
                  </td>
                </tr>
                <tr>
                  <th>Uploaded on</th>
                  <td>{{ $job->created_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>

    </div>
</section>  
@endsection     