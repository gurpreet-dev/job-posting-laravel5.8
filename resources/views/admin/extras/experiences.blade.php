@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>User Experiences</h1>
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
                                <th>Name</th>
                                <th>Experience</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($experiences as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td><a href="{{ route('viewuser', [$data->user->id]) }}">{{ ucwords($data->user->name) }}</a></td>
                                <td>{{ $data->content }}</td>
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

            <form action="{{ route('set-featured-experience') }}" method="post" id="add-user">
            @csrf

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Featured Experiences</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">
                        <div class="form-group">
                            <select class="form-control" name="featured[]" id="featured_teachers" multiple="multiple">
                                <option>--Select--</option>
                                @foreach($experiences as $data)
                                <option value="{{ $data->id }}" {{ $data->featured == 1 ? 'selected' : '' }}>ID: {{ $data->id }} || By: {{ $data->user->name }}</option>
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
        //maximumSelectionLength: 3
    });
});

</script>  

@endsection