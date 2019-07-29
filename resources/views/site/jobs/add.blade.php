@extends('layouts.site')
@section('content')

<article class="positions-art">
    <section class="positions-sec">
        <div class="container">
        <form id="position-form" action="{{ route('job-post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @component('components.company-detail')
                    @endcomponent
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 ">
                    @component('components.alerts')
                    @endcomponent
                    <div class="positions-div">
                        <ul id="my-tabs" class="nav nav-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#jobpost">job post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#interview-video">interview video</a>
                        </li>
                        </ul>
                        <div class="tab-content">
                            <div id="jobpost" class="container tab-pane  active">
                                <div class="form-group row featured-image">
                                    <label class="col-sm-12 col-form-label">featured image</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="featured_image" class="form-control pro-img" placeholder="">
                                        <div class="upload-div"><img src="{{ url('/') }}/images/icons/upload.svg" class="previewHolder"></div>  
                                        <div><label class="error" for="featured_image"></label></div>
                                    </div>   
                                </div>
                                <div class="form-group row view-img">
                                    <label class="col-sm-3 col-form-label">form view image</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="view_image" class="form-control pro-img" placeholder="">
                                        <div class="upload-div"><img src="{{ url('/') }}/images/icons/upload.svg" class="previewHolder"></div>
                                        <div><label class="error" for="view_image"></label></div>  
                                    </div>   
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Job Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="title" class="form-control" placeholder="Enter Job Title" value="{{ old('title') }}">
                                    </div> 
                                </div>
                                <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">email</label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control" placeholder="Company@domain.com" value="{{ old('email') }}">
                                </div> 
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Location</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="location" class="form-control" placeholder="Enter Location" value="{{ old('location') }}">
                                    </div> 
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">job region</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="regions" name="state">
                                    <option value=''>Select Job region</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">job type</label>
                                <div class="col-sm-6">
                                    @php $types = \App\Config::getJobTypes(); @endphp
                                    <select class="form-control" id="job-type" name="type">
                                    <option value=''>Select Job Type</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type }}">{{ ucwords($type) }}</option>
                                    @endforeach
                                </select>
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label pl-0 pr-0">number of vacancies</label>
                                <div class="col-sm-6">
                                    <input type="number" name="vacancies" class="form-control" placeholder="Enter no. of Vacancies" value="{{ old('vacancies') }}">
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">description</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" rows="5" id="comment" name="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    </div> 
                                </div>
                                <div class="next-btn">
                                    <button class="nav-link" id="next-nav" type="button"><img src="{{ url('/') }}/images/icons/next.png"></button>
                                </div>
                            </div> <!-- ---job-post ends here -------->

                            <div id="interview-video" class="container tab-pane fade">        
                            <div class="form-group row ">
                                <label class="col-sm-12 col-form-label highlight">interview video</label>
                                <div class="col-sm-4 thumbnail">
                                    <label>thumbnail</label>
                                    <div class="upload-div"><img src="{{ url('/') }}/images/icons/upload.svg" class="previewHolder"></div> 
                                    <input type="file" name="interview_thumbnail" class="form-control pro-img" placeholder="">
                                    <span><button type="button">Upload</button></span>
                                </div>   
                                <div class="col-sm-7 video">
                                    <label>video</label>
                                    <div class="upload-div"><img src="{{ url('/') }}/images/icons/upload.svg"></div>  
                                    <input type="file" name="interview_video" class="form-control" placeholder="">
                                    <span><button type="button">Upload</button></span>
                                </div>

                            </div>

                            <div class="form-group submit-btn">
            <input type="submit" name="" value="post" class="save-btn">
        </div>
                            
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
        </div>
    </section>
</article>

<script>
var form = $("#position-form").validate({
    //ignore: "",
    rules:{
        title: 'required',
        email: {
            required: true,
            email: true
        },
        location: 'required',
        state: 'required',
        type: 'required',
        vacancies: {
            required: true,
            digits: true
        },
        description: 'required',
        featured_image: {
            required: true,
            accept:"jpg,png,jpeg,gif"
        },
        view_image: {
            required: true,
            accept:"jpg,png,jpeg,gif"
        },
        interview_thumbnail: {
            required: true,
            accept:"jpg,png,jpeg,gif"
        },
        interview_video: {
            required: true,
            accept:"mp4"
        }
    },
    messages: {
        title: 'Title is required',
        email: {
            email: "Enter valid email address"
        },
        location: 'Location is required',
        state: 'State is required',
        type: 'Type is required',
        vacancies: {
            digits: 'Enter Valid Vacancy'
        },
        description: 'Description is required',
        featured_image: {
            accept:"Only image type jpg/png/jpeg/gif is allowed"
        },
        view_image: {
            accept:"Only image type jpg/png/jpeg/gif is allowed"
        },
        interview_thumbnail: {
            accept:"Only image type jpg/png/jpeg/gif is allowed"
        },
        interview_video: {
            accept:"Only video type mp4 is allowed"
        }
    }
});

$(document).ready(function(){
    $('.next-btn #next-nav').click(function(e){
        if(form.form()){
            e.preventDefault();
            $('#my-tabs a[href="#interview-video"]').tab('show');
        }
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(input).next('.upload-div').find('.previewHolder').attr('src', e.target.result);
            $(input).prev('.upload-div').find('.previewHolder').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".pro-img").change(function(){
    readURL(this);
});

</script>


@endsection