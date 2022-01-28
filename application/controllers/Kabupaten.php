<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Kabupaten extends CI_Controller
    {
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->library('form_validation'); 
        $this->load->model('Tbl_kabupaten_model');       
    }
    public function index()
    {
        $this->template->load('template','master_data/kabupaten/kabupaten_list');
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_kabupaten_model->json();
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kabupaten/create_action'),
            'id' => set_value('id'),
            'kabupaten' => set_value('kabupaten'),
        );
        $this->template->load('template','master_data/kabupaten/tbl_kabupaten_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kabupaten' => $this->input->post('kabupaten',TRUE),
            );
            $this->Tbl_kabupaten_model->insert($data);
            if(isset($_POST['ajax'])){
                $this->db->select("max(id) id");
                $get = $this->db->get('tbl_kabupaten')->row();
                echo $get->id;
            }
            else{
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kabupaten'));
            }
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_kabupaten_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kabupaten/update'),
                'id' => set_value('id',$row->id),
                'kabupaten' => set_value('kabupaten',$row->kabupaten),
            );
            $this->template->load('template','master_data/kabupaten/tbl_kabupaten_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kabupaten' => $this->input->post('kabupaten', TRUE),
            );
            $this->Tbl_kabupaten_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_kabupaten_model->get_by_id($id);

        if ($row) {
            $this->Tbl_kabupaten_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kabupaten'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    function addKab(){
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kabupaten' => $this->input->post('kabupaten',TRUE),
            );
            $this->Tbl_kabupaten_model->insert($data);
            echo json_encode(array(
                "statusCode"=>200,
                'Kabupaten' => $data
            ));
        }
    }

}