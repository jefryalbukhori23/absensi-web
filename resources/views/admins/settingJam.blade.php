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
                        <th>Nama Lengkap</th>
                        <th>NISN</th>
                        <th>Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 50; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>Nama Lengkap {{ $i }}</td>
                            <td>NISN{{ $i }}</td>
                            <td>Kelamin{{ $i }}</td>
                            <td>Tempat Lahir{{ $i }}</td>
                            <td>Tanggal Lahir{{ $i }}</td>
                            <td>Telepon{{ $i }}</td>
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