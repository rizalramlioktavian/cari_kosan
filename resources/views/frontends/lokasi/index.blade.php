@extends('layouts.appFrontend')

@section('title', 'Lokasi')

@section('content')
    <!-- form-jelajahi -->
    <section id="jelajahi">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <h1>Cari penginapan<br>berdasarkan kebutuhanmu.</h1>

                    <form method="GET" action="{{ route('lokasi.index') }}">
                        <input type="text" class="form-control mt-3" name="search" id="search" value="{{ $search }}" placeholder="cth. kosan palembang, Amaris kosan" aria-label="cth. kosan palembang, Amaris kosan" aria-describedby="button-jelajahi">
                        <button class="btn btn-primary mt-3" type="submit" id="button-jelajahi">Jelajahi</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- form-jelajahi -->

    <!-- kosan -->
    <section id="kosan">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Tempat Rekomendasi</h5>
                    <p>Cari penginapan terbaik dimanapun atau disekitarmu.</p>
                </div>
                <div class="col-lg-6 more">
                    {{ $kosans->links() }}
                </div>
            </div>
            <div class="row">
                @foreach ($kosans as $kosan)
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="{{ asset('img/kosan/' . $kosan->picture) }}" class="card-img-top" alt="{{ $kosan->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $kosan->title }} {{ $kosan->city->title }}</h5>
                                <p class="card-text">{!! $kosan->address !!}</p>
                                <h4 class="text-primary">{{ rupiahFormat($kosan->price) }}<small>/malam</small></h4>
                                <a href="{{ route('lokasi.detail', $kosan->slug) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 d-flex justify-content-between mt-3">
                <div>
                    Showing {{ $kosans->firstItem() }} to {{ $kosans->lastItem() }} of
                    {{ $kosans->total() }} entries
                </div>
            </div>
        </div>
    </section>
    <!-- kosan -->
@endsection
