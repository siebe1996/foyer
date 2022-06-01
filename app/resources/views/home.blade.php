@extends('master')
@section('title', 'Home')
@section('main')
    <main class="container">
        <h2>Games</h2>
        @if($startedGames || $otherGames)
            @foreach($startedGames as $startedGame)
                <div>
                    <p>{{$startedGame->title}}</p>
                    @if($startedGame->active)
                        <form action="{{url('games/'.$startedGame->id.'/pause')}}" method="post">
                            @csrf
                            <button type="submit">pause</button>
                        </form>
                    @else
                        <form action="{{url('games/'.$startedGame->id.'/start')}}" method="post">
                            @csrf
                            <button type="submit">restart</button>
                        </form>
                    @endif
                </div>
            @endforeach
            @foreach($otherGames as $otherGame)
                <div>
                    <p>{{$otherGame->title}}</p>
                </div>
            @endforeach
        @else
            <p>no games available</p>
        @endif
        <h2>Previous Games</h2>
        @if($previousGames)
            @foreach($previousGames as $previousGame)
                <div>
                    <p>{{$previousGame->title}}</p>
                </div>
            @endforeach
        @else
            <p>no games available</p>
        @endif
    </main>
@endsection
