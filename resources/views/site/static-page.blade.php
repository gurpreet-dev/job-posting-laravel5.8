@extends('layouts.site')
@section('content')

<article class="aboutus-art">
    <section class="aboutus-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                    <h2>{{ $page->title }}</h2>
                    <div class="about-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

@endsection