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
                    <img src="{{ url('img/sfeer/_DSC0040.jpg') }}" alt="macarons"
                         class="img-fluid">
                </div>
                <div class="col-3">
                    <img src="{{ url('img/sfeer/_DSC7933.jpg') }}" alt="pepers"
                         class="img-fluid">
                </div>
                <div class="col-3">
                    <img src="{{ url('img/sfeer/355800547_1317378762202088_2797515416647032132_n.jpg') }}" alt="st-baafs"
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
                <div class="col-3">
                    <img src="{{ url('img/sfeer/_DSC7904.jpg') }}" alt="hapjes" class="img-fluid">
                </div>
                <div class="col-3">
                    <img src="{{ url('img/sfeer/356965638_3458037431191910_3413825880845877044_n.jpg') }}" alt="terras buiten" class="img-fluid">
                </div>
                <div class="col-3">
                    <img src="{{ url('img/sfeer/_DSC7618.jpg') }}" alt="gezonde hapjes" class="img-fluid">
                </div>
            </div>
        </div>
        <div>
            <p>&copy; Laurence Delbeke, &copy; Michiel Devijver, &copy; Laura Vleugels</p>
        </div>


    </main>
@endsection
