<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('hrms/Tbl_jabatan_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','hrms/master_jabatan/tbl_jabatan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_jabatan_model->json();
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/jabatan/create_action'),
            'id_jabatan' => set_value('id_jabatan'),
            'nama_jabatan' => set_value('nama_jabatan'),
    );
        $this->template->load('template','hrms/master_jabatan/tbl_jabatan_create', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
            'dtm_crt' => date("Y-m-d H:i:s",  time()),
            'dtm_upd' => date("Y-m-d H:i:s",  time()),
        );

            $this->Tbl_jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('hrms/jabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hrms/jabatan/update_action'),
                'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
                'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
        );
            $this->template->load('template','hrms/master_jabatan/tbl_jabatan_create', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jabatan', TRUE));
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
        );

            $this->Tbl_jabatan_model->update($this->input->post('id_jabatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hrms/jabatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_jabatan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/jabatan'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_jabatan', 'id jabatan', 'trim');
        $this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'trim|required');
    }
    
    

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_dokter.xls";
        $judul = "tbl_dokter";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Dokter");
    xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
    xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
    xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
    xlsWriteLabel($tablehead, $kolomhead++, "Id Agama");
    xlsWriteLabel($tablehead, $kolomhead++, "Alamat Tinggal");
    xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
    xlsWriteLabel($tablehead, $kolomhead++, "Id Status Menikah");
    xlsWriteLabel($tablehead, $kolomhead++, "Id Spesialis");
    xlsWriteLabel($tablehead, $kolomhead++, "No Izin Praktek");
    xlsWriteLabel($tablehead, $kolomhead++, "Golongan Darah");
    xlsWriteLabel($tablehead, $kolomhead++, "Alumni");

    foreach ($this->Tbl_jabatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_dokter);
        xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
        xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
        xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
        xlsWriteNumber($tablebody, $kolombody++, $data->id_agama);
        xlsWriteLabel($tablebody, $kolombody++, $data->alamat_tinggal);
        xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
        xlsWriteNumber($tablebody, $kolombody++, $data->id_status_menikah);
        xlsWriteNumber($tablebody, $kolombody++, $data->id_spesialis);
        xlsWriteLabel($tablebody, $kolombody++, $data->no_izin_praktek);
        xlsWriteLabel($tablebody, $kolombody++, $data->golongan_darah);
        xlsWriteLabel($tablebody, $kolombody++, $data->alumni);

        $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_dokter.doc");

        $data = array(
            'tbl_dokter_data' => $this->Tbl_jabatan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('dokter/tbl_dokter_doc',$data);
    }
    
    function autocomplate(){
        autocomplate_json('tbl_dokter', 'nama_dokter');
    }

}

/* End of file Dokter.php */
/* Location: ./application/controllers/Dokter.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */