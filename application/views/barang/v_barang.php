<main>
    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content" style="margin-top: -20px;">
                <h4 class="page-header-title">
                    <div class="page-header-icon">
                        <i data-feather="layout"></i>
                    </div>
                    <span>Data Barang</span>
                </h4>
                <div class="page-header-subtitle"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: -130px;">

        <div class="card mb-4">
            <div class="card-header">
                <div>
                    <a href="<?= base_url('barang/tambah'); ?>" class="btn btn-info">Tambah Data</a>
                    <?php $kode_barang = '';
                    foreach ($barang as $brg):
                        $kode_barang = $brg['kode_barang'];
                    endforeach; ?>
                    <!-- Tombol Cetak Gambar Barcode -->
                  <!  <a href="<?= base_url('barang/cetak_barcode') ?>?kode_barang=<?= $kode_barang ?>"
                        class="btn btn-success ml-2" target="_blank">Cetak Gambar Barcode</a>
                    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
                    <!-- Akhir Tombol Cetak Gambar Barcode -->
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="datatable table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5px;">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Detail</th>
                                <th>Satuan</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($barang as $brg): ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?></center>
                                    </td>
                                    <td><?= $brg['kode_barang'] ?></td>
                                    <td><?= $brg['nama_barang'] ?></td>
                                    <td><?= $brg['detail_barang'] ?></td>
                                    <td><?= $brg['satuan'] ?></td>
                                    <td><?= $brg['kategori'] ?></td>
                                    <td><?= $brg['stok'] ?></td>
                                    <td><?= $rp = 'Rp ' . number_format($brg['harga_beli'], 0, ',', '.'); ?></td>
                                    <td><?= $rp = 'Rp ' . number_format($brg['harga_jual'], 0, ',', '.'); ?></td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-secondary">
                                                    <svg id="barcode-<?= $brg['kode_barang'] ?>"
                                                        style="width: 100px; height: 30px;"></svg>
                                                    <script>
                                                        JsBarcode("#barcode-<?= $brg['kode_barang'] ?>", "<?= $brg['kode_barang'] ?>", {
                                                            format: "CODE128",
                                                            displayValue: true,
                                                            fontSize: 18,
                                                            height: 30,
                                                            width: 2
                                                        });
                                                    </script>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-info">
                                                    <a href="<?= base_url(); ?>barang/ubah/<?= $brg['id_barang'] ?>"
                                                        style="color: #fff;">
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <a href="<?= base_url(); ?>barang/hapus/<?= $brg['id_barang'] ?>"
                                                        class="tombol-hapus" style="color: #fff;">
                                                        <i data-feather="trash-2"></i>
                                                    </a>
                                                </button>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url(); ?>material/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('.tombol-hapus').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Yakin mau menghapus?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak, Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        });
    });
</script>