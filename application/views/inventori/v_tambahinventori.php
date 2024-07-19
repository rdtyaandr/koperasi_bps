<main>
    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content">
                <!-- Konten Header Halaman -->
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: -175px;">
        <div class="card mb-4 ml-3 mr-3">
            <div class="card-header">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>">
                    <!-- Flash Data -->
                </div>
                <?= $judul; ?>
                <a href="#" class="btn btn-primary" style="margin-left: 850px;" data-toggle="modal" data-target="#barangModal">Lihat Barang</a>

                <!-- Modal -->
                <div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="barangModalLabel">Daftar Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Detail</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($barang as $brg) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $brg['kode_barang'] ?></td>
                                                <td><?= $brg['nama_barang'] ?></td>
                                                <td><?= $brg['detail_barang'] ?></td>
                                                <td><?= $brg['qty'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <form method="POST" action="<?= base_url() ?>inventori/tambah">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input class="form-control" type="text" name="kode_barang" id="kodeBarangInv"
                                        autocomplete="off" value="<?= set_value('kode_barang') ?>"
                                        onkeypress="return RestrictSpace()" onchange="get_detail(this.value, 1)"/>
                                    <small class="form-text text-danger"><?= form_error('kode_barang');?></small>
                                </div>
                                <div class="form-group">
                                    <label>No Urut Barang</label>
                                    <input class="form-control" type="text" name="id_barang" autocomplete="on"
                                        id="idBarangInv" value="<?= set_value('id_barang');?>" />
                                    <small class="form-text text-danger"><?= form_error('id_barang'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input class="form-control" type="text" name="nama_barang" autocomplete="off"
                                        value="<?= set_value('nama_barang') ?>" id="namaBarangInv" />
                                    <small class="form-text text-danger"><?= form_error('nama_barang'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Detail</label>
                                    <Input class="form-control" rows="4" name="detail_barang"
                                        value="<?= set_value('detail_barang') ?>" id="detailBarangInv">
                                    <small class="form-text text-danger"><?= form_error('detail_barang'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label>QTY</label>
                                    <input class="form-control" type="number" name="qty" autocomplete="off"
                                        value="<?= set_value('qty') ?>" id="qty" /><small
                                        class="form-text text-danger"><?= form_error('qty'); ?></small>
                                </div>
                                <div class="form-group mt-4 pt-1">
                                    <button type="submit" class="btn btn-success" name="tambahinv">
                                        Tambah
                                    </button>
                                    <a href="<?= base_url() ?>inventori" class="btn btn-warning kembali">
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4">
                            <img src="<?= base_url() ?>material/assets/img/drawkit/color/drawkit-folder-man.svg"
                                style="margin-top: 100px; width: 300px">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    
    // Fungsi untuk mencegah pengguna memasukkan spasi pada input
    function RestrictSpace() {
        if (event.keyCode == 32) {
            return false;
        }
    }

    // Fungsi untuk mendapatkan detail barang berdasarkan kode barang
    function get_detail(b, n) {
    $.ajax({
        method: 'POST',
        url: '<?= base_url() ?>inventori/autokodebaranginv',
        data: { kode_barang: b },
        success: function (hasil) {
            var data = $.parseJSON(hasil);
            console.log(data);
            $('#idBarangInv').val(data.id_barang);
            $('#namaBarangInv').val(data.nama_barang);
            $('#detailBarangInv').val(data.detail_barang);
        }
    });
}

</script>
