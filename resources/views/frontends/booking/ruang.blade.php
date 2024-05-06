@extends('layouts.appFrontend')

@section('title', 'Ruang')

@section('content')
    <section id="ruang">
        <div class="container">

            <!-- breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-5">
                    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}"><iconify-icon
                                icon="iconamoon:arrow-left-2"></iconify-icon>Kembali</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('booking.detail', $kosan->slug) }}">Detail Kosan</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><b>Pilih Ruang</b></li>
                </ol>
            </nav>
            <!-- breadcrumb -->

            <div class="row mt-5">
                {{-- Menampilkan Alert --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
                @endif

                @if ($ruang->isEmpty())
                    <h5>Ruang tidak tersedia di {{ $kosan->title }} {{ $kosan->city->title }}</h5>
                @else
                    <h5>Ruang tersedia di {{ $kosan->title }} {{ $kosan->city->title }}</h5>
                    @foreach ($ruang as $ruang)
                        <div class="col-lg-6">
                            <div class="card mb-3 mt-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset('img/ruang/' . $ruang->picture) }}" class="img-fluid rounded-start"
                                            alt="{{ $ruang->title }}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $ruang->title }} - {{ $ruang->type_sewa }}</h5>
                                            <p class="card-text">{!! $ruang->ruang_facility !!}</p>
                                            {{-- <a href="{{ route('booking.order', ['slug' => $kosan->slug, 'slug_ruang' => $ruang->slug]) }}" class="btn btn-primary">Pilih Ruang</a> --}}
                                            <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('booking.order', ['slug' => $kosan->slug, 'slug_ruang' => $ruang->slug]) }}" class="btn btn-primary">Pilih Ruang</a>
                                                <div>
                                                    <h5 class="text-primary">{{ rupiahFormat($ruang->price) }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection

@push('js-ruang')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
