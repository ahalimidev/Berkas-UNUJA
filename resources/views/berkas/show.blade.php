@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
    <h3>Tampil Berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Tampil Berkas</span>
                </h3>

            </div>
            <div class="card-body">
                @include('errors.alert')
                <div class="row justify-content-md-center">
                    <div class="align-content-center">
                        <div class="row">
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Unit</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-sm " value="{{ $one->nama_unit }}"
                                    disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Struktur</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-sm "
                                    value="{{ $one->nama_struktur }}" disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Jenis Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-sm "
                                    value="{{ $one->nama_jenis_berkas }}" disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Nama Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-sm " value="{{ $one->nama_berkas }}"
                                    disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Keterangan Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="keterangan_berkas" class="form-control form-control-sm "
                                    value="{{ $one->keterangan_berkas }}" disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Berkas</span>
                                </label>
                                <!--end::Label-->
                                <a href="{{ route('berkas.show.pdf', ['data' => $one->berkas]) }}" target="blank_"
                                    class="btn btn-sm btn-primary w-200px mt-5">Download Berkas</a>
                            </div>

                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-7 fw-bold mb-3">
                                    <span>Status Berkas</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3 p-2">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status_berkas" type="radio"
                                                value="y" id="kt_modal_update_role_option_1"
                                                {{ $one->status_berkas == 'y' ? 'checked' : '' }} disabled>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_1" disabled>
                                                <div class="fw-bolder text-gray-800">Publik</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3 p-2">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status_berkas" type="radio"
                                                value="n" id="kt_modal_update_role_option_2"
                                                {{ $one->status_berkas == 'n' ? 'checked' : '' }} disabled>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_2" disabled>
                                                <div class="fw-bolder text-gray-800">Private</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Status</span>
                                </label>
                                @php
                                    if ($one->status == 'active') {
                                        $active = 'checked';
                                        $block = '';
                                    } else {
                                        $active = '';
                                        $block = 'checked';
                                    }
                                @endphp
                                <!--end::Label-->
                                <div class="row">
                                    <div class="d-flex fv-row col-sm-6 p-2">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input {{ $active }} class="form-check-input me-3" name="status"
                                                type="radio" value="active" id="kt_modal_update_role_option_2" disabled>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_2" disabled>
                                                <div class="fw-bolder text-gray-800">Active</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <div class="d-flex fv-row col-sm-6 p-2">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input {{ $block }} class="form-check-input me-3" name="status"
                                                type="radio" value="block" id="kt_modal_update_role_option_2" disabled>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_2" disabled>
                                                <div class="fw-bolder text-gray-800">Block</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-sm btn-bg-success w-100px text-white"
                                    href="{{ redirect()->back()->getTargetUrl() }}">
                                    <span class="indicator-label">Kembali</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
