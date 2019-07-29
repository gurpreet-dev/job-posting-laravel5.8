@extends('layouts.site')
@section('content')

<article class="profile-art">
    <section class="profile-sec">
        <div class="container">
            <div class="row">
                @component('components.user-sidebar')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 ">
                    <div class="text-center">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    </div>
                    <div class="changepsw-div">
                        <h4>Change Password</h4>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-7 m-auto">
                            <form class="changepsw-form" method="post" action="{{ route('change-password') }}" id="chpass">
                                @csrf
                                <div class="form-group ">
                                    <input type="password" class="form-control" name="opassword" placeholder="Current Password">         
                                </div>
                                <div class="form-group ">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="New Password">   
                                </div>
                                <div class="form-group ">
                                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">         
                                </div>
                                <div class="form-group text-center">
                                <input type="submit" value="save">
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</article>

<script>
$("#chpass").validate({
    rules:{
        opassword: "required",
        password: {
            required: true,
            minlength: 8
        },
        cpassword: {
            required: true,
            minlength: 8,
            equalTo: "#password"
        }
    },
    messages:{
        opassword: "Current Password is required",
        password: {
            required: "New Password is required",
            minlength: "Your password must be at least 8 characters long"
        },
        cpassword: {
            required: "Confirm Password is required",
            minlength: "Your password must be at least 8 characters long",
            equalTo: "New and confirm password is not matched"
        }
    }
});
</script>

@endsection