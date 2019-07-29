@extends('layouts.site')

@section('content')

<article class="register-art">
    <section class="register-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-10 col-lg-6 m-auto text-center">
                    <div class="register-div">

                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        <h4>register</h4>		  
                        <form id="applicant-form" action="{{ route('register') }}" method="post" >
                            @csrf
                            <div class="toggle-btn">
                                <span class="applicant">Applicant</span>
                                <label class="switch">
                                <input type="checkbox" name="role" value="doctor" checked>
                                    <span class="slider round"></span>
                                </label>
                                <span class="hiring-doc">hiring doc</span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <label class="error">{{ $errors->first('name') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <label class="error">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <input type="number" name="phone" placeholder="Phone Number" class="form-control" value="{{ old('phone') }}" style="display: none;">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <label class="error">{{ $errors->first('password') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
                            </div>
                            <div class="form-group form-check checkbox-input">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="tc" required><span class="custom-check"></span> I agree to the<a href="{{ url('/') }}/page/{{ \App\Config::get_field('terms_condition') != '' ?  \App\Config::get_field('terms_condition') : '#' }}" class="terms-link" target="_blank"> Terms of use </a> and <a href="{{ url('/') }}/page/{{ \App\Config::get_field('privacy_policy') != '' ?  \App\Config::get_field('privacy_policy') : '#' }}" class="terms-link" target="_blank">Privacy Policy</a> 
                                </label>
                                <label for="tc" class="error"></label>    
                            </div>
                            <div class="form-group">
                                <input type="submit" name="" value="Register" class="register-btn" >
                            </div>
                            
                        </form>
                        <div class="register-info">
                            <p>Already have an account?<a href="{{ route('login') }}"> Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script type="text/javascript">

$("#applicant-form").validate({
    rules:{
        email: {
            required: true,
            email: true
        },
        name: "required",
        phone: {
            required: true,
            minlength: 10,
            digits: true
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            minlength: 8,
            equalTo: "#password"
        },
        tc: "required"
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        name: "Name is requried",
        phone: {
            required: "Phone number is required",
            minlength: "Phone number must be at least 10 characters long",
            digits: "Enter valid phone number"
        },
        password: {
            required: "Please enter a password",
            minlength: "Your password must be at least 8 characters long"
        },
        password_confirmation: {
            required: "Please enter a password",
            minlength: "Your password must be at least 8 characters long",
            equalTo: "Please enter the same password as above"
        },
        tc: "Please accept Terms of use and Privacy Policy."
    }
});

$("input[name='role']").change(function(){
    $("input[name='phone']").toggle();
});

</script>

@endsection