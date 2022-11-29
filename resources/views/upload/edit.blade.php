@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
    <h3>Edit Upload Berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Edit Upload Berkas</span>
                </h3>

            </div>
            <form action="{{ route('upload.update', ['upload' => $id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="align-content-center">
                            <div class="row">
                                <div class="flex-column mb-8 fv-row col-sm-4">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Kategori Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="selectpicker form-control form-control-sm form-select-solid"
                                        data-live-search="true" title="Kategori Berkas" id="id_kategori_berkas"
                                        name="id_kategori_berkas" required>

                                    </select>

                                </div>
                                <div class="flex-column mb-8 fv-row col-sm-4">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Sub Kategori Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="selectpicker form-control form-control-sm form-select-solid"
                                        data-live-search="true" title="Sub Kategori Berkas" id="id_sub_berkas"
                                        name="id_sub_berkas" required>

                                    </select>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Lembaga / Fakultas</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="selectpicker form-control form-control-sm form-select-solid"
                                        data-live-search="true" title="Lembaga / Fakultas" id="pilih_kategori" required>
                                        <option value="1" {{ $one->id_lembaga != null ? 'selected' : '' }}>Lembaga
                                        </option>
                                        <option value="2"{{ $one->id_lembaga != null ? '' : 'selected' }}>Fakultas
                                        </option>
                                    </select>

                                </div>
                            </div>
                            <div class="flex-column mb-8 fv-row" id="ll_lembaga">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Lembaga</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Lembaga" id="id_lembaga" name="id_lembaga">

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
                            <div class="flex-column mb-8 fv-row" id="ll_prodi">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Program Studi</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Program Studi" id="id_prodi" name="id_prodi">

                                </select>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Nama Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="nama_berkas" class="form-control form-control-sm "
                                    value="{{ $one->nama_berkas }}" required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Keterangan Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="keterangan_berkas" class="form-control form-control-sm "
                                    value="{{ $one->keterangan_berkas }}" />

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="file" name="berkas" class="form-control form-control-sm" id="berkas"
                                    accept=".pdf">
                                <a href="{{ route('berkas_file', ['data' => $one->berkas]) }}" target="blank_"
                                    class="btn btn-sm btn-primary w-200px mt-5">Download Berkas</a>

                            </div>

                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-7 fw-bold mb-3 required">
                                    <span>Status Berkas</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status_berkas" type="radio"
                                                value="y" id="kt_modal_update_role_option_1"
                                                {{ $one->status_berkas == 'y' ? 'checked' : '' }} required>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                <div class="fw-bolder text-gray-800">Publik</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status_berkas" type="radio"
                                                value="n" id="kt_modal_update_role_option_2"
                                                {{ $one->status_berkas == 'n' ? 'checked' : '' }} required>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_2">
                                                <div class="fw-bolder text-gray-800">Private</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                </div>
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
        kategori();
        $("#ll_lembaga").hide();
        $("#ll_fakultas").hide();
        $("#ll_prodi").hide();
        $("#pilih_kategori").on("change", function() {
            var x = $("#pilih_kategori").find("option:selected").val()
            if (x == 1) {
                $("#ll_lembaga").show();
                $("#ll_fakultas").hide();
                $("#ll_prodi").hide();
                lembaga();
            } else if (x == 2) {
                $("#ll_lembaga").hide();
                $("#ll_fakultas").show();
                $("#ll_prodi").show();
                fakultas();
            }
        });

        if ("{{ $one->id_lembaga != null }}") {
            $("#ll_lembaga").show();
            $("#ll_fakultas").hide();
            $("#ll_prodi").hide();
            lembaga();
        } else {
            $("#ll_lembaga").hide();
            $("#ll_fakultas").show();
            $("#ll_prodi").show();
            fakultas();
        }

        $("#id_fakultas").on("change", function() {
            var x = $("#id_fakultas").find("option:selected").val()
            if (x != "") {
                prodi(x)
            }
        });

        $("#id_kategori_berkas").on("change", function() {
            var xx = $("#id_kategori_berkas").find("option:selected").val()
            console.log(xx);
            if (xx != "") {
                sub_kategori_berkas(xx)
            }
        });

        function kategori() {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/kategori_berkas') }}",
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
                $("#id_kategori_berkas").empty();

                $.each(data, function(index, item) {
                    $("#id_kategori_berkas").append("<option value='" + item.id_kategori_berkas + "'>" +
                        item.nama_kategori_berkas + "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');
                if ("{{ $one->id_kategori_berkas != null }}") {
                    $("#id_kategori_berkas").val("{{ $one->id_kategori_berkas }}")
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker('render');
                    sub_kategori_berkas("{{ $one->id_kategori_berkas }}")
                }
            }).catch(function(error) {
                console.log(error);
            });

        }

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
                $("#id_lembaga").append('<option value="">All Data</option>');
                $.each(data, function(index, item) {
                    $("#id_lembaga").append("<option value='" + item.id_lembaga + "'>" + item.nama_lembaga +
                        "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');
                if ("{{ $one->id_lembaga != null }}") {
                    $("#id_lembaga").val("{{ $one->id_lembaga }}")
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker('render');
                }
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
                $("#id_fakultas").append('<option value="">All Data</option>');
                $.each(data, function(index, item) {
                    $("#id_fakultas").append("<option value='" + item.id_fakultas + "'>" + item
                        .nama_fakultas + "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');
                if ("{{ $one->id_fakultas != null }}") {
                    $("#id_fakultas").val("{{ $one->id_fakultas }}")
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker('render');
                    prodi("{{ $one->id_fakultas }}")
                }

            }).catch(function(error) {
                console.log(error);
            });

        }

        function prodi(id) {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/prodi') }}" + "/" + id,
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
                $("#id_prodi").empty();
                $("#id_prodi").append('<option value="">All Data</option>');
                $.each(data, function(index, item) {
                    $("#id_prodi").append("<option value='" + item.prodi_id + "'>" + item.program_studi +
                        "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');
                if ("{{ $one->id_prodi != null }}") {
                    $("#id_prodi").val("{{ $one->id_prodi }}")
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker('render');
                }
            }).catch(function(error) {
                console.log(error);
            });

        }

        function sub_kategori_berkas(id) {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/sub_kategori_berkas') }}" + "/" + id,
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
                console.log(data);

                $("#id_sub_berkas").empty();
                $.each(data, function(index, item) {
                    $("#id_sub_berkas").append("<option value='" + item.id_sub_berkas + "'>" + item
                        .nama_sub_berkas + "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');
                if ("{{ $one->id_sub_berkas != null }}") {
                    $("#id_sub_berkas").val("{{ $one->id_sub_berkas }}")
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker('render');
                }
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
