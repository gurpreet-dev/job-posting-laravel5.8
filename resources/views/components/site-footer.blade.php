<footer>
    <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="logo-image">
                            <a href="{{ url('/') }}">
                            @if(\App\Config::get_field('logo') != '')
                            <img src="{{ url('/') }}/images/config/{{ \App\Config::get_field('logo') }}">
                            @else
                            {{ \App\Config::get_field('site_title') }}
                            @endif
                            </a>
                        </div>
                        <a href="mailto:{{ \App\Config::get_field('email') }}" class="contact-info">{{ \App\Config::get_field('email') }}</a>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <h4>quick links</h4>
                        <ul class="quick-links">
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ route('job-post') }}">positions</a></li>
                            <li><a href="{{ route('blogs') }}">practise growth interviews</a></li>
                            
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <h4>who we are</h4>
                        <ul class="info-links">
                            <li><a href="{{ \App\Config::get_field('about_us') != '' ? route('page-view', \App\Config::get_field('about_us')) : '#' }}"> about us</a></li>
                            <li><a href="{{ route('faq') }}">faq</a></li>
                            <li><a href="{{ route('contact-us') }}">contact us</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <h4>get in touch</h4>
                        <ul class="social-links">
                            <li>
                            <a href="{{ \App\Config::get_field('facebook_link') != '' ?  \App\Config::get_field('facebook_link') : '#' }}"><img src="{{ url('/') }}/images/icons/facebook.svg"></a>
                            </li>
                            <li>
                                <a href="{{ \App\Config::get_field('twitter_link') != '' ?  \App\Config::get_field('twitter_link') : '#' }}"><img src="{{ url('/') }}/images/icons/twitter.svg"></a>
                            </li>
                            <li>
                                <a href="{{ \App\Config::get_field('linkedin_link') != '' ?  \App\Config::get_field('linkedin_link') : '#' }}"><img src="{{ url('/') }}/images/icons/linkedin.svg"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <div class="disclaimer">
                            <p>{!! \App\Config::get_field('disclaimer') !!}</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-12 col-md-12 col-lg-12 text-center">
                    <div class="copyright-div">
                        <p>{{ \App\Config::get_field('copyright') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>