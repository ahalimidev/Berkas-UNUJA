@extends('layouts.index')

@section('css')
@endsection

@section('title-header')
<h3>Mengedit Sub Kategori berkas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Mengedit Sub Kategori berkas</span>
                </h3>

            </div>
            <form action="{{ route('sub_kategori.update', ['sub_kategori' => $id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 align-content-center">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Kategori Berkas</span>
                                </label>
                                <!--end::Label-->
                                <select class="selectpicker form-control form-control-sm form-select-solid"
                                    data-live-search="true" title="Kategori Berkas" id="id_kategori_berkas"
                                    name="id_kategori_berkas" required>
                                    @foreach ($kategori_berkas as $item)
                                        @if ($item->id_kategori_berkas == $one->id_kategori_berkas)
                                            <option value="{{$item->id_kategori_berkas}}" selected>{{$item->nama_kategori_berkas}}</option>
                                        @else
                                            <option value="{{$item->id_kategori_berkas}}">{{$item->nama_kategori_berkas}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Sub Kategori berkas</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" name="nama_sub_berkas" class="form-control form-control-sm " value="{{$one->nama_sub_berkas}}"   required />
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
        <div class="text-center">
            <a class="btn btn-sm btn-bg-success w-100px text-white" href="{{ redirect()->back()->getTargetUrl() }}">
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
