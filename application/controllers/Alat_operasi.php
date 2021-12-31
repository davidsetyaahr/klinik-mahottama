<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alat_operasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('datatables');
        $this->load->model('Tbl_alat_operasi_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/operasi/alat_operasi_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_alat_operasi_model->json();
    }
    
    public function _rules() 
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function create() 
    {
        $data = array(
            'judul' => 'INPUT DATA ALAT OPERASI',
            'button' => 'Create',
            'action' => site_url('Alat_operasi/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'stok_terpakai' => set_value('stok_terpakai'),
            'stok_tidak_terpakai' => set_value('stok_tidak_terpakai'),
        );
        $this->template->load('template','master_data/operasi/tbl_alat_operasi_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama',TRUE),
                'stok_terpakai' => $this->input->post('stok_terpakai',TRUE),
                'stok_tidak_terpakai' => $this->input->post('stok_tidak_terpakai',TRUE),
            );
            $this->Tbl_alat_operasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Alat_operasi'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_alat_operasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul' => 'EDIT DATA ALAT OPERASI',
                'button' => 'Update',
                'action' => site_url('Alat_operasi/update'),
                'id' => set_value('id',$row->id),
                'nama' => set_value('nama',$row->nama),
                'stok_terpakai' => set_value('stok_terpakai',$row->stok_terpakai),
                'stok_tidak_terpakai' => set_value('stok_tidak_terpakai',$row->stok_tidak_terpakai),
            );
            $this->template->load('template','master_data/operasi/tbl_alat_operasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Alat_operasi'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'stok_terpakai' => $this->input->post('stok_terpakai',TRUE),
                'stok_tidak_terpakai' => $this->input->post('stok_tidak_terpakai',TRUE),
            );
            $this->Tbl_alat_operasi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Alat_operasi'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Tbl_alat_operasi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_alat_operasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Alat_operasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Alat_operasi'));
        }
    }
}