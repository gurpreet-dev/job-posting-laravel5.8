@extends('layouts.site')
@section('content')

<article class="appliedjobs-art">
    <section class="appliedjobs-sec">
        <div class="container">
            <div class="row">
                @component('components.company-detail')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 ">
                        @component('components.alerts')
                        @endcomponent
                        <div class="appliedjobs-div">
                        <h4>Applied jobs</h4>

                        @if(!$applicants->isEmpty())
                        @foreach($applicants as $user)

                        <div class="main-div">
                            <div class="row">
                                <div class="col-sm-4 col-md-3 col-lg-3">
                                <div class="job-image">
                                    <img src="{{ \App\Hash::userImage('/images/users/', $user->user->image) }}">
                                </div>
                                </div>
                                <div class=" col-sm-8 col-md-7 col-md-9">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5>{{ ucwords($user->user->name) }}</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 ">
                                        <div id="applicant-info">
                                        @if($user->status == 1)
                                        <img src="{{ url('/') }}/images/icons/selected.png">
                                        @endif
                                        <a href="{{ route('job-applicant', [\App\Hash::encode($user->job->id), \App\Hash::encode($user->user_id)]) }}" >Applicant Info</a>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-9 ">
                                    <div><span class="job-type">{{ $user->job->type }}</span></div>
                                    <p>{{ strlen($user->job->description) < 252 ? $user->job->description : substr($user->job->description, 0, 252).'...' }}</p>     
                                    </div>
                                    </div>
                                                
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div id="pagination-div">
                            {{ $applicants->links() }}
                        </div>
                        @else
                        <div class="main-div">
                            <div class="col-md-12">
                                <div class="alert alert-info">No Records Found</div>
                            </div>
                        </div>
                        @endif

                    </div>	
                </div>
            </div>
        </div>
    </section>
</article>

@endsection