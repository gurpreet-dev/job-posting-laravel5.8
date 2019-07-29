@extends('layouts.site')
@section('content')

<article class="profile-art">
    <section class="profile-sec">
        <div class="container">
            <div class="row">
                @component('components.user-sidebar')
                @endcomponent
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 text-center">
                    @component('components.alerts')
                    @endcomponent
                    <div class="profile-div">
                        <h4>Profile</h4>
                        <form class="profile-form">
                            <div class="form-group">
                                <div class="avatar-wrapper">
                                    <div class="avatar">
                                        <img src="{{ App\Hash::userImage('/images/users/', Auth::user()->image) }}">
                                    </div>
                                    <a href="{{ route('edit-profile') }}" id="edit-btn"><img src="{{ url('/') }}/images/icons/edit.png"></a>
                                </div>	
                            </div>
                            <div class="form-group">
                                <span class="form-control">{{ ucwords(Auth::user()->name) }}</span>
                            </div>
                            <div class="form-group">
                                <span class="form-control" placeholder="johndoe@gmail.com">{{ Auth::user()->email }}</span>                      
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</article>

@endsection