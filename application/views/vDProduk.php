<!-- Nama: Bagas Adi Pratama Wijanarko -->
<!-- NIM: 2023310001 -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="card mb-4 mx-4 mt-3">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5 class="mb-0">Daftar Produk</h5>
                        <a href="<?php echo site_url('dashboard/tambah_produk') ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Data
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Price</th>
                                        <th>Picture</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tbproduct as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $row->nama_produk ?></td>
                                            <td><?php echo $row->deskripsi_produk ?></td>
                                            <td><?php echo 'Rp. ' . $row->harga_produk ?></td>
                                            <td><img src="<?php echo base_url('assets/uploads/' . $row->gambar_produk); ?>" width="120" height="100"></td>
                                            <td class="d-flex">
                                                <!-- Tombol Hapus (berubah jadi button) -->
                                                <button class="btn btn-outline-danger btn-sm btn-hapus" data-id="<?php echo $row->id_produk ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Tombol Edit -->
                                                <a href="<?php echo site_url('dashboard/edit_produk/' . $row->id_produk) ?>" class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </main>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    // Menambahkan event listener untuk semua tombol dengan class 'btn-hapus'
    document.querySelectorAll('.btn-hapus').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            // Menampilkan SweetAlert2 konfirmasi hapus
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // Jika dikonfirmasi, arahkan ke URL hapus
                if (result.isConfirmed) {
                    window.location.href = "<?php echo site_url('dashboard/hapus_produk/') ?>" + id;
                }
            });
        });
    });
</script>