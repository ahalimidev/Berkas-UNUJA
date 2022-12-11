@extends('layouts.index')

@section('css')
@endsection

@section('list')
<li class="breadcrumb-item text-gray-800">Jenis Berkas</li>
<li class="text-gray-800">Create Jenis Berkas</li>
@endsection

@section('content')
    <div class="content flex-column-fluid">
        <div class="card mb-xl-8 mb-5 border-2">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Add Jenis Berkas</span>
                </h3>

            </div>
            <form action="{{ route('jenis_berkas.store') }}" method="post">
                @csrf

                <div class="card-body py-12">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 align-content-center">
                            <div class="d-flex flex-column fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Jenis Berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="nama_jenis_berkas"
                                    class="form-control form-control-sm" value="{{ old('nama_jenis_berkas') }}"
                                    required />
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
            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ route('jenis_berkas.index') }}">
                <span class="indicator-label">Go Back</span>
            </a>
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
