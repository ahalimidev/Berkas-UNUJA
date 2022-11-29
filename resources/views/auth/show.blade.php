@extends('layouts.index')

@section('css')
@endsection

@section('title-header')
<h3>Detail Login</h3>

@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Detail Login</span>
                </h3>

            </div>
            <div class="card-body">
                @include('errors.alert')
                <div class="row justify-content-md-center">
                    <div class="col-sm-6 align-content-center">

                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Nama</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm "
                                value="{{ $one->nama }}" disabled />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Username</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm "
                                value="{{ $one->username }}" disabled />
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Status</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm "
                                value="{{ $one->status }}" disabled />
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Username</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm "
                                value="{{ $one->username }}" disabled />
                        </div>

                        @if ($one->id_lembaga != null)
                        <div class="flex-column mb-8 fv-row" id="ll_lembaga">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Lembaga</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm " value="{{$one->nama_lembaga}}" disabled/>
                        </div>
                        @else
                        <div class="flex-column mb-8 fv-row" id="ll_fakultas">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Fakultas</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm " value="{{$one->nama_fakultas}}" disabled/>
                        </div>
                        @endif

                        <div class="text-center">
                            <a class="btn btn-sm btn-bg-success w-100px text-white"
                                href="{{ redirect()->back()->getTargetUrl() }}">
                                <span class="indicator-label">Go Back</span>
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
