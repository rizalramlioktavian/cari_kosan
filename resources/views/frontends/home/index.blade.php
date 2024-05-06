@extends('layouts.appFrontend')

@section('content')
    <!-- hero -->
    <section id="hero">
        <div class="container">
            <div class="row">
                @foreach ($heroes as $hero)
                <div class="col-lg-6">
                    <div class="deskripsi-hero">
                        <h1>Temukan Kosan Impianmu <br>  </h1>
                        <p>Cari kosan terbaik dengan mudah<br>cukup lewat handphone mu.</p>
                        <a class="btn btn-primary" href="{{ route('booking.index') }}">Cari Kosan</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('img/hero/' . $hero->picture) }}" alt="img-hero">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- hero -->

    <!-- kosan -->
    <section id="kosan">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Cari Kosan </h5>
                    <p>Cari kosan sesuai dengan keinginan dan kebutuhanmu.</p>
                </div>
                <div class="col-lg-6">
                    <a class="more" href="{{ route('booking.index') }}">Lihat lainnya</a>
                </div>
            </div>

            <div class="row">
                @foreach ($kosans as $kosan)
                <div class="col-lg-3">
                    <div class="card">
                        <img src="{{ asset('img/kosan/' . $kosan->picture) }}" class="card-img-top"
                        alt="{{ $kosan->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kosan->title }} {{ $kosan->city->title }}</h5>
                            <p class="card-text">{!! $kosan->address !!}</p>
                            <select class="form-select">
                                <option selected disabled>Harga {{ $kosan->title }}</option>
                                @foreach ($kosan->ruang as $ruang)
                                    @php
                                        $typeSewa = '';
                                        switch ($ruang->type_sewa) {
                                            case 'Harian':
                                            $typeSewa = 'Per Hari';
                                            break;
                                            case 'Mingguan':
                                            $typeSewa = 'Per Minggu';
                                            break;
                                            case 'Bulanan':
                                                $typeSewa = 'Per Bulan';
                                                break;
                                                case 'Tahunan':
                                                $typeSewa = 'Per Tahun';
                                                break;
                                            default:
                                                $typeSewa = $ruang->type_sewa;
                                                break;
                                            }
                                    @endphp
                                    <option value="{{ $ruang->id }}">{{ rupiahFormat($ruang->price) }} /{{ $typeSewa }}</option>
                                @endforeach
                            </select>

                                <a href="{{ route('booking.detail', $kosan->slug) }}" class="btn btn-primary mt-5">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- kosan -->

    <!-- kota -->
    <section id="kota">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Eksplor Berdasarkan Kota</h5>
                    <p>Lebih nyaman dan happy dengan penginapan yang lebih terjangkau.</p>
                </div>
                <div class="col-lg-6">
                    <a class="more" href="#">Lihat lainnya</a>
                </div>
            </div>
            <div class="row">
                @foreach ($cities as $city)
                    <div class="col-lg-3">
                        <div class="card text-white">
                            <img src="{{ asset('img/city/' . $city->picture) }}" class="card-img" alt="{{ $city->title }}">
                            <div class="card-img-overlay">
                                <h5 class="card-title">{{ $city->title }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- kota -->

    <!-- promo -->
    <section id="promo">
        <div class="container">
            <div class="row">
                @if ($promotions->isEmpty())
                    <div class="col">
                        <img src="{{ asset('assets_frontend/aset/belum_adapromo.png') }}" alt="no-promo">
                    </div>
                @else
                    @foreach ($promotions as $promo)
                        <div class="col">
                            <img src="{{ asset('img/promotion/' . $promo->picture) }}" class="card-img"
                                alt="{{ $promo->title }}">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- promo -->

    <!-- artikel -->
    <section id="artikel">
        <div class="container">
            <div class="row">
                @foreach ($applications as $apps)
                    <div class="col-lg-5">
                        <img src="{{ asset('img/application/' . $apps->picture) }}" class="card-img"
                            alt="{{ $apps->title }}">
                    </div>
                    <div class="col-lg-7">
                        <div class="deskripsi">
                            <h1>{!! $apps->title !!}</h1>
                            <p class="mt-3 mb-3">{!! $apps->description !!}</p>
                            <img src="{{ asset('assets_frontend/aset/ic-getplayapp.png') }}" alt="apps">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- artikel -->
@endsection
