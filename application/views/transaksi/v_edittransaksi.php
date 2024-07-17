<main>
    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content">

            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: -175px;">
        <div class="card mb-4 ml-3 mr-3">
            <div class="card-header">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>">
                </div>
                <?= $judul; ?>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <form method="POST" action="<?= base_url('transaksi/edit') ?>">
                                <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input class="form-control" type="text" name="nama_unit"
                                        value="<?= $data['nama_unit']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Cara bayar</label>
                                    <select class="form-control" name="cara_bayar">
                                        <option value="1" <?= ($data['cara_bayar'] == 1) ? "selected" : "" ?>>Dibayar Cash
                                        </option>
                                        <option value="0" <?= ($data['cara_bayar'] == 0) ? "selected" : "" ?>>Dibayar
                                            Kredit</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Status Bayar</label>
                                    <select class="form-control" name="status_bayar">
                                        <option value="1" <?= ($data['status_bayar'] == 1) ? "selected" : "" ?>>Lunas
                                        </option>
                                        <option value="0" <?= ($data['status_bayar'] == 0) ? "selected" : "" ?>>Belum Lunas
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pengambilan</label>
                                    <select class="form-control" name="status_pengambilan">
                                        <option value="1" <?= ($data['status_pengambilan'] == 1) ? "selected" : "" ?>>Sudah
                                            Diambil</option>
                                        <option value="0" <?= ($data['status_pengambilan'] == 0) ? "selected" : "" ?>>Belum
                                            Diambil</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    Simpan Perubahan
                                </button>
                                <a href="<?= base_url() ?>transaksi/data" class="btn btn-warning">Kembali</a>
                        </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <img src="<?= base_url() ?>material/assets/img/drawkit/color/drawkit-developer-woman.svg"
                            style="width: 400px; transform: rotateY(180deg); margin-top: 40px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<script>

</script>