@extends('layouts.appFrontend')

@section('title', 'Cek-Order')

@section('content')
    <section class="container">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        {{-- Menampilkan Alert --}}
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {!! session('success') !!}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {!! session('error') !!}
                        @endif

                        <div class="row mb-5 d-flex justify-content-end">
                            {{-- Left Element --}}
                            <div class="col-md-5">
                                <a href="{{ route('pembayaran.index') }}" class="btn btn-primary">
                                    <iconify-icon icon="iconamoon:arrow-left-2"></iconify-icon>
                                    Pembayaran
                                </a>
                            </div>
                            {{-- Right Element --}}
                            <div class="col-md-1">
                                <form method="GET" action="{{ route('cekOrder.index') }}">
                                    <div class="mb-3">
                                        <select class="form-select" name="pagination" id="pagination"
                                            onchange="this.form.submit()">
                                            <option value="2" {{ $pagination == 2 ? 'selected' : '' }}>2</option>
                                            <option value="5" {{ $pagination == 5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ $pagination == 25 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ $pagination == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ $pagination == 100 ? 'selected' : '' }}>50</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('cekOrder.index') }}">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><iconify-icon
                                                icon="material-symbols:search"></iconify-icon></span>
                                        <input type="text" class="form-control" name="search" id="search"
                                            value="{{ $search }}" placeholder="Search keyword..."
                                            aria-label="Search keyword..." aria-describedby="button-addon2">
                                        <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- table striped --}}
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>BOOKING DATA</th>
                                        <th>TOTAL HARGA</th>
                                        <th>STATUS</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        {{--  berdasarkan tanggal order dan jam 23:00 WIB dengan status process dan user_id yang sama dengan user yang login saat ini tidak melakukan pembayaran maka booking hapus otomatis --}}
                                        @if (date('Y-m-d H:i:s') > date('Y-m-d 23:59:00', strtotime($order->created_at)) &&
                                                $order->status == 'process' &&
                                                $order->user_id == Auth::user()->id)
                                            @php
                                                $order->delete();
                                            @endphp
                                        @else
                                            <tr>
                                                <td class="align-middle">
                                                    {{ $loop->iteration + $orders->perPage() * ($orders->currentPage() - 1) }}
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li><b>Kota:</b> {{ $order->ruang->kosan->city->title }}</li>
                                                        <li><b>Kosan:</b> {{ $order->ruang->kosan->title }}</li>
                                                        <li><b>Kamar:</b> {{ $order->ruang->title }}</li>
                                                        <li><b>Promo:</b>
                                                            {{ $order->promo_id ? $order->promotion->title : 'Belum ada promo!' }}
                                                            <b>{{ $order->promotion ? $order->promotion->discount : '' }}%</b>
                                                        </li>
                                                        <hr>
                                                        <li><b>Nama:</b> {{ $order->name }}</li>
                                                        <li><b>Telepon:</b> {{ $order->phone }}</li>
                                                        <li><b>Email:</b> {{ $order->email }}</li>
                                                        <li><b>Pembayaran:</b> {{ $order->payment_method }}</li>
                                                        <li><b>Tanggal Order:</b> {{ dateFormat($order->tanggal_sewa) }} WIB
                                                        </li>
                                                        <hr>
                                                        <li><b>Total Sewa:</b> {{ $order->ruang->type_sewa == 'Harian' ? $order->total_sewa . ' Hari' : ($order->ruang->type_sewa == 'Mingguan' ? $order->total_sewa . ' Minggu' : ($order->ruang->type_sewa == 'Bulanan' ? $order->total_sewa . ' Bulan' : $order->total_sewa . ' Tahun')) }}</li>
                                                    </ul>
                                                </td>
                                                <td class="align-middle"><b>{{ rupiahFormat($order->total_price) }}</b>
                                                </td>

                                                <td class="align-middle">
                                                    @if ($order->status == 'process')
                                                        <span class="badge text-bg-warning">Menunggu Pembayaraan</span>
                                                    @else
                                                        <span class="badge text-bg-success">Pembayaran Lunas</span>
                                                    @endif
                                                </td>

                                                <td class="align-middle">
                                                    @if ($order->status == 'success')
                                                        {{-- jika status pembayaran success, maka tombol delete tidak ditampilkan --}}
                                                        <a href="{{ route('booking.detail', $order->ruang->kosan->slug) }}"
                                                            class="btn btn-outline-primary">
                                                            {{-- <iconify-icon icon="bx:bxl-tripadvisor"></iconify-icon> --}}
                                                            <i class="fas fa-star"></i>
                                                            Beri Rating
                                                        </a>
                                                    @else
                                                        {{-- jika status pembayaran process, maka tombol delete ditampilkan --}}
                                                        <button class="btn btn-outline-danger" onclick="deleteData('{{ $order->id }}')">
                                                            <iconify-icon icon="material-symbols:delete"></iconify-icon>
                                                        </button>
                                                        <form id="deleteForm{{ $order->id }}" action="{{ route('cekOrder.destroy', $order->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 d-flex justify-content-between mt-3">
                            <div>
                                Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                            </div>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-cekOrder')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
