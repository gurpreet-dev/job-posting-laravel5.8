@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Add Page</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add new page</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="page-add" method="post" action="{{route('addpage')}}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                        
                            @if ($errors->has('title'))
                                <label class="error">{{ $errors->first('title') }}</label>
                            @endif

                        </div>

                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea name="content" class="form-control page-textarea summernote" required></textarea>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box -->

    </div>
</section>    

<script>
$("#page-add").validate();
</script>

@endsection