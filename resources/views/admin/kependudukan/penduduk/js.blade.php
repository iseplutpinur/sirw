<!-- DATA TABLE JS-->
<script src="{{ asset('assets/templates/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/templates/admin/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/templates/admin/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/templates/admin/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/templates/admin/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

{{-- sweetalert --}}
<script src="{{ asset('assets/templates/admin/plugins/sweet-alert/sweetalert2.all.js') }}"></script>

<script>
    let global_is_insert = true;
    const table_html = $('#tbl_main');
    $(document).ready(function() {
        // datatable =================================================================================================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // return;
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
                    d['filter[rt_id]'] = $('#filter_rt').val();
                    d['filter[jenis_kelamin]'] = $('#filter_jenis_kelamin').val();
                    d['filter[agama]'] = $('#filter_agama').val();
                    d['filter[status_kawin]'] = $('#filter_status_kawin').val();
                    d['filter[pendidikan]'] = $('#filter_pendidikan').val();
                    d['filter[pekerjaan]'] = $('#filter_pekerjaan').val();
                    d['filter[status_penduduk]'] = $('#filter_status_penduduk').val();
                    d['filter[ktp]'] = $('#filter_ktp').val();
                    d['filter[akte]'] = $('#filter_akte').val();
                    // asal negara
                    // nama negara query distict ke penduduk negara
                    // status meninggal [ya, tidak]
                    // tanggal lahir dari - sampai
                    // kota lahir
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
                        return ` <button type="button" class="btn btn-rounded btn-primary btn-sm" title="Edit Data" onClick="editFunc('${data}')" data-toggle="tooltip" title="Ubah Data">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-rounded btn-danger btn-sm" title="Delete Data" onClick="deleteFunc('${data}')"  data-toggle="tooltip" title="Hapus Data">
                        <i class="fa fa-trash" aria-hidden="true"></i>
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
                    render: function(data, type, row) {
                        return ` <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${row.rt_nama}">
                            ${data}
                            </span> `;
                    }
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
                    data: 'tanggal_lahir_str',
                    name: 'tanggal_lahir',
                    className: 'text-nowrap text-capitalize',
                },
                {
                    data: 'umur',
                    name: 'umur_hari',
                    className: 'text-capitalize',
                    render(data, type, row) {
                        let text = data ? (`${data} Tahun`) : '';
                        text = text == '' ?
                            (row.umur_bulan ? (`${row.umur_bulan} Bulan`) : '') : text;
                        text = text == '' ?
                            (row.umur_hari ? (`${row.umur_hari} Hari`) : '') : text;

                        if (row.tanggal_mati_str) {
                            text +=
                                `<span class="badge  bg-warning" data-toggle="tooltip" title="Meninggal pada tanggal ${row.tanggal_mati_str}">${row.tanggal_mati_str}</span>`;
                        }
                        return text;
                    },
                },
                {
                    data: 'agama',
                    name: 'agama',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        return ` <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${row.agama_nama}">
                            ${data}
                            </span> `;
                    }
                },
                {
                    data: 'status_kawin',
                    name: 'status_kawin',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        return ` <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${row.status_kawin_nama}">
                            ${data}
                            </span> `;
                    }
                },
                {
                    data: 'pendidikan',
                    name: 'pendidikan',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        return ` <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${row.pendidikan_nama}">
                            ${data}
                            </span> `;
                    }
                },
                {
                    data: 'pekerjaan',
                    name: 'pekerjaan',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        return ` <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${row.pekerjaan_nama}">
                            ${data}
                            </span> `;
                    }
                },
                {
                    data: 'status_penduduk',
                    name: 'status_penduduk',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        return ` <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${row.status_penduduk_nama}">
                            ${data}
                            </span> `;
                    }
                },
                {
                    data: 'ktp_ada',
                    name: 'ktp_ada',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        const status = data == 1 ? 'Ada' : 'Tidak';
                        const status_nama = data == 1 ? 'Ada' : 'Tidak Ada';
                        const bg = data == 1 ? 'bg-success' : 'bg-danger';
                        return ` <span class="badge ${bg}" tabindex="0" data-toggle="tooltip" title="${status_nama}">
                            ${status}
                            </span> `;
                    }
                },
                {
                    data: 'akte_ada',
                    name: 'akte_ada',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        const status = data == 1 ? 'Ada' : 'Tidak';
                        const status_nama = data == 1 ? 'Ada' : 'Tidak Ada';
                        const bg = data == 1 ? 'bg-success' : 'bg-danger';
                        return ` <span class="badge ${bg}" tabindex="0" data-toggle="tooltip" title="${status_nama}">
                            ${status}
                            </span> `;
                    }
                },
                {
                    data: 'no_hp',
                    name: 'no_hp',
                    className: 'text-nowrap text-capitalize',
                },
                {
                    data: 'alamat_lengkap',
                    name: 'alamat_lengkap',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        return ` <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="${data}">
                            ${String(data).substr(0, 100) + (String(data).length > 100 ? '...' : '')}
                            </span> `;
                    }
                },
                {
                    data: 'negara',
                    name: 'negara',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        const status = data == 1 ? 'WNI' : 'WNA';
                        const status_nama = data == 1 ? 'Warga Negara Indonesia' :
                            'Warga Negara Asing';
                        const bg = data == 1 ? 'bg-success' : 'bg-info';
                        return ` <span class="badge ${bg}" tabindex="0" data-toggle="tooltip" title="${status_nama}">
                            ${status}
                            </span> `;
                    }
                },
                {
                    data: 'negara_nama',
                    name: 'negara_nama',
                    className: 'text-nowrap text-capitalize',
                    render: function(data, type, row) {
                        const status = row.negara == 1 ? 'IND' : data;
                        const status_nama = row.negara == 1 ? 'Indonesia' : data;
                        const bg = row.negara == 1 ? 'bg-success' : 'bg-info';
                        return ` <span class="badge ${bg}" tabindex="0" data-toggle="tooltip" title="${status_nama}">
                            ${status}
                            </span> `;
                    }
                },

            ],
            order: [
                [1, 'asc']
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

        new_table.on('draw.dt', function() {
            var PageInfo = table_html.DataTable().page.info();
            new_table.column(0, {
                page: 'current'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });

        });
        // datatable =================================================================================================

        // asal data ==================================================================================================
        $('#negara').change(() => {
            refresh_input_view();
        })
        $('#asal_data').change(() => {
            refresh_input_view();
        })
        $('#ktp_status').change(() => {
            refresh_input_view();
        })
        $('#akte_status').change(() => {
            refresh_input_view();
        })
        // asal data ==================================================================================================



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
            $.ajax({
                type: "POST",
                url: "{{ route('admin.kependudukan.penduduk.insert') }}",
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

                    resetErrorAfterInput();
                    refresh_input_view();
                    $('#MainForm').trigger("reset");
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
        $('#modal-default-title').html("Tambah Data Penduduk");
        resetErrorAfterInput();
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
                            title: 'Data deleted successfully',
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

    function viewKtp(ele) {
        const data = ele.dataset;
        const link = `{{ url($folder_ktp) }}/${data.foto}`
        $('#modal-default-ktp').modal('show');
        const btn_download = $('#donwloadd-btn-ktp');
        const img_modal = $('#img-modal-ktp');
        btn_download.attr('href', link);
        btn_download.attr('download', `ktp-${data.nama}-${data.nik}`);

        img_modal.attr('src', link);
        img_modal.attr('alt', data.nama);
    }

    function viewAkte(ele) {
        const data = ele.dataset;
        const link = `{{ url($folder_akte) }}/${data.foto}`
        $('#modal-default-akte').modal('show');
        const btn_download = $('#donwloadd-btn-akte');
        const img_modal = $('#img-modal-akte');
        btn_download.attr('href', link);
        btn_download.attr('download', `akte-${data.nama}-${data.nik}`);

        img_modal.attr('src', link);
        img_modal.attr('alt', data.nama);
    }

    function wn_refresh() {
        const penduduk_negara = $('#penduduk_negara');
        const negara_asal = $('#negara_asal');
        const nama = $('#nama');

        if (penduduk_negara.val() == 0) {
            negara_asal.parent().parent().fadeIn();
            nama.parent().parent().attr('class', 'col-md-4');
            penduduk_negara.parent().parent().attr('class', 'col-md-4');
            negara_asal.attr('required', '');
        } else {
            negara_asal.parent().parent().hide();
            nama.parent().parent().attr('class', 'col-md-6');
            penduduk_negara.parent().parent().attr('class', 'col-md-6');
            negara_asal.removeAttr('required')
        }
    }

    function refresh_input_view() {
        const asal_data = $('#asal_data');
        const tinggal_dari_tanggal = $('#tinggal_dari_tanggal');
        const datang_keterangan = $('#datang_keterangan');

        // asal data
        if (asal_data.val() == 0) {
            tinggal_dari_tanggal.parent().parent().hide();
            tinggal_dari_tanggal.removeAttr('required');
            datang_keterangan.parent().parent().hide();
            datang_keterangan.removeAttr('required');
        } else {
            tinggal_dari_tanggal.parent().parent().fadeIn();
            tinggal_dari_tanggal.attr('required', '');

            datang_keterangan.parent().parent().fadeIn();
        }

        // asal negara
        const negara = $('#negara');
        const negara_nama = $('#negara_nama');
        const negara_dari = $('#negara_dari');
        if (negara.val() == 1) {
            negara_nama.parent().parent().hide();
            negara_nama.removeAttr('required');
            negara_dari.parent().parent().hide();
            negara_dari.removeAttr('required');
        } else {
            negara_nama.parent().parent().fadeIn();
            negara_nama.attr('required', '');
            negara_dari.parent().parent().fadeIn();
            negara_dari.attr('required', '');
        }

        // ktp
        const ktp_status = $('#ktp_status');
        const ktp_dari = $('#ktp_dari');
        const ktp_file = $('#ktp_file');
        if (ktp_status.val() == 0) {
            ktp_dari.parent().parent().hide();
            ktp_file.parent().parent().hide();
        } else {
            ktp_dari.parent().parent().fadeIn();
            ktp_file.parent().parent().fadeIn();
        }

        // akte
        const akte_status = $('#akte_status');
        const akte_dari = $('#akte_dari');
        const akte_file = $('#akte_file');
        if (akte_status.val() == 0) {
            akte_dari.parent().parent().hide();
            akte_file.parent().parent().hide();
        } else {
            akte_dari.parent().parent().fadeIn();
            akte_file.parent().parent().fadeIn();
        }

    }
</script>
