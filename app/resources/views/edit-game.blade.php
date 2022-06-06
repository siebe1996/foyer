@extends('master')
@section('title', 'Edit '.$game->title.' | Gotcha')
@section('main')
    <main class="container">
        <h2>{{'Edit '.$game->title}}</h2>
        @include('common.errors')
        @foreach($errors->getMessages() as $key => $message)
            <p hidden>{{$errorArray[] = $key}}</p>
        @endforeach
        <form class="needs-validation" novalidate="" method="post" action="{{ url('games/'.$game->id) }}"
              enctype="multipart/form-data">
            @csrf
            <div>
                <label for="start-date" class="form-label datelabel">Start Date</label>
                <input type="datetime-local"
                       class="{{ session()->exists('_old_input.start_date') ? (in_array('start_date', $errorArray) ? 'is-invalid' : 'is-valid')  : '' }}"
                       id="start-date" name="start_date" value="{{ old('start_date', date('Y-m-d\TH:i:s', strtotime($game->start_date))) }}">
            </div>

            <div>
                <label for="end-date" class="form-label datelabel">End Date</label>
                <input type="datetime-local"
                       class="{{ session()->exists('_old_input.end_date') ? (in_array('end_date', $errorArray) ? 'is-invalid' : 'is-valid')  : '' }}"
                       id="end-date" name="end_date" value="{{ old('end_date', date('Y-m-d\TH:i:s', strtotime($game->end_date))) }}">
            </div>

            <div>
                <label for="weapon" class="form-label">Weapon</label>
                <select
                    class="form-select {{ session()->exists('_old_input.weapon_id') ? (in_array('weapon_id', $errorArray) ? 'is-invalid' : 'is-valid')  : '' }}"
                    id="weapon" required="" name="weapon_id">
                    <option value="">Choose...</option>
                    @foreach($weapons as $weapon)
                        @if (intval(old('weapon_id', $game->weapon_id)) === $weapon->id)
                            <option value="{{ $weapon->id }}"
                                    selected>{{ $weapon->technique }}</option>
                        @else
                            <option
                                value="{{ $weapon->id }}">{{ $weapon->technique }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit">Edit {{$game->title}}</button>
        </form>
    </main>
@endsection
