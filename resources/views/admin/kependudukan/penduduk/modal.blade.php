<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-default-title">Tambah Data Penduduk</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="MainForm" name="MainForm" method="POST"
                    enctype="multipart/form-data">
                    <span class="fw-bold">Data Dasar</span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nik">Nomori Induk Kependudukan</label>
                                <input type="number" class="form-control" id="nik" name="nik"
                                    placeholder="Nomori Induk Kependudukan" maxlength="16" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nama">Nama Lengkap
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Lengkap" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="kota_lahir">Kota Lahir
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kota_lahir" name="kota_lahir"
                                    placeholder="Kota Lahir" required="" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir
                                    <span class="text-danger">*</span>
                                    <span class="text-success">bulan/tanggal/tahun</span>
                                </label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="no_hp">No Telepon</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    placeholder="No Telepon" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="jenis_kelamin">Jenis Kelamin
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="laki-laki" class="text-capitalize">laki-laki</option>
                                    <option value="perempuan" class="text-capitalize">perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="alamat_lengkap">Alamat Lengkap
                                    <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="2" required
                                    placeholder="Alamat Yang Digunakan Untuk Laporan Dan Lain Lain"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="my-1">

                    {{-- asal data penduduk --}}
                    <span class="fw-bold">Asal Data Penduduk</span>
                    <div class="row">
                        <div class="col-md-6">
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
                                <label class="form-label text-capitalize" for="tinggal_dari_tanggal">
                                    Tanggal Datang<span class="text-danger">*</span>
                                    <span class="text-success">bulan/tanggal/tahun</span>
                                </label>
                                <input type="date" id="tinggal_dari_tanggal" class="form-control"
                                    name="tinggal_dari_tanggal">
                            </div>
                        </div>

                        <div class="col-md-6" style="display: none">
                            <div class="form-group">
                                <label class="form-label" for="datang_keterangan">Kedatangan Keterangan </label>
                                <input type="text" class="form-control" id="datang_keterangan"
                                    name="datang_keterangan" placeholder="Kedatangan Keterangan" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="negara">Kewarganegaraan
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" id="negara" name="negara">
                                    <option value="1" class="text-capitalize">warga negara indonesia</option>
                                    <option value="0" class="text-capitalize">warga negara asing</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6" style="display: none">
                            <div class="form-group">
                                <label class="form-label" for="negara_nama">Negara Asal
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="negara_nama" name="negara_nama"
                                    placeholder="Negara Asal" />
                            </div>
                        </div>

                        <div class="col-md-6" style="display: none">
                            <div class="form-group">
                                <label class="form-label" for="negara_dari">Masuk Dari Tanggal
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="negara_dari" name="negara_dari"
                                    placeholder="Masuk Dari Tanggal" />
                            </div>
                        </div>
                    </div>
                    <hr class="my-1">


                    {{-- data master --}}
                    <span class="fw-bold">Data Rukun Tetangga</span>
                    <div class="row">

                        {{-- rt --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-capitalize" for="rt_id">rukun tetangga
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" id="rt_id" name="rt_id" required="">
                                    @foreach ($rts ?? [] as $v)
                                        <option value="{{ $v->id }}" class="text-capitalize">
                                            {{ $v->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="rt_dari">Masuk RT Dari Tanggal</label>
                                {{-- jika tidak ada maka akan mengambil data dari tanggal masuk warga negara asing atau tanggal kedatangan, atau tanggal lahir --}}
                                <input type="date" class="form-control" id="rt_dari" name="rt_dari" />
                            </div>
                        </div>

                        <hr class="my-1">
                        <span class="fw-bold">Data Akte dan KTP</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="ktp_status">KTP Ada/Tidak
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" id="ktp_status" name="ktp_status" required="">
                                        <option value="0" class="text-capitalize">Tidak Ada</option>
                                        <option value="1" class="text-capitalize">Ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none">
                                <div class="form-group">
                                    <label class="form-label" for="ktp_dari">Ada KTP Dari Tanggal</label>
                                    {{-- jika tidak ada maka akan mengambil data dari tanggal lahir ditambah 17 tahun --}}
                                    <input type="date" class="form-control" id="ktp_dari" name="ktp_dari" />
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none">
                                <div class="form-group">
                                    <label class="form-label" for="ktp_file">KTP Gambar</label>
                                    <input type="file" accept="image/*" class="form-control" id="ktp_file"
                                        name="ktp_file" />
                                </div>
                            </div>

                            {{-- akte --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="akte_status">Akte Ada/Tidak
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" id="akte_status" name="akte_status" required="">
                                        <option value="0" class="text-capitalize">Tidak Ada</option>
                                        <option value="1" class="text-capitalize">Ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none">
                                <div class="form-group">
                                    <label class="form-label" for="akte_dari">Ada Akte Dari Tanggal</label>
                                    {{-- jika tidak ada maka akan mengambil data dari tanggal lahir --}}
                                    <input type="date" class="form-control" id="akte_dari" name="akte_dari" />
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none">
                                <div class="form-group">
                                    <label class="form-label" for="akte_file">Akte Gambar</label>
                                    <input type="file" accept="image/*" class="form-control" id="akte_file"
                                        name="ktp_file" />
                                </div>
                            </div>

                        </div>

                        <hr class="my-1">
                        <span class="fw-bold">Data Agama</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="agama_id">Agama
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" id="agama_id" name="agama_id">
                                        @foreach ($agamas ?? [] as $v)
                                            <option value="{{ $v->id }}" class="text-capitalize">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="agama_dari">Agama Dari Tanggal</label>
                                    {{-- jika tidak ada maka akan mengambil data dari tanggal lahir --}}
                                    <input type="date" class="form-control" id="agama_dari" name="agama_dari" />
                                </div>
                            </div>

                        </div>

                        <hr class="my-1">
                        <span class="fw-bold">Data Pendidikan</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="pendidikan_id">pendidikan
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" id="pendidikan_id" name="pendidikan_id">
                                        @foreach ($pendidikans ?? [] as $v)
                                            <option value="{{ $v->id }}" class="text-capitalize">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="pendidikan_dari">pendidikan Dari Tanggal</label>
                                    {{-- jika tidak ada maka akan mengambil data dari tanggal lahir --}}
                                    <input type="date" class="form-control" id="pendidikan_dari"
                                        name="pendidikan_dari" />
                                </div>
                            </div>

                        </div>

                        <hr class="my-1">
                        <span class="fw-bold">Data Pekerjaan</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="pekerjaan_id">pekerjaan
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" id="pekerjaan_id" name="pekerjaan_id">
                                        @foreach ($pekerjaans ?? [] as $v)
                                            <option value="{{ $v->id }}" class="text-capitalize">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="pekerjaan_dari">Pekerjaan Dari Tanggal</label>
                                    {{-- jika tidak ada maka akan mengambil data dari tanggal lahir --}}
                                    <input type="date" class="form-control" id="pekerjaan_dari"
                                        name="pekerjaan_dari" />
                                </div>
                            </div>

                        </div>

                        <hr class="my-1">
                        <span class="fw-bold">Data Status Kawin</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="status_kawin_id">status kawin
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" id="status_kawin_id" name="status_kawin_id">
                                        @foreach ($status_kawins ?? [] as $v)
                                            <option value="{{ $v->id }}" class="text-capitalize">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="status_kawin_dari">Status kawin Dari
                                        Tanggal</label>
                                    {{-- jika tidak ada maka akan mengambil data dari tanggal lahir --}}
                                    <input type="date" class="form-control" id="status_kawin_dari"
                                        name="status_kawin_dari" />
                                </div>
                            </div>

                        </div>

                        <hr class="my-1">
                        <span class="fw-bold">Data Status Penduduk</span>
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="status_penduduk_dari">
                                        Status Penduduk Dari Tanggal</label>
                                    {{-- jika tidak ada maka akan mengambil data dari tanggal lahir --}}
                                    <input type="date" class="form-control" id="status_penduduk_dari"
                                        name="status_penduduk_dari" />
                                </div>
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
