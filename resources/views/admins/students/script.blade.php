<script>
    $(document).ready(function() {
        var table = $('#tables').DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/students',
                type: 'GET',
                dataType: 'json'
            },
            columns: [{
                    data: 'id',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'nisn'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'place_birth'
                },
                {
                    data: 'date_of_birth'
                },
                {
                    data: 'telephone_number'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<div class="d-flex"><button title="Edit Data" class="btn btn-warning btn-sm me-2" data-id="' +
                            data
                            .id + '"data-kode="' + data.kode + '"data-name="' + data.name +
                            '" data-bs-toggle="modal" data-bs-target="#edit"><i class="fas fa-edit"></i></button>' +
                            '<button title="Hapus Data" class="btn btn-danger btn-sm me-2" data-id="' +
                            data
                            .id +
                            '" ><i class="fas fa-trash"></i></button></div>';
                    }
                }
            ]
        });

        //add
        $('#add_form').submit(function(e) {
            // alert('yo')
            e.preventDefault();

            var overlay = $('.fullscreen-overlay');
            var loadingIcon = $('.loading-container');

            overlay.show(); // Menampilkan layar penuh
            loadingIcon.show(); // Menampilkan indikator loading

            console.log(overlay);
            // return false;

            var tombolKirim = $(this).find('button[type="submit"]');

            tombolKirim.prop('disabled', true);
            tombolKirim.css('display', 'none');

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '/students', // Ganti dengan URL rute Anda
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Tanggapan sukses, lakukan sesuatu (misalnya: tampilkan pesan sukses)
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses Simpan Data!',
                        text: 'Data Berhasil Ditambahkan',
                        timer: 900
                    });
                    table.ajax.reload()
                    $('#atambahSiswaModaldd').modal('hide');
                    $('#add_form')[0].reset();
                    console.log(response.message);
                    // location.reload();
                },
                error: function(error) {
                    console.log(error);
                    var errorText = 'Terjadi kesalahan';
                    // Tampilkan pesan error jika ada
                    if (error.responseJSON && error.responseJSON.errors) {
                        var errorMessages = error.responseJSON.errors;
                        for (var key in errorMessages) {
                            if (errorMessages.hasOwnProperty(key)) {
                                errorText = errorMessages[key][0];
                                break;
                            }
                        }
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorText,
                    });
                },
                complete: function() {
                    tombolKirim.prop('disabled', false);
                    overlay.hide(); // Menyembunyikan layar penuh
                    loadingIcon.hide(); // Menyembunyikan indikator loading
                    tombolKirim.show();
                }
            });
        });

        // Edit
        $('.table').on('click', '.btn-warning', function() {
            var id = $(this).data('id');
            var data = $(this).data();

            // Menampilkan form edit pada modal
            $('#edit-isi').html(
                '<form action="" id="editform" enctype="multipart/form-data">' +
                '@csrf' +
                '@method('PUT')' +
                '<div class="form-group">' +
                '<label for="basicInput">Kode Satuan Unit</label>' +
                '<input type="text" class="form-control rounded-3" id="basicInput"' +
                'placeholder="Masukan Kode Satuan Unit" value="' + data.kode + '" name="kode">' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="basicInput">Nama Satuan Unit</label>' +
                ' <input type="text" class="form-control rounded-3" id="basicInput"' +
                ' placeholder="Masukan nama Satuan Unit" value="' + data.name + '" name="name">' +
                '</div>' +
                '<div class="col-lg-12 col-xl-12">' +
                '<div class="mb-3">' +
                '<button class="btn btn-primary" type="submit">Edit</button>' +
                '</div>' +
                '</div>' +
                '</form>'
            );

            $('.img').dropify();

            // Tampilkan modal
            $('#edit').modal('show');

            // Mengirim permintaan Ajax untuk mengupdate data ketika form disubmit
            $('#editform').submit(function(event) {
                event.preventDefault();

                var overlay = $('.fullscreen-overlay');
                var loadingIcon = $('.loading-container');

                overlay.show(); // Menampilkan layar penuh
                loadingIcon.show(); // Menampilkan indikator loading

                var tombolKirim = $(this).find('button[type="submit"]');

                tombolKirim.prop('disabled', true);
                tombolKirim.css('display', 'none');

                var formData = new FormData(this);

                $.ajax({
                    url: '/get_satuan_unit/' + id,
                    method: 'POST',
                    data: formData, // Mengirim objek FormData
                    processData: false, // Tidak memproses data secara otomatis
                    contentType: false, // Mengabaikan tipe konten secara otomatis
                    success: function(response) {
                        console.log(response);
                        $('#edit').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Update Data Vendor',
                            timer: 900
                        });
                        table.ajax.reload();
                        // location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        var errorText = 'Terjadi kesalahan';
                        // Tampilkan pesan error jika ada
                        if (error.responseJSON && error.responseJSON.errors) {
                            var errorMessages = error.responseJSON.errors;
                            for (var key in errorMessages) {
                                if (errorMessages.hasOwnProperty(key)) {
                                    errorText = errorMessages[key][0];
                                    break;
                                }
                            }
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorText,
                        });
                    },
                    complete: function() {
                        tombolKirim.prop('disabled', false);
                        overlay.hide(); // Menyembunyikan layar penuh
                        loadingIcon.hide(); // Menyembunyikan indikator loading
                        tombolKirim.show();
                    }
                });
            });
        });

        // hapus
        $('.table').on('click', '.btn-danger', function() {
            var id = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Tampilkan konfirmasi penghapusan menggunakan Swal Alert
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi penghapusan, kirim permintaan Ajax ke server untuk menghapus data
                    $.ajax({
                        url: '/get_satuan_unit/' + id,
                        type: 'DELETE',
                        headers: {
                            // Menambahkan token CSRF ke header permintaan
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log(
                                response); // Menampilkan respons dari server
                            Swal.fire('Berhasil', 'Data berhasil dihapus',
                                'success');
                            table.ajax.reload();
                            // location.reload();

                        },
                        error: function(error) {
                            console.log(
                                error
                            ); // Menampilkan pesan error jika permintaan gagal
                            Swal.fire('Error',
                                'Terjadi kesalahan saat menghapus data, Coba lagi nanti',
                                'error', 900);
                        }
                    });
                }
            });
        });
    });
</script>
