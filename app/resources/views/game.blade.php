@extends('master')
@section('title', $game->title.' | Gotcha')
@section('main')
    <main class="container">
        <h2>{{ $game->title }}</h2>
        <a class="gameControls" href="{{ url('games/'.$game->id.'/edit') }}">edit</a>
        <a class="gameControls" href="{{ url('games/'.$game->id.'/leaderboard') }}">leaderbord</a>
        <div>
            <div class="gameheaders">
                <p>id</p>
                <p>name</p>
                <p>target</p>
                <p>status</p>
            </div>
            @foreach($users as $user)
                <div class="gameheaders">
                    <p>{{$user->id}}</p>
                    <p>{{$user->first_name}}</p>
                    <p>{{$user->pivot->target_id}}</p>
                    @if($user->pivot->alive)
                        <p>alive</p>
                        <form action="{{url('users/'.$user->id.'/kill')}}" method="post">
                            @csrf
                            <input type="hidden" id="gameId" name="game_id" value="{{$game->id}}">
                            <button type="submit">kill</button>
                        </form>
                    @else
                        <p>death</p>
                    @endif
                </div>
            @endforeach
        </div>
    </main>
@endsection
