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
        

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Info</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-condensed">
              <tbody>
                <tr>
                  <th>Application ID</th>
                  <td>{{ $applicant->id }}</td>
                </tr>
                <tr>
                  <th>Job ID</th>
                  <td>{{ $applicant->job_id }}</td>
                </tr>
                <tr>
                  <th>Job Title</th>
                  <td><a href="{{ route('admin.job-view', [$applicant->job_id]) }}">{{ ucwords($applicant->job->title) }}</a></td>
                </tr>
                <tr>
                  <th>User ID</th>
                  <td>{{ $applicant->user_id }}</td>
                </tr>
                <tr>
                  <th>User Name</th>
                  <td><a href="{{ route('viewuser', [$applicant->user_id]) }}">{{ ucwords($applicant->user->name) }}</a></td>
                </tr>

                <tr>
                  <th>Applied on</th>
                  <td>{{ $applicant->created_at }}</td>
                </tr>

                <tr>
                  <th>Document</th>
                  <td>
                  <embed class="currentimg" src="https://drive.google.com/viewerng/viewer?embedded=true&url={{ url('/') }}/images/documents/{{ $applicant->document }}" width="100%" height="375">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>

    </div>
</section>  
@endsection     