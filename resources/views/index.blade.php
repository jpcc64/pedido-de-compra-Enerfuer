
@if (Auth::check())
@include('formPrincipal')
@else
@include('login')
@endif
