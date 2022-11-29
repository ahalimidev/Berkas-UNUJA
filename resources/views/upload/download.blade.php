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
        <div class="col-sm-3">
            <div class="card border-2 shadow  bg-white rounded p-4 m-1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Kategori Berkas</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Kategori Berkas" id="id_kategori_berkas"
                                    name="id_kategori_berkas" required>

                                </select>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Sub Berkas</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Sub Berkas" id="id_sub_berkas" name="id_sub_berkas"
                                    required>

                                </select>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Lembaga / Fakultas</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Lembaga / Fakultas" id="pilih_kategori"
                                    name="pilih_kategori" required>
                                    <option value="0">Semua Lembaga Dan Fakultas</option>
                                    <option value="1">Lembaga</option>
                                    <option value="2">Fakultas</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="flex-column mb-2 fv-row" id="ll_lembaga">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Lembaga</span>
                        </label>
                        <!--end::Label-->
                        <select class="selectpicker form-control form-control-sm form-select-solid" data-live-search="true"
                            title="Lembaga" id="id_lembaga" name="id_lembaga">

                        </select>

                    </div>
                    <div class="row" id="ll_fakultas">
                        <div class="col-sm-12">
                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Fakultas</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Fakultas" id="id_fakultas" name="id_fakultas">

                                </select>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex flex-column mb-2 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Program Studi</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Program Studi" id="id_prodi" name="id_prodi">

                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-sm btn-primary w-100 " id="pencarian">Pencarian</a>
            </div>
        </div>


        <div class="col-sm-9">
            <div class="card border-2 shadow  bg-white rounded p-4 m-1">
                <div class="card-body">
                    <div class="text-danger mb-3">
                       Perhatikan pada status di kolom. Jika Status Private harus login serta Status Publik tanpa login untuk download berkas
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table-bordered dt-responsive nowrap table" style="width:100%">
                            <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-50px text-center">Download</th>
                                    <th class="w-100">Nama Berkas</th>
                                    <th class="w-100px">Lembaga</th>
                                    <th class="w-100px">Status</th>
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
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        var table;
        var id_kategori_berkas = "";
        var id_fakultas = "";
        var pilih_kategori = "";
        var id_lembaga = "";
        var id_sub_berkas = "";
        var id_prodi = ""

        var download = '{{ route('berkas_file', [':upload']) }}'
        var show = '{{ route('show_file', [':upload']) }}'
        var auth_login = '{{ route('auth.index') }}'
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
                        data: "action",
                        className: "text-center p-4",
                        render: function(data) {
                            var xx = data.split("#_#");
                            if (xx[1] == 'n') {
                                if ("{{ $login }}") {
                                    var x_download = `<a data-toggle='tooltip' data-placement='top' title='Download'  href='${download.replace(':upload', xx[0])}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-download ' aria-hidden='true'></span></a>`;
                                    var x_show = `<a data-toggle='tooltip' data-placement='top' title='Show' traget="_blank"  href='${show.replace(':upload', xx[0])}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-file-pdf' aria-hidden='true'></span></a>`;
                                    return `${x_download} ${x_show}`;
                                } else {
                                    var x_download = `<a data-toggle='tooltip' data-placement='top' title='Login'  href='${auth_login}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-box-arrow-in-right' aria-hidden='true'></span></a>`;
                                    return `${x_download} `;
                                }
                            } else {
                                var x_show = `<a data-toggle='tooltip' data-placement='top' title='Show' traget="_blank"  href='${show.replace(':upload', xx[0])}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-file-pdf' aria-hidden='true'></span></a>`;
                                var x_download =  `<a data-toggle='tooltip' data-placement='top' title='Download'  href='${download.replace(':upload', xx[0])}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-download ' aria-hidden='true'></span></a>`;
                                return `${x_download} ${x_show}`;
                            }

                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "nama_berkas",
                        className: "p-4",
                        render: function(data) {
                            var x = data.split("#_#")
                            if (x[3] == 'n') {
                                if ("{{ $login }}") {
                                    var y = `
                                    <div>
                                        <a  href="${download.replace(':upload', x[1])}">${x[0]}</a>
                                        <p class='text-muted'>${x[2]}</p>
                                    </div>`
                                    return y;
                                } else {
                                    var y = `
                                <div>
                                    <a  href="${auth_login}">${x[0]}</a>
                                    <p class='text-muted'>${x[2]}</p>
                                </div>`
                                    return y;
                                }
                            } else {
                                var y = `
                                <div>
                                    <a  href="${download.replace(':upload', x[1])}">${x[0]}</a>
                                    <p class='text-muted'>${x[2]}</p>
                                </div>`
                                return y;
                            }

                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "lembaga",
                        className: "p-4",
                        render: function(data) {
                            var x = data.split("#_#");
                            return `${x[0]}${x[1]} ${x[2]}`;
                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "status_berkas",
                        className: "p-4",
                        render: function(data) {
                            return data == 'y' ? "Publik" : "Private"
                        },
                        orderable: true,
                        searchable: true,
                    },

                ],
            });
        });
        kategori();
        $("#ll_lembaga").hide();
        $("#ll_fakultas").hide();
        $("#ll_prodi").hide();
        $("#pilih_kategori").on("change", function() {
            var id_lembaga = "";
            var id_fakultas = "";
            var id_prodi = ""
            $("#id_lembaga").empty();
            $("#id_fakultas").empty();
            $("#id_prodi").empty();
            pilih_kategori = $("#pilih_kategori").find("option:selected").val()
            if (pilih_kategori == 1) {
                $("#ll_lembaga").show();
                $("#ll_fakultas").hide();
                $("#ll_prodi").hide();
                lembaga();
            } else if (pilih_kategori == 2) {
                $("#ll_lembaga").hide();
                $("#ll_fakultas").show();
                $("#ll_prodi").show();
                fakultas();
            } else {
                $("#ll_lembaga").hide();
                $("#ll_fakultas").hide();
                $("#ll_prodi").hide();
            }

            $('.selectpicker').selectpicker('refresh');
            $('.selectpicker').selectpicker('render');
        });

        $("#id_fakultas").on("change", function() {
            id_fakultas = $("#id_fakultas").find("option:selected").val()
            if (id_fakultas != "") {
                prodi(id_fakultas)
            }
        });

        $("#id_kategori_berkas").on("change", function() {
            id_kategori_berkas = $("#id_kategori_berkas").find("option:selected").val()
            if (id_kategori_berkas != "") {
                sub_kategori_berkas(id_kategori_berkas)
            }
        });

        $("#id_sub_berkas").on("change", function() {
            id_sub_berkas = $("#id_sub_berkas").find("option:selected").val()

        });

        $("#id_lembaga").on("change", function() {
            id_lembaga = $("#id_lembaga").find("option:selected").val()

        });

        $("#id_prodi").on("change", function() {
            id_prodi = $("#id_prodi").find("option:selected").val()

        });

        function kategori() {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/kategori_berkas') }}",
                    dataType: 'json',
                    success: function(data) {
                        resolve(data)
                    },
                    error: function(error) {
                        reject(error)
                    },
                });
            });
            x.then((data) => {
                $("#id_kategori_berkas").empty();

                $.each(data, function(index, item) {
                    $("#id_kategori_berkas").append("<option value='" + item.id_kategori_berkas + "'>" +
                        item.nama_kategori_berkas + "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');

            }).catch(function(error) {
                console.log(error);
            });
        }

        function lembaga() {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/lembaga') }}",
                    dataType: 'json',
                    success: function(data) {
                        resolve(data)
                    },
                    error: function(error) {
                        reject(error)
                    },
                });
            });
            x.then((data) => {
                $("#id_lembaga").empty();
                $("#id_lembaga").append('<option value="">All Data</option>');
                $.each(data, function(index, item) {
                    $("#id_lembaga").append("<option value='" + item.id_lembaga + "'>" + item.nama_lembaga +
                        "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');

            }).catch(function(error) {
                console.log(error);
            });
        }

        function fakultas() {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/fakultas') }}",
                    dataType: 'json',
                    success: function(data) {
                        resolve(data)
                    },
                    error: function(error) {
                        reject(error)
                    },
                });
            });
            x.then((data) => {
                $("#id_fakultas").empty();
                $("#id_fakultas").append('<option value="">All Data</option>');
                $.each(data, function(index, item) {
                    $("#id_fakultas").append("<option value='" + item.id_fakultas + "'>" + item
                        .nama_fakultas + "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');

            }).catch(function(error) {
                console.log(error);
            });
        }

        function prodi(id) {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/prodi') }}" + "/" + id,
                    dataType: 'json',
                    success: function(data) {
                        resolve(data)
                    },
                    error: function(error) {
                        reject(error)
                    },
                });
            });
            x.then((data) => {
                $("#id_prodi").empty();
                $("#id_prodi").append('<option value="">All Data</option>');
                $.each(data, function(index, item) {
                    $("#id_prodi").append("<option value='" + item.prodi_id + "'>" + item
                        .program_studi + "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');

            }).catch(function(error) {
                console.log(error);
            });
        }

        function sub_kategori_berkas(id) {
            const x = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('api/sub_kategori_berkas') }}" + "/" + id,
                    dataType: 'json',
                    success: function(data) {
                        resolve(data)
                    },
                    error: function(error) {
                        reject(error)
                    },
                });
            });
            x.then((data) => {
                console.log(data);

                $("#id_sub_berkas").empty();
                $.each(data, function(index, item) {
                    $("#id_sub_berkas").append("<option value='" + item.id_sub_berkas + "'>" + item
                        .nama_sub_berkas + "</option>");
                });
                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');

            }).catch(function(error) {
                console.log(error);
            });
        }

        $("#pencarian").click(function() {
            if (id_kategori_berkas == "" || id_sub_berkas == "" || pilih_kategori == "") {
                Swal.fire('Infromasi', 'Kategori dan sub kategori berkas kosong', 'error')
            } else {
                var url =`?q=pencarian&id_kategori_berkas=${id_kategori_berkas}&id_sub_berkas=${id_sub_berkas}&pilih_kategori=${pilih_kategori}&id_lembaga=${id_lembaga}&id_fakultas=${id_fakultas}&id_prodi=${id_prodi}`;
                var url_x = "{{ url('/') }}" + url;
                table.ajax.url(url_x);
                table.ajax.reload();
            }
        });
    </script>
@endsection
