<main>
    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content" style="margin-top: -20px;">
                <h4 class="page-header-title">
                    <div class="page-header-icon">
                        <i data-feather="bar-chart"></i>
                    </div>
                    <span>Data Transaksi</span>
                </h4>
                <div class="page-header-subtitle"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: -130px;">
        <div class="card mb-4">
            <div class="card-header">
                <div>
                    <a href="<?= base_url('transaksi'); ?>" class="btn btn-info">
                        <i data-feather="plus" style="font-size: 18px;"></i>
                    </a>

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
                                <th>Unit</th>
                                <th>Cara Bayar</th>
                                <th>Status Bayar</th>
                                <th>Pengambilan</th>
                                <th>Tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d): ?>
                                <tr>
                                    <td>
                                        <center><?= $no++; ?></center>
                                    </td>
                                    <td><?= $d['nama_unit'] ?></td>
                                    <td>
                                        <?php if ($d['cara_bayar'] == 1) {
                                            echo "<h6><span class='badge badge-primary' style='border-radius: 20px; padding: 6px;'>&nbsp;&nbsp;&nbsp;Dibayar Cash&nbsp;&nbsp;&nbsp;</span><h6>";
                                        } else {
                                            echo "<h6><span class='badge badge-indigo' style='border-radius: 20px; padding: 6px;'>&nbsp;&nbsp;&nbsp;Dibayar Kredit&nbsp;&nbsp;&nbsp;</span><h6>";
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($d['status_bayar'] == 1) {
                                            echo "<h6><span class='badge badge-success' style='border-radius: 20px; padding: 6px;'>&nbsp;&nbsp;&nbsp;Sudah Lunas&nbsp;&nbsp;&nbsp;</span><h6>";
                                        } else {
                                            echo "<h6><span class='badge badge-danger' style='border-radius: 20px; padding: 6px;'>&nbsp;&nbsp;&nbsp;Belum Lunas&nbsp;&nbsp;&nbsp;</span><h6>";
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($d['status_pengambilan'] == 1) {
                                            echo "<h6><span class='badge badge-info' style='border-radius: 20px; padding: 6px;'>&nbsp;&nbsp;&nbsp;Sudah Diambil&nbsp;&nbsp;&nbsp;</span><h6>";
                                        } else {
                                            echo "<h6><span class='badge badge-danger' style='border-radius: 20px; padding: 6px;'>&nbsp;&nbsp;&nbsp;Belum Diambil&nbsp;&nbsp;&nbsp;</span><h6>";
                                        } ?>
                                    </td>
                                    <td><?php

                                    $create = explode(' ', $d['created_at']);
                                    $create2 = explode('-', $create[0]);
                                    $tanggal = $create2[2];
                                    $bulan = $create2[1];
                                    $tahun = $create2[0];

                                    $tampil_tanggal = $tanggal . "-" . $bulan . "-" . $tahun;
                                    $param = $d['id_transaksi'];
                                    echo $tampil_tanggal;
                                    ?></td>
                                    <td>
                                        <center>
                                           <!-- <a href="#" class="badge badge-primary detail" data-toggle="modal"
                                                data-target="#exampleModalLg" data-parameter="<?= $d['id_transaksi']; ?>">
                                                <i data-feather="eye"></i>
                                            </a> -->
                                            <a href="<?= base_url('transaksi/ubahtransaksi') ?>/<?= $d['id_transaksi']; ?>"
                                                class="badge badge-info"><i data-feather="edit"></i></a>
                                            <a href="<?= base_url('transaksi/hapus') ?>/<?= $d['id_transaksi']; ?>"
                                                class="badge badge-danger tombol-hapus"><i data-feather="trash-2"></i></a>
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

    <!-- Large modal 
    <div class="modal fade" id="exampleModalLg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">
                                    <center>Kategori</center>
                                </th>
                                <th scope="col">Harga</th>
                                <th scope="col">
                                    <center>Jumlah</center>
                                </th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="detail_transaksi">
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" id="footer-modal">
                    
                </div>
            </div>
        </div>
    </div>
                              <!-- ? -->      

</main>


<script src="<?= base_url(); ?>material/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>material/js/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function () {
        // Event handler untuk tombol detail
        $('.detail').on('click', function () {
            var id_transaksi = $(this).data('parameter'); // Ambil ID transaksi dari atribut data-parameter

            // Lakukan AJAX request untuk mendapatkan detail transaksi
            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>transaksi/get_detail_transaksi/" + id_transaksi, // URL ke method baru di controller
                dataType: "json",
                success: function (data) {
                    // Kosongkan isi tbody terlebih dahulu
                    $('#detail_transaksi').html('');

                    // Iterasi melalui data dan tambahkan baris baru ke tbody
                    $.each(data, function (index, item) {
                        var row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nama_barang}</td>
                                <td><center>${item.kategori}</center></td>
                                <td>${item.harga}</td>
                                <td><center>${item.jumlah}</center></td>
                                <td>${item.total}</td>
                            </tr>
                        `;
                        $('#detail_transaksi').append(row);
                    });
                },
                error: function () {
                    // Handle error jika ada
                    alert('Gagal memuat detail transaksi!');
                }
            });
        });

        // Event handler untuk tombol hapus (contoh, jika dibutuhkan)
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
    });
</script>
