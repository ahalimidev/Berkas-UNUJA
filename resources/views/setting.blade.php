@extends('layouts.index')

@section('css')

@endsection
@section('title-header')
    <h3>Pengaturan Pengguna</h3>
@endsection
@section('content')
<div class="content flex-column-fluid">
    <div class="card mb-xl-8 mb-5 border-2">
        <div class="card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Pengaturan Pengguna</span>
            </h3>

        </div>
        <form action="{{ route('user.setting.simpan') }}" method="post">
            @csrf
            <div class="card-body py-12">
                @include('errors.alert')
                <div class="row justify-content-md-center">
                    <div class="col-sm-6 align-content-center">
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold  mb-2 required">
                                <span>Nama</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" name="nama" class="form-control form-control-sm" value="{{$one->nama}}" required />
                        </div>
                        <div class="flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 ">
                                <span>Unit</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-sm" value="{{ $one->nama_unit}}" disabled />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                <span>Username</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" name="username" class="form-control form-control-sm" value="{{$one->username}}" required />
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                <span>Password</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" name="password" class="form-control form-control-sm"  />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary w-250px" id="btnSubmit">
                                <span class="indicator-label">Update</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    window.onbeforeunload = function() {
        $("button[type=submit]").prop("disabled", "disabled");
    }
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 2000);
</script>
@endsection
