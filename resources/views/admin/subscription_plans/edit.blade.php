@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Edit Plan</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <form action="{{ route('admin.edit_plan', [$plan->id]) }}" method="post" id="add-plan" enctype="multipart/form-data">
            @csrf
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Basic Info</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ $plan->title }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Enter Subtitle" value="{{ $plan->subtitle }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea class="form-control" placeholder="Enter Content" name="content">{{ $plan->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Enter Price" value="{{ $plan->price }}">
                        </div>

                    </div>
                        
            </div>
            <!-- /.box -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Features</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                    <div class="box-body">

                        @php
                        $types = App\SubscriptionPlan::feature_types();
                        @endphp

                        @foreach($types as $type)

                        @if($type['type'] == 'text' || $type['type'] == 'number')
                        <div class="form-group">
                            <label for="{{ $type['label'] }}" class="control-label">{{ $type['label'] }}</label> <small> {{ isset($type['alert']) ? ' ('.$type['alert'].')' : '' }}</small>
                            <input type="{{ $type['type'] }}" name="features[{{ $type['name'] }}]" placeholder="{{ $type['placeholder'] }}" class="form-control {{ $type['class'] }}" value="{{ App\SubscriptionPlan::getFeature($type['name'], $plan->id) }}" required>
                        </div>
                        @endif

                        @if($type['type'] == 'select')
                        <div class="form-group">
                            <label for="{{ $type['label'] }}" class="control-label">{{ $type['label'] }}</label>
                            <select class="form-control" name="features[{{ $type['name'] }}]">
                                @foreach($type['options'] as $key => $value)
                                <option value="{{ $key }}" {{ App\SubscriptionPlan::getFeature($type['name'], $plan->id) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        @endforeach

                    </div>
                        
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            <!-- /.box -->

            
        </div>
        <!-- /.box -->

        </form>
    </div>
</section>    

<script type="text/javascript">



$("#add-plan").validate({
    rules:{
        duration: "required",
        title: "required",
        subtitle: "required", 
        content: "required",
        price: {
            required: true,
            number: true
        }
    },
    messages:{
        duration: "Please select duration",
        title: "Title is requried",
        subtitle: "Subtitle is requried",
        content: "Content is required",
        price: {
            required: "Enter Price",
            number: "Enter Valid Price"
        }
    }
});

$(".gpnumbers_only").rules("add", { 
  required:true,
  digits: true
});
</script>

@endsection