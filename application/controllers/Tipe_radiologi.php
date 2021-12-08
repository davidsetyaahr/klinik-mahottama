<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipe_radiologi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->model('Tbl_tipe_radiologi_model');
        $this->load->model('Tbl_kategori_periksa_lab_radiologi_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/tipe_radiologi/tipe_radiologi_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_tipe_radiologi_model->json();
    }
    public function _rules() 
    {
        // $this->form_validation->set_rules('kode_tindakan', 'Kode Tindakan', 'trim|required');
        $this->form_validation->set_rules('item', 'Item', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tipe_radiologi/create_action'),
            'id_tipe' => set_value('id_tipe'),
            'item' => set_value('item'),
            'harga' => set_value('harga'),
            'nilai_normal' => set_value('nilai_normal'),
            'id_kategori' => set_value('id_kategori'),
            'kategori' => $this->Tbl_kategori_periksa_lab_radiologi_model->get_all(),
        );
        $this->template->load('template','master_data/tipe_radiologi/tbl_tipe_radiologi_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'item' => $this->input->post('item', TRUE),
                'harga' => $this->input->post('harga',TRUE),
                'nilai_normal' => $this->input->post('nilai_normal',TRUE),
                'id_kategori' => $this->input->post('id_kategori',TRUE),
            );
            $this->Tbl_tipe_radiologi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tipe_radiologi'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_tipe_radiologi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tipe_radiologi/update'),
                'id_tipe' => set_value('id_tipe',$row->id_tipe),
                'item' => set_value('item',$row->item),
                'harga' => set_value('harga',$row->harga),
                'nilai_normal' => set_value('nilai_normal',$row->nilai_normal),
                'id_kategori' => set_value('id_kategori', $row->id_kategori),
                'kategori' => $this->Tbl_kategori_periksa_lab_radiologi_model->get_all(),
            );
            $this->template->load('template','master_data/tipe_radiologi/tbl_tipe_radiologi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tipe_radiologi'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_tipe', TRUE));
        } else {
            $data = array(
                'item' => $this->input->post('item', TRUE),
                'harga' => $this->input->post('harga',TRUE),
                'nilai_normal' => $this->input->post('nilai_normal',TRUE),
            );
            $this->Tbl_tipe_radiologi_model->update($this->input->post('id_tipe', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tipe_radiologi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_tipe_radiologi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_tipe_radiologi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tipe_radiologi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tipe_radiologi'));
        }
    }
}