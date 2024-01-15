<script>
    $(document).ready(function() {  
        var table = $('#table').DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/schools',
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
                data: "school_name",
            },
            {
                data: "type_school",
            },
            {
                data: "npsn",
            },
            {
                data: "email",
            },
            {
                data: "telephone_number",
            },
            {
                data: "address",
            },
            {
                data: "headmaster",
            },
            {
                data: null,
                    render: function(data, type, row) {
                        return '<div class="d-flex"><button title="Edit Data" class="btn btn-warning btn-sm me-2" data-id="' +
                            data
                            .id + '"data-kode=" data-bs-toggle="modal" data-bs-target="#edit"><i class="fas fa-edit"></i></button>' +
                            '<button title="Hapus Data" class="btn btn-danger btn-sm me-2" data-id="' +
                            data
                            .id +
                            '" ><i class="fas fa-trash"></i></button></div>';
                    }
            },
        ]
        });
    });
</script>