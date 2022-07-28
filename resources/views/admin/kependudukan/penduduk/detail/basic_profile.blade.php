<div class="col-xl-4">
    <div class="card">
        <div class="card-body">
            <form action="" id="basic_profile">

                <div class="text-center chat-image mb-5">
                    <input type="hidden" name="id" value="1">
                    <input type="file" hidden="" id="profile" name="profile" accept="image/*">
                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                        <img alt="avatar" onclick="{$('#profile').trigger('click')}"
                            onerror="this.src='{{ url($penduduk->image_default) }}';this.onerror='';"
                            src="{{ $penduduk->foto }}" class="brround" id="img_profile"
                            style="height: 80px; width: 80px; object-fit: cover; object-position: center; border-radius: 50%;">

                        <label for="profile"><span class="badge rounded-pill avatar-icons bg-primary"><i
                                    class="fe fe-edit fs-12"></i></span></label>
                    </div>
                    <div class="text-center">
                        <h5 class="mb-1 text-dark fw-semibold" id="penduduk_nama">{{ $penduduk->nama }}</h5>
                    </div>
                </div>

                <div class="form-group  mt-3">
                    <label for="nama">Nama Lengkap</label>
                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Lengkap"
                        value="{{ $penduduk->nama }}" required>
                </div>

                <div class="form-group  mt-3">
                    <label for="nik">Nomor induk kependudukan</label>
                    <input class="form-control" type="text" name="nik"id="nik"
                        placeholder="Nomor induk kependudukan" value="{{ $penduduk->nik }}">
                </div>

                <div class="form-group  mt-3">
                    <label for="kota_lahir">Kota Lahir</label>
                    <input class="form-control" type="text" name="kota_lahir"id="kota_lahir" placeholder="Kota Lahir"
                        value="{{ $penduduk->kota_lahir }}">
                </div>

                <div class="form-group  mt-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input class="form-control" type="date" name="tanggal_lahir"id="tanggal_lahir"
                        placeholder="Tanggal Lahir" value="{{ $penduduk->tanggal_lahir }}">
                </div>

                <div class="form-group  mt-3">
                    <label for="tanggal_mati">Tanggal Meninggal <span class="badge bg-danger">Reset</span></label>
                    <input class="form-control" type="date" name="tanggal_mati"id="tanggal_mati"
                        placeholder="Tanggal Mati" value="{{ $penduduk->tanggal_mati }}">
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="laki-laki" {{ $penduduk->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}
                            class="text-capitalize">laki-laki</option>
                        <option value="perempuan" {{ $penduduk->jenis_kelamin == 'perempuan' ? 'selected' : '' }}
                            class="text-capitalize">perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="alamat_lengkap">Alamat Lengkap</label>
                    <textarea class="form-control" rows="2" name="alamat_lengkap" id="alamat_lengkap" placeholder="Alamat Lengkap">{{ $penduduk->alamat_lengkap }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label text-capitalize"
                        for="asal_data"data-toggle="tooltip"title="Jika Ditambahakn kelahiran maka pada laporan kelahiran akan ditambahkan">
                        Ditambahkan Berdasarkan</label>
                    <select class="form-control" id="asal_data" name="asal_data">
                        <option value="0" {{ $penduduk->asal_data == '0' ? 'selected' : '' }}
                            class="text-capitalize">Kelahiran</option>
                        <option value="1" {{ $penduduk->asal_data == '1' ? 'selected' : '' }}
                            class="text-capitalize">Kedatangan</option>
                    </select>
                </div>

            </form>
        </div>
        <div class="card-footer text-end">
            <button type="submit" form="basic_profile" class="btn btn-success my-1">
                <li class="fa fa-save mr-1"></li> Save changes
            </button>
        </div>
    </div>
</div>
