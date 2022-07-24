<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default active mb-2">
        <div class="panel-heading " role="tab" id="headingOne1">
            <h4 class="panel-title">
                <a role="button" data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse1"
                    aria-expanded="true" aria-controls="collapse1">
                    Filter Data
                </a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne1">
            <div class="panel-body">
                <form action="javascript:void(0)" class="ml-md-3 mb-md-3" id="FilterForm">
                    <div class="form-group float-start me-2">
                        <label for="filter_rt">Rt</label>
                        <select class="form-control" id="filter_rt" name="filter_rt" style="max-width: 200px">
                            <option value="">Semua Rt</option>
                            @foreach ($rts ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="filter_jenis_kelamin" name="filter_jenis_kelamin"
                            style="max-width: 200px">
                            <option value="">Semua JK</option>
                            <option value="laki-laki" class="text-capitalize">laki-laki</option>
                            <option value="perempuan" class="text-capitalize">perempuan</option>
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_agama">Agama</label>
                        <select class="form-control" id="filter_agama" name="filter_agama" style="max-width: 200px">
                            <option value="">Semua Agama</option>
                            @foreach ($agamas ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_status_kawin">Status Kawin</label>
                        <select class="form-control" id="filter_status_kawin" name="filter_status_kawin"
                            style="max-width: 200px">
                            <option value="">Semua SK</option>
                            @foreach ($status_kawins ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_pendidikan">Pendidikan</label>
                        <select class="form-control" id="filter_pendidikan" name="filter_pendidikan"
                            style="max-width: 200px">
                            <option value="">Semua Pend</option>
                            @foreach ($pendidikans ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_pekerjaan">Pekerjaan</label>
                        <select class="form-control" id="filter_pekerjaan" name="filter_pekerjaan"
                            style="max-width: 200px">
                            <option value="">Semua Pek</option>
                            @foreach ($pekerjaans ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_status_penduduk">Jenis Penduduk</label>
                        <select class="form-control" id="filter_status_penduduk" name="filter_status_penduduk"
                            style="max-width: 200px">
                            <option value="">Semua JP</option>
                            @foreach ($status_penduduks ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_ktp">Status KTP</label>
                        <select class="form-control" id="filter_ktp" name="filter_ktp" style="max-width: 200px">
                            <option value="">Semua Sts. KTP</option>
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="form-group float-start me-2">
                        <label for="filter_akte">Status Akte</label>
                        <select class="form-control" id="filter_akte" name="filter_akte" style="max-width: 200px">
                            <option value="">Semua Sts. Akte</option>
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                </form>
                <div style="clear: both"></div>
                <button type="submit" form="FilterForm" class="btn btn-rounded btn-md btn-info"
                    data-toggle="tooltip" title="Refresh Filter Table">
                    <i class="bi bi-arrow-repeat"></i> Terapkan filter
                </button>
            </div>
        </div>
    </div>
</div>
<hr>
