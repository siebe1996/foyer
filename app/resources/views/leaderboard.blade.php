@extends('master')
@section('title', 'Leaderboard | '.$game->title.' | Gotcha')
@section('main')
    <main class="container">
        <h2>{{ $game->title }}</h2>
        <div>
            <p>Alive:</p>
            <p>{{$alive}}</p>
        </div>
        <div>
            <p>Death:</p>
            <p>{{$death}}</p>
        </div>
        <h3>Leaderboard</h3>
        <div>
            <div>
                <p>name</p>
                <p>kills</p>
            </div>
            @foreach($users as $user)
                <div>
                    <p>{{$user->first_name}}</p>
                    <p>{{$user->pivot->kills}}</p>
                </div>
            @endforeach
        </div>
    </main>
@endsection
