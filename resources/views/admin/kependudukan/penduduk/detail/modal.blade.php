@foreach ($masters as $master)
    <div class="modal fade" id="{{ $master['name'] }}_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="{{ $master['name'] }}_modal_title">Tambah Data Penduduk
                        {{ $master['title'] }}</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="{{ $master['name'] }}_form" method="POST"
                        data-name="{{ $master['name'] }}" data-title="{{ $master['title'] }}"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" id="{{ $master['name'] }}_form_id" name="id">
                            <label class="form-label text-capitalize" for="{{ $master['name'] }}_id">
                                {{ $master['title'] }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="{{ $master['name'] }}_id" name="{{ $master['name'] }}_id">
                                @foreach ($master['data'] ?? [] as $v)
                                    <option value="{{ $v->id }}" class="text-capitalize">
                                        {{ $v->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="{{ $master['name'] }}_dari">
                                Dari Tanggal<span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="{{ $master['name'] }}_dari" name="dari"
                                required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="{{ $master['name'] }}_sampai">Sampai Tanggal
                                <span class="badge bg-danger" style="cursor: pointer;"
                                    onclick="$('#{{ $master['name'] }}_sampai').val('')">reset</span></label>
                            <input type="date" class="form-control" id="{{ $master['name'] }}_sampai"
                                name="sampai" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" form="{{ $master['name'] }}_form">
                        <li class="fa fa-save mr-1"></li> Simpan
                    </button>
                    <button class="btn btn-light" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
