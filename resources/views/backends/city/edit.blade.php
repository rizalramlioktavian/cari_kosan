@extends('layouts.appBackend')

@section('title', 'Edit City')
@section('page-heading', 'Edit City')

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
                <form action="{{ route('city.update', $city->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $city->title }}" placeholder="Enter Title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="picture" class="form-label">Input Picture</label>
                                <input class="form-control @error('picture') is-invalid @enderror" type="file" name="picture" id="picture">
                                <img src="{{ asset('img/city/' . $city->picture) }}" alt="{{ $city->title }}" class="rounded-square" width="80" height="100">

                                    @error('picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status"
                                    id="status" @if ($city->status == 'show') checked @endif>
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

@push('js-edit-city')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
