@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/flatpickr/flatpickr.min.css') }}">
@endsection
@section('title-header')
    <h3>Download Berkas</h3>
@endsection
@section('content')
    <div class="flex-column-fluid row">
        <div class="card border-2 shadow bg-white rounded p-4 ">
            <div class="card-body">
                <div class="row mb-6">
                    <div class="flex-column mb-2 fv-row col-sm-3">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Jenis Berkas</span>
                        </label>
                        <!--end::Label-->
                        <select class="selectpicker form-control form-control-sm form-select-solid" data-live-search="true"
                            title="Jenis Berkas" id="id_jenis_berkas" name="id_jenis_berkas">
                            <option value="" selected></option>
                            @foreach ($jenis_berkas as $item)
                                <option value="{{ $item->id_jenis_berkas }}">{{ $item->nama_jenis_berkas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-column mb-2 fv-row col-sm-3">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Unit</span>
                        </label>
                        <!--end::Label-->
                        <select class="selectpicker form-control form-control-sm form-select-solid" data-live-search="true"
                            title="Unit" id="unit" name="unit">
                            <option value="" selected></option>
                            @foreach ($unit as $item)
                                <option value="{{ $item->id_unit }}">{{ $item->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-column mb-2 fv-row col-sm-2">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Tanggal Awal</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-sm" id="tanggal_awal" readonly>
                    </div>
                    <div class="flex-column mb-2 fv-row col-sm-2">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Tanggal Akhir</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-sm" id="tanggal_akhir" readonly>
                    </div>

                    <div class="flex-column mb-2 fv-row col-sm-2">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Status Berkas</span>
                        </label>
                        <!--end::Label-->
                        <select class="selectpicker form-control form-control-sm form-select-solid" data-live-search="true"
                            title="Status Berkas" id="status_berkas">
                            <option value="" selected></option>
                            <option value="n">Private</option>
                            <option value="y">Publik</option>
                        </select>
                    </div>

                    <div class="flex-column mb-2 fv-row col-sm-3">
                        <button type="button" class="btn btn-primary btn-sm mt-9 w-100" id="btn_filter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-filter" viewBox="0 0 16 16">
                                <path
                                    d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                                </path>
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="nowrap table" style="width:100%">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-50px">Nomor</th>
                                <th class="w-75">Berkas</th>
                                <th class="w-100px">Unit</th>
                                <th class="w-100px">Status</th>
                                <th class="w-100px">Tanggal Upload</th>
                                <th class="w-100px">Tanggal Pembaruan</th>
                                <th class="w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/flatpickr/id.js') }}"></script>
    <script>
        var table;

        $("#tanggal_awal").flatpickr({
            format: "d/m/Y",
            altFormat: "d/m/Y",
            allowInput: false,
            altInput: true,
            locale: "id",
        });
        $("#tanggal_akhir").flatpickr({
            format: "d/m/Y",
            altFormat: "d/m/Y",
            allowInput: false,
            altInput: true,
            locale: "id",
        });
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            var url_x = "{{ url('/') }}";
            table = $('#example').DataTable({
                stateSave: true,
                stateDuration: -1,
                language: {
                    processing: '<p clas="text-bold p-5">Tunggu Sebentar...</p>'
                },
                info: false,
                processing: true,
                serverSide: true,
                order: [],
                ordering: true,
                ajax: url_x,
                columns: [{
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "nama_berkas",
                        render: function(data) {
                            var x = data.split("#_#")
                            var detail = '{{ route('dashboard.show', [':id_berkas']) }}'
                            return `<a  href="${detail.replace(':id_berkas', x[1])}" target="_blank">${x[0]}</a>`;
                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "nama_unit",
                        render: function(data) {

                            return data;
                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "status_berkas",
                        render: function(data) {
                            return data == 'y' ? "Publik" : "Private"
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "create_date",
                        render: function(data) {

                            return data;
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "update_date",
                        render: function(data) {

                            return data;
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "action",
                        render: function(data) {
                            var detail = '{{ route('dashboard.show', [':id_berkas']) }}'
                            var x_detail = "";
                            x_detail =
                                `<a target="_blank" data-toggle='tooltip' data-placement='top' title='Detail' href='${detail.replace(':id_berkas', data)}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-file-text ' aria-hidden='true'></span></a>`;
                            return `${x_detail}`;
                        },
                        orderable: false,
                        searchable: false,
                    },
                ],
            });
        });

        $("#btn_filter").click(function() {
            var id_jenis_berkas = $("#id_jenis_berkas").find("option:selected").val();
            var status_berkas = $("#status_berkas").find("option:selected").val();
            var unit = $("#unit").find("option:selected").val();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();
            var url =`?q=pencarian&id_jenis_berkas=${id_jenis_berkas}&status_berkas=${status_berkas}&unit=${unit}&tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}`;
            var url_x = "{{ url('/') }}" + url;
            table.ajax.url(url_x);
            table.ajax.reload();
        });
    </script>
@endsection
