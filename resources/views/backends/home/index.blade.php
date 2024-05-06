@extends('layouts.appBackend')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <section class="row">
        {{-- Menampilkan Alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
        @endif
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Order</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahOrder }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Pendapatan</h6>
                                    <h6 class="font-extrabold mb-0">{{ rupiahFormat($totalPendapatan) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Proses</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahProcess}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Selesai</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahSuccess}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            @if (Auth::user()->picture)
                                <img src="{{ asset('storage/users/' . Auth::user()->picture) }}" alt="Profile Picture"
                                    class="rounded-circle" style="width: 50px; height: 50px;">
                            @else
                                <img src="https://picsum.photos/200" alt="Profile Picture" class="rounded-circle"
                                    style="width: 50px; height: 50px;">
                            @endif
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">Hi, <b>{{ Auth::user()->name }}</b></h5>
                            <h6 class="text-muted mb-0">@<x>{{ Auth::user()->role == 'admin' ? 'Administrator' : 'User' }}</x>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-adminhome')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
