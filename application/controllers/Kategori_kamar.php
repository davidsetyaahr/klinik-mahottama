<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_kamar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->model('Tbl_kategori_kamar_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/kategori_kamar/kategori_kamar_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_kategori_kamar_model->json();
    }
    public function _rules() 
    {
        // $this->form_validation->set_rules('kode_tindakan', 'Kode Tindakan', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kategori_kamar/create_action'),
            'id_kategori_kamar' => set_value('id_kategori_kamar'),
            'nama' => set_value('nama'),
            'harga' => set_value('harga'),
        );
        $this->template->load('template','master_data/kategori_kamar/tbl_kategori_kamar_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'harga' => $this->input->post('harga',TRUE),
            );
            $this->Tbl_kategori_kamar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kategori_kamar'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_kategori_kamar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kategori_kamar/update'),
                'id_kategori_kamar' => set_value('id_kategori_kamar',$row->id_kategori_kamar),
                'nama' => set_value('nama',$row->nama),
                'harga' => set_value('harga',$row->harga),
            );
            $this->template->load('template','master_data/kategori_kamar/tbl_kategori_kamar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_kamar'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_kategori_kamar', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'harga' => $this->input->post('harga',TRUE),
            );
            $this->Tbl_kategori_kamar_model->update($this->input->post('id_kategori_kamar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kategori_kamar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_kategori_kamar_model->get_by_id($id);

        if ($row) {
            $this->Tbl_kategori_kamar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategori_kamar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_kamar'));
        }
    }
}