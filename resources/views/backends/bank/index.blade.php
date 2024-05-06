@extends('layouts.appBackend')

@section('title', 'Bank')
@section('page-heading', 'Bank')

@section('content')
<!-- Striped rows start -->
<section class="section">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                {{-- Menampilkan Alert --}}
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
                @endif



                <div class="card-content">
                    <div class="card-body">
                        <div class = "row mb-5">
                            <div class="col-md-5">
                                <a href="{{ route('bank.create') }}" class="btn btn-primary">Add Bank</a>
                            </div>

                            <div class="col-md-1">
                                <form method="GET" action="{{ route('bank.index') }}">
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
                                <form method="GET" action="{{ route('bank.index') }}">
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
                                        <th>NO</th>
                                        <th>PICTURE</th>
                                        <th>BANK NAME</th>
                                        <th>BANK ACCOUNT NUMBER</th>
                                        <th>ACCOUNT NAME</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $bank)
                                        <tr>
                                            <td>{{ $loop->iteration + $banks->perPage() * ($banks->currentPage() - 1) }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('img/bank/' . $bank->picture) }}" alt="image"
                                                    style="margin-top: 10px; border-radius: 5px;" class="rounded-square"
                                                    width="80" height="100">
                                            </td>
                                            <td>{{ $bank->bank_name }}</td>
                                            <td>{{ $bank->bank_account_number }}</td>
                                            <td>{{ $bank->account_name }}</td>
                                            <td>{{ $bank->status }}</td>
                                            <td>
                                                <a href="{{ route('bank.edit', $bank->id) }}"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                                {{-- <form action="{{ route('bank.destroy', $bank->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                </form> --}}
                                                @if ($bank->status !='show')
                                                <button class="btn btn-danger"
                                                    onclick="deleteData({{ $bank->id }})"><i
                                                    class="bi bi-trash-fill"></i></button>

                                                <form id="deleteForm-{{ $bank->id }}"
                                                    action="{{ route('bank.destroy', $bank->id) }}" method="POST"
                                                    class="d-inline">
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
                                Showing {{ $banks->firstItem() }} to {{ $banks->lastItem() }} of
                                {{ $banks->total() }}
                                entries
                            </div>
                            <div>
                                {{ $banks->links() }}
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


@push('js-bank')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush

