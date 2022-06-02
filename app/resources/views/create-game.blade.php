@extends('master')
@section('title', 'Create Game | Gotcha')
@section('main')
    <main class="container">
        <h2>Create a Game</h2>
        @include('common.errors')
        @foreach($errors->getMessages() as $key => $message)
            <p hidden>{{$errorArray[] = $key}}</p>
        @endforeach

        <form class="needs-validation" novalidate="" method="post" action="{{ url('games') }}"
              enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title" class="form-label">Title</label>
                <input type="text"
                       class="form-control {{ session()->exists('_old_input.title') ? (in_array('title', $errorArray) ? 'is-invalid' : 'is-valid')  : '' }}"
                       id="title" placeholder="" name="title" value="{{ old('title', '') }}">
            </div>

            <div>
                <label for="start-date" class="form-label">Start Date</label>
                <input type="datetime-local"
                       class="{{ session()->exists('_old_input.start_date') ? (in_array('start_date', $errorArray) ? 'is-invalid' : 'is-valid')  : '' }}"
                       id="start-date" name="start_date" value="{{ old('start_date', '') }}">
            </div>

            <div>
                <label for="end-date" class="form-label">End Date</label>
                <input type="datetime-local"
                       class="{{ session()->exists('_old_input.end_date') ? (in_array('end_date', $errorArray) ? 'is-invalid' : 'is-valid')  : '' }}"
                       id="end-date" name="end_date" value="{{ old('end_date', '') }}">
            </div>

            <div>
                <label for="weapon" class="form-label">Weapon</label>
                <select
                    class="form-select {{ session()->exists('_old_input.weapon_id') ? (in_array('weapon_id', $errorArray) ? 'is-invalid' : 'is-valid')  : '' }}"
                    id="weapon" required="" name="weapon_id">
                    <option value="">Choose...</option>
                    @foreach($weapons as $weapon)
                        @if (intval(old('weapon_id')) === $weapon->id)
                            <option value="{{ $weapon->id }}"
                                    selected>{{ $weapon->technique }}</option>
                        @else
                            <option
                                value="{{ $weapon->id }}">{{ $weapon->technique }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit">Create a game</button>
        </form>
    </main>
@endsection
