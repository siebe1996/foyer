@extends('master')
@section('title', 'Moodboard | NTGent Foyer')
@section('main')
    <main class="container">
        <h2>moodboard</h2>

            <div class="row marginBottomSmall">
                <div class="d-flex justify-content-around">
                    <div class="col-5">
                        <img src="{{ url('img/sfeer/cocktails_bar.avif') }}" alt="cocktails bar" class="img-fluid">
                    </div>
                    <div class="col-5">
                        <img src="{{ url('img/sfeer/zaal_hapjes.avif') }}" alt="mensen aan bar" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="row marginBottomSmall">
                <div class="d-flex justify-content-around">
                    <div class="col-3">
                        <img src="{{ url('img/sfeer/serdi_terras.avif') }}" alt="sfeer terras" class="img-fluid">
                    </div>
                    <div class="col-3">
                    <img src="{{ url('img/sfeer/teras.avif') }}" alt="terras" class="img-fluid">
                    </div>
                    <div class="col-3">
                    <img src="{{ url('img/sfeer/terras_leeg.avif') }}" alt="leeg terras" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="row marginBottom">
                <div class="d-flex justify-content-around">
                    <img src="{{ url('img/sfeer/daan_anja_bar.avif') }}" alt="hapjes" class="img-fluid">
                </div>
            </div>

            
    </main>
@endsection
