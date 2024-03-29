@extends('layouts.index')

@section('css')
@endsection

@section('title-header')
    <h3>Pembaruan Jenis Berkas</h3>
@endsection

@section('content')
    <div class="content flex-column-fluid">
        <div class="card mb-xl-8 mb-5 border-2">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Pembaruan Jenis Berkas</span>
                </h3>

            </div>
            <form action="{{ route('jenis_berkas.update', ['jenis_berka' => $id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body py-12">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 align-content-center">
                            <div class="d-flex flex-column fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Jenis Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="nama_jenis_berkas"
                                    class="form-control form-control-sm" value="{{ $one->nama_jenis_berkas }}"
                                    required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-7 fw-bold mb-3 required">
                                    <span>Standar SPMI</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3 p-2">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status_spmi" type="radio"
                                                value="y" id="kt_modal_update_role_option_11"  {{ $one->status_spmi == 'y' ? 'checked' : '' }} required>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_11">
                                                <div class="fw-bolder text-gray-800">Aktif</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-lx-4 col-lxx-3 p-2">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="status_spmi" type="radio"
                                                value="n" id="kt_modal_update_role_option_22" {{ $one->status_spmi == 'n' ? 'checked' : '' }} required>
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_22">
                                                <div class="fw-bolder text-gray-800">Tidak Aktif</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
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
                                <div class="d-flex fv-row mb-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input {{ $active }} class="form-check-input me-3" name="status"
                                            type="radio" value="active" id="kt_modal_update_role_option_2">
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_2">
                                            <div class="fw-bolder text-gray-800">Active</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input {{ $block }} class="form-check-input me-3" name="status"
                                            type="radio" value="block" id="kt_modal_update_role_option_2">
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_2">
                                            <div class="fw-bolder text-gray-800">Block</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary w-250px" id="btnSubmit">
                                    <span class="indicator-label">Update</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="text-center">
            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ route('jenis_berkas.index') }}">
                <span class="indicator-label">Kembali</span>
            </a>
        </div>
    </div>
@endsection

@section('javascript')
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
