@extends('layouts.appBackend')

@section('title', 'Order')
@section('page-heading', 'Order')

@section('content')
    <!-- Striped rows start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    {{-- Menampilkan Alert --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
                    @endif



                    <div class="card-content">
                        <div class="card-body">
                            <div class = "row mb-5">
                                <div class="col-md-5">
                                    <a href="{{ route('order.create') }}" class="btn btn-primary">Add Order</a>
                                </div>

                                <div class="col-md-1">
                                    <form method="GET" action="{{ route('order.index') }}">
                                        <fieldset class="form-group">
                                            <select class="form-select" name="pagination" id="pagination"
                                                onchange="this.form.submit()">
                                                <option value="5" {{ $pagination == 5 ? 'selected' : '' }}>5
                                                </option>
                                                <option value="10" {{ $pagination == 10 ? 'selected' : '' }}>10
                                                </option>
                                                <option value="25" {{ $pagination == 25 ? 'selected' : '' }}>25
                                                </option>
                                                <option value="50" {{ $pagination == 50 ? 'selected' : '' }}>50
                                                </option>
                                                <option value="100" {{ $pagination == 100 ? 'selected' : '' }}>100
                                                </option>
                                            </select>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('order.index') }}">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="bi bi-search"></i></span>
                                            <input type="text" class="form-control" name="search" id="search"
                                                value="{{ $search }}" placeholder="Search keyword..."
                                                aria-label="Username" aria-describedby="basic-addon2">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">NO</th>
                                            <th rowspan="2" class="text-center">USER</th>
                                            <th colspan="2" class="text-center">DATA</th>
                                            <th rowspan="2" class="text-center">TOTAL PRICE</th>
                                            <th rowspan="2" class="text-center">STATUS</th>
                                            <th rowspan="2" class="text-center">ACTION</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">BOOKING</th>
                                            <th class="text-center">ORDER</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration + $orders->perPage() * ($orders->currentPage() - 1) }}
                                                </td>
                                                <td>{{$order->user->name}}</td>
                                                <td>
                                                    <ul>
                                                        <li><b>Kosan</b> {{ $order->ruang->kosan->title }} </li>
                                                        <li><b>Kamar</b> {{ $order->ruang->title }} </li>
                                                        <li><b>Diskon</b>{{ $order->promo_id ? $order->promotion->title : 'Belum ada promo' }}
                                                            <b>{{ $order->promotion ? $order->promotion->discount : '' }}%</b>
                                                        </li>
                                                    </ul>
                                                </td>

                                                <td>
                                                    <ul>
                                                        <li><b>Nama:</b> {{ $order->name }}</li>
                                                        <li><b>Telepon:</b> {{ $order->phone }}</li>
                                                        <li><b>Email:</b> {{ $order->email }}</li>
                                                        <li><b>Pembayaran:</b> {{ $order->payment_method }}</li>
                                                        <li><b>Tanggal Order:</b> {{ dateFormat($order->created_at) }} WIB
                                                        </li>
                                                        <hr>
                                                        <li><b>Check In:</b>
                                                            {{ dateFormatBack($order->check_in, '14:00') }}WIB</li>
                                                        <li><b>Check Out:</b>
                                                            {{ dateFormatBack($order->check_out, '10:00') }}WIB</li>
                                                        <li><b>Menginap:</b> {{ $order->total_nights }}Malam</li>
                                                    </ul>
                                                </td>
                                                <td>{{ rupiahFormat($order->total_price) }}</td>
                                                {{-- <td>
                                                <ul>
                                                    <li>
                                                    Tersedia: <b><span class="badge bg-{{ $order->total_order - ($order->order ?
                                                    $order->order->where('check_out', '>', now()->format('Y-m-d 14:00:00'))->count() : 0) > 0 ? 'success' : 'danger' }}">
                                                    {{ $order->total_order - ($order->order ? $order->order->where('check_out', '>', now()->format('Y-m-d 14:00:00'))->count() : 0) }}</span></b> Order
                                                    </li>
                                                    <li>
                                                        Terpkai: <b><span class="badge bg-warning">{{ $order->order->where('check_out', '>', now()->format('Y-m-d 14:00:00'))->count() }}</span></b> Order
                                                    </li>
                                                </ul>
                                            </td> --}}
                                                <td>
                                                    @if ($order->status == 'process')
                                                        <a href="{{ route('order.status', $order->id) }}"
                                                            class="btn btn-warning">Menunggu Pembayaran</a>
                                                    @else
                                                        <span class="text-success">Pembayaran Lunas</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($order->status == 'success')
                                                    @else
                                                        <button class="btn btn-danger"
                                                            onclick="deleteData({{ $order->id }})"><i
                                                                class="bi bi-trash-fill"></i></button>

                                                            <form id="deleteForm-{{ $order->id }}"
                                                                action="{{ route('order.destroy', $order->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                    @endif
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 d-flex justify-content-between mt-3">
                                <div>
                                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of
                                    {{ $orders->total() }}
                                    entries
                                </div>
                                <div>
                                    {{ $orders->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Striped rows end -->
@endsection


@push('js-order')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush

