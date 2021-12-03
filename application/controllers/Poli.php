<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poli extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_poli_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('item', 'item', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function index()
    {
        $this->template->load('template','master_data/poli/tbl_poli_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_poli_model->json();
    }

    public function create() 
    {
        $data = array(
        'button' => 'Create',
        'action' => site_url('poli/create_action'),
	    'item' => set_value('item'),
	);
        $this->template->load('template','master_data/poli/tbl_poli_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'item' => $this->input->post('item',TRUE),
	    );

            $this->Tbl_poli_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('poli'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_poli_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Create',
                'action' => site_url('poli/create_action'),
	            'item' => set_value('item'),
            );
            $this->template->load('template','master_data/poli/tbl_poli_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('poli'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_poli', TRUE));
        } else {
            $data = array(
                'item' => $this->input->post('item',TRUE),
            );
            $this->Tbl_poli_model->update($this->input->post('id_poli', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('poli'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Tbl_poli_model->get_by_id($id);

        if ($row) {
            $this->Tbl_poli_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('poli'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('poli'));
        }
    }
}