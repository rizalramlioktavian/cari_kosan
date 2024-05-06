@extends('layouts.appBackend')

@section('title', 'Edit-Kosan')
@section('page-heading', 'Edit-Kosan')

@section('content')
    <section class="section">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    {{-- Menampilkan Alert --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('kosan.update', $kosan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            value="{{ $kosan->title }}" name="title" id="title"
                                            placeholder="Enter Title">

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="title">Input Picture</label>
                                    <input class="form-control @error('picture') is-invalid @enderror" type="file"
                                        name="picture" id="picture">
                                    <img src="{{ asset('img/kosan/' . $kosan->picture) }}" alt="{{ $kosan->title }}"
                                        class="rounded-square" width="80" height="100">

                                    @error('picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="city_id">City</label>

                                    <fieldset class="form-group">
                                        <select class="form-select @error('picture') is-invalid @enderror" name="city_id"
                                            id="city_id">
                                            <option selected disabled>Select City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($kosan->city_id == $city->id)  selected @endif>{{ $city->title }}</option>
                                            @endforeach
                                        </select>

                                        @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            name="price" id="price" placeholder="Enter Price"
                                            value="{{ $kosan->price }}">

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                            placeholder="Enter Address">{{ $kosan->address }}</textarea>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                            placeholder="Enter Description">{{ $kosan->description }}</textarea>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="kosan_facility">Kosan Facility</label>
                                        <textarea class="form-control @error('kosan_facility') is-invalid @enderror" name="kosan_facility" id="kosan_facility"
                                            placeholder="Enter Kosan_facility">{{ $kosan->kosan_facility }}</textarea>

                                        @error('kosan_facility')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="public_facility">Public Facility</label>
                                        <textarea class="form-control @error('public_facility') is-invalid @enderror" name="public_facility"
                                            id="public_facility" placeholder="Enter Public_facility">{{ $kosan->public_facility }}</textarea>

                                        @error('public_facility')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="other_facility">Other Facility</label>
                                        <textarea class="form-control @error('other_facility') is-invalid @enderror" name="other_facility" id="other_facility"
                                            placeholder="Enter Other_facility">{{ $kosan->other_facility }}</textarea>

                                        @error('other_facility')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection


@push('js-add-kosan')
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

