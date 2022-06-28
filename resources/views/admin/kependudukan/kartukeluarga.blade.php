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
                                    <th class="text-nowrap text-center">No</th>
                                    <th class="text-nowrap text-center">Action</th>
                                    <th class="text-nowrap text-center">RT</th>
                                    <th class="text-nowrap text-center">Nomor KK</th>
                                    <th class="text-nowrap text-center">Anggota</th>
                                    <th class="text-nowrap text-center">Alamat</th>
                                    <th class="text-nowrap text-center">Foto</th>
                                    <th class="text-nowrap text-center">Jml. Anggota</th>
                                    <th class="text-nowrap text-center">Tgl. Ditambah</th>
                                    <th class="text-nowrap text-center">Tgl. Diubah</th>
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
                    url: "{{ route('admin.kependudukan.kk') }}",
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
                        data: 'id',
                        name: 'id',
                        render(data, type, full, meta) {
                            return ` <button type="button" class="btn btn-rounded btn-primary btn-sm" title="Edit Data" onClick="editFunc('${data}')">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah
                            </button>
                            <button type="button" class="btn btn-rounded btn-danger btn-sm" title="Delete Data" onClick="deleteFunc('${data}')">
                            <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                            </button>
                        `;
                        },
                        orderable: false,
                        className: 'text-nowrap'
                    },
                    {
                        data: 'rt',
                        name: 'rt',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'no',
                        name: 'no',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'anggota',
                        name: 'anggota',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                        className: 'text-nowrap text-capitalize',
                    },

                    {
                        data: 'foto_link',
                        name: 'foto_link',
                        className: 'text-nowrap text-capitalize',
                        render(data, type, full, meta) {
                            return data ? `<button type="button"
                                    class="btn btn-rounded btn-primary btn-sm"
                                    title="Lihat foto ktp"
                                    data-link="${full.foto_link}"
                                    data-no="${full.no}"
                                    onClick="viewFoto(this)">
                                    <i class="fa fa-eye"></i>
                                </button>` : '';
                        },
                    },

                    {
                        data: 'jumlah_anggota',
                        name: 'jumlah_anggota',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'created',
                        name: 'created',
                        className: 'text-nowrap text-capitalize',
                    },
                    {
                        data: 'updated',
                        name: 'updated',
                        render(data, type, full, meta) {
                            return data != full.created ? data : '';
                        },
                        className: 'text-nowrap text-capitalize',
                    },

                ],
                order: [
                    [2, 'asc']
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
                    "{{ route('admin.kependudukan.kk.insert') }}" :
                    "{{ route('admin.kependudukan.kk.update') }}";
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
                $('#modal-default-title').html("Tambah Data Kartu Keluarga");
                $('#modal-default').modal('show');
                $('#id').val('');
                resetErrorAfterInput();
                global_is_edit = false;
            }
        }


        function editFunc(id) {
            $('#main-card').LoadingOverlay("show");
            $.ajax({
                type: "GET",
                url: `{{ url('admin/kependudukan/kk/find') }}/${id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: null,
                success: (data) => {
                    $('#id').val(data.id);
                    $('#alamat').val(data.alamat);
                    $('#no').val(data.no);
                    $('#foto').val('');

                    $('#modal-default-title').html("Ubah Data Kartu Keluarga");
                    $('#modal-default').modal('show');
                    resetErrorAfterInput();
                    global_is_edit = true;
                },
                error: function(data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Something went wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                complete: function() {
                    $('#main-card').LoadingOverlay("hide");
                }
            });
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
                        url: `{{ url('admin/kependudukan/kk') }}/${id}`,
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

        function viewFoto(ele) {
            const data = ele.dataset;
            const link = data.link;
            $('#modal-default-foto').modal('show');
            const btn_download = $('#donwloadd-btn-foto');
            const img_modal = $('#img-modal-foto');
            btn_download.attr('href', link);
            btn_download.attr('download', `kk-${data.no}`);

            img_modal.attr('src', link);
            img_modal.attr('alt', data.no);
        }
    </script>
@endsection
