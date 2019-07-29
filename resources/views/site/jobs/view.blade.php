@extends('layouts.site')
@section('content')

<article class="positions-art">
    <section class="positions-sec">
        <div class="container">
                <div class="row">
                    
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center">
                        <div class="inner-sec">
                            @if(!empty($company))
                            <img src="{{ \App\Hash::Image('/images/companies/', $company->image) }}" width="100%">
                            <span class="company-name">{{ $company->name }}</span>
                            <span class="tagline">{{ $company->tagline }}</span>
                            <p>{{ $company->description }}</p>
                            <span class="location">{{ $address->address_1 != '' ? $address->address_1.', ' : '' }}{{ $address->address_2 != '' ? $address->address_2.', ' : '' }}{{ $address->state != '' ? $address->state.', ' : '' }}{{ $address->city != '' ? $address->city.', ' : '' }}{{ $address->zipcode != '' ? $address->zipcode.' ' : '' }}</span>
                            <div class="company-info"> 
                            <a href="#">{{ $company->email }}</a>
                            <span>{{ strtolower($company->website) }}</span>
                            </div>
                            <ul class="social-links">
                            @if($company->facebook_link != '' || $company->facebook_link != null)
                            <li><a href="{{ $company->facebook_link }}"><img src="{{ url('/') }}/images/icons/facebook.svg"></a></li>
                            @endif

                            @if($company->twitter_link != '' || $company->twitter_link != null)
                            <li><a href="{{ $company->twitter_link }}"><img src="{{ url('/') }}/images/icons/twitter.svg"></a></li>
                            @endif

                            @if($company->linkedin_link != '' || $company->linkedin_link != null)
                            <li><a href="{{ $company->linkedin_link }}"><img src="{{ url('/') }}/images/icons/linkedin.svg"></a></li>
                            @endif
                            </ul>
                            @else
        <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Company details has been inserted yet!</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 ">
                        <div class="positions-div">
                            <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#jobpost">job post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#interview-video">interview video</a>
                            </li>
                            </ul>
                            <div class="tab-content">
                                <div id="jobpost" class="container tab-pane  active">
                                <form id="jobpost-form">
                                        <div class="form-group row featured-image">
                                        <label class="col-sm-12 col-form-label">featured image</label>
                                        <div class="col-sm-9">
                                            <div class="image-div"><img src="{{ \App\Hash::Image('/images/jobs/', $job->featured_image) }}"></div>  
                                        </div>   
                                    </div>
                                    <div class="form-group row view-img">
                                        <label class="col-sm-3 col-form-label">form view image</label>
                                        <div class="col-sm-6">
                                            <div class="image-div"><img src="{{ \App\Hash::Image('/images/jobs/', $job->view_image) }}"></div>  
                                        </div>   
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Job Title</label>
                                        <div class="col-sm-6">
                                            <span class="form-control">{{ $job->title }}</span>
                                        </div> 
                                        </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">email</label>
                                        <div class="col-sm-6">
                                        <span class="form-control">{{ $job->email }}</span>
                                        </div> 
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Location</label>
                                        <div class="col-sm-6">
                                        <span class="form-control">{{ $job->location }}</span>
                                        </div> 
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">job region</label>
                                    <div class="col-sm-6">
                                    <span class="form-control">{{ $job->state }}</span>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">job type</label>
                                    <div class="col-sm-6">
                                    <span class="form-control">{{ $job->type }}</span>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label pl-0 pr-0">number of vacancies</label>
                                    <div class="col-sm-6">
                                    <span class="form-control">{{ $job->vacancies }}</span>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">description</label>
                                        <div class="col-sm-6">
                                            <span class="form-control">{{ $job->description }}</span>
                                        </div> 
                                    </div>
                                    
                            </form>
                                </div> <!-- ---job-post ends here -------->

                                <div id="interview-video" class="container tab-pane fade">   
                                <form class="interviewedit-form">
                                    <div class="form-group row video-edit">
                                        <label class="col-sm-12 col-form-label highlight">interview video</label>
                                        <div class="col-sm-7">
                                        <div class="video-div">
                                            <iframe width="100%" src="{{ \App\Hash::Image('/images/jobs/', $job->interview_video) }}">
                                            </iframe>  
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-sm-12 thumbnail">
                                        <label>thumbnail</label>
                                            <div class="video-div">
                                            <img width="100%" src="{{ \App\Hash::Image('/images/jobs/', $job->interview_thumbnail) }}">
                                            </div>
                                            
                                        </div>   
                                        <!-- <div class="col-sm-7 video">
                                        <label>video</label>
                                        <div class="video-div">
                                            <iframe width="100%" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                                            </iframe>  
                                        </div>  
                                        <input type="file" name="" class="form-control" placeholder="">
                                        
                                        </div> -->
                                    </div>
                            
                                </form>     
                        
                                
                                </div><!--  interview -view ends here -->
                            </div>
                        </div>
                        
                    </div>
                </div>
        </form>
        </div>
    </section>
</article>

@endsection