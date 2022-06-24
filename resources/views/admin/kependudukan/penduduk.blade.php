@extends('templates.admin.master')

@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-md-flex flex-row justify-content-between">
                    <h3 class="card-title">Penduduk</h3>
                    <button type="button" class="btn btn-rounded btn-success" data-bs-effect="effect-scale"
                        data-bs-toggle="modal" href="#modal-default" onclick="add()" data-target="#modal-default">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    {{-- <h5 class="h5">Filter Data</h5>
                    <form action="javascript:void(0)" class="form-inline ml-md-3 mb-md-3" id="FilterForm">
                        <div class="form-group me-md-3">
                            <label for="filter_status">Agama</label>
                            <select class="form-control" id="filter_status" name="filter_status" style="max-width: 200px">
                                <option value="">All Agama</option>
                                <option value="1">Dipakai</option>
                                <option value="0">Tidak Dipakai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-rounded btn-md btn-info" title="Refresh Filter Table">
                            <i class="bi bi-arrow-repeat"></i> Refresh
                        </button>
                    </form> --}}
                    <div class="table-responsive table-striped">
                        <table class="table table-bordered border-bottom" id="tbl_main">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        No
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Rt
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Nama
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        NIK
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Jenis Kelamin
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" colspan="2">
                                        Tanggal Lahir
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Umur
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Agama
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Status KW/BW
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Status Pendidikan
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Status Kerjaan
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Status Penduduk
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        KTP Ya/Tidak
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Akte Ya/Tidak
                                    </th>
                                    <th class="text-center" style="vertical-align: middle" rowspan="2">
                                        Alamat
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-nowrap text-center">Kota</th>
                                    <th class="text-nowrap text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
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
                                    <label class="form-label" for="nik">Nomori Induk Kependudukan <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nik" name="nik"
                                        placeholder="Nomori Induk Kependudukan" required="" maxlength="16" />
                                </div>
                            </div>
                            <div class="col-6">
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
                                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        placeholder="Tanggal Lahir" required="" />
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
                                    <label class="form-label text-capitalize" for="status">Status Ada<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1" class="text-capitalize">Ada di lingkungan RW</option>
                                        <option value="0" class="text-capitalize">Tidak ada di lingkungan RW</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="alamat_lengkap">Alamat Lengkap <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" required></textarea>
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
@endsection

@section('javascript')
    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/templates/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/templates/admin/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>


    {{-- sweetalert --}}
    <script src="{{ asset('assets/templates/admin/plugins/sweet-alert/sweetalert2.all.js') }}"></script>

    <script>
        let global_is_edit = true;
        const table_html = $('#tbl_main');
        $(document).ready(function() {
            // datatable ====================================================================================
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const new_table = table_html.DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: true,
                // responsive: true,
                scrollX: true,
                aAutoWidth: false,
                bAutoWidth: false,
                type: 'GET',
                ajax: {
                    url: "{{ route('admin.kependudukan.penduduk') }}",
                    data: function(d) {
                        d['filter[status]'] = $('#filter_status').val();
                    }
                },
                columns: [{
                        data: null,
                        name: 'id',
                        orderable: false,
                    },
                    {
                        data: 'rt',
                        name: 'rt',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'kota_lahir',
                        name: 'kota_lahir',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'umur',
                        name: 'umur',
                        className: 'text-nowrap text-capitalize',
                        render(data, type, full, meta) {
                            return data ? `${data} Tahun` : '';
                        },
                    },
                    {
                        data: 'agama',
                        name: 'agama',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'status_kawin',
                        name: 'status_kawin',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'pendidikan',
                        name: 'pendidikan',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'status_penduduk',
                        name: 'status_penduduk',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'ada_ktp_str',
                        name: 'ada_ktp_str',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'ada_akte_str',
                        name: 'ada_akte_str',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'alamat_lengkap',
                        name: 'alamat_lengkap',
                        className: 'text-nowrap text-capitalize',
                        render: function(data, type, row) {
                            return `
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${data}">
                                ${String(data).substr(0, 100) + (String(data).length > 100 ? '...' : '')}
                                </span>
                                `;
                        }
                    },
                    // {
                    //     data: 'id',
                    //     name: 'id',
                    //     render(data, type, full, meta) {
                    //         return ` <button type="button" class="btn btn-rounded btn-primary btn-sm" title="Edit Data" onClick="editFunc('${data}')">
                //     <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                //     </button>
                //     <button type="button" class="btn btn-rounded btn-danger btn-sm" title="Delete Data" onClick="deleteFunc('${data}')">
                //     <i class="fa fa-trash" aria-hidden="true"></i> Delete
                //     </button>
                //     `;
                    //     },
                    //     orderable: false,
                    //     className: 'text-nowrap'
                    // },
                    // {
                    //     data: 'status_str',
                    //     name: 'status',
                    //     render(data, type, full, meta) {
                    //         const class_el = full.status == 1 ? 'badge bg-success' :
                    //             'badge bg-danger';
                    //         return `<span class="${class_el} p-1">${full.status_str}</span>`;
                    //     },
                    // },
                    // {
                    //     data: 'nama',
                    //     name: 'nama',
                    //     className: 'text-nowrap'
                    // },
                    // {
                    //     data: 'singkatan',
                    //     name: 'singkatan',
                    //     className: 'text-nowrap'
                    // },
                    // {
                    //     data: 'keterangan',
                    //     name: 'keterangan',
                    //     className: 'text-nowrap'
                    // },

                ],
                order: [
                    [1, 'asc']
                ]
            });

            new_table.on('draw.dt', function() {
                var PageInfo = table_html.DataTable().page.info();
                new_table.column(0, {
                    page: 'current'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });

            $('#FilterForm').submit(function(e) {
                e.preventDefault();
                var oTable = table_html.dataTable();
                oTable.fnDraw(false);
            });

            // insertForm ===================================================================================
            $('#MainForm').submit(function(e) {
                e.preventDefault();
                resetErrorAfterInput();
                var formData = new FormData(this);
                setBtnLoading('#btn-save', 'Save Changes');
                const route = ($('#id').val() == '') ?
                    "{{ route('admin.kependudukan.penduduk.insert') }}" :
                    "{{ route('admin.kependudukan.penduduk.update') }}";
                $.ajax({
                    type: "POST",
                    url: route,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#modal-default").modal('hide');
                        var oTable = table_html.dataTable();
                        oTable.fnDraw(false);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data saved successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        global_is_edit = true;
                    },
                    error: function(data) {
                        const res = data.responseJSON ?? {};
                        errorAfterInput = [];
                        for (const property in res.errors) {
                            errorAfterInput.push(property);
                            setErrorAfterInput(res.errors[property], `#${property}`);
                        }
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: res.message ?? 'Something went wrong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    complete: function() {
                        setBtnLoading('#btn-save',
                            '<li class="fa fa-save mr-1"></li> Simpan',
                            false);
                    }
                });
            });
        });

        function add() {
            if (global_is_edit) {
                $('#MainForm').trigger("reset");
                $('#modal-default-title').html("Tambah Penduduk");
                $('#modal-default').modal('show');
                $('#id').val('');
                resetErrorAfterInput();
                global_is_edit = false;
            }
        }


        function editFunc(datas) {
            const data = datas.dataset;
            $('#modal-default-title').html("Ubah Penduduk");
            $('#modal-default').modal('show');
            $('#MainForm').trigger("reset");
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#status').val(data.status);
            $('#singkatan').val(data.singkatan);
            $('#keterangan').val(data.keterangan);
        }

        function deleteFunc(id) {
            swal.fire({
                title: 'Are you sure?',
                text: "Are you sure you want to proceed ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: `{{ url('admin/kependudukan/penduduk') }}/${id}`,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                onOpen: function() {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Agama  deleted successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var oTable = table_html.dataTable();
                            oTable.fnDraw(false);
                        },
                        complete: function() {
                            swal.hideLoading();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.hideLoading();
                            swal.fire("!Opps ", "Something went wrong, try again later", "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection
