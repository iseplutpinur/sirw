@extends('templates.admin.master')

@section('content')
    <div class="row">
        @include('admin.kependudukan.penduduk.detail.basic_profile', $compact)

        <div class="col-xl-8">
            <div class="row">
                {{-- Rukun tetangga --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex flex-row justify-content-between">
                            <div class="card-title">Riwayat Rukun Tetangga</div>
                            <button class="btn btn-info btn-sm" data-bs-effect="effect-scale" data-bs-toggle="modal"
                                href="#modal-pendidikan" onclick="pendidikanAdd()" data-target="#modal-pendidikan">
                                <i class="far fa-arrow-alt-right"></i>Pindah RT</button>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush" id="pendidikan-body">
                                {{-- item --}}
                                <div
                                    class="list-group-item list-group-item-action d-md-flex flex-row justify-content-between">
                                    <div>
                                        <div class="d-flex w-100">
                                            <h5 class="mb-1 fw-bold" data-commet="ada link ke rt">Nama RT</h5>
                                        </div>
                                        <p class="my-0">Dari:</p>
                                        <p class="my-0">Sampai:</p>
                                    </div>

                                    <div class="text-md-center">
                                        <button class="btn btn-primary btn-sm my-1" data-toggle="tooltip" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm my-1" data-toggle="tooltip" title="Hapus Data">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($masters as $master)
                    <div class="col-lg-6">
                        <div class="card" id="{{ $master['name'] }}_card">
                            <div class="card-header d-flex flex-row justify-content-between">
                                <div class="card-title h6">Riwayat {{ $master['title'] }}</div>
                                <div>
                                    <button class="btn btn-danger btn-sm" data-bs-effect="effect-scale"
                                        data-name="{{ $master['name'] }}" data-title="{{ $master['title'] }}"
                                        id="{{ $master['name'] }}_sesuaikan" data-toggle="tooltip"
                                        title="Sesuaikan Tanggal Sampai Menjadi Tanggal Yang diambil dari tanggal dari data selanjutnya dikurangi 1 hari ">
                                        <i class="fas fa-sync  me-2"></i>Sesuaikan</button>

                                    <button class="btn btn-info btn-sm" data-bs-effect="effect-scale"
                                        data-name="{{ $master['name'] }}" data-title="{{ $master['title'] }}"
                                        data-bs-toggle="modal" id="{{ $master['name'] }}_tambah"
                                        href="#{{ $master['name'] }}_modal" data-target="#{{ $master['name'] }}_modal"
                                        data-toggle="tooltip" title="Tambah data penduduk {{ $master['title'] }}">
                                        <i class="fas fa-plus me-2"></i>Tambah</button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush" id="{{ $master['name'] }}_list_body"> </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


        {{-- Negara --}}

        {{-- Pekerjaan --}}
        {{-- Pendidikan --}}
        {{-- Status Kawin --}}
        {{-- Status Penduduk --}}
        {{-- Ktp --}}
        {{-- Akte --}}
    </div>
    @include('admin.kependudukan.penduduk.detail.modal', $compact)
@endsection

@section('stylesheet')
    <link rel="stylesheet"
        href="{{ asset('assets/templates/admin/plugins/fontawesome-free-5.15.4-web/css/all.min.css') }}">
@endsection

@section('javascript')
    @include('admin.kependudukan.penduduk.detail.js', $compact)
@endsection
