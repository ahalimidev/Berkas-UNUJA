@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
@endsection

@section('title-header')
    <h3>List Sub Kategori berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">List Sub Kategori berkas</span>
                </h3>
                <div class="card-toolbar">

                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('sub_kategori.create') }}">Add
                            Sub Kategori berkas</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="text-muted mb-3">
                    Pada halaman ini digunakan untuk menambah, mengedit, dan detail Sub Kategori berkas
                </div>

                <div class="table-responsive">
                    <table id="example" class="table-bordered dt-responsive nowrap table" style="width:100%">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-25px"></th>

                                <th class="text-center">Actions</th>
                                <th class="text-center">Kategori berkas</th>
                                <th class="text-center">Sub Kategori berkas</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                    </table>
                </div>
            </div>
            <!--begin::Body-->
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/custom/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/print.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#example').DataTable({
                stateSave: true,
                stateDuration: -1,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: window.location.href,
                order: [],
                ordering: true,
                columns: [{
                        data: "DT_RowIndex",
                        render: function(data) {
                            if (data != null) {
                                return "";
                            }

                            return data;
                        },
                        orderable: false,
                    },
                    {
                        data: "action",
                        render: function(data) {
                            var detail = '{{ route('sub_kategori.show', [':kategori']) }}';
                            var edit = '{{ route('sub_kategori.edit', [':kategori']) }}';
                            var x_edit = "";
                            var x_detail = "";
                            x_detail =
                                `<a data-toggle='tooltip' data-placement='top' title='View' href='${detail.replace(':kategori', data)}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-file-text ' aria-hidden='true'></span></a>`;
                            x_edit =
                                `<a data-toggle='tooltip' data-placement='top' title='Edit' href='${edit.replace(':kategori', data)}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-pencil ' aria-hidden='true'></span> </a>`;
                            return `${x_detail} ${x_edit} `;
                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "nama_kategori_berkas",
                        name: "nama_kategori_berkas"
                    },
                    {
                        data: "nama_sub_berkas",
                        name: "nama_sub_berkas"
                    },
                ],
            });
        });
    </script>
@endsection
