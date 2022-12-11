@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">

@endsection

@section('list')
<li class="breadcrumb-item text-gray-800">User</li>
<li class="text-gray-800">Create User</li>
@endsection

@section('content')
    <div class="content flex-column-fluid">
        <div class="card mb-xl-8 mb-5 border-2">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Add User</span>
                </h3>

            </div>
            <form action="{{ route('user.store') }}" method="post">
                @csrf

                <div class="card-body py-12">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 align-content-center">
                            <div class="d-flex flex-column fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Nama</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="nama" class="form-control form-control-sm" required />
                            </div>
                            <div class="flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Unit</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid" data-live-search="true" title="Unit" id="id_unit" name="id_unit" >
                                    @foreach ($v_unit as $item)
                                        <option value="{{$item->id_unit}}">{{$item->nama_unit}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="d-flex flex-column fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Username</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="username" class="form-control form-control-sm" required />
                            </div>
                            <div class="d-flex flex-column fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Password</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="password" class="form-control form-control-sm" required />
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary w-250px" id="btnSubmit">
                                    <span class="indicator-label">Save</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="text-center">
            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ route('user.index') }}">
                <span class="indicator-label">Go Back</span>
            </a>
        </div>
    </div>
@endsection

@section('javascript')
<script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
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
