<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipe_kategori_periksa_lab_radiologi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->model('Tbl_kategori_periksa_lab_radiologi_model');
        $this->load->library('form_validation');        
    }

    public function index()
    {
        $this->template->load('template','master_data/kategori_periksa_lab_radiologi/kategori_periksa_lab_radiologi_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_kategori_periksa_lab_radiologi_model->json();
    }

    public function _rules() 
    {
        // $this->form_validation->set_rules('kode_tindakan', 'Kode Tindakan', 'trim|required');
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Tipe_kategori_periksa_lab_radiologi/create_action'),
            'id_kategori' => set_value('id_kategori'),
            'nama_kategori' => set_value('nama_kategori'),
        );
        $this->template->load('template','master_data/kategori_periksa_lab_radiologi/kategori_periksa_lab_radiologi_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori', TRUE),
            );
            $this->Tbl_kategori_periksa_lab_radiologi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tipe_kategori_periksa_lab_radiologi'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_kategori_periksa_lab_radiologi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Tipe_kategori_periksa_lab_radiologi/update'),
                'id_kategori' => set_value('id_kategori',$row->id_kategori),
                'nama_kategori' => set_value('nama_kategori',$row->nama_kategori),
            );
            $this->template->load('template','master_data/kategori_periksa_lab_radiologi/kategori_periksa_lab_radiologi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tipe_kategori_periksa_lab_radiologi'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_kategori', TRUE));
        } else {
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori', TRUE),
            );
            $this->Tbl_kategori_periksa_lab_radiologi_model->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tipe_kategori_periksa_lab_radiologi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_kategori_periksa_lab_radiologi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_kategori_periksa_lab_radiologi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tipe_kategori_periksa_lab_radiologi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tipe_kategori_periksa_lab_radiologi'));
        }
    }
}