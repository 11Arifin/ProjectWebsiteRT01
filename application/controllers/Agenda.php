<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Agenda_model');
    }

    public function index() {
        // Update status otomatis
        $this->Agenda_model->update_status();

        $data['title'] = 'Agenda Kegiatan — RT 01 Desa Sejahtera';
        $data['page'] = 'agenda';
        $data['agenda_upcoming'] = $this->Agenda_model->get_upcoming(20);
        $data['agenda_done'] = $this->Agenda_model->get_done(10);

        $this->load->view('templates/header', $data);
        $this->load->view('agenda/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail($id) {
        $agenda = $this->Agenda_model->get_by_id($id);

        if (!$agenda) {
            show_404();
        }

        $data['title'] = $agenda->judul . ' — RT 01 Desa Sejahtera';
        $data['page'] = 'agenda';
        $data['agenda'] = $agenda;

        $this->load->view('templates/header', $data);
        $this->load->view('agenda/detail', $data);
        $this->load->view('templates/footer', $data);
    }
}
