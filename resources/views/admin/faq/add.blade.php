@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Add Faq</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <form action="{{ route('addfaq') }}" id="add-course" method="post">
            @csrf

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Faq</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter title" class="form-control">
                        
                            @if ($errors->has('title'))
                                <label class="error">{{ $errors->first('title') }}</label>
                            @endif

                        </div>

                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea name="content" class="form-control"></textarea>
                        </div>
                        
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            <!-- /.box -->

            
        </div>
        <!-- /.box -->

        </form>
    </div>
    </div>
</section>    

<script>
$("#add-course").validate({
    rules:{
        title: "required",
        content: "required"
    },
    messages:{
        title: "Title is required",
        content: "Content is required"
    }
});
</script>

@endsection