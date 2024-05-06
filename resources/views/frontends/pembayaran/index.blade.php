@extends('layouts.appFrontend')

@section('title', 'Pembayaran')

@section('content')
    <!-- sukses -->
    <section id="sukses">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="deskripsi">
                        {{-- Menampilkan Alert --}}
                        @if (session()->has('success1') && session()->has('success2') && session()->has('success3'))
                            <div class="alert alert-success" role="alert">
                                <h1>{{ session()->get('success1') }} {{ session()->get('success2') }} <span class="text-primary">{{ session()->get('success3') }}</span></h1>
                            </div>
                        @endif

                        <h4>Silahkan <span class="text-primary">cek pesanan anda</span> dan selesaikan pembayaran sebelum <span class="text-primary">{{ \Carbon\Carbon::now()->format('d/m/Y, 23:59') }}</span> malam</h4>
                        <p>Apabila belum melakukan pembayaran sebelum tanggal dan pukul tersebut maka booking otomatis dihapus oleh sistem.</p>

                        <h5>Transfer Bank</h5>
                        <div class="row">
                            @foreach ($bank as $bank)
                                <div class="col-lg-4 mb-2">
                                    <div class="card" style="border: none">
                                        <img src="{{ asset('img/bank/' . $bank->picture) }}" alt="{{ $bank->bank_name }}"
                                            style="margin-top: 10px; border-radius: 5px;" class="round-square" width="50" height="50">
                                        <div class="card-body">
                                            <p>{{ $bank->bank_name }}</p>
                                            <h4>{{ $bank->bank_account_number }}</h4>
                                            <p>a.n {{ $bank->account_name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('cekOrder.index') }}" class="btn btn-primary">Cek Pesanan</a>
                        <a href="{{ route('home') }}">Ke Beranda</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets_frontend/aset/img-success.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- sukses -->
@endsection

@push('js-pembayaraan')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
