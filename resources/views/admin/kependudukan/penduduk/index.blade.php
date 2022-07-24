@extends('templates.admin.master')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card" id="main-card">
                <div class="card-header d-md-flex flex-row justify-content-between">
                    <h3 class="card-title">Penduduk</h3>
                    <div>
                        <button type="button" class="btn btn-rounded btn-success" data-bs-effect="effect-scale"
                            data-bs-toggle="modal" href="#modal-default" onclick="add()" data-target="#modal-default">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.kependudukan.penduduk.filter', $compact)
                    @include('admin.kependudukan.penduduk.table', $compact)
                </div>
            </div>
        </div>
    </div>
    @include('admin.kependudukan.penduduk.modal', $compact)
@endsection

@section('javascript')
    @include('admin.kependudukan.penduduk.js', $compact)
@endsection
