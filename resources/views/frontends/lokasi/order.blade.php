@extends('layouts.appFrontend')

@section('title', 'Order')

@section('content')
    <section id="order">
        <div class="container">
            <!-- breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-5">
                    <li class="breadcrumb-item"><a href="{{ route('lokasi.index') }}"><iconify-icon
                                icon="iconamoon:arrow-left-2"></iconify-icon>Kembali</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{-- <a href="{{ route('lokasi.detail', ['id' => $kosan->id, 'ruang_id' => $ruang->id]) }}">Detail Kosan</a> --}}
                        <a href="{{ route('lokasi.detail', ['slug' => $kosan->slug, 'slug_ruang' => $ruang->slug]) }}">Detail Kosan</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        {{-- <a href="{{ route('lokasi.ruang', ['id' => $kosan->id, 'ruang_id' => $ruang->id]) }}">Pilih Kamar</a> --}}
                        <a href="{{ route('lokasi.ruang', ['slug' => $kosan->slug, 'slug_ruang' => $ruang->slug]) }}">Pilih Kamar</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><b>Ajukan Pemesanan</b></li>
                </ol>
            </nav>
            <!-- breadcrumb -->

            <div class="row">
                {{-- Menampilkan Alert --}}
                @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
                @endif

                <div class="col-lg-6">
                    <h4>Informasi Anda</h4>

                    {{-- <form action="{{ route('lokasi.store', ['id' => $kosan->id, 'ruang_id' => $ruang->id]) }}" method="POST"> --}}
                        <form action="{{ route('lokasi.store', ['slug' => $kosan->slug, 'slug_ruang' => $ruang->slug]) }}" method="POST">
                            @csrf
                        <!-- informasi pemesan -->
                        <div class="row">

                            <div class="col-lg-6">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" @if (Auth::check()) value="{{ Auth::user()->name }}" @endif placeholder="Masukkan Nama Lengkap">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Nomor Telepon</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" id="phone"
                                    @if (Auth::check()) value="{{ Auth::user()->phone }}" @endif
                                    placeholder="Masukkan Nomor Telepon">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email"
                                    @if (Auth::check()) value="{{ Auth::user()->email }}" @endif
                                    placeholder="Masukkan Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="payment_method">Pembayaran</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror"
                                    name="payment_method" id="payment_method">
                                    <option selected disabled>Select Payment Method</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="OVO">OVO</option>
                                    <option value="GoPay">GoPay</option>
                                    <option value="Dana">Dana</option>
                                    <option value="LinkAja">LinkAja</option>
                                    <option value="ShopeePay">ShopeePay</option>
                                </select>

                                @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- informasi pemesan -->

                        <!-- detail biaya -->
                        <div class="col-lg-12 mt-5">
                            <h4>Detail Biaya</h4>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="check_in">Check In</label>
                                    <input type="date" class="form-control @error('check_in') is-invalid @enderror"
                                        name="check_in" id="check_in" value="{{ old('check_in') }}"
                                        placeholder="Enter Check In" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                                    @error('check_in')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="check_out">Check Out</label>
                                    <input type="date" class="form-control @error('check_out') is-invalid @enderror"
                                        name="check_out" id="check_out" value="{{ old('check_out') }}"
                                        placeholder="Enter Check Out" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                                    @error('check_out')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="promo_id">Promo</label>
                                    {{-- Jika ada promo dan status promo 'show', maka form aktif --}}
                                    @if (count($promotion) > 0 && $promotion->where('status', 'show')->count() > 0)
                                        <select class="form-select @error('promo_id') is-invalid @enderror" name="promo_id"
                                            id="promo_id">
                                            <option selected disabled>Select Promo</option>
                                            @foreach ($promotion as $promo)
                                                {{-- Tambahkan kondisi untuk memeriksa status promo --}}
                                                @if ($promo->status == 'show')
                                                    <option value="{{ $promo->id }}">
                                                        {{ $promo->title }} -
                                                        {{ $promo->discount }}%</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        {{-- Jika tidak ada Promo atau semua promonya memiliki status 'hide', maka form tidak aktif --}}
                                        <input type="text" class="form-control" value="Belum ada Promo!" disabled>
                                    @endif

                                    @error('promo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="total_nights">Berapa Malam</label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control  @error('total_nights') is-invalid @enderror"
                                            name="total_nights" id="total_nights" value="{{ old('total_nights') }}"
                                            placeholder="0">
                                        <span class="input-group-text">Malam</span>

                                        @error('total_nights')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 mt-3">
                                <div class="row g-0">
                                    <div class="col-md-6">
                                        <img src="{{ asset('img/ruang/' . $ruang->picture) }}"
                                            class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $ruang->title }}</h5>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>{!! $ruang->ruang_facility !!}</p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="price">
                                                        <h6>Biaya</h6>
                                                    </label>
                                                    <h4 class="text-primary">{{ rupiahFormat($ruang->price) }}/Malam</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($ruang->total_ruang - ($ruang->order ? $ruang->order->where('check_out', '>', now()->format('Y-m-d H:i:s'))->count() : 0) > 0)
                                @if (Auth::check() && Auth::user()->order && Auth::user()->order->where('status', 'process')->count() > 0)
                                    <button class="btn btn-danger w-100" disabled>Tidak dapat melakukan lokasi kamar</button>
                                    <p class="text-secondary">Anda memiliki lokasi kamar yang sedang diproses dan belum melakukan pembayaran.</p>
                                @else
                                    <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                                    <p class="text-secondary">Pastikan semua data benar sebelum klik tombol pesan.</p>
                                @endif
                            @else
                                <button class="btn btn-danger w-100" disabled>Kamar Penuh</button>
                                <p class="text-secondary">Mohon maaf, kamar yang Anda pilih sudah penuh.</p>
                            @endif
                        </div>
                        <!-- detail biaya -->
                    </form>
                </div>
            </div>
    </section>
@endsection

@push('js-order')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush

