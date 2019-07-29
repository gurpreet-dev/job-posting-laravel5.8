@extends('layouts.site')
@section('content')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  	<article class="subscription-art">
  		<section class="subscription-sec">
  			<div class="container">
                @component('components.alerts')
                @endcomponent
  				<div class="row">
  					<div class="col-12 col-sm-12 col-md-12 col-lg-9 ">
  				      	<div class="head-sec">
                  			<h4>order summary</h4>
                  			<p>You are signing for a {{ strtolower($plan->title) }} plan subscription. You will be charged <span class="charges">{{ \App\Hash::price($plan->price) }}</span></p>    
                		</div>
                		<div class="inner-sec">
                			<p>{{ strtolower($plan->title) }} plan subscription <span class="charges">{{ \App\Hash::price($plan->price) }}</span></p>
                			<div id="total">
                				<p>total <span class="charges">{{ \App\Hash::price($plan->price) }}</span></p>
                			</div>
                			
                		</div>
                		<form id="subscription-form" method="post" action="{{ route('buy-plan', [\App\Hash::encode($plan->id)]) }}">
                            @csrf
                            @if(Auth::guest())
                			<div class="account-info">
            					<h6>account information</h6>
	                			<p>Have an Account ?<a href="{{ url('/') }}/login?redirectto={{ urlencode(url('/').'/buy-plan/'.\App\Hash::encode($plan->id)) }}"> login</a></p>
	                			<div class="form-group row">
									<label class="col-sm-2 col-form-label">name</label>
									  <div class="col-sm-5">
										 <input type="text" name="name" class="form-control" placeholder="Enter Name" required="" value="{{ old('name') }}"> 
									  </div>   
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label ">email</label>
									  <div class="col-sm-5">
										 <input type="email" name="email" class="form-control" placeholder="Enter Email" required="" value="{{ old('email') }}"> 
                                        @if ($errors->has('email'))
                                            <label class="error">{{ $errors->first('email') }}</label>
                                        @endif
									  </div>   
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label ">password</label>
									  <div class="col-sm-5">
										 <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password"  required="" > 
									  </div>   
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label ">confirm password</label>
									  <div class="col-sm-5">
										 <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"  required=""> 
									  </div>   
								</div>
                			</div>
                            @endif
                			<div class="payment-info">
                            <div class="payment-errors"></div>
                				<h6>enter your payment information</h6>
	                			<p>This is a secure 128-bit SSL encrypted payment</p>
                				<div class="form-group row">
									<label class="col-sm-2 col-form-label ">card number</label>
									  <div class="col-sm-5">
										 <input type="number" name="cc_number" class="form-control card-number" placeholder="Card Number" size="20" value="{{ !empty($card) ? $card->number : old('cc_number') }}" required=""> 
									  </div>   
								</div>
                                @php
                                if(!empty($card)){
                                    $expiry = explode('-', $card->expiry);
                                }else{
                                    $expiry = [];
                                }
                                @endphp
								<div class="form-group row">
									<label class="col-sm-2 col-form-label ">expiration date</label>
									  <div class="col-sm-2">
										 <input type="number" name="expiry_month" class="form-control card-expiry-month" placeholder="MM"  required="" value="{{ !empty($expiry) ? $expiry[1] : old('expiry_month') }}" max="12"> 
									  </div>
                                      <div class="col-sm-3">
										 <input type="number" name="expiry_year" size="4" class="form-control card-expiry-year" placeholder="YYYY"  required="" value="{{ !empty($expiry) ? $expiry[0] : old('expiry_year') }}"> 
									  </div>   
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label ">CVV</label>
									  <div class="col-sm-5">
										 <input type="text" name="cvv" class="form-control card-cvc" placeholder="Enter CVV" size="4"  required=""> 
									  </div>   
								</div>
								<p id="details">Your <span class="charges">{{ \App\Hash::price($plan->price) }}</span> subscription will begin today.</p>
								<div class="form-group form-check checkbox-input">
									<label class="form-check-label">
										<input type="checkbox" name="tc" class="form-check-input" required><span class="custom-check"></span> I agree to the<a href="{{ url('/') }}/page/{{ \App\Config::get_field('terms_condition') != '' ?  \App\Config::get_field('terms_condition') : '#' }}" class="terms-link" target="_blank"> Terms of use </a> and <a href="{{ url('/') }}/page/{{ \App\Config::get_field('privacy_policy') != '' ?  \App\Config::get_field('privacy_policy') : '#' }}" target="_blank" class="terms-link">Privacy Policy</a> 
                                        <label for="tc" class="error"></label>
									</label>    
                                    
                </div>
                <div class="form-group">
									<input type="submit" name="" value="Buy Now" class="submit-button">
								</div>
              </div>
            </form>
  				</div>
  			</div>
  		</div>
  	</section>
</article>

<script>
var cc_pay = $("#subscription-form").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        name: "required",
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            minlength: 8,
            equalTo: "#password"
        },
        cc_number: {
            required: true,
            minlength: 16,
            digits: true,
            creditcard: true
        },
        expiry_month: {
            required: true
        },
        expiry_year: {
            required: true
        },
        cvv: "required",
        tc: "required"
    },
    messages: {
        email: {
            required: "Email is required",
            email: "Please enter valid email"
        },
        name: "Name is requried",
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long"
        },
        password_confirmation: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long",
            equalTo: "Please enter the same password as above"
        },
        cc_number: {
            required: 'Please enter card number',
            minlength: 'Card number must be of atleast 16 characters long',
            digits: 'Please enter digits only',
            creditcard: "Please enter valid card number"
        },
        expiry_month: {
            required: 'Please select expiry month'
        },
        expiry_year: {
            required: 'Please select expiry year'
        },
        cvv: "Please enter cvv",
        tc: "Please accept Terms of use and Privacy Policy."
    }
});

Stripe.setPublishableKey('pk_test_u825TyM8LNxfwYLXNljnVIJe00fBshOhSt');
    function stripeResponseHandler(status, response) {
        if (response.error) {
            // re-enable the submit button
            $('.submit-button').removeAttr("disabled");
            // show the errors on the form
            $(".payment-errors").html('<div class="alert alert-danger">'+response.error.message+'</div>');
        } else {
            var form$ = $("#subscription-form");
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // and submit
            form$.get(0).submit();
        }
    }
    $(document).ready(function() {

        $("#subscription-form").submit(function(event) {
            // disable the submit button to prevent repeated clicks

            if(cc_pay.form()){
                $('.submit-button').attr("disabled", "disabled");
                // createToken returns immediately - the supplied callback submits the form if there are no errors
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
                return false; // submit from callback
            }

        });
    });

</script>

@endsection