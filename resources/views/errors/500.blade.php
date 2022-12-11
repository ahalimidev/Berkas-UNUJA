<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>Universitas Nurul Jadid</title>
	<meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700" />
	<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="bg-body">

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-center flex-column-fluid p-10">
            <img src="{{ asset('assets/media/illustrations/sketchy/17.png') }}" alt="" class="mw-100 mb-10 h-lg-450px" />
            <h1 class="fw-bold mb-10" style="color: #A3A3C7">Kesalahan server dari dalam</h1>
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
