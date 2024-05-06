@extends('layouts.appFrontend')

@section('title', 'detail')

@push('css-detail')
<style>
    /* rating */
    .checked {
        color: #ffe400;
    }

    .rating-css div {
        color: #ffe400;
        font-size: 30px;
        font-family: sans-serif;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;
        padding: 20px 0;
    }

    .rating-css input {
        display: none;
    }

    .rating-css input+label {
        font-size: 60px;
        text-shadow: 1px 1px 0 #8f8420;
        cursor: pointer;
    }

    .rating-css input:checked+label~label {
        color: #b4afaf;
    }

    .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
    }

</style>
@endpush

@section('content')
<section id="detail">
    <div class="container">
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5 mb-5">
              <li class="breadcrumb-item"><a href="{{route('booking.index')}}" class="d-flex align-items-center"><iconify-icon icon="iconamoon:arrow-left-2"></iconify-icon>Kembali</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail Kosan</li>
            </ol>
        </nav>
        <!-- breadcrumb -->

        <div class="row">

            @if (@session()->has('error'))
            <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
        @endif

           <div class="col-lg-6">
            <img class="w-100" src="{{ asset('img/kosan/' . $kosan->picture) }}" alt="{{ $kosan->title }}">
           </div>
           <div class="col-lg-6">
            <div class="deskripsi-kosan">
                <h1>{{ $kosan->title }} {{ $kosan->city->title }}</h1>
                <p>{!! $kosan->address !!}</p>



                <!-- Menampilkan Rating -->
                <div class="d-flex justify-content-between align-items-center">
                    @php
                        $ratenum = number_format($rating_count);
                    @endphp

                    <!-- Count Rating -->
                    <div class="rating">
                        @for ($i = 1; $i <= $ratenum; $i++)
                            <i class="fa fa-star checked"></i>
                        @endfor
                        @for ($j = $ratenum; $j < 5; $j++)
                            <i class="fa fa-star"></i>
                        @endfor
                        <span>
                            @if ($rating->count() > 0)
                                {{ $rating->count() }} Ratings / ({{ $order_count }}) Orders
                            @else
                                0 Ratings / (0) Orders
                            @endif
                        </span>
                    </div>
                    <!-- End of Count Rating -->

                    @if (Auth::check())


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ratingKosanModal">
                            Beri Rating
                        </button>
                        <!-- End of Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="ratingKosanModal" tabindex="-1" aria-labelledby="ratingKosanModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ratingKosanModalLabel">{{ $kosan->title }} {{ $kosan->city->title }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('rating.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="kosan_id" value="{{ $kosan->id ?? '' }}">
                                            <div class="rating-css">
                                                <div class="star-icon">
                                                    @if ($user_rating)
                                                        @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                                            <input type="radio" id="rating{{ $i }}"
                                                                name="kosan_rating" value="{{ $i }}"
                                                                checked>
                                                            <label for="rating{{ $i }}" class="fa fa-star"></label>
                                                        @endfor

                                                        @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                                            <input type="radio" id="rating{{ $j }}"
                                                                name="kosan_rating" value="{{ $j }}">
                                                            <label for="rating{{ $j }}" class="fa fa-star"></label>
                                                        @endfor

                                                    @else
                                                        <input type="radio" value="1" name="kosan_rating" checked id="rating1">
                                                        <label for="rating1" class="fa fa-star"></label>
                                                        <input type="radio" value="2" name="kosan_rating" id="rating2">
                                                        <label for="rating2" class="fa fa-star"></label>
                                                        <input type="radio" value="3" name="kosan_rating" id="rating3">
                                                        <label for="rating3" class="fa fa-star"></label>
                                                        <input type="radio" value="4" name="kosan_rating" id="rating4">
                                                        <label for="rating4" class="fa fa-star"></label>
                                                        <input type="radio" value="5" name="kosan_rating" id="rating5">
                                                        <label for="rating5" class="fa fa-star"></label>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- form input comment here --}}
                                            <div class="form-group" style="margin-top: 20px;">
                                                <label for="comment">Komentar:</label>
                                                <textarea class="form-control" name="comment" id="comment" rows="3">{{ $user_rating ? $user_rating->comment : '' }}</textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Modal -->


                    @endif
                </div>
                {{-- End of Menampilkan Rating --}}

                <h5 class="mt-3">Tentang Kosan</h5>
                <p>{!! $kosan->description !!}</p>
            </div>
             {{-- jika sudah jam 23:00 maka tidak bisa pesan kosan lagi (jam 23:00 - 06:00) dan dapat pesan kosan lagi (jam 06:00 - 23:00) --}}
            {{-- @if (date('H') >= 23 || date('H') <6)
                <a href="#" class="btn btn-primary w-100 mt-3" disabled>Maaf Anda Tidak Bisa Pesan Kosan, Karena Waktu Pemesanan Kosan Hanya Buka Pukul 06:00 -23:00 WIB</a>
            @else --}}
                <a href="{{ route('booking.ruang', $kosan->slug) }}" class="btn btn-primary w-100 mt-3" disabled>Pesan Sekarang</a>
            {{-- @endif --}}
           </div>
        </div>

        <div class="row mt-5">
            <h5>Fasilitas</h5>
            <div class="row"></div>
                <div class="col-lg-4">
                    <h5><iconify-icon icon="ri:kosan-line"></iconify-icon>Layanan Kosan</h5>
                    {!! $kosan->kosan_facility !!}
                </div>
            <div class="col-lg-4">
                <h5><iconify-icon icon="icon-park-outline:kosan-please-clean"></iconify-icon>Fasilitas Publik</h5>
                {!! $kosan->public_facility !!}
            </div>
            <div class="col-lg-4">
                <h5><iconify-icon icon="game-icons:gym-bag"></iconify-icon>Fasilitas Lainnya</h5>
                {!! $kosan->other_facility !!}
            </div>
        </div>

        <div>
            <h5 class="mt-5">Review Rating & Ulasan</h5>
            @if ($rating->count() > 0)
                @foreach ($rating as $rate)
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title" style="font-size: 20px;">{{ $rate->user->name }}</h5>
                                <div class="rating">
                                    @for ($i = 1; $i <= $rate->stars_rated; $i++)
                                        <i class="fa fa-star" style="color: #ffe400;"></i>
                                    @endfor
                                    @for ($j = $rate->stars_rated; $j < 5; $j++)
                                        <i class="fa fa-star" style="color: #b4afaf;"></i>
                                    @endfor

                                    <span>{{ dateFormat($rate->created_at) }}</span>

                                    <div class="mt-3">
                                        <p>{{ $rate->comment }}</p>
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

@push('js-detail')
<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
        $(this).remove();
    });
}, 5000);
</script>
@endpush

