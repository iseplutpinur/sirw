<script src="{{ asset('assets/templates/admin/plugins/sweet-alert/sweetalert2.all.js') }}"></script>
<script src="{{ asset('assets/templates/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/templates/admin/plugins/loading/loadingoverlay.min.js') }}"></script>

<script>
    const global_is_edit = new Map();
    const masters = new Array();

    @foreach ($masters as $master)
        masters.push({
            'name': `{{ $master['name'] }}`,
            'title': `{{ $master['title'] }}`,
        });
    @endforeach

    $(document).ready(e => {
        tooltip_refresh();

        $('#nama').keyup(function() {
            $('#penduduk_nama').html(this.value);
        })

        // loop data master
        masters.forEach(e => {
            master = e.name;
            master_title = e.title;

            master_refresh(master, master_title);
            // button sesuaikan
            $(`#${e.name}_sesuaikan`).click(function() {
                const {
                    name,
                    title
                } = this.dataset;
                const el = $(this);
                swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Tanggal sampai di list akan diubah menjadi tanggal dari data selanjutnya di kurangi 1 hari ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: `{{ url($prefix_uri) }}/${name}/refresh`,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            data: {
                                penduduk_id: '{{ $penduduk->id }}'
                            },
                            beforeSend: function() {
                                el.attr('disable', true);
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
                                    title: 'Data berhasil disesuaikan',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                master_refresh(name, title);
                            },
                            complete: function() {
                                swal.hideLoading();
                                el.removeAttr('disable');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                swal.hideLoading();
                                swal.fire("!Opps ",
                                    "Something went wrong, try again later",
                                    "error"
                                );
                            }
                        });
                    }
                });
            })

            // button tambah
            $(`#${e.name}_tambah`).click(function() {
                const {
                    name,
                    title
                } = this.dataset;
                let is_edit = global_is_edit.get(name);
                if (is_edit == undefined) {
                    is_edit = 1;
                    global_is_edit.set(name, 1);
                }

                if (is_edit == 1) {
                    $(`#${name}_form`).trigger('refresh');
                    $(`#${name}_form_id`).val('');
                    $(`#${name}_modal_title`).html(`Tambah Data Penduduk ${title}`);
                    global_is_edit.set(name, 0);
                }

            })

            // insert or update
            $(`#${e.name}_form`).submit(function(ev) {
                ev.preventDefault();
                const form = new FormData(this);
                form.append('penduduk_id', '{{ $penduduk->id }}');
                $.LoadingOverlay("show");

                const {
                    name,
                    title
                } = this.dataset;

                const route = `{{ url($prefix_uri) }}/${name}/` +
                    ($(`#${name}_form_id`).val() == "" ? 'insert' : 'update');
                $.ajax({
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: route,
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                }).done((data) => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Data saved successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    master_refresh(name, title);
                    global_is_edit.set(name, 1);
                }).fail(($xhr) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Something went wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).always(() => {
                    $.LoadingOverlay("hide");
                    $(`#${name}_modal`).modal('hide')
                })
            });

        });

        // update penduduk
        $(`#basic_profile`).submit(function(ev) {
            ev.preventDefault();
            const form = new FormData(this);
            form.append('penduduk_id', '{{ $penduduk->id }}');
            $.LoadingOverlay("show");
            $.ajax({
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ route($prefix . '.update', $penduduk->id) }}`,
                data: form,
                cache: false,
                contentType: false,
                processData: false,
            }).done((data) => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data saved successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
            }).fail(($xhr) => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong',
                    showConfirmButton: false,
                    timer: 1500
                })
            }).always(() => {
                $.LoadingOverlay("hide");
            })
        });

    })

    function tooltip_refresh() {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // agama ==========================================================================================================
    // get all
    function master_refresh(name, title) {
        $(`#${name}_card`).LoadingOverlay("show");
        $.ajax({
            type: "GET",
            url: `{{ url($prefix_uri) }}/${name}/all`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                penduduk_id: '{{ $penduduk->id }}'
            },
            success: (data) => {
                const container = $(`#${name}_list_body`);
                container.html('');
                data.forEach(e => {
                    container.append(`<div class="list-group-item list-group-item-action d-md-flex flex-row justify-content-between">
                                    <div>
                                        <div class="d-flex w-100">
                                            <h5 class="mb-1 fw-bold" data-commet="ada link ke rt" data-toggle="tooltip" title="${e.model_full}">${e.model}</h5>
                                        </div>
                                        <p class="my-0" data-toggle="tooltip" title="${e.dari_full_str} sampai dengan ${e.sampai_full_str ?? 'Sekarang'}">${e.dari_str} - ${e.sampai_str ?? 'Sekarang'}</p>
                                    </div>

                                    <div class="text-md-center">
                                        <button class="btn btn-primary btn-sm my-1" data-toggle="tooltip" onclick="master_edit('${name}','${title}','${e.id}')" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm my-1" data-toggle="tooltip" onclick="master_delete('${name}','${title}','${e.id}')" title="Hapus Data">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>`);
                });
                tooltip_refresh();
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
                $(`#${name}_card`).LoadingOverlay("hide");
            }
        });
    }

    // delete
    function master_delete(name, title, id) {
        swal.fire({
            title: 'Are you sure?',
            text: "Are you sure you want to proceed ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: `{{ url($prefix_uri) }}/${name}/${id}`,
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
                        master_refresh(name, title);
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

    // edit
    function master_edit(name, title, id) {
        $.LoadingOverlay("show");
        $.ajax({
            type: "GET",
            url: `{{ url($prefix_uri) }}/${name}/find`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id
            },
            success: (data) => {
                $(`#${name}_modal`).modal('show');
                $(`#${name}_id`).val(data[`${name}_id`]);
                $(`#${name}_form_id`).val(data.id);
                $(`#${name}_dari`).val(data.dari);
                $(`#${name}_sampai`).val(data.sampai);
                $(`#${name}_modal_title`).html(`Ubah Data Penduduk ${title}`);
                global_is_edit.set(name, 1);
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
                $.LoadingOverlay("hide");
            }
        });
    }
    // agama ==========================================================================================================
</script>
