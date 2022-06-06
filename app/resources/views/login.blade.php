@extends('master')

@section('title', 'Sign in | Gotcha' )


@section('main')
    <main class="container">

        <h4>Sign in</h4>
        <form class="needs-validation" novalidate="" method="post" action="{{ url('login') }}">
            @csrf
                <div>
                    <label for="email">Email</label>
                    <div class="loginComp">
                        <i class="fa fa-user icon"></i>
                    <input type="text" class="@error('email') is-invalid @enderror" id="email"
                           placeholder="Username" name="email" value="{{ old('email', '') }}">
                    </div>
                        @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password">Password</label>
                    <div class="loginComp">
                    <i class="fa fa-key icon"></i>
                    <input type="password" class="@error('password') is-invalid @enderror"
                           id="password" placeholder="Password" name="password" value="">
                    </div>

                        @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            <div class="checkBoxFlex">
                <input type="checkbox" id="remember" name="remember"
                       @if(old('remember')) checked="checked" @endif>
                <label for="remember">Remember me</label>
            </div>
            <button type="submit">Sign in</button>
        </form>
    </main>

@endsection
