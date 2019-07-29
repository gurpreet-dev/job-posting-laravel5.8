@extends('layouts.site')
@section('content')

<article class="contact-art">
    <section class="contact-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-7 col-lg-7 ">
                    <h2>contact us</h2>
                    <div class="address">
                        <p>Contact Address : {{ \App\Config::get_field('address') }} </p>
                        <p>Telephone : {{ \App\Config::get_field('phone') }}</p>
                        <p>Email : {{ \App\Config::get_field('email') }}</p>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('contact-us') }}" method="post" id="contact-form">
                    @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control" placeholder="Enter your Name" value="{{ old('name') }}">
                            </div>  
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control" placeholder="Enter your Email" value="{{ old('email') }}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" name="subject" class="form-control" placeholder="Enter your Subject" value="{{ old('subject') }}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="5" id="comment" name="content" placeholder="Description here...">{{ old('content') }}</textarea>
                            </div>  
                        </div>
                        <div class="form-group">
                            <input type="submit" name="" class="submit-btn">
                        </div>
                    </form>
                        </div>
                <div class="col-12 col-sm-12 col-md-5 col-lg-5 ">
                    <div class="image">
                        <img src="images/contactus.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script type="text/javascript">

$("#contact-form").validate({
    rules:{
        email: {
            required: true,
            email: true
        },
        name: "required",
        subject: "required",
        content: "required",
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        name: "Name is requried",
        subject: "Subject is required",
        content: "Description is required"
    }
});

</script>


@endsection