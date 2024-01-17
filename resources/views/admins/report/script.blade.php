<script>
        $(document).ready(function() {
        var table = $('#table').DataTable({
            initComplete: function () {
                // Menyesuaikan elemen pencarian setelah tabel selesai diinisialisasi
                $('.dataTables_filter label').append('<i class="position-absolute fas fa-search" style="left: 15px; top: 15px; color: #BDBDBD"></i>');
                $('.dataTables_length label').append('<button type="button" class="btn btn-custom" data-toggle="modal" data-target="#exampleModal">Tambah siswa</button>');
                $('.dataTables_filter input').attr('placeholder', 'Cari...');
            },
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/get_data_absensi',
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
                    data: "date",
                },
                {
                    data: "time",
                },
                {
                    data: "status",
                },
                {
                    data: "photo",
                },
                {
                    data: "latitude",
                },
                {
                    data: "longitude",
                },
            ]
        });
    });
</script>