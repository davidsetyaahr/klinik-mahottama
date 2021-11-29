<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_biaya extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->model('Tbl_kategori_biaya_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/kategori_biaya/kategori_biaya_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_kategori_biaya_model->json();
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
            'action' => site_url('kategori_biaya/create_action'),
            'id_kategori_biaya' => set_value('id_kategori_biaya'),
            'item' => set_value('item'),
        );
        $this->template->load('template','master_data/kategori_biaya/tbl_kategori_biaya_form', $data);
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
            $this->Tbl_kategori_biaya_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kategori_biaya'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_kategori_biaya_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kategori_biaya/update'),
                'id_kategori_biaya' => set_value('id_kategori_biaya',$row->id_kategori_biaya),
                'item' => set_value('item',$row->item),
            );
            $this->template->load('template','master_data/kategori_biaya/tbl_kategori_biaya_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_biaya'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_kategori_biaya', TRUE));
        } else {
            $data = array(
                'item' => $this->input->post('item', TRUE),
            );
            $this->Tbl_kategori_biaya_model->update($this->input->post('id_kategori_biaya', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kategori_biaya'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_kategori_biaya_model->get_by_id($id);

        if ($row) {
            $this->Tbl_kategori_biaya_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategori_biaya'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_biaya'));
        }
    }
}