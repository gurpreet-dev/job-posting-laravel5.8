@if(Session::has('registration'))
<div class="alert alert-info">
    {!! Session::get('registration') !!}
</div>
@endif

@if(Session::has('payment_success'))
<div class="alert alert-info">
    {!! Session::get('payment_success') !!}
</div>
@endif

@if(Session::has('payment_error'))
<div class="alert alert-warning">
    {!! Session::get('payment_error') !!}
</div>
@endif

@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning" role="alert">
<i class="fa fa-exclamation-triangle"></i> {!! session('warning') !!}
</div>
@endif

@if (session('info'))
<div class="alert alert-info" role="alert">
{!! session('info') !!}
</div>
@endif