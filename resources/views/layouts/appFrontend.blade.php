
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Telnest - Pesan Hotel</title>

    @include('layouts.frontends.styles')
</head>
<body>
    <!-- navbar -->
    @include('layouts.frontends.navbar')
    <!-- navbar -->

    <!-- content -->
    @yield('content')
    <!-- content -->

    <!-- footer -->
    <footer>
        <h6>&copy; Copyright, CariKosan 2024</h6>
    </footer>
    <!-- footer -->

    <!-- scripts -->
    @include('layouts.frontends.scripts')
    <!-- scripts -->
</body>
</html>
