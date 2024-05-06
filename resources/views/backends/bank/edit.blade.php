@extends('layouts.appBackend')

@section('title', 'Edit Bank')
@section('page-heading', 'Edit Bank')

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
                <form action="{{ route('bank.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" id="bank_name" value="{{$bank->bank_name}}" placeholder="Enter Bank Name">

                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bank_account_number">Bank Account Number</label>
                                <input type="number" class="form-control @error('bank_account_number') is-invalid @enderror" name="bank_account_number" id="bank_account_number" value="{{$bank->bank_account_number}}" placeholder="Enter Bank Account Number">

                                @error('bank_account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="account_name">Account Name</label>
                                <input type="text" class="form-control @error('account_name') is-invalid @enderror" name="account_name" id="account_name" value="{{$bank->account_name}}" placeholder="Enter Account Name">

                                @error('account_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="picture" class="form-label">Input Picture</label>
                                <input class="form-control @error('picture') is-invalid @enderror" type="file" name="picture" id="picture">
                                <img src="{{ asset('img/bank/' . $bank->picture) }}" alt="{{ $bank->title }}" class="rounded-square" width="80" height="100">

                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status"
                                    id="status" @if ($bank->status == 'show') checked @endif>
                                <label class="form-check-label" for="status">Geser Untuk Menampilkan</label>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1"><i class="bi bi-save"></i>Save</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1"><i class="bi bi-x-circle"></i>Reset</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js-edit-bank')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush

