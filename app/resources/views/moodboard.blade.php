@extends('master')
@section('title', 'Moodboard | NTGent Foyer')
@section('main')
    <main class="container">
        <h2>moodboard</h2>
        <div>
            <img src="{{ url('img/sfeer/cocktails_bar.avif') }}" alt="cocktails bar">
            <img src="{{ url('img/sfeer/daan_anja_bar.avif') }}" alt="mensen aan bar">
            <img src="{{ url('img/sfeer/serdi_terras.avif') }}" alt="sfeer terras">
            <img src="{{ url('img/sfeer/teras.avif') }}" alt="terras">
            <img src="{{ url('img/sfeer/terras_leeg.avif') }}" alt="leeg terras">
            <img src="{{ url('img/sfeer/zaal_hajes') }}" alt="hapjes">
        </div>
    </main>
@endsection
