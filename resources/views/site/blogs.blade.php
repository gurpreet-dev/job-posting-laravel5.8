@extends('layouts.site')
@section('content')

<article class="practise-growth-art">
    <section class="top-job-sec">
    <div class="container">
        <div class="row">
            @if(!$blogs->isEmpty())
            @foreach($blogs as $blog)
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="main-div">
                    <div class="top-img">
                        <img src="{{ \App\Hash::image('/images/blog/', $blog->image) }}">
                        <a href="{{ route('blog', [$blog->slug]) }}">view more</a>
                    </div>
                    <div class="bottom-text">
                        <h6>{{ $blog->title }}</h6>
                        {!! substr(strip_tags($blog->content), 0, 109) !!}
                                                                            
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            {{ $blogs->links() }}
            </div>
            @else
            <div class="alert alert-info">No Blogs Found!</div>
            @endif
        </div>
    </div>
    </section>
</article>

@endsection