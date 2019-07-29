<ul class="nav nav-tabs " role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() == 'address' ? 'active' : '' }}" href="{{ route('address') }}">address</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() == 'company-info' ? 'active' : '' }}" href="{{ route('company-info') }}">company info</a>
    </li>
</ul>