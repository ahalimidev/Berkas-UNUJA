@extends('layouts.index')

@section('css')
@endsection

@section('title-header')
    <h3>Tampil Sub Berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Tampil Sub Berkas</span>
                </h3>

            </div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="align-content-center">
                        <div class="row">
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Nama Berkas</span>
                                </label>
                                <!--end::Label-->
                                <p>{{$one->nama_berkas}}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Unit</span>
                                </label>
                                <!--end::Label-->
                                <p>{{$one->nama_unit}}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Struktur</span>
                                </label>
                                <!--end::Label-->
                                <p>{{$one->nama_struktur}}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Jenis Berkas</span>
                                </label>
                                <!--end::Label-->
                                <p>{{$one->nama_jenis_berkas}}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Keterangan Berkas</span>
                                </label>
                                <!--end::Label-->
                                <p>{{$one->keterangan_berkas}}</p>
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
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Nama Sub Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{$one->nama_sub_berkas}}" class="form-control form-control-sm "
                                    disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Sub Unit</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{$one->sub_nama_unit}}" class="form-control form-control-sm "
                                    disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Sub Struktur</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{$one->sub_nama_struktur}}" class="form-control form-control-sm "
                                    disabled />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Sub Berkas</span>
                                </label>
                                <!--end::Label-->
                                <a href="{{ route('sub_berkas.show.pdf', ['data' => $one->sub_berkas]) }}" target="blank_"
                                    class="btn btn-sm btn-primary w-200px mt-5">Download Sub Berkas</a>
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
@endsection
