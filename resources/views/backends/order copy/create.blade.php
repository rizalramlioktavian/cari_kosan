@extends('layouts.appBackend')

@section('title', 'Add Order')
@section('page-heading', 'Add Order')

@section('content')
    <section class="section">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    {{-- Menampilkan Alert --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"></div>
                                    <div class="mb-3">
                                        <label for="ruang_id">Ruang</label>
                                        <select class="form-select @error('ruang_id') is-invalid @enderror" name="ruang_id"
                                            id="ruang_id">
                                            <option selected disabled>Select Ruang</option>
                                            @foreach ($ruangs as $ruang)
                                                @php
                                                    // hitung sisa ruang berdasarkan total kamar dikurangi jumlah order yang belum check out
                                                    $availableRuangs = $ruang->total_ruang - ($ruang->order ? $ruang->order->where('check_out', '>', now())->count() : 0);
                                                    // get kosan title berdasarkan ruang id yang dipilih (relasi) tanpa duplikasi
                                                    $kosans = App\Models\Kosan::whereHas('ruang', function ($kosan) use ($ruang) {
                                                        $kosan->where('id', $ruang->id);
                                                    })->pluck('title')->first();
                                                    // get city title berdasarkan ruang id yang dipilih (relasi) tanpa duplikasi
                                                    $cities = App\Models\City::whereHas('kosan.ruang', function ($city) use ($ruang) {
                                                        $city->where('id', $ruang->id);
                                                    })->pluck('title')->first();
                                                @endphp

                                                @if ($availableRuangs > 0)
                                                    <option value="{{ $ruang->id }}">{{ $kosans }} ({{ $cities }}) - Tipe kamar: {{ $ruang->title }} (Jml: {{ $ruang->total_ruang }} / Sisa: {{ $availableRuangs }} Kamar)
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('ruang_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" value="{{ old('name') }}"
                                                placeholder="Enter Name">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                                name="phone" id="phone" value="{{ old('phone') }}"
                                                placeholder="Enter Phone">

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" value="{{ old('email') }}"
                                                placeholder="Enter Email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="payment_method">Payment Method</label>
                                            <select class="form-select @error('payment_method') is-invalid @enderror"
                                                name="payment_method" id="payment_method">
                                                <option selected disabled>Select Payment Method</option>
                                                <option value="transfer">Transfer</option>
                                                <option value="ovo">OVO</option>
                                                <option value="gopay">GoPay</option>
                                                <option value="dana">Dana</option>
                                                <option value="linkaja">LinkAja</option>
                                                <option value="shopeepay">Shopeepay</option>
                                            </select>

                                            @error('payment_method')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="check_in">Check In</label>
                                            <input type="date"
                                                class="form-control @error('check_in') is-invalid @enderror" name="check_in"
                                                id="check_in" value="{{ old('check_in') }}" placeholder="Enter Check In"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                                            @error('check_in')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="check_out">Check Out</label>
                                            <input type="date"
                                                class="form-control @error('check_out') is-invalid @enderror"
                                                name="check_out" id="check_out" value="{{ old('check_out') }}"
                                                placeholder="Enter Check Out"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                                            @error('check_out')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="promo_id">Promo</label>
                                            {{-- Jika ada promo dan status promo 'show', maka form aktif --}}
                                            @if (count($promotions) > 0 && $promotions->where('status', 'show')->count() > 0)
                                                <select class="form-select @error('promo_id') is-invalid @enderror"
                                                    name="promo_id" id="promo_id">
                                                    <option selected disabled>Select Promo</option>
                                                    @foreach ($promotions as $promo)
                                                        {{-- Tambahkan kondisi untuk memeriksa status promo --}}
                                                        @if ($promo->status == 'show')
                                                            <option value="{{ $promo->id }}">{{ $promo->title }} -
                                                                {{ $promo->discount }}%</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @else
                                                {{-- Jika tidak ada Promo atau semua promonya memiliki status 'hide', maka form tidak aktif --}}
                                                <input type="text" class="form-control" value="Belum ada Promo!"
                                                    disabled>
                                            @endif

                                            @error('promo_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="total_nights">Total Nights</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control  @error('total_nights') is-invalid @enderror" name="total_nights"
                                                id="total_nights" value="{{ old('total_nights') }}" placeholder="Enter Total Ruang">
                                                <span class="input-group-text">Night</span>

                                                @error('total_nights')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1"><i class="bi bi-save"></i>
                                    Save</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1"><i
                                        class="bi bi-x-circle"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-add-order')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush

