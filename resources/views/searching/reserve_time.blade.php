@extends('layouts/master')

<link href="{{ URL::to('css/searching_style.css') }}" rel="stylesheet" type="text/css">

@section('content')
<div class="container">
    <ul class="nav nav-pills justify-content-center" style="margin: 3rem auto 5rem auto">
        <li class="nav-item">
            <a class="nav-link active" href="#">I_314</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I_315</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_002</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_017</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_105</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_107</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_223</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_404</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_507-1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">I1_933</a>
        </li>
    </ul>

    @include('partials/calender')
        @yield('calender')
</div>
@endsection