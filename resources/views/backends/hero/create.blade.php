@extends('layouts.appBackend')

@section('title', 'Hero')
@section('page-heading', 'Hero')

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
            <form action="{{ route('hero.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <textarea class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter Title"></textarea>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Description"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="form-label">Input Picture</label>
                            <input class="form-control @error('picture') is-invalid @enderror" type="file" name="picture" id="picture">
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


@push('js-add-hero')
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

