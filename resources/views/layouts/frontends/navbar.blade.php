@guest
    <!-- navbar Guest -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets_frontend/aset/logo.jpg') }}"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                    {{-- user sebelum login atau pengunjung belum daftar --}}
                    <a class="nav-link {{ Route::is('booking*') ? 'active' : '' }}" href="{{ route('booking.index') }}" style="{{ Route::is('booking*') ? 'color: blue;' : '' }}">Booking</a>

                    <a class="nav-link {{ Route::is('lokasi*') ? 'active' : '' }}" href="{{ route('lokasi.index') }}"
                    style="{{ Route::is('lokasi*') ? 'color: blue;' : '' }}">Lokasi</a>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        {{-- jika dihalaman home maka tampilkan button login dan register, jika dihalaman login maka tampilkan
                        button register, jika dihalaman register maka tampilkan button login --}}
                        @if (Route::is('login'))
                            <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                        @elseif (Route::is('register'))
                            <a class="btn btn-primary" href="{{ route('login') }}">Masuk</a>
                        @else
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">Masuk</a>
                            <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar Guest -->
@else
    <!-- navbar Admin -->
    @if (Auth::user()->role == 'admin')
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets_frontend/aset/logo.jpg') }}"
                        alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="btn btn-outline-primary" href="{{ route('admin.home') }}">Home</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar Admin -->
    @else
        <!-- navbar User -->
        <nav id="logged" class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets_frontend/aset/logo.jpg') }}"
                        alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">

                        {{-- user setelah login atau pengunjung sudah daftar --}}
                        <a class="nav-link {{ Route::is('booking*') ? 'active' : '' }}" href="{{ route('booking.index') }}" style="{{ Route::is('booking*') ? 'color: blue;' : '' }}">Booking</a>
                        <a class="nav-link {{ Route::is('lokasi*') ? 'active' : '' }}" href="{{ route('lokasi.index') }}" style="{{ Route::is('lokasi*') ? 'color: blue;' : '' }}">Lokasi</a>
                        <a class="nav-link {{ Route::is('cekOrder*') ? 'active' : '' }}" href="{{ route('cekOrder.index') }}" style="{{ Route::is('cekOrder*') ? 'color: blue;' : '' }}">Cek Order</a>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- Nama User --}}
                            <h5 class="me-3">Hi, <b>{{ Auth::user()->name }}</b> </h5>
                            {{-- Picture --}}
                            @if (Auth::user()->picture)
                                <img src="{{ asset('storage/users/' . Auth::user()->picture) }}" alt="Profile Picture"
                                    class="rounded-circle" style="width: 50px; height: 50px;">
                            @else
                                <img src="https://picsum.photos/200" alt="Profile Picture" class="rounded-circle"
                                    style="width: 50px; height: 50px;">
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                            {{-- <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> --}}

                            <li>
                                <a href="#" onclick="preventDefault();" class="dropdown-item">
                                    Log Out
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar User -->
    @endif
@endguest

@push('js-navbar')
    <script>
        function preventDefault() {
            Swal.fire({
                title: 'Logout',
                text: 'Apakah kamu yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
