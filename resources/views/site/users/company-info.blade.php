@extends('layouts.site')
@section('content')

<article class="profile-art">
    <section class="profile-sec">
        <div class="container">
            <div class="row">
                @component('components.user-sidebar')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 ">
                    @component('components.alerts')
                    @endcomponent
                    <div class="company-detail-div">
                        <h4>Company Details</h4>
                        @component('components.company-nav')
                        @endcomponent
                        <div class="tab-content">
                            <div id="company-info" class="container">
                                <form class="company-form" method="post" action="{{ route('company-info') }}" id="exp-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Company Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="name" class="form-control" placeholder="Enter Company Name" value="{{ !empty($company) ? $company->name : old('name') }}" required=""> 
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tagline</label>
                                            <div class="col-sm-6">
                                            <input type="text" name="tagline" class="form-control" placeholder="Enter Tagline" value="{{ !empty($company) ? $company->tagline : old('tagline') }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-6">
                                            <textarea class="form-control" rows="5" id="comment" name="description" placeholder="Description" required>{{ !empty($company) ? $company->description : old('description') }}</textarea>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Website</label>
                                            <div class="col-sm-6">
                                            <input type="url" name="website" class="form-control" id="url" placeholder="url/" value="{{ !empty($company) ? $company->website : old('website') }}" required>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-12 col-form-label social-links ">Social Links</label>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label fb-icon"><img src="{{ url('/') }}/images/icons/facebook.svg"></label>
                                        <div class="col-sm-6">
                                                <input type="text" name="facebook_link" class="form-control" placeholder="Facebook Page URL" value="{{ !empty($company) ? $company->facebook_link : old('facebook_link') }}">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label twitter-icon"><img src="{{ url('/') }}/images/icons/twitter.svg"></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="twitter_link" class="form-control" placeholder="Twitter Page URL" value="{{ !empty($company) ? $company->twitter_link : old('twitter_link') }}" >
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label linkedin-icon"><img src="{{ url('/') }}/images/icons/linkedin.svg"></label>
                                        <div class="col-sm-6">
                                                <input type="text" name="linkedin_link" class="form-control" placeholder="Linkedin Page URL" value="{{ !empty($company) ? $company->linkedin_link : old('linkedin_link') }}">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row custom-upload">
                                        <label class="col-sm-3 col-form-label">Logo</label>
                                        <div class="col-sm-6">
                                            <div class="upload-div">
                                            @if(!empty($company))
                                            <img src="{{ \App\Hash::Image('/images/company/', $company->image) }}" id="preview">
                                            @else
                                            <img src="{{ url('/') }}/images/icons/upload.svg" id="preview">
                                            @endif
                                            </div>
                                            <input id="logo-img" type="file" name="image" class="form-control" >
                                            <span><button type="button">Choose Image</button></span>
                                            <div>
                                                <label class="error" for="image"></label>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="form-group text-center">
                                    <input type="submit" name="" value="save" class="save-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </section>
</article>

<script>

$("#exp-form").validate({
    rules:{
        image: {
            accept:"jpg,png,jpeg,gif"
        }
    },
    messages: {
        image: {
            accept:"Only image type jpg/png/jpeg/gif is allowed"
        }
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#logo-img").change(function(e){
    
    readURL(this);
});


</script>

@endsection