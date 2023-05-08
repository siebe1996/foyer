@extends('master')
@section('title', 'Leaderboard | '.$game->title.' | Gotcha')
@section('main')
    <main class="container">
        <h2 class="leaderbordTitle">{{ $game->title }}</h2>
        <div class="leaderbordHeader">
        <div class="gameheaders deathAlive">
            <p title="Alive"><i class="fa-solid fa-sun"></i></p>
            <p>{{$alive}}</p>
        </div>
        <div class="gameheaders deathAlive">
            <p title="Dead"><i class="fa-solid fa-skull"></i></p>
            <p>{{$death}}</p>
        </div>
        </div>
        <h3 class="leaderbordTitle">Leaderboard</h3>
        <div>
            <div class="gameheaders gameContent">
                <p>name</p>
                <p>kills</p>
            </div>
            @foreach($users as $user)
                <div class="gameheaders gameContent">
                    <p>{{$user->first_name}}</p>
                    <p>{{$user->pivot->kills}}</p>
                </div>
            @endforeach
        </div>
    </main>
@endsection
