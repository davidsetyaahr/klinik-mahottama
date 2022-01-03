<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangan_operasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('datatables');
        $this->load->model('Tbl_ruangan_operasi_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/operasi/ruangan_operasi_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_ruangan_operasi_model->json();
    }
    
    public function _rules() 
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ruangan_operasi/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
        );
        $this->template->load('template','master_data/operasi/tbl_ruangan_operasi_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama',TRUE),
                'status' => '0',
            );
            $this->Tbl_ruangan_operasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ruangan_operasi'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_ruangan_operasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ruangan_operasi/update'),
                'id' => set_value('id',$row->id),
                'nama' => set_value('nama',$row->nama),
            );
            $this->template->load('template','master_data/operasi/tbl_ruangan_operasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangan_operasi'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_jenis_operasi', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                // 'status' => '0',
            );
            $this->Tbl_ruangan_operasi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ruangan_operasi'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Tbl_ruangan_operasi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_ruangan_operasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ruangan_operasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangan_operasi'));
        }
    }
}