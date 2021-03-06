<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Biaya extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->model('Tbl_biaya_model');
        $this->load->model('Tbl_kategori_biaya_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/biaya/biaya_list');
    }
    public function json() {
        $biaya = $this->Tbl_biaya_model->getBiaya();
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count((array)$biaya),
            "recordsFiltered" => count((array)$biaya),
            "data" => $biaya,
        );
        header('Content-Type: application/json');
        echo json_encode($output);
    }
    public function _rules() 
    {
        // $this->form_validation->set_rules('kode_tindakan', 'Kode Tindakan', 'trim|required');
        $this->form_validation->set_rules('id_kategori_biaya', 'id kategori biaya', 'trim|required');
        $this->form_validation->set_rules('nama_biaya', 'nama biaya', 'trim|required');
        $this->form_validation->set_rules('biaya', 'Biaya', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('biaya/create_action'),
            'id_biaya' => set_value('id_biaya'),
            'id_kategori_biaya' => set_value('id_kategori_biaya'),
            'nama_biaya' => set_value('nama_biaya'),
            'tipe_biaya' => set_value('tipe_biaya')=='' ? 1 : set_value('tipe_biaya'),
            'presentase' => set_value('presentase'),
            'id_biaya_presentase' => set_value('id_biaya_presentase'),
            'biaya' => set_value('biaya'),
            'is_id_dokter' => set_value('is_id_dokter'),
            'item' => $this->Tbl_kategori_biaya_model->get_all(),
            'biayaFix' => $this->Tbl_biaya_model->getBiaya(),
        );
        $this->db->select('nama_dokter,id_dokter');
        $data['dokter'] = $this->db->get('tbl_dokter')->result();
       $this->template->load('template','master_data/biaya/tbl_biaya_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kategori_biaya' => $this->input->post('id_kategori_biaya', TRUE),
                'nama_biaya' => $this->input->post('nama_biaya', TRUE),
                'tipe_biaya' => $this->input->post('tipe_biaya', TRUE),
                'is_id_dokter' => $this->input->post('is_id_dokter', TRUE),
            );
            if($data['tipe_biaya']=='1'){
                $data['biaya'] = $this->input->post('biaya', TRUE);
            }
            else{
                $data['presentase'] = $this->input->post('persentase', TRUE);
                $data['id_biaya_presentase'] = $this->input->post('id_biaya_persentase', TRUE);
            }
            $this->Tbl_biaya_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('biaya'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_biaya_model->getBiaya($not=null,['id_biaya' => $id]);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('biaya/update'),
                'id_biaya' => set_value('id_biaya',$row[0]->id_biaya),
                'id_kategori_biaya' => set_value('id_kategori_biaya',$row[0]->id_kategori_biaya),
                'tipe_biaya' => set_value('tipe_biaya',$row[0]->tipe_biaya),
                'presentase' => set_value('presentase',$row[0]->presentase),
                'id_biaya_presentase' => set_value('id_biaya_presentase',$row[0]->id_biaya_presentase),
                'nama_biaya' => set_value('nama_biaya',$row[0]->nama_biaya),
                'biaya' => set_value('biaya',$row[0]->biaya),
                'is_id_dokter' => set_value('is_id_dokter',$row[0]->is_id_dokter),
                'item' => $this->Tbl_kategori_biaya_model->get_all(),
                'biayaFix' => $this->Tbl_biaya_model->getBiaya($not=$id)
            );
            $this->db->select('nama_dokter,id_dokter');
            $data['dokter'] = $this->db->get('tbl_dokter')->result();
            $this->template->load('template','master_data/biaya/tbl_biaya_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('biaya'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_biaya', TRUE));
        } else {
            $data = array(
                'id_kategori_biaya' => $this->input->post('id_kategori_biaya', TRUE),
                'nama_biaya' => $this->input->post('nama_biaya', TRUE),
                'tipe_biaya' => $this->input->post('tipe_biaya', TRUE),
                'is_id_dokter' => $this->input->post('is_id_dokter', TRUE),
            );
            if($data['tipe_biaya']=='1'){
                $data['biaya'] = $this->input->post('biaya', TRUE);
                $data['presentase'] = null;
                $data['id_biaya_presentase'] = null;
            }
            else{
                $data['biaya'] = 0;
                $data['presentase'] = $this->input->post('persentase', TRUE);
                $data['id_biaya_presentase'] = $this->input->post('id_biaya_persentase', TRUE);
            }

            $this->Tbl_biaya_model->update($this->input->post('id_biaya', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('biaya'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_biaya_model->get_by_id($id);

        if ($row) {
            $this->Tbl_biaya_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('biaya'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('biaya'));
        }
    }
}