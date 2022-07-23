<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-default-title"></h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="MainForm" name="MainForm" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="nik">Nomori Induk Kependudukan</label>
                                <input type="number" class="form-control" id="nik" name="nik"
                                    placeholder="Nomori Induk Kependudukan" maxlength="16" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nama">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Lengkap" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="penduduk_negara">Warga Negara<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="penduduk_negara" name="penduduk_negara">
                                    <option value="1" class="text-capitalize">warga negara indonesia</option>
                                    <option value="0" class="text-capitalize">warga negara asing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4" style="display: none">
                            <div class="form-group">
                                <label class="form-label" for="negara_asal">Negara Asal <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="negara_asal" name="negara_asal"
                                    placeholder="Negara Asal" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kota_lahir">Kota Lahir<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kota_lahir" name="kota_lahir"
                                    placeholder="Kota Lahir" required="" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir
                                    <span class="text-danger">*</span>
                                    <span class="text-success">bulan/tanggal/tahun</span>
                                </label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    required="" />
                                <input type="hidden" id="tanggal_lahir_id" name="tanggal_lahir_id">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="jenis_kelamin">Jenis Kelamin<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="laki-laki" class="text-capitalize">laki-laki</option>
                                    <option value="perempuan" class="text-capitalize">perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="agama_id">Agama<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="agama_id" name="agama_id">
                                    @foreach ($agamas ?? [] as $v)
                                        <option value="{{ $v->id }}" class="text-capitalize">
                                            {{ $v->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="pendidikan_id">pendidikan<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="pendidikan_id" name="pendidikan_id">
                                    @foreach ($pendidikans ?? [] as $v)
                                        <option value="{{ $v->id }}" class="text-capitalize">
                                            {{ $v->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="pekerjaan_id">pekerjaan<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="pekerjaan_id" name="pekerjaan_id">
                                    @foreach ($pekerjaans ?? [] as $v)
                                        <option value="{{ $v->id }}" class="text-capitalize">
                                            {{ $v->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="status_kawin_id">status kawin<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="status_kawin_id" name="status_kawin_id">
                                    @foreach ($status_kawins ?? [] as $v)
                                        <option value="{{ $v->id }}" class="text-capitalize">
                                            {{ $v->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="status_penduduk_id">status
                                    penduduk<span class="text-danger">*</span></label>
                                <select class="form-control" id="status_penduduk_id" name="status_penduduk_id">
                                    @foreach ($status_penduduks ?? [] as $v)
                                        <option value="{{ $v->id }}" class="text-capitalize">
                                            {{ $v->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="file_ktp">KTP</label>
                                <input type="file" class="form-control" id="file_ktp" name="file_ktp" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="file_akte">Akte Kelahiran</label>
                                <input type="file" class="form-control" id="file_akte" name="file_akte" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="asal_data">
                                    Ditambahkan Berdasarkan<span class="text-danger">*</span></label>
                                <select class="form-control" id="asal_data" name="asal_data">
                                    <option value="0" class="text-capitalize">Kelahiran</option>
                                    <option value="1" class="text-capitalize">Kedatangan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: none">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="tanggal_datang">
                                    Tanggal Datang<span class="text-danger">*</span>
                                    <span class="text-success">bulan/tanggal/tahun</span>
                                </label>
                                <input type="hidden" id="tanggal_datang_id" name="tanggal_datang_id">
                                <input type="date" class="form-control" id="tanggal_datang"
                                    name="tanggal_datang">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="alamat_lengkap">Alamat Lengkap
                                    <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" required
                                    placeholder="Alamat Yang Digunakan Untuk Laporan Dan Lain Lain"></textarea>
                            </div>
                        </div>
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
