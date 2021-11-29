<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipe_kategori_tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->model('Tbl_tipe_kategori_tindakan_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/tipe_kategori_tindakan/tipe_kategori_tindakan_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_tipe_kategori_tindakan_model->json();
    }
    public function _rules() 
    {
        // $this->form_validation->set_rules('kode_tindakan', 'Kode Tindakan', 'trim|required');
        $this->form_validation->set_rules('item', 'Item', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tipe_kategori_tindakan/create_action'),
            'id_kategori' => set_value('id_kategori'),
            'item' => set_value('item'),
        );
        $this->template->load('template','master_data/tipe_kategori_tindakan/tbl_tipe_kategori_tindakan_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'item' => $this->input->post('item', TRUE),
            );
            $this->Tbl_tipe_kategori_tindakan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tipe_kategori_tindakan'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_tipe_kategori_tindakan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tipe_kategori_tindakan/update'),
                'id_kategori' => set_value('id_kategori',$row->id_kategori),
                'item' => set_value('item',$row->item),
            );
            $this->template->load('template','master_data/tipe_kategori_tindakan/tbl_tipe_kategori_tindakan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tipe_kategori_tindakan'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_kategori', TRUE));
        } else {
            $data = array(
                'item' => $this->input->post('item', TRUE),
            );
            $this->Tbl_tipe_kategori_tindakan_model->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tipe_kategori_tindakan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_tipe_kategori_tindakan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_tipe_kategori_tindakan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tipe_kategori_tindakan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tipe_kategori_tindakan'));
        }
    }
}