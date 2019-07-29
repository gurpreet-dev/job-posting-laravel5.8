@extends('layouts.site')
@section('content')

<article class="faq-art">
    <section class="faq-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                    <h2>faq's</h2>
                    @if(!$faqs->isEmpty())
                    <div id="accordion">
                        @php $i = 1; @endphp
                        @foreach($faqs as $faq)
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapse{{ $i }}">
                                Q.   {{ $faq->title }}

                                </a>
                            </div>
                            <div id="collapse{{ $i }}" class="collapse {{ $i == 1 ? 'show' : '' }}" data-parent="#accordion">
                                <div class="card-body">
                                <span>Ans.  </span>{{ $faq->content }}
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                    {{ $faqs->links() }}
                    @else
                    <div class="alert alert-info">No faq's found yet!</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</article>

@endsection