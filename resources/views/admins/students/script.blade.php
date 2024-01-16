<script>
    $(document).ready(function() {
        var table = $('#tables').DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/students',
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'id',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "fullname",
                },
                {
                    data: "nisn",
                },
                {
                    data: "gender",
                },
                {
                    data: "place_birth",
                },
                {
                    data: "date_of_birth",
                },
                {
                    data: "telephone_number",
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<div class="d-flex"><button title="Edit Data" class="btn btn-warning btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '"data-kode=" data-bs-toggle="modal" data-bs-target="#edit"><i class="fas fa-edit"></i></button>' +
                            '<button title="Hapus Data" class="btn btn-danger btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '" ><i class="fas fa-trash"></i></button></div>';
                    }
                },
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
                    table.ajax.reload();
                    $('#exampleModal').modal('hide');
                    $('#add_form')[0].reset();
                    // console.log(response.message);
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
            $.ajax({
                url: '/students/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    // Menampilkan form edit pada modal
                    $('#edit-isi').html(
                        '<form action="" id="editform" enctype="multipart/form-data">' +
                        '@csrf' +
                        '@method('PUT')' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Sekolah</label>' +
                        '<select name="id_school" id="" class="form-control">' +
                        '<option value="" disabled> -- Pilih Sekolah -- </option>' +
                        '@foreach ($schools as $item)' +
                        '<option value="{{ $item->id }}" @if($item->id === ' + response.id_school + ') selected @endif>{{ $item->school_name }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Nama Siswa</label>' +
                        '<input type="text" class="form-control" id="school_name" name="fullname" placeholder="Nama Siswa" value="' +
                        response.fullname + '">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="message-text" class="col-form-label">Jenis Kelamin</label><br>' +
                        '<input class="" type="radio" name="gender" id="gridRadios1" value="L"' +
                        (response.gender === 'L' ? ' checked' : '') + '>' +
                        ' L <br>' +
                        '<input class="" type="radio" name="gender" id="gridRadios2" value="P"' +
                        (response.gender === 'P' ? ' checked' : '') + '>' +
                        ' P' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Email</label>' +
                        '<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="' +
                        response.email + '">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Telepon</label>' +
                        '<input type="number" class="form-control" id="telephone_number" name="telephone_number" placeholder="Telepon" value="' +
                        response.telephone_number + '">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">NISN</label>' +
                        '<input type="number" class="form-control" id="nisn" name="nisn" placeholder="NISN" value="' +
                        response.nisn + '">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Tempat Lahir</label>' +
                        '<input type="text" class="form-control" id="place_birth" name="place_birth" placeholder="Tempat Lahir" value="' +
                        response.place_birth + '">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Tanggal Lahir</label>' +
                        '<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Tanggal Lahir" value="' +
                        response.date_of_birth + '">' +
                        '</div>'+
                        '<div><button type="submit" class="btn btn-primary">Edit</button></div>' +
                        '</form>'
                    );

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
                            url: '/students/' + id,
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
                                    text: 'Berhasil Update Data Sekolah',
                                    timer: 900
                                });
                                table.ajax.reload();
                                // location.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                var errorText = 'Terjadi kesalahan';
                                // Tampilkan pesan error jika ada
                                if (error.responseJSON && error
                                    .responseJSON.errors) {
                                    var errorMessages = error
                                        .responseJSON.errors;
                                    for (var key in errorMessages) {
                                        if (errorMessages
                                            .hasOwnProperty(key)) {
                                            errorText = errorMessages[
                                                key][0];
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
                                overlay
                                    .hide(); // Menyembunyikan layar penuh
                                loadingIcon
                                    .hide(); // Menyembunyikan indikator loading
                                tombolKirim.show();
                            }
                        });
                    });
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
                }
            });
        });

        // hapus
        $('.table').on('click', '.btn-danger', function() {
            var id = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Tampilkan konfirmasi penghapusan menggunakan Swal Alert
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus data sekolah ini?',
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
                        url: '/students/' + id,
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
