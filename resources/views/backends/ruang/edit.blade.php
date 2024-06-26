@extends('layouts.appBackend')

@section('title', 'EditRuang')
@section('page-heading', 'Ruang')

@section('content')
<section class="section">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
        {{-- Menampilkan Alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session ('success') }} <span class="bold-text">{{ session('boldName') }}</span> di Webiste Telnest.</div>
        @endif


        <div class="card-body">
            <form action="{{ route('ruang.update', $ruang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="title"><b>Title</b></label>
                            <input type="text" name="title" id="title" class="form-control @if($errors->has('title')) is-invalid @endif" placeholder="Enter Title" value="{{ $ruang->title }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                       <label for="picture" class="form-label"><b>Input Picture</b></label>
                            <input class="form-control @error('picture') is-invalid @enderror" type="file" name="picture" id="picture">
                            <img src="{{ asset('img/ruang/' . $ruang->picture) }}" alt="{{ $ruang->title }}" style="margin-top: 10px; border-radius: 5px;" class="rounded-square" width="80" height="100">

                            @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                       </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="kosan_id"><b>Kosan</b></label>
                            <fieldset class="form-group">
                                <select class="form-select" id="kosan_id" name="kosan_id">
                                    <option selected disabled>Select Kosan</option>
                                    @foreach ($kosans as $kosan)
                                        <option value="{{ $kosan->id }}" @if ($ruang->kosan_id == $kosan->id) selected @endif> {{ $kosan->title }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="price"><b>Price</b></label>
                            <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Price" value="{{ $ruang->price }}">

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="type_sewa"><b>Type Sewa</b></label>
                            <select class="form-select" id="type_sewa" name="type_sewa">
                                <option selected disabled>Select Type Sewa</option>
                                <option value="Harian" @if ($ruang->type_sewa == 'Harian') selected @endif>Per Hari</option>
                                <option value="Mingguan" @if ($ruang->type_sewa == 'Mingguan') selected @endif>Per Minggu</option>
                                <option value="Bulanan" @if ($ruang->type_sewa == 'Bulanan') selected @endif>Per Bulan</option>
                                <option value="Tahunan" @if ($ruang->type_sewa == 'Tahunan') selected @endif>Per Tahun</option>
                            </select>

                            @error('type_sewa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="total_ruang"><b>Total_ruang</b></label>
                            <input type="text" id="total_ruang" name="total_ruang" class="form-control @error('total_ruang') is-invalid @enderror" placeholder="Enter Total_ruang" value="{{ $ruang->total_ruang }}">

                            @error('total_ruang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="ruang_facility" class="form-label"><b>Ruang Facility</b></label>
                            <textarea class="form-control @error('ruang_facility') is-invalid @enderror" id="ruang_facility" name="ruang_facility" rows="3" placeholder="EnterRuang_Facility">{{ $ruang->ruang_facility }}</textarea>

                            @error('ruang_facility')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</section>


@endsection


@push('js-edit-ruang')
    <script src="{{ asset('js/general.js') }}"></script>
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 300,
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template paste textpattern imagetools codesample toc help autoresize emoticons quickbars linkchecker advcode mediaembed image imagetools wordcount textpattern noneditable help charmap emoticons',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            toolbar_mode: 'floating',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endpush
