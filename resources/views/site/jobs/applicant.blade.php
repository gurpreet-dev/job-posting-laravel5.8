@extends('layouts.site')
@section('content')

<article class="applicantinfo-art">
    <section class="applicantinfo-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center">
                    <div class="inner-sec">
                        <div class="applicant-img">
                            <img src="{{ \App\Hash::userImage('/images/users/', $info->user->image) }}">
                        </div>
                        <div class="company-info"> 
                            <p class="app-name">{{ ucwords($info->user->name) }}</p>
                            <p>{{ $info->user->email }}</p>
                            <p>{{ $info->user->phone }}</p>
                        </div>

                        @if(\App\JobApplicant::hiredUsers($job_id) >= $job->vacancies)
                        <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Vacancies already completed!</div>
                        @else
                        @if(!empty($info) && $info->status == 0)
                        <form action="{{ route('job-applicant', [\App\Hash::encode($info->job_id), \App\Hash::encode($info->user_id)]) }}" method="post">
                            @csrf
                            <input type="submit" class="select" value="Select">
                        </form>
                        @else
                        <h3><span class="badge badge-success">Selected</span></h3>
                        @endif
                        @endif
                        
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 ">
                    <div class="applicant-info-div">
                        <h4>Applicant Info</h4>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="resume-slider">
                                
                                <embed class="currentimg" src="https://drive.google.com/viewerng/viewer?embedded=true&url={{ url('/') }}/images/documents/{{ $info->document }}" width="100%" height="375">
                            </div>
                        </div>
    
                    </div>	
                </div>
            </div>
        </div>
    </section>
</article>

@endsection