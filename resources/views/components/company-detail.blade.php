@php

$company = DB::table('companies')->where('user_id', Auth::id())->first();
$address = DB::table('addresses')->where('user_id', Auth::id())->first();

@endphp

<div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center">
    <div class="inner-sec">
        @if(!empty($company))
        <img src="{{ \App\Hash::image('/images/company/', $company->image) }}" width="100%">
        <span class="company-name">{{ $company->name }}</span>
        <span class="tagline">{{ $company->tagline }}</span>
        <p>{{ $company->description }}</p>
        <span class="location">{{ $address->address_1 != '' ? $address->address_1.', ' : '' }}{{ $address->address_2 != '' ? $address->address_2.', ' : '' }}{{ $address->state != '' ? $address->state.', ' : '' }}{{ $address->city != '' ? $address->city.', ' : '' }}{{ $address->zipcode != '' ? $address->zipcode.' ' : '' }}</span>
        <div class="company-info"> 
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
        @if(Route::currentRouteName() == 'job-post')
        <!-- <div class="form-group submit-btn">
            <input type="submit" name="" value="post" class="save-btn">
        </div> -->
        @endif
        @else
        <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Company details has been inserted yet!</div>
        @endif
    </div>
</div>