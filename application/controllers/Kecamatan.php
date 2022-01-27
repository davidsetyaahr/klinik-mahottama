<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Kecamatan extends CI_Controller
    {
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->library('form_validation'); 
        $this->load->model('Tbl_kecamatan_model');       
        $this->load->model('Tbl_kabupaten_model');       
    }
    public function index()
    {
        $this->template->load('template','master_data/kecamatan/kecamatan_list');
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_kecamatan_model->json();
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_kabupaten', 'id_kabupaten', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kecamatan/create_action'),
            'id' => set_value('id'),
            'id_kabupaten' => set_value('id_kabupaten'),
            'kecamatan' => set_value('kecamatan'),
            'kabupaten' => $this->Tbl_kabupaten_model->get_all()
        );
        $this->template->load('template','master_data/kecamatan/tbl_kecamatan_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
                'kecamatan' => $this->input->post('kecamatan',TRUE),
            );
            $this->Tbl_kecamatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kecamatan'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_kecamatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kecamatan/update'),
                'id_kabupaten' => set_value('id_kabupaten',$row->id_kabupaten),
                'id' => set_value('id',$row->id),
                'kecamatan' => set_value('kecamatan',$row->kecamatan),
                'kabupaten' => $this->Tbl_kabupaten_model->get_all()
            );
            $this->template->load('template','master_data/kecamatan/tbl_kecamatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_kabupaten' => $this->input->post('id_kabupaten', TRUE),
                'kecamatan' => $this->input->post('kecamatan', TRUE),
            );
            $this->Tbl_kecamatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kecamatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_kecamatan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_kecamatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kecamatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }

}