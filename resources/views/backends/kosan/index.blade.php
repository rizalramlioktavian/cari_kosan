@extends('layouts.appBackend')

@section('title', 'Kosan')
@section('page-heading', 'Kosan')

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
                                    <a href="{{ route('kosan.create') }}" class="btn btn-primary">Add Kosan</a>
                                </div>

                                <div class="col-md-1">
                                    <form method="GET" action="{{ route('kosan.index') }}">
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
                                    <form method="GET" action="{{ route('kosan.index') }}">
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
                                            <th rowspan="2" class="text-center">PICTURE</th>
                                            <th rowspan="2" class="text-center">TITLE</th>
                                            <th rowspan="2" class="text-center">KOSAN DESCRIPTION</th>
                                            <th colspan="3" class="text-center">FACILITY</th>
                                            <th rowspan="2" class="text-center">ACTION</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">KOSAN</th>
                                            <th class="text-center">PUBLIC</th>
                                            <th class="text-center">OTHER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kosans as $kosan)
                                            <tr>
                                                <td>{{ $loop->iteration + $kosans->perPage() * ($kosans->currentPage() - 1) }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('img/kosan/' . $kosan->picture) }}" alt="image"
                                                        style="margin-top: 10px; border-radius: 5px;" class="rounded-square"
                                                        width="80" height="100">
                                                </td>
                                                <td>{{ $kosan->title }}</td>
                                                <td>

                                                    {{-- @if ($kosan->city)
                                                        <p><b>City:</b> {{ $kosan->city->title }}</p>
                                                    @endif --}}
                                                    {{-- (jika ada atau tidak(null/not_null) title city berdasarkan city_id di table kosan maka data tetap ditampilakn ), aktifkan yagn diatas dan nonaktifkan yang di bawah --}}
                                                    <p><b>City:</b> {{ $kosan->city->title }}</p>
                                                    <p><b>Price:</b> {{ rupiahFormat($kosan->price) }}</p>
                                                    <p><b>Address:</b> {!! Str::limit($kosan->address, 50) !!}</p>
                                                    <p><b>Detail:</b> {!! Str::limit($kosan->description, 50) !!}</p>
                                                </td>
                                                <td>{!! $kosan->kosan_facility !!}</td>
                                                <td>{!! $kosan->public_facility !!}</td>
                                                <td>{!! $kosan->other_facility !!}</td>
                                                <td>

                                                    <a href="{{ route('kosan.edit', $kosan->id) }}"
                                                        class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                                    {{-- <form action="{{ route('kosan.destroy', $kosan->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                </form> --}}
                                                    {{-- @if ($kosan->room->count() == 0) --}}
                                                    <button class="btn btn-danger"
                                                        onclick="deleteData('{{ $kosan->id }}')"><i
                                                            class="bi bi-trash-fill"></i></button>

                                                    <form id="deleteForm-{{ $kosan->id }}"
                                                        action="{{ route('kosan.destroy', $kosan->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    {{-- @endif --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 d-flex justify-content-between mt-3">
                                <div>
                                    Showing {{ $kosans->firstItem() }} to {{ $kosans->lastItem() }} of
                                    {{ $kosans->total() }}
                                    entries
                                </div>
                                <div>
                                    {{ $kosans->links() }}
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


@push('js-kosan')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
