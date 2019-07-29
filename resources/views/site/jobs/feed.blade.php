@extends('layouts.site')
@section('content')

<article class="candidate-art">
    <section class="candidate-sec">
        <div class="container">
            <div class="row">
                @component('components.user-sidebar')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 ">
                    @component('components.alerts')
                    @endcomponent
                    <div class="jobapply-div">
                        <h4>Apply jobs</h4>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 ml-auto">
                            <a href="{{ route('job-feed') }}" class="btn btn btn-info">All Jobs</a>
                            <a href="{{ route('job-hired') }}" class="btn btn-outline-success">Hired</a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 ml-auto">
                            <form>
                                <select class="form-control" id="job-type">
                                <option value="">All</option>
                                @foreach(\App\Config::getJobTypes() as $type)
                                <option value="{{ $type }}" {{ $type == $job_type ? 'selected' : '' }}>{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                            </form>
                        </div>
                        @if(!$jobs->isEmpty())
                        @foreach($jobs as $job)
                        <div class="main-div">
                            <div class="row">
                            <div class="col-12 col-sm-4 col-md-4 col-lg-3">
                                <div class="job-image">
                                <img src="{{ \App\Hash::Image('/images/jobs/', $job->view_image) }}">
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-8 col-md-9">
                                <div class="content">
                                <div class="heading">
                                    <h5>{{ $job->title }}</h5>    
                                </div>
                                @if(!$job->isHired->isEmpty()))
                                <span class="status">Hired</span>
                                @elseif(!$job->applicants->isEmpty())
                                <span class="status">Already Applied</span>
                                @else
                                <a href="{{ route('job-apply', [\App\Hash::encode($job->id)]) }}" class="apply">Apply</a>
                                @endif
                                <div><span class="location">{{ $job->location != '' ? $job->location.', ' : '' }}{{ $job->state }}</span></div>
                                <a href="#" class="vacancies"><span>{{ ($job->vacancies - $job->hiredApplicants->count()) >= 0 ? $job->vacancies - $job->hiredApplicants->count() : 0 }} </span>Vacancies</a>
                                <p>{{ strlen($job->description) < 252 ? $job->description : substr($job->description, 0, 252).'...' }} </p>
                                <ul class="edit-links">
                                    <li><a href="{{ route('job-view', [\App\Hash::encode($job->id)]) }}"><img src="{{ url('/') }}/images/icons/eye.png"></a>  </li>   
                                    <li><span class="job-type">{{ $job->type }}</span></li>
                                </ul>
                                                            
                                </div>

                            </div>
                            </div>
                        </div>
                        @endforeach
                        <div id="pagination-div">
                            <!-- <ul class="pagination">
                                <li class="page-item"><a href="jobposted.html"><img src="{{ url('/') }}/images/icons/previous.png"></a></li>
                                <li class="page-item"><a href="jobposted2.html"><img src="{{ url('/') }}/images/icons/next.png"></a></li>
                            </ul> -->
                            {{ $jobs->links() }}
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

<script>
    $("#job-type").change(function(){
        var url = window.location.href.split('?')[0];
        window.location.href = url+'?type='+$(this).val();
    });
</script>

@endsection