@extends('layouts.site')

@section('content')

<article class="login-art">
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-10 col-lg-6 m-auto text-center">
                    @component('components.alerts')
                    @endcomponent
                    <div class="login-div">
                        <h4>{{ __('Login') }}</h4>
                        @if(!isset($_GET['redirectto']))
                        @php $action = route('login'); @endphp
                        @else
                        @php $action = url('/').'/login?redirectto='.$_GET['redirectto']; @endphp
                        @endif		  
                        <form id="login-form" method="POST" action="{{ $action }}">
                            @csrf
                            <div class="form-group">
                                <span class="applicant">Applicant</span>
                                <label class="switch">
                                <input type="checkbox" name="role" value="doctor" {{ old('role') == null ? '' : 'checked' }}>
                                    <span class="slider round"></span>
                                </label>
                                <span class="hiring-doc">hiring doc</span>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ isset($_GET['email']) ? $_GET['email'] : old('email') }}" required>
                                @if ($errors->has('email'))
                                <label class="error">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <label class="error">{{ $errors->first('password') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" name="" value="Login" class="login-btn" >
                            </div>
                        </form>
                        <div class="forgot-psw">
                            <a href="{{ url('/password/reset') }}">Forgot Password?</a>
                        </div>
                        <div class="register-div">
                            <p>Don't have an account ? <a href="{{ route('register') }}">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script type="text/javascript">

$("#login-form").validate({
    rules:{
        email: {
            required: true,
            email: true
        },
        password: "required"
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        password: "Please enter a password"
    }
});
</script>

@endsection
