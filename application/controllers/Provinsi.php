<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Provinsi extends CI_Controller
    {
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->library('form_validation'); 
        $this->load->model('Tbl_provinsi_model');       
    }
    public function index()
    {
        $this->template->load('template','master_data/provinsi/provinsi_list');
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_provinsi_model->json();
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('provinsi/create_action'),
            'id' => set_value('id'),
            'provinsi' => set_value('provinsi'),
        );
        $this->template->load('template','master_data/provinsi/tbl_provinsi_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'provinsi' => $this->input->post('provinsi',TRUE),
            );
            $this->Tbl_provinsi_model->insert($data);
            if(isset($_POST['ajax'])){
                $this->db->select("max(id) id");
                $get = $this->db->get('tbl_provinsi')->row();
                echo $get->id;
            }
            else{
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('provinsi'));
            }
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_provinsi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('provinsi/update'),
                'id' => set_value('id',$row->id),
                'provinsi' => set_value('provinsi',$row->provinsi),
            );
            $this->template->load('template','master_data/provinsi/tbl_provinsi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('provinsi'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'provinsi' => $this->input->post('provinsi', TRUE),
            );
            $this->Tbl_provinsi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('provinsi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_provinsi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_provinsi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('provinsi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('provinsi'));
        }
    }

}