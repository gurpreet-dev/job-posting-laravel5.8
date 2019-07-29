@extends('layouts.site')

@section('content')

<article class="forgot-art">
    <section class="forgot-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-10 col-lg-6 m-auto text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="forgot-div">
                        
                        <h4>forgot password</h4>		  
                        <form id="forgot-form" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" name="" value="Send" class="send-btn" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
$("#forgot-form").validate({
    rules:{
        email: {
            required: true,
            email: true
        }
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        }
    }
});
</script>

@endsection
