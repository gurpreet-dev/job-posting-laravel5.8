@if(Auth::user()->role == 'doctor')
<div class="col-12 col-sm-12 col-md-12 col-lg-4">
    <div class="head-sec">
            @if(Auth::user()->subscribed == null)
            @php
            $subscriptions = DB::table('subscriptions')->where('user_id', Auth::user()->id)->get();
            @endphp
            @if(!$subscriptions->isEmpty())
            <span class="badge badge-warning"><i class="fa fa-exclamation-triangle"></i> Subscription Expired</span>
            @else
            <span class="badge badge-info"><i class="fa fa-exclamation-triangle"></i> Click <a href="{{ url('/') }}/#subscription-plans">here</a> to subscribe in order to post a job.</span>
            @endif
            @else
            @php
            $subscription = \App\Subscription::where('id', Auth::user()->subscription_id)->first();
            $jobs = DB::table('jobs')->where('created_at', '>=', $subscription->payment_date)->count();
            @endphp
            <h5>{{ strtoupper(\App\SubscriptionPlan::getPlan(Auth::user()->plan_id)->title) }}- <span>{{ $jobs }}/{{ \App\SubscriptionPlan::getFeature('jobs_limit', Auth::user()->plan_id) }} Job Post</span></h5>
            @endif
        </div>
    <div class="inner-sec">
        <div class="sidebar-outer">
            <div class="menu_sec">
                <ul>
                    <li><a href="{{ route('user-profile') }}" class="{{ Route::currentRouteName() == 'user-profile' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/avatar.svg" alt="Icon">Profile</a></li>
                    <li><a href="{{ route('change-password') }}" class="{{ Route::currentRouteName() == 'change-password' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/lock.svg" alt="Icon">Change Password</a></li>
                    <li><a href="{{ route('address') }}" class="{{ Route::currentRouteName() == 'address' || Route::currentRouteName() == 'company-info' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/company-detail.png" alt="Icon">Company Details</a></li>
                    <li><a href="{{ route('job-posted') }}" class="{{ Route::currentRouteName() == 'job-posted' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/job-posted.png" alt="Icon">Jobs Posted</a></li>
                    <li><a href="{{ route('user-payment') }}" class="{{ Route::currentRouteName() == 'user-payment' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/credit-card.svg" alt="Icon">Payment Method</a></li>
                    <li><a href="{{ route('share-experience') }}" class="{{ Route::currentRouteName() == 'share-experience' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/share.png" alt="Icon">Share Your Experience</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-12 col-sm-12 col-md-12 col-lg-4">
    <div class="inner-sec">
        <div class="sidebar-outer">
            <div class="menu_sec">
                <ul>
                    <li><a href="{{ route('user-profile') }}" class="{{ Route::currentRouteName() == 'user-profile' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/avatar.svg" alt="Icon">Profile</a></li>
                    <li><a href="{{ route('change-password') }}" class="{{ Route::currentRouteName() == 'change-password' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/lock.svg" alt="Icon">Change Password</a></li>
                    <li><a href="{{ route('job-feed') }}" class="{{ Route::currentRouteName() == 'job-feed' ? 'active' : '' }}"><img src="{{ url('/') }}/images/icons/job-posted.svg" alt="Icon">Job Apply</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif