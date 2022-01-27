<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Dusun extends CI_Controller
    {
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->library('form_validation'); 
        $this->load->model('Tbl_kecamatan_model');       
        $this->load->model('Tbl_kabupaten_model');       
        $this->load->model('Tbl_desa_model');       
        $this->load->model('Tbl_dusun_model');       
    }
    public function index()
    {
        $this->template->load('template','master_data/dusun/dusun_list');
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_dusun_model->json();
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_kecamatan', 'id_kecamatan', 'trim|required');
        $this->form_validation->set_rules('dusun', 'dusun', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dusun/create_action'),
            'id' => set_value('id'),
            'id_kecamatan' => set_value('id_kecamatan'),
            'dusun' => set_value('dusun'),
            'kabupaten' => $this->Tbl_kabupaten_model->get_all(),
            'kecamatan' => $this->Tbl_kecamatan_model->get_all()
        );
        $this->template->load('template','master_data/dusun/tbl_dusun_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
                'dusun' => $this->input->post('dusun',TRUE),
            );
            $this->Tbl_dusun_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dusun'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_dusun_model->get_by_id($id);
        var_dump($row);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dusun/update'),
                'id_kecamatan' => set_value('id_kecamatan',$row->id_kecamatan),
                'id' => set_value('id',$row->id),
                'dusun' => set_value('dusun',$row->dusun),
                'kecamatan' => $this->Tbl_kecamatan_model->get_all()
            );
            $this->template->load('template','master_data/dusun/tbl_dusun_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dusun'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_kecamatan' => $this->input->post('id_kecamatan', TRUE),
                'dusun' => $this->input->post('dusun', TRUE),
            );
            $this->Tbl_dusun_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dusun'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_dusun_model->get_by_id($id);

        if ($row) {
            $this->Tbl_dusun_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dusun'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dusun'));
        }
    }

}