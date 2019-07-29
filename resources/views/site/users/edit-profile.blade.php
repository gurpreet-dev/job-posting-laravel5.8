@extends('layouts.site')
@section('content')

<article class="profile-art">
    <section class="profile-sec">
        <div class="container">
            <div class="row">
                @component('components.user-sidebar')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 text-center">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="profile-div">
                        <h4>Profile</h4>
                        <form class="profile-form" method="post" action="{{ route('edit-profile') }}" id="edit-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="avatar-wrapper">
                                    <div class="avatar">
                                        <img src="{{ App\Hash::userImage('/images/users/', Auth::user()->image) }}" id="preview">
                                    </div>
                                    <input type="file" name="image" class="form-control" id="pro-img">
                                    <span><img src="{{ url('/') }}/images/icons/photo-camera.png"></span>
                                </div>	
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="John doe" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group disabled-input">
                                <input type="email" name="email" class="form-control" placeholder="johndoe@gmail.com" value="{{ Auth::user()->email }}">
                                <!-- <i class="fas fa-ban"></i>       -->
                                @if ($errors->has('email'))
                                    <label class="error">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" class="submit-btn" value="Save" >
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</article>


<script type="text/javascript">

$("#edit-form").validate({
    rules:{
        email: {
            required: true,
            email: true
        },
        name: "required",
        address: "required",
        image: {
            accept:"jpg,png,jpeg,gif"
        }
    },
    messages:{
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        name: "Name is requried",
        address: "Address is required",
        image: {
            accept: "Only image type jpg/png/jpeg/gif is allowed"
        }
    }
});

/*******************/

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#pro-img").change(function(){
    readURL(this);
});

</script>

@endsection