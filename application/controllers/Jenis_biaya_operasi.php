<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_biaya_operasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('datatables');
        $this->load->model('Tbl_jenis_operasi_model');
        $this->load->model('Tbl_biaya_jenis_operasi_model');
        $this->load->model('Tbl_biaya_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/operasi/jenis_biaya_operasi_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_biaya_jenis_operasi_model->json();
    }
    public function _rules() 
    {
        $this->form_validation->set_rules('id_jenis_operasi', 'id_jenis_operasi', 'trim|required');
        $this->form_validation->set_rules('id_biaya', 'id_biaya', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_biaya_operasi/create_action'),
            'id' => set_value('id'),
            'id_jenis_operasi' => set_value('id_jenis_operasi'),
            'id_biaya' => set_value('id_biaya'),
            'jenis' => $this->Tbl_jenis_operasi_model->get_all(),
            'biaya' => $this->Tbl_biaya_model->get_all(),
        );
        $this->template->load('template','master_data/operasi/tbl_jenis_biaya_operasi_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_jenis_operasi' => $this->input->post('id_jenis_operasi',TRUE),
                'id_biaya' => $this->input->post('id_biaya',TRUE),
            );
            // foreach ($_POST['id_jenis_operasi'] as $key => $value) {
            //     $data = array(
            //         'id_jenis_operasi' => $_POST['id_jenis_operasi'][$key],
            //         'id_biaya' => $_POST['id_biaya'][$key],
            //     );

            //     $this->Tbl_biaya_jenis_operasi_model->insert($data);
            // }
            $this->Tbl_biaya_jenis_operasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Jenis_biaya_operasi'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_biaya_jenis_operasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_biaya_operasi/update'),
                'id' => set_value('id',$row->id),
                'id_jenis_operasi' => set_value('id_jenis_operasi',$row->id_jenis_operasi),
                'id_biaya' => set_value('id_biaya',$row->id_biaya),
                'jenis' => $this->Tbl_jenis_operasi_model->get_all(),
                'biaya' => $this->Tbl_biaya_model->get_all(),
            );
            $this->template->load('template','master_data/operasi/tbl_jenis_biaya_operasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Jenis_biaya_operasi'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_jenis_operasi' => $this->input->post('id_jenis_operasi',TRUE),
                'id_biaya' => $this->input->post('id_biaya',TRUE),
            );
            $this->Tbl_biaya_jenis_operasi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Jenis_biaya_operasi'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Tbl_biaya_jenis_operasi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_biaya_jenis_operasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Jenis_biaya_operasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Jenis_biaya_operasi'));
        }
    }
}