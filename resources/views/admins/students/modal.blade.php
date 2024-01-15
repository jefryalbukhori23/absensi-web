<div class="modal fade" id="tambahSiswaModal" tabindex="-1" role="dialog" aria-labelledby="tambahSiswaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_form">
                <div class="modal-body">
                    <div class="modal-body">
                        <!-- Formulir untuk mengumpulkan data siswa -->
                        @csrf
                        <div class="form-group">
                            <label for="id_school">Sekolah:</label>
                            <select class="form-control" name="id_school">
                                <option value="" disabled selected> >> Pilih Seolah << </option>
                                        @foreach ($schools as $item)
                                <option value="{{ $item->id }}">{{ $item->school_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN:</label>
                            <input type="number" class="form-control" id="nisn" name="nisn">
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin:</label> <br>
                            <input type="radio" id="gender" value="L" name="gender"> Pria <br>
                            <input type="radio" id="gender" value="P" name="gender"> Wanita
                        </div>
                        <div class="form-group">
                            <label for="place_birth">Tempat Lahir:</label>
                            <input type="text" class="form-control" id="place_birth" name="place_birth">
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                        </div>
                        <div class="form-group">
                            <label for="telephone_number">Nomor Telepon:</label>
                            <input type="number" class="form-control" id="telephone_number" name="telephone_number">
                        </div>
                        <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit --}}
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit-isi">

            </div>
        </div>
    </div>
</div>
