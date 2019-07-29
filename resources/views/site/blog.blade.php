@extends('layouts.site')
@section('content')

<article class="blog-art">
    <section class="blog-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                    <div class="blog-img">
                <img src="{{ \App\Hash::image('/images/blog/', $blog->image) }}">
                </div>
                <div class="info">
                <div id="head-sec">
                    <h4>blog details</h4>
                    <p>{{ $blog->title }}</p>
                </div>
                <div id="acc-detail">
                    <p>Admin <span id="time">{{ date('M d, Y', strtotime($blog->created_at)) }}</span></p>
                    
                </div>
                {!! $blog->content !!}
                </div>
                </div>
    
            </div>
        </div>
    </section>
</article>

@endsection