<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Desa extends CI_Controller
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
    }
    public function index()
    {
        $this->template->load('template','master_data/desa/desa_list');
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_desa_model->json();
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_kecamatan', 'id_kecamatan', 'trim|required');
        $this->form_validation->set_rules('desa', 'desa', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('desa/create_action'),
            'id' => set_value('id'),
            'id_kecamatan' => set_value('id_kecamatan'),
            'desa' => set_value('desa'),
            'kabupaten' => $this->Tbl_kabupaten_model->get_all(),
            'kecamatan' => $this->Tbl_kecamatan_model->get_all()
        );
        $this->template->load('template','master_data/desa/tbl_desa_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
                'desa' => $this->input->post('desa',TRUE),
            );
            $this->Tbl_desa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('desa'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_desa_model->get_by_id($id);
        var_dump($row);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('desa/update'),
                'id_kecamatan' => set_value('id_kecamatan',$row->id_kecamatan),
                'id' => set_value('id',$row->id),
                'desa' => set_value('desa',$row->desa),
                'kecamatan' => $this->Tbl_kecamatan_model->get_all()
            );
            $this->template->load('template','master_data/desa/tbl_desa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('desa'));
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
                'desa' => $this->input->post('desa', TRUE),
            );
            $this->Tbl_desa_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('desa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_desa_model->get_by_id($id);

        if ($row) {
            $this->Tbl_desa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('desa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('desa'));
        }
    }

    public function desaByKec()
    {
        $data = $this->db->get_where("tbl_desa",['id_kecamatan' => $_GET['id_kecamatan']])->result();
        echo json_encode($data);
    }

}