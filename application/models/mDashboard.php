<!-- Nama: Bagas Adi Pratama Wijanarko -->
<!-- NIM: 2023310001 -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mDashboard extends CI_Model
{
    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('tbproduct');
        $query = $this->db->get();
        return $query;
    }

    public function jumlah_produk()
    {
        return $this->db->count_all('tbproduct');  // Menghitung jumlah baris dalam tabel produk
    }

    public function simpan($table, $data)
    {
        $insert = $this->db->insert($table, $data);
        return $insert;
    }

    public function hapus_produk($id)
    {
        // Ambil data produk berdasarkan ID
        $produk = $this->db->get_where('tbproduct', ['id_produk' => $id])->row();

        // Jika produk ditemukan dan ada gambar, hapus gambarnya
        if ($produk) {
            $gambar_path = './assets/uploads/' . $produk->gambar_produk;
            if (!empty($produk->gambar_produk) && file_exists($gambar_path)) {
                unlink($gambar_path);
            }

            // Hapus data dari database
            $this->db->where('id_produk', $id);
            $this->db->delete('tbproduct');
            redirect('dashboard/lihat_produk');
        } else {
            // Produk tidak ditemukan
            log_message('error', 'Produk dengan ID ' . $id . ' tidak ditemukan untuk dihapus.');
        }
    }

    public function ambil_id_produk($id)
    {
        return $this->db->get_where('tbproduct', ['id_produk' => $id])
            ->row_array();
    }

    public function proses_edit_produk($id)
    {
        // Ambil data dari form
        $data = [
            'nama_produk'       => $this->input->post('nm_produk', true),
            'deskripsi_produk'  => $this->input->post('des_produk', true),
            'harga_produk'      => $this->input->post('har_produk', true),
        ];

        // Ambil data produk lama untuk mendapatkan nama gambar sebelumnya
        $produk = $this->db->get_where('tbproduct', ['id_produk' => $id])->row();

        // Pastikan produk dengan ID tersebut ada sebelum update
        if (!$produk) {
            return ['error' => 'Produk tidak ditemukan'];
        }

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['gambar_produk']['name'])) {

            // Konfigurasi upload
            $config['upload_path']   = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar_produk')) {  // Perbaikan key input
                echo 'Upload gagal: ' . $this->upload->display_errors();
                return;
            }

            // Ambil informasi file yang diunggah
            $upload = $this->upload->data();

            // Hapus gambar lama jika ada
            if ($produk->gambar_produk && file_exists('./assets/uploads/' . $produk->gambar_produk)) {
                unlink('./assets/uploads/' . $produk->gambar_produk);
            }

            // Simpan nama file baru ke dalam array data
            $data['gambar_produk'] = $upload['file_name'];
        } else {
            // Jika tidak ada file yang diupload, gunakan nama gambar lama
            $data['gambar_produk'] = $produk->gambar_produk;
        }

        // Proses update data
        $this->db->where('id_produk', $id);
        $update = $this->db->update('tbproduct', $data);

        if ($update) {
            redirect('dashboard/lihat_produk');
        } else {
            echo 'Gagal memperbarui produk';
        }
    }
}
