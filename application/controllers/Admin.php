<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Berita_model');
        $this->load->model('Agenda_model');
        $this->load->helper('url');
    }

    // Cek apakah sudah login — return false jika belum (tidak pakai redirect di sini)
    private function cek_login() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(base_url('admin/login'));
            exit();
        }
    }

    // ==================== AUTH ====================

    public function login() {
        // Jika sudah login, langsung ke dashboard
        if ($this->session->userdata('admin_logged_in')) {
            redirect(base_url('admin/dashboard'));
            exit();
        }

        $data['title'] = 'Login Admin — RT 01 Desa Sejahtera';
        $data['error'] = '';

        if ($this->input->post()) {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password');

            if (empty($username) || empty($password)) {
                $data['error'] = 'Username dan password wajib diisi!';
            } else {
                $query = $this->db->get_where('admin', array('username' => $username));

                if ($query->num_rows() > 0) {
                    $admin = $query->row();
                    if (password_verify($password, $admin->password)) {
                        // Set session data
                        $this->session->set_userdata('admin_logged_in', TRUE);
                        $this->session->set_userdata('admin_id', $admin->id);
                        $this->session->set_userdata('admin_nama', $admin->nama);
                        $this->session->set_userdata('admin_username', $admin->username);

                        // Redirect ke dashboard
                        redirect(base_url('admin/dashboard'));
                        exit();
                    } else {
                        $data['error'] = 'Password salah! Silakan coba lagi.';
                    }
                } else {
                    $data['error'] = 'Username tidak ditemukan!';
                }
            }
        }

        $this->load->view('admin/login', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('admin/login'));
        exit();
    }

    // ==================== DASHBOARD ====================

    public function dashboard() {
        $this->cek_login();

        $data['title']          = 'Dashboard Admin';
        $data['total_berita']   = $this->Berita_model->count_all();
        $data['total_agenda']   = $this->Agenda_model->count_all();
        $data['berita_publish'] = $this->Berita_model->count_publish();
        $data['agenda_upcoming']= $this->Agenda_model->count_upcoming();
        $data['berita_terbaru'] = $this->Berita_model->get_all_admin(5);
        $data['agenda_terbaru'] = $this->Agenda_model->get_all(5);

        $this->load->view('admin/dashboard', $data);
    }

    // ==================== BERITA ====================

    public function berita() {
        $this->cek_login();

        $data['title']  = 'Kelola Berita';
        $data['berita'] = $this->Berita_model->get_all_admin();

        $this->load->view('admin/berita/index', $data);
    }

    public function tambah_berita() {
        $this->cek_login();
        $data['title']  = 'Tambah Berita';
        $data['action'] = 'tambah';
        $this->load->view('admin/berita/form', $data);
    }

    public function simpan_berita() {
        $this->cek_login();

        $gambar = '';
        if (!empty($_FILES['gambar']['name'])) {
            $upload_dir = FCPATH . 'assets/img/berita/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, TRUE);

            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = 'berita_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect(base_url('admin/berita/tambah'));
                return;
            }
        }

        $save_data = array(
            'judul'    => $this->input->post('judul', TRUE),
            'konten'   => $this->input->post('konten'),
            'gambar'   => $gambar,
            'kategori' => $this->input->post('kategori', TRUE),
            'tanggal'  => $this->input->post('tanggal'),
            'status'   => $this->input->post('status'),
        );

        $this->Berita_model->insert($save_data);
        $this->session->set_flashdata('success', 'Berita berhasil ditambahkan!');
        redirect(base_url('admin/berita'));
    }

    public function edit_berita($id) {
        $this->cek_login();

        $berita = $this->Berita_model->get_by_id($id);
        if (!$berita) show_404();

        $data['title']  = 'Edit Berita';
        $data['action'] = 'edit';
        $data['berita'] = $berita;

        $this->load->view('admin/berita/form', $data);
    }

    public function update_berita($id) {
        $this->cek_login();

        $berita = $this->Berita_model->get_by_id($id);
        $gambar = $berita->gambar;

        if (!empty($_FILES['gambar']['name'])) {
            $upload_dir = FCPATH . 'assets/img/berita/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, TRUE);

            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = 'berita_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama
                if ($berita->gambar && file_exists(FCPATH . 'assets/img/berita/' . $berita->gambar)) {
                    unlink(FCPATH . 'assets/img/berita/' . $berita->gambar);
                }
                $gambar = $this->upload->data('file_name');
            }
        }

        $update_data = array(
            'judul'    => $this->input->post('judul', TRUE),
            'konten'   => $this->input->post('konten'),
            'gambar'   => $gambar,
            'kategori' => $this->input->post('kategori', TRUE),
            'tanggal'  => $this->input->post('tanggal'),
            'status'   => $this->input->post('status'),
        );

        $this->Berita_model->update($id, $update_data);
        $this->session->set_flashdata('success', 'Berita berhasil diperbarui!');
        redirect(base_url('admin/berita'));
    }

    public function hapus_berita($id) {
        $this->cek_login();

        $berita = $this->Berita_model->get_by_id($id);
        if ($berita && $berita->gambar && file_exists(FCPATH . 'assets/img/berita/' . $berita->gambar)) {
            unlink(FCPATH . 'assets/img/berita/' . $berita->gambar);
        }

        $this->Berita_model->delete($id);
        $this->session->set_flashdata('success', 'Berita berhasil dihapus!');
        redirect(base_url('admin/berita'));
    }

    // ==================== AGENDA ====================

    public function agenda() {
        $this->cek_login();

        $data['title']  = 'Kelola Agenda';
        $data['agenda'] = $this->Agenda_model->get_all();

        $this->load->view('admin/agenda/index', $data);
    }

    public function tambah_agenda() {
        $this->cek_login();
        $data['title']  = 'Tambah Agenda';
        $data['action'] = 'tambah';
        $this->load->view('admin/agenda/form', $data);
    }

    public function simpan_agenda() {
        $this->cek_login();

        $save_data = array(
            'judul'     => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi'),
            'tanggal'   => $this->input->post('tanggal'),
            'waktu'     => $this->input->post('waktu'),
            'lokasi'    => $this->input->post('lokasi', TRUE),
            'status'    => $this->input->post('status'),
        );

        $this->Agenda_model->insert($save_data);
        $this->session->set_flashdata('success', 'Agenda berhasil ditambahkan!');
        redirect(base_url('admin/agenda'));
    }

    public function edit_agenda($id) {
        $this->cek_login();

        $agenda = $this->Agenda_model->get_by_id($id);
        if (!$agenda) show_404();

        $data['title']  = 'Edit Agenda';
        $data['action'] = 'edit';
        $data['agenda'] = $agenda;

        $this->load->view('admin/agenda/form', $data);
    }

    public function update_agenda($id) {
        $this->cek_login();

        $update_data = array(
            'judul'     => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi'),
            'tanggal'   => $this->input->post('tanggal'),
            'waktu'     => $this->input->post('waktu'),
            'lokasi'    => $this->input->post('lokasi', TRUE),
            'status'    => $this->input->post('status'),
        );

        $this->Agenda_model->update($id, $update_data);
        $this->session->set_flashdata('success', 'Agenda berhasil diperbarui!');
        redirect(base_url('admin/agenda'));
    }

    public function hapus_agenda($id) {
        $this->cek_login();
        $this->Agenda_model->delete($id);
        $this->session->set_flashdata('success', 'Agenda berhasil dihapus!');
        redirect(base_url('admin/agenda'));
    }
}
