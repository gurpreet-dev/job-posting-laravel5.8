@extends('layouts.site')
@section('content')

<article class="resume-art">
    <section class="resume-sec">
        <div class="container">
            <div class="row">
                @component('components.user-sidebar')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 ">
                    <div class="resume-div">
                        <h4>resume</h4>
                        <form id="resume-form" method="post" action="{{ route('job-apply', [$id]) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row custom-upload">
                            <div class="col-sm-8">
                                <div class="upload-div"><img src="{{ url('/') }}/images/icons/upload.svg"></div>
                                <input type="file" name="document" class="form-control" placeholder="Your Company">
                                <button type="button">Upload</button>
                            </div>  
                        </div>
                        <!-- <label>Preview</label>
                        <div class="preview-img form-group">
                            <img src="images/resume.png">
                        </div> -->
                        <div class="form-group text-center">
                            <input type="submit"  name="" value="save">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
$("#resume-form").validate({
    ignore: "",
    rules:{
        document: {
            required: true,
            extension:"docx|doc|pdf"
        }
    },
    messages: {
        document: {
            extension:"Only document type doc/docx/pdf is allowed"
        }
    }
});

</script>

@endsection