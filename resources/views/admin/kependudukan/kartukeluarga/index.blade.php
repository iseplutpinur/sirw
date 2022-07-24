@extends('templates.admin.master')

@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card" id="main-card">
                <div class="card-header d-md-flex flex-row justify-content-between">
                    <h3 class="card-title">List Kartu Keluarga</h3>
                    <button type="button" class="btn btn-rounded btn-success" data-bs-effect="effect-scale"
                        data-bs-toggle="modal" href="#modal-default" onclick="add()" data-target="#modal-default">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    @include('admin.kependudukan.kartukeluarga.filter', $compact)
                    @include('admin.kependudukan.kartukeluarga.table', $compact)
                </div>
            </div>
        </div>
    </div>
    @include('admin.kependudukan.kartukeluarga.modal', $compact)
@endsection

@section('javascript')
    @include('admin.kependudukan.kartukeluarga.js', $compact)
@endsection
