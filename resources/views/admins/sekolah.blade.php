@extends('admins.layouts.base')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <button class="btn btn-primary">
                Tambah siswa
            </button>
            <table class="dataTables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>Negara / Swasta</th>
                        <th>NPSN</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Kepala Sekolah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 50; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>Nama Sekolah {{ $i }}</td>
                            <td>Negara / Swasta{{ $i }}</td>
                            <td>NPSN{{ $i }}</td>
                            <td>Email{{ $i }}</td>
                            <td>Telepon{{ $i }}</td>
                            <td>Alamat{{ $i }}</td>
                            <td>Kepala Sekolah{{ $i }}</td>
                            <td><button class="btn btn-primary">Aksi</button></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection