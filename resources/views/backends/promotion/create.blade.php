@extends('layouts.appBackend')

@section('title', 'Add Promotion')
@section('page-heading', 'Add Promotion')

@section('content')
    <section class="section">
        <div class="card">
            {{-- Menampilkan Alert --}}
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
            @endif

            <div class="card-body">
                <form action="{{ route('promotion.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter Title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" id="discount" placeholder="Enter Discount">

                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="picture" class="form-label">Input Picture</label>
                                <input class="form-control @error('picture') is-invalid @enderror" type="file" name="picture" id="picture">

                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status"
                                    id="status">
                                <label class="form-check-label" for="status">Geser Untuk Menampilkan</label>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js-add-promotion')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
