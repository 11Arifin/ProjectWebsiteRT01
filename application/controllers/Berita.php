<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Berita_model');
        $this->load->library('pagination');
    }

    public function index() {
        $per_page = 6;
        $total = $this->Berita_model->count_for_pagination();
        $page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;

        // Konfigurasi Pagination
        $config['base_url'] = base_url('berita');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 2;
        $config['full_tag_open'] = '<nav class="pagination-nav"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['anchor_class'] = 'page-link';
        $this->pagination->initialize($config);

        $keyword = $this->input->get('q');

        if ($keyword) {
            $data['berita'] = $this->Berita_model->search($keyword, $per_page, $page);
        } else {
            $data['berita'] = $this->Berita_model->get_all($per_page, $page);
        }

        $data['title'] = 'Berita — RT 01 Desa Sejahtera';
        $data['page'] = 'berita';
        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['keyword'] = $keyword;

        $this->load->view('templates/header', $data);
        $this->load->view('berita/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail($slug) {
        $berita = $this->Berita_model->get_by_slug($slug);

        if (!$berita) {
            show_404();
        }

        $data['title'] = $berita->judul . ' — RT 01 Desa Sejahtera';
        $data['page'] = 'berita';
        $data['berita'] = $berita;

        $this->load->view('templates/header', $data);
        $this->load->view('berita/detail', $data);
        $this->load->view('templates/footer', $data);
    }
}
