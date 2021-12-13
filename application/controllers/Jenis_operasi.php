<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_operasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('datatables');
        $this->load->model('Tbl_jenis_operasi_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/jenis_operasi/jenis_operasi_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_jenis_operasi_model->json();
    }
    public function _rules() 
    {
        $this->form_validation->set_rules('nama_jenis_operasi', 'nama_jenis_operasi', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_operasi/create_action'),
            'id_jenis_operasi' => set_value('id_jenis_operasi'),
            'nama_jenis_operasi' => set_value('nama_jenis_operasi'),
        );
        $this->template->load('template','master_data/jenis_operasi/tbl_jenis_operasi_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_jenis_operasi' => $this->input->post('nama_jenis_operasi', TRUE),
            );
            $this->Tbl_jenis_operasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis_operasi'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_jenis_operasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_operasi/update'),
                'id_jenis_operasi' => set_value('id_jenis_operasi',$row->id_jenis_operasi),
                'nama_jenis_operasi' => set_value('nama_jenis_operasi',$row->nama_jenis_operasi),
            );
            $this->template->load('template','master_data/jenis_operasi/tbl_jenis_operasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_operasi'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_jenis_operasi', TRUE));
        } else {
            $data = array(
                'nama_jenis_operasi' => $this->input->post('nama_jenis_operasi', TRUE),
            );
            $this->Tbl_jenis_operasi_model->update($this->input->post('id_jenis_operasi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis_operasi'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Tbl_jenis_operasi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jenis_operasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenis_operasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_operasi'));
        }
    }
}