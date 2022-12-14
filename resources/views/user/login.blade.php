<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Universitas Nurul Jadid</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link href="{{ asset('assets/plugins/custom/font/font.css?family=Poppins:300,400,500,600,700') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!}
    <script type="text/javascript">
        function callbackThen(response) {
            // read Promise object
            response.json().then(function(data) {
                console.log(data);
                if (data.success && data.score >= 0.6) {
                    console.log('valid recaptcha');
                } else {
                    Swal.fire('Errors', 'Recaptcha Error', 'error')
                }
            });
        }

        function callbackCatch(error) {
            console.error('Error:', error)
        }
    </script>

</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset('assets/media/illustrations/14.png') }})">
            <div class="d-flex flex-center flex-column flex-column-fluid pb-lg-20 p-10">
                <a href="" class="mb-12">
                    <img alt="Logo" src="{{ asset('assets/media/unuja.png') }}" width="100px" height="100px" />
                </a>
                <form action="" method="post">
                    @csrf
                    <div class="w-lg-500px bg-body p-lg-15 mx-auto rounded p-10 shadow-sm">
                        @include('errors.alert')

                        <div class="mb-5 text-center">
                            <!--begin::Title-->
                            <h3 class="text-dark mb-8">Apliaski Peraturan Universistas Nurul Jadid</h3>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                            <input class="form-control form-control-sm form-control-solid" type="text"
                                name="username" required />
                        </div>
                        <div class="fv-row mb-5">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            </div>
                            <input class="form-control form-control-sm form-control-solid" type="password"
                                id="password" name="password" required />
                        </div>
                        <div class="mb-5 text-center">
                            <button id="kt_sign_in_submit" class="btn btn-sm btn-primary w-100 mb-5">
                                <span class="indicator-label">Login</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--begin::Javascript-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Javascript-->
</body>

</html>
