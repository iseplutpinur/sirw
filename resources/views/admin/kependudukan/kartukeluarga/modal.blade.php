<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-default-title"></h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="MainForm" name="MainForm" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">


                    <div class="form-group">
                        <label class="form-label" for="no">Nomori Kartu Keluarga<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="no" name="no"
                            placeholder="Nomori Kartu Keluarga" maxlength="16" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label text-capitalize" for="rt_id">rukun tetangga<span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="rt_id" name="rt_id">
                            @foreach ($rts ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label text-capitalize" for="alamat">Alamat<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label text-capitalize" for="foto">Foto KK</label>
                        <input type="file" class="form-control" id="foto" name="foto" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-save" form="MainForm">
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

<div class="modal fade" id="modal-default-foto">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-default-foto-title">Lihat foto</h6><button aria-label="Close"
                    class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="img-modal-foto" />
            </div>
            <div class="modal-footer">
                <a href="" download="" id="donwloadd-btn-foto" class="btn btn-primary">
                    <li class="fa fa-save mr-1"></li> Download
                </a>
                <button class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-anggota">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-anggota-title">Kartu Keluarga Anggota</h6><button aria-label="Close"
                    class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="AnggotaForm" name="Anggota" method="POST"
                    enctype="multipart/form-data">
                    <div class="d-md-flex justify-content-between">
                        <input type="hidden" id="kartu_keluarga_id" name="kartu_keluarga_id">
                        <input type="hidden" id="form_no_kk" name="form_no_kk">
                        <div class="me-md-2 mb-2" style="width: 100%">
                            <select class="form-control" id="penduduk_id" name="penduduk_id" style="width: 100%"
                                required>
                                <option value="" selected>Pilih Penduduk</option>
                            </select>
                        </div>
                        <div class="me-md-2 mb-2" style="width: 100%">
                            <select class="form-control" id="hubungan_dengan_kk_id" name="hubungan_dengan_kk_id"
                                required>
                                <option value="">Pilih Hubungan Dengan KK</option>
                                @foreach ($hub_kks ?? [] as $v)
                                    <option value="{{ $v->id }}" class="text-capitalize">
                                        {{ $v->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-rounded btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah
                            </button>
                        </div>
                    </div>
                </form>

                <hr>
                <div class="table-responsive table-striped">
                    <table class="table table-bordered border-bottom" id="tbl_anggota">
                        <thead>
                            <tr>
                                <th class="text-nowrap text-center">No</th>
                                <th class="text-nowrap text-center">Hapus</th>
                                <th class="text-nowrap text-center">NIK</th>
                                <th class="text-nowrap text-center">Nama</th>
                                <th class="text-nowrap text-center">Hub. Dgn. KK</th>
                                <th class="text-nowrap text-center">Tgl. Ditambah</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_anggota_body"> </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
