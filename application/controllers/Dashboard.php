<!-- Nama: Bagas Adi Pratama Wijanarko -->
<!-- NIM: 2023310001 -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mDashboard');
    }

    public function index()
    {
        // Memuat model mDashboard
        $this->load->model('mDashboard');
    
        // Mengambil jumlah produk dari database
        $data['jumlah_produk'] = $this->mDashboard->jumlah_produk();
    
        // Memuat view dengan data yang sudah diambil
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("templates/topbar");
        $this->load->view("templates/index", $data);  // Mengirimkan data jumlah produk ke view
        $this->load->view("templates/footer");
    }    

    public function lihat_produk()
    {
        $data['tbproduct'] = $this->mDashboard->get_data()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('vDProduk', $data);
        $this->load->view('templates/footer', $data);
    }


    public function tambah_produk()
    {
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("templates/topbar");
        $this->load->view("vTambah_produk");
        $this->load->view("templates/footer");
    }

    public function hapus_produk($id)
    {
        $this->mDashboard->hapus_produk($id);
        redirect('dashboard/lihat_produk');
    }

    public function edit_produk($id)
    {
        $data['produk'] = $this->mDashboard->ambil_id_produk($id);

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("templates/topbar");
        $this->load->view('vEdit_produk', $data);
        $this->load->view("templates/footer");
    }

    public function proses_edit_produk()
    {
        $id = $this->input->post('id'); // Ambil ID dari form
        $this->mDashboard->proses_edit_produk($id);
        redirect('dashboard/lihat_produk');
    }

    public function simpan_produk()
    {
        // Konfigurasi upload
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar_produk')) {  // Sesuai dengan name di form
            echo 'Upload gagal: ' . $this->upload->display_errors();
            return;
        }

        // Ambil informasi file yang diunggah
        $upload = $this->upload->data();

        // Simpan data ke dalam array
        $data = array(
            'nama_produk'       => $this->input->post('nm_produk', true),
            'deskripsi_produk'  => $this->input->post('des_produk', true),
            'harga_produk'      => $this->input->post('har_produk', true),
            'gambar_produk'     => $upload['file_name'],  // Konsisten dengan name input
        );

        // Simpan ke database menggunakan model
        $insert = $this->mDashboard->simpan('tbproduct', $data);

        if ($insert) {
            redirect('dashboard/lihat_produk');
        } else {
            echo 'Gagal Disimpan';
        }
    }
}
