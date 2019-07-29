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
                    <div class="payment-method-div">
                        <h4>Payment Method</h4>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-9 m-auto">
                            <form class="payment-form" method="post" action="{{ route('user-payment') }}" id="pay-form">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Card number</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="number" placeholder="{{ __('Card Number') }}" value="{{ !empty($card) ? $card->number : '' }}">       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">expiration date</label>
                                    <div class="col-sm-7">
                                        <input type="month" class="form-control" name="expiry" placeholder="{{ __('Expiration') }}" value="{{ !empty($card) ? $card->expiry : '' }}">   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">card holder name</label>  
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="owner" placeholder="{{ __('Cardholder\'s Name') }}" value="{{ !empty($card) ? $card->owner : '' }}">   
                                    </div>     
                                </div>
                                <div class="form-group text-center">
                                <input type="submit" value="save">
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
$("#pay-form").validate({
    rules:{
        number: {
            required: true,
            creditcard: true
        },
        expiry: "required",
        owner: "required"
    },
    messages:{
        number: {
            required: "Card number is required",
            creditcard: "Please enter valid card number"
        },
        expiry: "Select expiry date",
        owner: "Cardholder\'s Name is required"
    }
});
</script>

@endsection