@extends('layouts.site')

@section('content')

<article class="reset-art">
    <section class="reset-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-10 col-lg-6 m-auto text-center">
                    <div class="reset-div">
                        <h4>Reset password</h4>
                        <form id="reset-form" method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <input type="email"  name="email" value="{{ $email ?? old('email') }}" autocomplete="email" class="form-control" placeholder="Enter Email" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password"  name="password" id="password" autocomplete="new-password" class="form-control" placeholder="New Password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password_confirmation" autocomplete="new-password" class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="" value="Save" class="send-btn" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
$("#reset-form").validate({
    rules:{
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            minlength: 8,
            equalTo: "#password"
        }
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        password: {
            required: "Please provide new password",
            minlength: "Your password must be at least 8 characters long"
        },
        password_confirmation: {
            required: "Please provide confirm password",
            minlength: "Your password must be at least 8 characters long",
            equalTo: "Please enter the same password as above"
        }
    }
});
</script>

@endsection
