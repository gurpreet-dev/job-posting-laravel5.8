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
                    <div class="company-detail-div">
                        <h4>Company Details</h4>
                        @component('components.company-nav')
                        @endcomponent
                        <div class="tab-content">
                            <div id="address" class="container">
                                <form class="address-form" method="post" action="{{ route('address') }}" id="exp-form">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">street address</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="address_1" class="form-control" placeholder="Enter Address 1" id="address1" value="{{ !empty($address) ? $address->address_1 : old('address_1') }}" required>
                                            <input type="text" name="address_2" class="form-control" placeholder="Enter Address 2 " value="{{ !empty($address) ? $address->address_2 : old('address_2') }}">  
                                        </div>   
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">City</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="city" class="form-control" placeholder="Enter City" value="{{ !empty($address) ? $address->city : old('city') }}" required >
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">select state</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="states" name="state" required>
                                        @foreach($states as $state)
                                        <option value="{{ $state->name }}" {{ !empty($address) && $address->state == $state->name ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Zip Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="zipcode" class="form-control" placeholder="Enter Zipcode" value="{{ !empty($address) ? $address->zipcode : old('zipcode') }}" required>
                                    </div>
                                    
                                    </div>
                                    <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Phone number</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="phone" class="form-control" placeholder="Enter Phone number" value="{{ !empty($address) ? $address->phone : old('phone') }}" required>
                                    </div>
                                    </div>
                                    <div class="form-group text-center">
                                    <input type="submit" value="save" class="save-btn">
                                    </div>
                                </form>
                            </div>
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
        phone: {
            required: true,
            minlength: 10
        }
    },
    messages: {
        phone: {
            minlength: "Phone number must be atleast 10 characters long."
        }
    }
});
</script>

@endsection