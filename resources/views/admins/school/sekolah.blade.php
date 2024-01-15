@extends('admins.layouts.base')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <div class="col-4 mb-5">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah siswa
                </button>
            </div>
            <div class="container">
                <table class="w-100" id="table">
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
            </table>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    
    @include('admins.school.modal')

@endsection

@section('script')
@include('admins.school.script')
@endsection