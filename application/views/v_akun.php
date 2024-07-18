<link href="<?= base_url() ?>material/css/account.css" rel="stylesheet" />
<script src="<?= base_url() ?>material/js/account.js"></script>

<div class="container-fluid">
    <h1 class="mt-4">Detail Akun</h1>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-xl-4 col-lg-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user-circle fa-2x mr-2"></i> Profil
                </div>
                <div class="card-body text-center">
                    <div class="profile-picture">
                        <img class="img-account-profile rounded-circle mb-3"
                            src="<?= base_url() ?>material/image/user.png" alt="" style="width: 150px;">
                    </div>
                    <button class="btn btn-sm btn-link text-primary" id="editProfileBtn" data-toggle="modal"
                        data-target="#editProfileModal">
                        <i class="fas fa-camera fa-lg mr-2"></i> Edit Foto
                    </button>
                    <h4 class="mb-1"><?= $this->session->userdata('nama_lengkap'); ?></h4>
                    <p class="text-muted mb-3"><?= $this->session->userdata('username'); ?></p>
                </div>
            </div>
        </div>

        <!-- Account Details Form -->
        <div class="col-xl-8 col-lg-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-cog fa-2x mr-2"></i> Detail Akun
                </div>
                <div class="card-body">
                    <form action="<?= base_url('dashboard/update_account') ?>" method="post">
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                value="<?= $this->session->userdata('nama_lengkap'); ?>" readonly
                                onclick="resetPasswordFields()">
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?= $this->session->userdata('username'); ?>" onclick="resetPasswordFields()">
                        </div>
                        <div class="form-group" id="password-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah password"
                                onclick="showPasswordFields()">
                        </div>
                        <div id="newPasswordFields" style="display: none;">
                            <div class="form-group">
                                <label for="new_password" class="form-label">Masukkan password baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Ketik disini">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="form-label">Masukkan ulang password baru</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" placeholder="Ketik disini">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-save fa-lg mr-2"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Foto Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animate__animated animate__fadeInDown">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">
                    <i class="fas fa-camera fa-lg mr-2"></i> Edit Foto Profil
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk upload foto -->
                <form>
                    <div class="form-group">
                        <label for="uploadProfile" class="custom-file-label" id="customFileLabel">Pilih Foto
                            Profil</label>
                        <input type="file" class="custom-file-input" id="uploadProfile" onchange="updateFileName(this)">
                        <span class="custom-file-control" id="selectedFileName"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-save fa-lg"></i>
                </button>
            </div>
        </div>
    </div>
</div>