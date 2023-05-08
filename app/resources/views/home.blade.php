@extends('master')
@section('title', 'Home | Gotcha')
@section('main')
    <main class="container">
        <h2>Games</h2>
        @if($startedGames || $otherGames)
            @foreach($startedGames as $startedGame)
                <div class="game">
                    <a href="{{ url('games/'.$startedGame->id) }}">{{$startedGame->title}}</a>
                    @if($startedGame->active)
                        <form action="{{url('games/'.$startedGame->id.'/pause')}}" method="post">
                            @csrf
                            <button type="submit">pause</button>
                        </form>
                    @else
                        <form action="{{url('games/'.$startedGame->id.'/unpause')}}" method="post">
                            @csrf
                            <button type="submit">unpause</button>
                        </form>
                    @endif
                </div>
            @endforeach
            @foreach($otherGames as $otherGame)
                <div class="game">
                    <a href="{{ url('games/'.$otherGame->id) }}">{{$otherGame->title}}</a>
                </div>
            @endforeach
        @else
            <p>no games available</p>
        @endif
        <h2>Previous Games</h2>
        @if($previousGames)
            @foreach($previousGames as $previousGame)
                <div>
                    <a href="{{ url('games/'.$previousGame->id) }}">{{$previousGame->title}}</a>
                </div>
            @endforeach
        @else
            <p>no games available</p>
        @endif
    </main>
@endsection
