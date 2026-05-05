<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Berita_model');
        $this->load->model('Agenda_model');
    }

    public function index() {
        // Update status agenda otomatis
        $this->Agenda_model->update_status();

        $data['title'] = 'Beranda — RT 01 Desa Sejahtera';
        $data['page'] = 'home';
        $data['berita_terbaru'] = $this->Berita_model->get_latest(3);
        $data['agenda_upcoming'] = $this->Agenda_model->get_upcoming(3);

        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
