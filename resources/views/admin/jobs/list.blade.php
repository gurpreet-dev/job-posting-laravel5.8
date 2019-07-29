@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>All Jobs</h1>
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
                                <th>Title</th>
                                <th>User</th>
                                <th>Location</th>
                                <th>Applicants</th>
                                <th>Uploaded on</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{ ucwords($data->title) }}</td>
                                <td><a href="{{ route('viewuser', [$data->user->id]) }}">{{ ucwords($data->user->name) }}</a></td>
                                <td>{{ ucwords($data->location) }}</td>
                                <td>{{ $data->applicants->count() }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                @if($data->hired_user == null)
                                <span class="label label-warning">Pending</span>
                                @elseif($data->hired_user != null)
                                <span class="label label-success">Hired</span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.job-view', $data->id)}}" class="btn btn-xs btn-info">View</a>
                                    <a href="{{ route('admin.job-applicants', $data->id)}}" class="btn btn-xs btn-success">Applicants</a>  
                                    <a href="{{ route('admin.job-delete', $data->id) }}" class="btn btn-xs btn-danger" onclick = "if (! confirm('Do you want to delete this job?')) { return false; }">Delete</a>       
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

<section class="content">
    <div class="row">
        <div class="col-md-6">

            <form action="{{ route('set-featured-jobs') }}" method="post" id="add-user">
            @csrf

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Top Rated Jobs</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">
                        <div class="form-group">
                            <select class="form-control" name="featured[]" id="featured_teachers" multiple="multiple">
                                <option>--Select--</option>
                                @foreach($jobs as $data)
                                <option value="{{ $data->id }}" {{ $data->featured == 1 ? 'selected' : '' }}>{{ ucwords($data->title).' (ID:'.$data->id.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                
            </div>
            <!-- /.box -->
            </form>
        </div>
    </div>
</section>
            
<script>
    
$(document).ready(function() {
    $('#featured_teachers').select2({
        maximumSelectionLength: 3
    });
});
    
$("#filter-status").change(function(){
    var url = window.location.href.split('?')[0];
    window.location.href = url+'?status='+$(this).val();
});
</script>

@endsection