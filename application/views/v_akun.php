<link href="<?= base_url() ?>material/css/account.css" rel="stylesheet"/>

<div class="container-fluid">
    <h1 class="mt-4">Detail Akun</h1>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-xl-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">Profil</div>
                <div class="card-body text-center">
                    <div class="profile-picture">
                        <img class="img-account-profile rounded-circle mb-3" src="<?= base_url() ?>material/image/user.png" alt="" style="width: 150px;">
                    </div>
                    <button class="btn btn-sm btn-link text-primary" id="editProfileBtn" data-toggle="modal" data-target="#editProfileModal">Edit Foto</button>
                    <h4 class="mb-1"><?= $this->session->userdata('nama_lengkap'); ?></h4>
                    <p class="text-muted mb-3"><?= $this->session->userdata('username'); ?></p>
                </div>
            </div>
        </div>

        <!-- Account Details Form -->
        <div class="col-xl-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">Detail Akun</div>
                <div class="card-body">
                    <form action="<?= base_url('dashboard/update_account') ?>" method="post">
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $this->session->userdata('nama_lengkap'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $this->session->userdata('username'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $this->session->userdata('email'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Foto Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk upload foto -->
                <form>
                    <div class="form-group">
                        <label for="uploadProfile">Pilih Foto Profil</label>
                        <input type="file" class="form-control-file" id="uploadProfile">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

