@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
    <h3>Tambah Sub Berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Tambah Sub Berkas</span>
                </h3>

            </div>
            <form action="{{ route('sub_berkas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="align-content-center">
                            <div class="row">
                                <div class="flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="selectpicker form-control form-control-sm form-select-solid"
                                        data-live-search="true" title="Berkas" id="id_berkas" name="id_berkas" required>
                                        @foreach ($berkas as $item)
                                            <option value="{{ $item->id_berkas }}">{{ $item->nama_berkas }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>Unit</span>
                                    </label>
                                    <!--end::Label-->
                                    <p id="nama_unit"></p>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>Struktur</span>
                                    </label>
                                    <!--end::Label-->
                                    <p id="nama_struktur"></p>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>SPMI</span>
                                    </label>
                                    <!--end::Label-->
                                    <p id="status_spmi"></p>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>Jenis Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <p id="nama_jenis_berkas"></p>
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Keterangan Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <p id="keterangan_berkas"></p>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <a target="blank_" class="btn btn-sm btn-primary w-200px mt-5" id="berkas">Download Berkas</a>
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Nama Sub Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" name="nama_sub_berkas" class="form-control form-control-sm " required />
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Sub Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" name="sub_berkas" class="form-control form-control-sm" id="sub_berkas" accept=".pdf, .docx, .doc, .zip" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary w-250px" id="btnSubmit">
                                        <span class="indicator-label">Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-center">
            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ redirect()->back()->getTargetUrl() }}">
                <span class="indicator-label">Kembali</span>
            </a>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script>
        window.onbeforeunload = function() {
            $("button[type=submit]").prop("disabled", "disabled");
        }
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 2000);
        $("#id_berkas").on("change", function() {
            var id_berkas = $("#id_berkas").find("option:selected").val();
            const x = new Promise((resolve, reject) => {
                var url = '{{ route('sub_berkas.berkas', [':id_berkas']) }}';
                $.ajax({
                    url: url.replace(':id_berkas', id_berkas),
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
                $("#nama_unit").html(data.nama_unit);
                $("#nama_struktur").html(data.nama_struktur);
                $("#nama_jenis_berkas").html(data.nama_jenis_berkas);
                $("#keterangan_berkas").html(data.keterangan_berkas);
                $("#status_spmi").html(data.status_spmi == 'y' ? 'Aktif' : 'Tidak Aktif');
                var x = '{{ route('berkas.show.pdf', [':berkas']) }}'
                $("#berkas").attr("href", x.replace(':berkas', data.berkas));
            }).catch(function(error) {
                console.log(error);
            });
        });
    </script>
@endsection
