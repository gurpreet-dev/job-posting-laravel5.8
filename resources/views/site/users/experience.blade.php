@extends('layouts.site')
@section('content')

<article class="profile-art">
    <section class="profile-sec">
        <div class="container">
            <div class="row">
                @component('components.user-sidebar')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 ">
                    @component('components.alerts')
                    @endcomponent
                    <div class="share-div">
                        <h4>share your experience</h4>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8 m-auto">
                            <form class="share-form" method="post" action="{{ route('share-experience') }}" id="exp-form">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" rows="5" id="comment" name="content" placeholder="{{ __('Share Your Experience here...') }}">{{ !empty($experience) ? $experience->content : '' }}</textarea> 
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" name="" value="save">
                                </div> 
                            </form>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </section>
</article>

<script>
$("#exp-form").validate({
    rules:{
        content: "required"
    },
    messages:{
        content: "Content is required"
    }
});
</script>

@endsection