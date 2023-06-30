@extends('master')
@section('title', 'Moodboard | NTGent Foyer')
@section('main')
    <main class="container">
        <h2>moodboard</h2>

        <div class="row marginBottomSmall">
            <div class="d-flex justify-content-around">
                <div class="col-5">
                    <img src="{{ url('img/sfeer/2-IMG_3749_druk (c) Michiel Devijver.jpg') }}" alt="baba ganoush"
                         class="img-fluid">
                </div>
                <div class="col-5">
                    <img src="{{ url('img/sfeer/21-IMG_3676_druk (c) Michiel Devijver.jpg') }}" alt="aardbij hamburger"
                         class="img-fluid">
                </div>
            </div>
        </div>

        <div class="row marginBottomSmall">
            <div class="d-flex justify-content-around">
                <div class="col-3">
                    <img src="{{ url('img/sfeer/29-IMG_3698_druk (c) Michiel Devijver.jpg') }}" alt="vis"
                         class="img-fluid">
                </div>
                <div class="col-3">
                    <img src="{{ url('img/sfeer/_DSC7933.jpg') }}" alt="pepers"
                         class="img-fluid">
                </div>
                <div class="col-3">
                    <img src="{{ url('img/sfeer/_DSC7987.jpg') }}" alt="st-baafs"
                         class="img-fluid">
                </div>
            </div>
        </div>

        <div class="row marginBottomSmall">
            <div class="d-flex justify-content-around">
                <div class="col-5">
                    <img src="{{ url('img/sfeer/33-IMG_3716_druk (c) Michiel Devijver.jpg') }}" alt="zeewolf"
                         class="img-fluid">
                </div>
                <div class="col-5">
                    <img src="{{ url('img/sfeer/42-IMG_3805_druk (c) Michiel Devijver.jpg') }}" alt="kaas"
                         class="img-fluid">
                </div>
            </div>
        </div>

        <div class="row marginBottom">
            <div class="d-flex justify-content-around">
                <img src="{{ url('img/sfeer/_DSC7904.jpg') }}" alt="hapjes" class="img-fluid">
            </div>
        </div>


    </main>
@endsection
