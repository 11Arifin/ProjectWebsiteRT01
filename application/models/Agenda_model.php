<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_Model {

    protected $table = 'agenda';

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua agenda
    public function get_all($limit = null, $offset = 0) {
        $this->db->order_by('tanggal', 'ASC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table)->result();
    }

    // Ambil agenda mendatang
    public function get_upcoming($limit = 3) {
        $this->db->where('tanggal >=', date('Y-m-d'));
        $this->db->where('status', 'upcoming');
        $this->db->order_by('tanggal', 'ASC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }

    // Ambil agenda yang sudah lewat
    public function get_done($limit = null, $offset = 0) {
        $this->db->where('status', 'done');
        $this->db->order_by('tanggal', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table)->result();
    }

    // Ambil berdasarkan ID
    public function get_by_id($id) {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    // Hitung semua agenda
    public function count_all() {
        return $this->db->count_all($this->table);
    }

    // Hitung agenda mendatang
    public function count_upcoming() {
        $this->db->where('tanggal >=', date('Y-m-d'));
        $this->db->where('status', 'upcoming');
        return $this->db->count_all_results($this->table);
    }

    // Simpan agenda baru
    public function insert($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    // Update agenda
    public function update($id, $data) {
        return $this->db->update($this->table, $data, array('id' => $id));
    }

    // Hapus agenda
    public function delete($id) {
        return $this->db->delete($this->table, array('id' => $id));
    }

    // Update status otomatis (untuk cron atau call manual)
    public function update_status() {
        $this->db->where('tanggal <', date('Y-m-d'));
        $this->db->where('status', 'upcoming');
        return $this->db->update($this->table, array('status' => 'done'));
    }
}
