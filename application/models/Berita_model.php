<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {

    protected $table = 'berita';

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua berita yang sudah publish
    public function get_all($limit = null, $offset = 0) {
        $this->db->where('status', 'publish');
        $this->db->order_by('tanggal', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table)->result();
    }

    // Ambil semua berita untuk admin
    public function get_all_admin($limit = null, $offset = 0) {
        $this->db->order_by('created_at', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table)->result();
    }

    // Ambil berita berdasarkan slug
    public function get_by_slug($slug) {
        return $this->db->get_where($this->table, array('slug' => $slug, 'status' => 'publish'))->row();
    }

    // Ambil berita berdasarkan ID
    public function get_by_id($id) {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    // Hitung total berita publish
    public function count_publish() {
        $this->db->where('status', 'publish');
        return $this->db->count_all_results($this->table);
    }

    // Hitung total berita
    public function count_all() {
        return $this->db->count_all($this->table);
    }

    // Hitung untuk pagination
    public function count_for_pagination() {
        $this->db->where('status', 'publish');
        return $this->db->count_all_results($this->table);
    }

    // Berita terbaru (untuk homepage)
    public function get_latest($limit = 3) {
        $this->db->where('status', 'publish');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }

    // Simpan berita baru
    public function insert($data) {
        $data['slug'] = url_title($data['judul'], 'dash', TRUE) . '-' . time();
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    // Update berita
    public function update($id, $data) {
        return $this->db->update($this->table, $data, array('id' => $id));
    }

    // Hapus berita
    public function delete($id) {
        return $this->db->delete($this->table, array('id' => $id));
    }

    // Cari berita
    public function search($keyword, $limit = null, $offset = 0) {
        $this->db->like('judul', $keyword);
        $this->db->or_like('konten', $keyword);
        $this->db->where('status', 'publish');
        $this->db->order_by('tanggal', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table)->result();
    }
}
