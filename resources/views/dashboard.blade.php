@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="row">
            <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Master Lembaga</span>
                    </h3>
                    <div class="flex-column fv-row mt-5 w-250px">

                        <select class="selectpicker form-control form-control-sm form-select-solid bg-light-dark"
                            name="tahun1" id="tahun1" data-live-search="true">
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table-bordered dt-responsive nowrap table" style="width:100%">
                            <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-25px"></th>
                                    <th class="w-100px text-center">Lembaga</th>
                                    <th class="w-35px text-center">Total Berkas</th>
                                    <th class="w-35px text-center">Total Download</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Master Fakultas</span>
                    </h3>
                    <div class="flex-column fv-row mt-5 w-250px">

                        <select class="selectpicker form-control form-control-sm form-select-solid bg-light-dark"
                            name="tahun2" id="tahun2" data-live-search="true">
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table-bordered dt-responsive nowrap table" style="width:100%">
                            <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-25px"></th>
                                    <th class="w-100px text-center">Fakultas</th>
                                    <th class="w-35px text-center">Total Berkas</th>
                                    <th class="w-35px text-center">Total Download</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>

    <script>
        var table1;
        var table2;
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            var x1 = '{{ route('dashboard.master_lembaga') }}';

            table1 = $('#example1').DataTable({
                ajax: x1,
                language: {
                    processing: '<p clas="text-bold p-5">Tunggu Sebentar...</p>'
                },
                info: false,
                processing: true,
                serverSide: true,
                order: [
                    [3, 'desc']
                ],
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
                        data: "nama_lembaga",
                        name: "nama_lembaga"
                    },
                    {
                        data: "download",
                        name: "download"
                    },
                    {
                        data: "berkas",
                        name: "berkas"
                    },
                ],
            });
            var x2 = '{{ route('dashboard.master_fakultas') }}';
            table2 = $('#example2').DataTable({
                ajax: x2,
                language: {
                    processing: '<p clas="text-bold p-5">Tunggu Sebentar...</p>'
                },
                info: false,
                processing: true,
                serverSide: true,
                order: [
                    [3, 'desc']
                ],
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
                        data: "nama_fakultas",
                        name: "nama_fakultas"
                    },
                    {
                        data: "download",
                        name: "download"
                    },
                    {
                        data: "berkas",
                        name: "berkas"
                    },
                ],
            });
        });
        $('#tahun1').each(function() {
            var currentYear = new Date().getFullYear()
            max = currentYear + 0
            var option = "";
            for (var year = currentYear - 7; year <= max; year++) {
                var option = document.createElement("option");
                option.text = year;
                option.value = year;
                if (year == currentYear){
                    $(this).append('<option selected value="' + year + '">' + year + '</option>');
                }else{
                    $(this).append('<option value="' + year + '">' + year + '</option>');

                }
            }
        })
        $('#tahun2').each(function() {
            var currentYear = new Date().getFullYear()
            max = currentYear + 0
            var option = "";
            for (var year = currentYear - 7; year <= max; year++) {
                var option = document.createElement("option");
                option.text = year;
                option.value = year;
                if (year == currentYear){
                    $(this).append('<option selected value="' + year + '">' + year + '</option>');
                }else{
                    $(this).append('<option value="' + year + '">' + year + '</option>');

                }
            }
        })

        $("#tahun1").on("change", function() {
            var tahun = $("#tahun1").find("option:selected").val()
            var x = '{{ route('dashboard.master_lembaga_tahun', [':tahun']) }}';
            var xx = x.replace(':tahun', tahun)
            table1.ajax.url(xx);
            table1.ajax.reload();
        });
        $("#tahun2").on("change", function() {
            var tahun = $("#tahun2").find("option:selected").val()
            var x = '{{ route('dashboard.master_fakultas_tahun', [':tahun']) }}';
            var xx = x.replace(':tahun', tahun)
            table2.ajax.url(xx);
            table2.ajax.reload();

        });
    </script>
@endsection
