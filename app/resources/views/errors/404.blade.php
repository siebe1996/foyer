@extends('master')
@section('title', '404')
@section('main')
    <div id="main" class="container">
        <div class="col-md-6 px-0">
            <div class="notfound">
                <div class="major">
                    <h2>404</h2>
                </div>
                <h2>I don't know what you're looking for</h2>
                <p>I bet that you look good on the dancefloor</p>
                <p>I don't know if you're looking for romance or</p>
                <p>I don't know what you're looking for</p>
                <a href="{{ url('/') }}">Go To Homepage</a>
            </div>
        </div>
    </div>
@endsection
