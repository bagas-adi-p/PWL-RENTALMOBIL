<!-- Nama: Bagas Adi Pratama Wijanarko -->
<!-- NIM: 2023310001 -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">
                <div class="card-header d-flex">
                    <a href="<?php echo site_url('dashboard/lihat_produk/') ?>" style="width: 60px;"><i class="fas fa-arrow-left"></i> Back</a>
                    <h5 class="mb-0 w-100 text-center">Tambah Produk</h5>
                </div>
            </div>

            <div class="card-body">
                <!-- Tambahkan ID ke form -->
                <form id="formTambahProduk" action="<?php echo site_url('dashboard/simpan_produk') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nm_produk" class="form-control" placeholder="Masukkan Nama Produk" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_produk">Deskripsi Produk</label>
                        <textarea id="deskripsi_produk" name="des_produk" class="form-control" placeholder="Masukkan Deskripsi Produk" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="harga_produk">Harga Produk</label>
                        <input type="number" id="harga_produk" name="har_produk" class="form-control" placeholder="Masukkan Harga Produk" required min="1000">
                    </div>

                    <div class="form-group">
                        <label for="gambar_produk">Foto Produk</label><br>
                        <input type="file" name="gambar_produk" id="gambar_produk" accept="image/*" required>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="button" id="btnSubmitTambah" class="btn btn-primary btn-block">Tambah</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Script Konfirmasi SweetAlert -->
<script>
    document.getElementById('btnSubmitTambah').addEventListener('click', function() {
        const form = document.getElementById('formTambahProduk');

        // Cek validitas form HTML
        if (!form.checkValidity()) {
            form.reportValidity(); // tampilkan pesan validasi browser
            return;
        }

        // SweetAlert konfirmasi
        Swal.fire({
            title: 'Yakin ingin menambahkan produk?',
            text: "Pastikan data yang kamu masukkan sudah benar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>