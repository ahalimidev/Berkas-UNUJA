@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
@endsection

@section('title-header')
@endsection

@section('content')
<div class="flex-column-fluid">
<div class="row">


</div>
</div>
@endsection

@section('javascript')

<script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/dataTables.colReorder.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
@endsection
