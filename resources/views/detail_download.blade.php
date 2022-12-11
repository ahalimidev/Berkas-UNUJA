@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
@endsection
@section('title-header')
    <h3>Download Berkas</h3>
@endsection
@section('content')
    <div class="flex-column-fluid row">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">

            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="align-content-center">
                        <div class="row">
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Jenis Berkas</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->nama_jenis_berkas }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Nama Unit</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->nama_unit }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-4">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Nama Struktur</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->nama_struktur }}</p>

                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Nama Berkas</span>
                            </label>
                            <!--end::Label-->
                            <p>{{ $one->nama_berkas }}</p>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Keterangan Berkas</span>
                            </label>
                            <!--end::Label-->
                            <p>{{ $one->keterangan_berkas }}</p>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Berkas</span>
                            </label>
                            <!--end::Label-->
                            <a href="{{ route('download.pdf', ['data' => $one->berkas]) }}" target="blank_"
                                class="btn btn-sm btn-primary w-200px ">Download Data</a>
                        </div>
                        @if (count($all) > 0)
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Sub Berkas</span>
                            </label>
                            @foreach ($all as $item)
                            <hr>
                            <div class="d-flex flex-column mb-3 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>{{$item->sub_nama_unit.'('.$item->sub_nama_struktur.')'}}</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $item->nama_sub_berkas }}</p>

                                <a href="{{ route('sub.download.pdf', ['data' => $item->sub_berkas]) }}" target="blank_"
                                    class="btn btn-sm btn-primary w-200px ">Download Data</a>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script></script>
@endsection
