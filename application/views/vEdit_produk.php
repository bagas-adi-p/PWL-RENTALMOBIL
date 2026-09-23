<!-- Nama: Bagas Adi Pratama Wijanarko -->
<!-- NIM: 2023310001 -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">
                <div class="card-header d-flex ">
                    <a href="<?php echo site_url('dashboard/lihat_produk/') ?>" style="width: 60px ">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <h5 class="mb-0 w-100 text-center">Edit Produk</h5>
                </div>
                <div class="card-body">
                    <!-- Form Edit Produk -->
                    <form id="formEditProduk" action="<?php echo site_url('dashboard/proses_edit_produk') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $produk['id_produk']; ?>">

                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" id="nama_produk" name="nm_produk" class="form-control" required value="<?php echo $produk['nama_produk']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_produk">Deskripsi Produk</label>
                            <input type="text" id="deskripsi_produk" name="des_produk" class="form-control" required value="<?php echo $produk['deskripsi_produk']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="harga_produk">Harga Produk</label>
                            <input type="number" id="harga_produk" name="har_produk" class="form-control" required min="1000" value="<?php echo $produk['harga_produk']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="gambar_produk">Foto Produk (opsional)</label><br>
                            <input type="file" name="gambar_produk" id="gambar_produk" accept="image/*">
                        </div>

                        <button type="button" id="btnSubmitEdit" class="btn btn-primary btn-block">Ubah</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->



<script>
    document.getElementById('btnSubmitEdit').addEventListener('click', function() {
        const form = document.getElementById('formEditProduk');

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        Swal.fire({
            title: 'Yakin ingin mengubah produk?',
            text: "Pastikan data yang kamu masukkan sudah benar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>