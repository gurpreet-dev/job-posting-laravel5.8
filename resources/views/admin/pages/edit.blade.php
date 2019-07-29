@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Edit Page</h1>
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
                    <h3 class="box-title">Edit page</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="page-edit" method="post" action="{{route('editpage', ['id' => $page->id])}}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ $page->title }}" required>
                        
                            @if ($errors->has('title'))
                                <label class="error">{{ $errors->first('title') }}</label>
                            @endif

                        </div>

                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea name="content" class="form-control page-textarea summernote" required>{{ $page->content }}</textarea>
                        </div>

                        <div class="checkbox">
                        <label>
                            <input type="checkbox" name="status" value="1" {{ $page->status == 1 ? 'checked' : '' }}> Active
                        </label>
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
$("#page-edit").validate();
</script>

@endsection