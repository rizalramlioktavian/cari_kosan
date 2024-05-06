@extends('layouts.appBackend')

@section('title', 'Ruang')
@section('page-heading', 'Ruang')

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
                                <a href="{{ route('ruang.create') }}" class="btn btn-primary">Add Ruang</a>
                            </div>

                            <div class="col-md-1">
                                <form method="GET" action="{{ route('ruang.index') }}">
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
                                <form method="GET" action="{{ route('ruang.index') }}">
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
                                        <th rowspan="2" class="text-center">KOSAN</th>
                                        <th rowspan="2" class="text-center">PRICE</th>
                                        <th rowspan="2" class="text-center">TOTAL RUANG</th>
                                        <th rowspan="2" class="text-center">DESCRIPTION</th>
                                        <th rowspan="2" class="text-center">ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($ruangs as $ruang)
                                        <tr>
                                            <td>{{ $loop->iteration + $ruangs->perPage() * ($ruangs->currentPage() - 1) }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('img/ruang/' . $ruang->picture) }}" alt="image"
                                                    style="margin-top: 10px; border-radius: 7px;" class="rounded-square"
                                                    width="80" height="100">
                                            </td>
                                            <td>{{ $ruang->title }}</td>
                                            <td>
                                                {{-- @php
                                                    $kosans = App\Models\Kosan::whereHas('ruang', function ($kosan) use ($ruang) {
                                                        $kosan->where('id', $ruang->id);
                                                    })->pluck('title')->first();
                                                @endphp
                                                {{ $kosans}} --}}

                                                {{ $ruang->kosan->title }}
                                            </td>

                                            <td style="max-width: 200px">{{ rupiahFormat($ruang->price) }}</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                    Tersedia: <b><span class="badge bg-{{ $ruang->total_ruang - ($ruang->order ?
                                                    $ruang->order->where('check_out', '>', now()->format('Y-m-d 14:00:00'))->count() : 0) > 0 ? 'success' : 'danger' }}">
                                                    {{ $ruang->total_ruang - ($ruang->order ? $ruang->order->where('check_out', '>', now()->format('Y-m-d 14:00:00'))->count() : 0) }}</span></b> Ruang
                                                    </li>
                                                    <li>
                                                        Terpakai: <b><span class="badge bg-warning">{{ $ruang->order->where('check_out', '>', now()->format('Y-m-d 14:00:00'))->count() }}</span></b> Ruang
                                                    </li>
                                                </ul>
                                            </td>
                                            {{-- <td>
                                                {{ $ruang->total_ruang }}
                                            </td> --}}

                                            <td>{!! $ruang->ruang_facility !!}</td>


                                            <td>
                                                <a href="{{ route('ruang.edit', $ruang->id) }}"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                                    @if ($ruang->order->count()==0)
                                                    <button class="btn btn-danger" onclick="deleteData('{{ $ruang->id }}')"><i class="bi bi-trash-fill"></i></button>

                                                <form id="deleteForm-{{ $ruang->id }}"
                                                    action="{{ route('ruang.destroy', $ruang->id) }}" method="POST"
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
                                Showing {{ $ruangs->firstItem() }} to {{ $ruangs->lastItem() }} of
                                {{ $ruangs->total() }}
                                entries
                            </div>
                            <div>
                                {{ $ruangs->links() }}
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


@push('js-ruang')
    <script src="{{ asset('js/general.js') }}"></script>
@endpush
