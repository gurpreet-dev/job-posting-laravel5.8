@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Add User</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <form action="{{ route('add_blog') }}" id="add-cc" method="post" enctype="multipart/form-data">
            @csrf

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Blog</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" placeholder="Enter title" value="{{ old('title') }}" class="form-control">
                        
                            @if ($errors->has('title'))
                                <label class="error">{{ $errors->first('title') }}</label>
                            @endif

                        </div>

                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea class="form-control summernote" placeholder="Enter Content" name="content"></textarea>
                        
                            @if ($errors->has('content'))
                                <label class="error">{{ $errors->first('content') }}</label>
                            @endif

                        </div>
                        <div class="form-group">
                            <label class="control-label">Featured Image</label>
                            <input type="file" name="image2" id="upload" class="form-control">
                        </div>
                        <div class="form-group"style="overflow: hidden;">
                            <div class="col-md-4 text-center">
                                <div id="upload-demo" style="width:350px; display: none;"></div>
                            </div>
                        </div>
                        <input type="hidden" name="image">
                    </div>
                        
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary upload-result">Submit</button>
                    </div>
            </div>
            <!-- /.box -->

            
        </div>
        <!-- /.box -->

        </form>
    </div>
</section>    

<script>
$("#add-cc").validate({
    rules:{
        title: "required",
        content: "required",
        image2: {
            required: true,
            accept:"jpg,png,jpeg,gif"
        }
    },
    messages:{
        title: "Title is requried",
        content: "Content is required",
        image2: {
            required: "Please select Image",
            accept: "Only image type jpg/png/jpeg/gif is allowed"
        }
    }
});
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 684,
        height: 284,
        type: 'rectangular'
    },
    boundary: {
        width: 700,
        height: 350
    }
});
$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
$(".previewHolder").hide();
            $("#upload-demo").show();
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});
$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: {
            width: 1110,
            height: 367
        }
	}).then(function (resp) {
        $("input[name='image']").val(resp);
	});
});
</script>

@endsection