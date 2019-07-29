@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Edit {{ Auth::user()->role == 'admin' ? 'Profile' : 'User' }}</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            <form method="post" action="{{ route('edituser', $user->id) }}" id="add-user" enctype="multipart/form-data">
            @csrf

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Primary</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">
                        <div class="form-group">
                        <label class="control-label">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email }}">
                        
                            @if ($errors->has('email'))
                                <label class="error">{{ $errors->first('email') }}</label>
                            @endif

                        </div>

                        <div class="form-group">
                        <label class="control-label">Role</label>
                            <select class="form-control" name="role">
                                <option value="">--select role--</option>
                                @foreach(\App\User::roles() as $key => $value)
                                <option value="{{ $key }}" {{ $user->role == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                         <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status" value="1" {{ $user->status == 1 ? 'checked': '' }}> Active
                            </label>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                    
                
            </div>
            <!-- /.box -->


            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Info</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input type="number" class="form-control" name="phone" placeholder="Enter Phone" value="{{ $user->phone }}" required>
                        </div>

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
</section>    

<script>
$("#add-user").validate({
    rules:{
        email: {
            required: true,
            email: true
        },
        role: "required",
        name: "required",        
        phone: {
            required: true,
            minlength: 10,
            digits: true
        },
        address: "required",
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        role: "Select appropriate role",
        name: "Name is requried",
        phone: {
            required: "Phone is requried",
            minlength: "Phone must be at least 8 characters long",
            digits: "Enter valid phone number"
        },
        address: "Please enter address",
    }
});
</script>

@endsection