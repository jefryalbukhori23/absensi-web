<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_form">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" id="name_school" name="name_school" placeholder="Nama Sekolah">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Negeri / Swasta</label>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                            First radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                            Second radio
                            </label>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">NPSN</label>
                        <input type="text" class="form-control" id="npsn" name="npsn" placeholder="NPSN">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Pembimbing PKL</label>
                        <input type="text" class="form-control" id="pembimbing_pkl" name="pembimbing_pkl" placeholder="Pembimbing PKL">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Logo Sekolah</label>
                        <input type="text" class="form-control" id="logo" name="logo" placeholder="Logo Sekolah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>