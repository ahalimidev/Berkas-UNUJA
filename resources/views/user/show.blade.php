@extends('layouts.index')

@section('css')
@endsection

@section('title-header')
    <h3>Tampil Pengguna</h3>
@endsection

@section('content')
    <div class="content flex-column-fluid">
        <div class="card mb-xl-8 mb-5 border-2">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Tampil Pengguna</span>
                </h3>

            </div>
            <div class="card-body py-12">
                @include('errors.alert')
                <div class="row justify-content-md-center">
                    <div class="col-sm-6 align-content-center">
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Name</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->nama }}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Unit</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->nama_unit}}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Username</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->username }}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Password</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="************" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Create By</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->create_by }}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Create Date</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->create_date }}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Update By</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->update_by }}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Update Date</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->update_date }}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Status</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $one->status }}" disabled />
                        </div>
                        <div class="text-center">
                            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ route('jenis_berkas.index') }}">
                                <span class="indicator-label">Kembali</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
