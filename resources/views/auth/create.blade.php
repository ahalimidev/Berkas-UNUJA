@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">

@endsection

@section('title-header')
<h3>Menambah Login</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Menambahkan Login</span>
                </h3>

            </div>
            <form action="{{ route('auth.store') }}" method="post">
                @csrf

                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 align-content-center">

                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Nama</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="nama" class="form-control form-control-sm "  required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Username</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="username" class="form-control form-control-sm "  required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Password</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="password" class="form-control form-control-sm "  required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-7 fw-bold mb-3 required">
                                    <span>Status</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status" type="radio"
                                                value="editor" id="kt_modal_update_role_option_1" required>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                <div class="fw-bolder text-gray-800">Editor</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status" type="radio"
                                                value="viewer" id="kt_modal_update_role_option_2" required>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_2">
                                                <div class="fw-bolder text-gray-800">Viewer</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Lembaga / Fakultas</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Lembaga / Fakultas" id="pilih_kategori">
                                    <option value="1">Lembaga</option>
                                    <option value="2">Fakultas</option>
                                </select>

                            </div>
                            <div class="flex-column mb-8 fv-row" id="ll_lembaga">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Lembaga</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Lembaga" id="id_lembaga" name="id_lembaga" >

                                </select>

                            </div>
                            <div class="flex-column mb-8 fv-row" id="ll_fakultas">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Fakultas</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Fakultas" id="id_fakultas" name="id_fakultas">

                                </select>

                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary w-250px" id="btnSubmit">
                                    <span class="indicator-label">Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-center">
            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ redirect()->back()->getTargetUrl() }}">
                <span class="indicator-label">Go Back</span>
            </a>
        </div>
    </div>
@endsection

@section('javascript')

    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script>
         $("#ll_lembaga").hide();
         $("#ll_fakultas").hide();
         $("#pilih_kategori").on("change", function() {
            var x = $("#pilih_kategori").find("option:selected").val()
            if(x == 1){
                $("#ll_lembaga").show();
                $("#ll_fakultas").hide();
                lembaga();
            }else if(x == 2){
                $("#ll_lembaga").hide();
                $("#ll_fakultas").show();
                fakultas();
            }
        });

        function lembaga() {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/lembaga') }}",
                    dataType: 'json',
                    success: function(data) {
                        resolve(data)
                    },
                    error: function(error) {
                        reject(error)
                    },
                });
            });
            x.then((data) => {
                $("#id_lembaga").empty();
                $.each(data, function(index, item) {
                    $("#id_lembaga").append("<option value='" + item.id_lembaga + "'>" + item.nama_lembaga +"</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');

            }).catch(function(error) {
                console.log(error);
            });
        }

        function fakultas() {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/fakultas') }}",
                    dataType: 'json',
                    success: function(data) {
                        resolve(data)
                    },
                    error: function(error) {
                        reject(error)
                    },
                });
            });
            x.then((data) => {
                $("#id_fakultas").empty();
                $.each(data, function(index, item) {
                    $("#id_fakultas").append("<option value='" + item.id_fakultas + "'>" + item.nama_fakultas +"</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');

            }).catch(function(error) {
                console.log(error);
            });
        }

        window.onbeforeunload = function() {
            $("button[type=submit]").prop("disabled", "disabled");
        }
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
@endsection
