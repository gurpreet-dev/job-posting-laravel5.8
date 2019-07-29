@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Send a response</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Send a response</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="contact-form" method="post" action="{{route('admin.editContact', ['id' => $contact->id])}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" name="name" value="{{ $contact->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" name="email" value="{{ $contact->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Subject</label>
                            <input type="text" name="subject" value="{{ $contact->subject }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="content" class="form-control">{{ $contact->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Reply</label>
                            <textarea name="reply" class="form-control">{{ $contact->reply }}</textarea>
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
    </div>
</section>    
<script>
$("#contact-form").validate({
    rules:{
        email: {
            required: true,
            email: true
        },
        name: "required",
        message: "required",
        reply: "required"
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        name: "Name is required",
        message: "Message is required",
        message: "Reply is required"
    }
});
</script>
@endsection