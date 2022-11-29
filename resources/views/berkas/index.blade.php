@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
@endsection
@section('title-header')
    <h3>Upload Berkas</h3>
@endsection
@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">List Upload Berkas</span>
                </h3>
                <div class="card-toolbar">

                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('upload_berkas.create') }}">Add Upload Berkas</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="text-muted mb-3">
                    Pada halaman ini digunakan untuk menambah, mengedit, dan detail Upload Berkas
                </div>

                <div class="table-responsive">
                    <table id="example" class="table-bordered dt-responsive nowrap table" style="width:100%">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-25px"></th>
                                <th class="w-50px text-center">Actions</th>
                                <th class="w-100px text-center">Kategori Berkas</th>
                                <th class="w-100px text-center">Sub Kategori Berkas</th>
                                <th class="w-100px text-center">Nama Berkas</th>
                                <th class="w-100px text-center">Publikasi</th>
                                <th class="w-100px text-center">Lembaga</th>
                                <th class="w-100px text-center">Falkultas</th>
                                <th class="w-100px text-center">Program Studi</th>
                                <th class="w-100px text-center">Tanggal Simpan</th>
                                <th class="w-100px text-center">Simpan Oleh</th>
                                <th class="w-100px text-center">Tanggal Perubahan</th>
                                <th class="w-100px text-center">Perubahan Oleh</th>
                                <th class="w-100px text-center">Total Download</th>
                                <th class="w-100px text-center">Total Revisi</th>

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
    <script>
         $(document).ready(function() {
            var table = $('#example').DataTable({
                dom: "lBfrtip",
                stateSave: true,
                stateDuration: -1,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50]
                ],
                language: {
                    processing: '<p clas="text-bold p-5">Tunggu Sebentar...</p>'
                },
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
                            var x = data.split("#_#");
                            var download = '{{ route('berkas_file', [':upload']) }}'
                            var detail = '{{ route('upload_berkas.show', [':upload']) }}';
                            var edit = '{{ route('upload_berkas.edit', [':upload']) }}';
                            var x_edit = "";
                            var x_download = "";
                            var x_detail = "";
                            var x_delete = "";
                            x_download =
                                    `<a data-toggle='tooltip' data-placement='top' title='Download' target="blank_"  href='${download.replace(':upload', x[1])}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-download ' aria-hidden='true'></span></a>`;
                                x_detail =
                                    `<a data-toggle='tooltip' data-placement='top' title='View' href='${detail.replace(':upload', x[0])}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-file-text ' aria-hidden='true'></span></a>`;
                                x_edit =
                                    `<a data-toggle='tooltip' data-placement='top' title='Edit' href='${edit.replace(':upload', x[0])}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-pencil ' aria-hidden='true'></span> </a>`;
                                x_delete =
                                    `<a data-toggle='tooltip' data-placement='top' title='Delete' onclick='deleteConfirmation(${x[0]})' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-trash ' aria-hidden='true'></span></a>`;
                            return `${x_download} ${x_detail} ${x_edit} ${x_delete}`;
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
                    {
                        data: "nama_berkas",
                        name: "nama_berkas"
                    },
                    {
                        data: "status_berkas",
                        name: "status_berkas"
                    },
                    {
                        data: "nama_lembaga",
                        name: "nama_lembaga"
                    },
                    {
                        data: "nama_fakultas",
                        name: "nama_fakultas"
                    },
                    {
                        data: "program_studi",
                        name: "program_studi"
                    },
                    {
                        data: "create_date",
                        name: "create_date"
                    },
                    {
                        data: "create_by",
                        name: "create_by"
                    },
                    {
                        data: "update_date",
                        name: "update_date"
                    },
                    {
                        data: "update_by",
                        name: "update_by"
                    },
                    {
                        data: "total_download",
                        name: "total_download"
                    },
                    {
                        data: "total_revisi",
                        name: "total_revisi"
                    },

                ],
            });
        });

        function deleteConfirmation(upload) {
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Itu akan dihapus secara permanen!",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.value) {
                    var destroy = '{{ route('upload_berkas.destroy', [':upload']) }}';
                    $.ajax({
                        url: destroy.replace(':upload', upload),
                        method: 'DELETE',
                        data: {
                            "upload": upload,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data == 1 || data == 0) {
                                Swal.fire('Deleted!', 'File telah dihapus.', 'success')
                                window.location.reload();
                            } else {
                                Swal.fire('Permission', 'Tidak memiliki akses hapus!', 'error')
                            }
                        },
                        error: function(error) {
                            Swal.fire('Oops...', 'Ada yang salah dengan penghapusan !', 'error')

                        }
                    });

                }
            });
        }
    </script>
@endsection
