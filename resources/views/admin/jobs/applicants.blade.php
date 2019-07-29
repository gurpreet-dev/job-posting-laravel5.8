@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>{{ ucwords($job->title) }}'s Applicants</h1>
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
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Apply Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job->applicants as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td><a href="{{ route('viewuser', [$data->user->id]) }}">{{ ucwords($data->user->name) }}</a></td>
                                <td>{{ $data->user->email }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.job-applicant', $data->id)}}" class="btn btn-xs btn-info">View Application</a>         
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