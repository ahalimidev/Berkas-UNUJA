@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
    <h3>Tambah Berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Tambah Berkas</span>
                </h3>

            </div>
            <form action="{{ route('berkas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="align-content-center">
                            <div class="row">
                                <div class="flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Jenis Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <select class="selectpicker form-control form-control-sm form-select-solid"
                                        data-live-search="true" title="Jenis Berkas" id="id_jenis_berkas"
                                        name="id_jenis_berkas" required>
                                        @foreach ($jenis_berkas as $item)
                                            <option value="{{ $item->id_jenis_berkas }}">{{ $item->nama_jenis_berkas }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Nama Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" name="nama_berkas" class="form-control form-control-sm "
                                        required />
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Keterangan Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" name="keterangan_berkas" class="form-control form-control-sm " required/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                        <span>Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" name="berkas" class="form-control form-control-sm" id="berkas"
                                        accept=".pdf" required>
                                </div>

                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-7 fw-bold mb-3 required">
                                        <span>Status Berkas</span>
                                    </label>
                                    <!--end::Label-->
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3 p-2">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="status_berkas" type="radio"
                                                    value="y" id="kt_modal_update_role_option_1" required>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                    <div class="fw-bolder text-gray-800">Publik</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3 p-2">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="status_berkas" type="radio"
                                                    value="n" id="kt_modal_update_role_option_2" required>
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
    </script>
@endsection
