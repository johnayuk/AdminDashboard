@extends('layouts.app')

        <nav class="navbar navbar-expand-sm navbar-light bg-dark">
            <div class="container">

                <!--tips: to change the nav placement use .fixed-top,.fixed-bottom,.sticky-top-->
                <a class="navbar-brand" href="/">ALPHA-HMS</a>
                <!--<a class="navbar-brand" href="#">
                <img src="..." class="d-inline-block align-top" width="30" height="30" alt="...">My Brand
            </a>-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

             {{-- @if (Route::has('login'))
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto">
                        @auth

                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/dashboard') }}" >Dashboard <span class="sr-only">(current)</span></a>
                            </li> 
                        @else 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href='/register' " >register</a>
                            
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            @endif  --}}
           
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
       
        </nav>
                    {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif --}}

<section id="landing-hero">
    <div class="container">
<div class="row justify-content-center align-items-center" style="height: 60vh">
    <div class="col-md-7 m-auto">
        <small class="d-block text-center">WELCOME TO</small>
        <h1 class="display-4 text-center">ALPHA HMS</h1>
<a href="{{ route('login') }}" class="d-block m-auto mt-4 btn" style="width: 60%; background-color:#007bff">Continue to app</a>
    </div>

        </div>
    </div>
</section>


