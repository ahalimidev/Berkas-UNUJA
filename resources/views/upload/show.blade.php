@extends('layouts.index')

@section('css')

@endsection

@section('title-header')
    <h3>Detail Upload Berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Detail Upload Berkas</span>
                </h3>

            </div>
            <div class="card-body">
                @include('errors.alert')
                <div class="row justify-content-md-center">
                    <div class="align-content-center">
                        <div class="row">
                            <div class="flex-column mb-8 fv-row col-sm-4" >
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Kategori Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-sm " value="{{$one->nama_kategori_berkas}}" disabled/>


                            </div>
                            <div class="flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Sub Kategori Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-sm " value="{{$one->nama_sub_berkas}}" disabled/>


                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Lembaga / Fakultas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-sm " value="{{$one->id_lembaga != null ? "Lembaga" : "Fakultas"}}" disabled/>


                            </div>
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
                        <div class="flex-column mb-8 fv-row" id="ll_prodi">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Program Studi</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm " value="{{$one->program_studi}}" disabled/>


                        </div>
                        @endif



                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Nama Berkas</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm " value="{{$one->nama_berkas}}" disabled/>

                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Keterangan Berkas</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm " value="{{$one->keterangan_berkas}}" disabled/>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Berkas</span>
                            </label>
                            <!--end::Label-->
                            <a href="{{ route('berkas_file', ['data'=>$one->berkas]) }}" target="blank_" class="btn btn-sm btn-primary w-200px ">Download Berkas</a>
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-7 fw-bold mb-3 ">
                                <span>Status Berkas</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm " value="{{$one->status_berkas == 'y' ? 'Publik' : 'Private'}}" disabled/>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="text-center">
            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ redirect()->back()->getTargetUrl() }}">
                <span class="indicator-label">Go Back</span>
            </a>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
