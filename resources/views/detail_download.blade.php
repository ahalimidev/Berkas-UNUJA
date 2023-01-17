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
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Master Berkas</span>
                </h3>

            </div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="align-content-center">
                        <div class="row">
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Jenis Berkas</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->nama_jenis_berkas }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Unit</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->nama_unit }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Struktur</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->nama_struktur }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>SPMI</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->status_spmi == 'n' ? 'Tidak Aktif' : 'Aktif' }}</p>

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
                        <div class="row">
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Tanggal Upload</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->create_date == null ? '' : \Carbon\Carbon::parse($one->create_date)->format('d/m/Y H:i:s') }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>dibuat oleh</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->create_by }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Tanggal Pembaruan</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->update_date == null ? '' : \Carbon\Carbon::parse($one->update_date)->format('d/m/Y H:i:s') }}</p>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>perbarui oleh</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $one->update_by }}</p>

                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Berkas</span>
                            </label>
                            <!--end::Label-->
                            <a href="{{ route('download.pdf', ['data' => $one->berkas]) }}"
                                class="btn btn-sm btn-primary w-200px ">Unduh Berkas</a>
                            <a href="{{ route('viewers.pdf', ['data' => $one->berkas]) }}" target="blank_"
                                class="btn btn-sm btn-info mt-2 w-200px ">Lihat Berkas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (count($all) > 0)
            <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Sub Berkas</span>
                    </h3>

                </div>
                <div class="card-body">
                    @foreach ($all as $item)
                        <div class="d-flex flex-column mb-3 fv-row">
                            <!--begin::Label-->

                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Unit</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $item->sub_nama_unit }}</p>
                            </div>

                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                    <span>Nama Berkas</span>
                                </label>
                                <!--end::Label-->
                                <p>{{ $item->nama_sub_berkas }}</p>
                                <a href="{{ route('sub.download.pdf', ['data' => $item->sub_berkas]) }}" target="blank_"
                                    class="btn btn-sm btn-primary w-200px ">Unduh Berkas</a>
                                <a href="{{ route('viewers.pdf', ['data' => $item->sub_berkas]) }}" target="blank_"
                                    class="btn btn-sm btn-info mt-2 w-200px ">Lihat Berkas</a>

                            </div>

                            <div class="row mt-2">
                                <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>Tanggal Upload</span>
                                    </label>
                                    <!--end::Label-->
                                    <p>{{ $item->create_date == null ? '' : \Carbon\Carbon::parse($item->create_date)->format('d/m/Y H:i:s') }}
                                    </p>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>dibuat oleh</span>
                                    </label>
                                    <!--end::Label-->
                                    <p>{{ $item->create_by }}</p>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>Tanggal Pembaruan</span>
                                    </label>
                                    <!--end::Label-->
                                    <p>{{ $item->update_date == null ? '' : \Carbon\Carbon::parse($item->update_date)->format('d/m/Y H:i:s') }}
                                    </p>

                                </div>
                                <div class="d-flex flex-column mb-8 fv-row col-sm-3">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                        <span>perbarui oleh</span>
                                    </label>
                                    <!--end::Label-->
                                    <p>{{ $item->update_by }}</p>

                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script></script>
@endsection
