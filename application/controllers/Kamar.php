    <?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Kamar extends CI_Controller
    {
    function __construct()
    {
        parent::__construct();
        is_login();
	    $this->load->library('datatables');
        $this->load->model('Tbl_kamar_model');
        $this->load->model('Tbl_kategori_kamar_model');
        $this->load->library('form_validation');        
    }
    public function index()
    {
        $this->template->load('template','master_data/kamar/kamar_list');
    }
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_kamar_model->json();
    }
    public function _rules() 
    {
        // $this->form_validation->set_rules('kode_tindakan', 'Kode Tindakan', 'trim|required');
        $this->form_validation->set_rules('id_kategori_kamar', 'id_kategori_kamar', 'trim|required');
        $this->form_validation->set_rules('no_kamar', 'no_kamar', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kamar/create_action'),
            'id_kamar' => set_value('id_kamar'),
            'id_kategori_kamar' => set_value('id_kategori_kamar'),
            'no_kamar' => set_value('no_kamar'),
            'status' => set_value('0'),
            'item' => $this->Tbl_kategori_kamar_model->get_all()
        );
        $this->template->load('template','master_data/kamar/tbl_kamar_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kategori_kamar' => $this->input->post('id_kategori_kamar', TRUE),
                'no_kamar' => $this->input->post('no_kamar',TRUE),
                'status' => $this->input->post('0',TRUE),
            );
            $this->Tbl_kamar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kamar'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tbl_kamar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kamar/update'),
                'id_kamar' => set_value('id_kamar',$row->id_kamar),
                'id_kategori_kamar' => set_value('id_kategori_kamar',$row->id_kategori_kamar),
                'no_kamar' => set_value('no_kamar',$row->no_kamar),
                'status' => set_value('status',$row->status),
                'item' => $this->Tbl_kategori_kamar_model->get_all()
            );
            $this->template->load('template','master_data/kamar/tbl_kamar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
        }
    }

    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_kamar', TRUE));
        } else {
            $data = array(
                'id_kategori_kamar' => $this->input->post('id_kategori_kamar', TRUE),
                'no_kamar' => $this->input->post('no_kamar',TRUE),
                'status' => $this->input->post('status',TRUE),
            );
            $this->Tbl_kamar_model->update($this->input->post('id_kamar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kamar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_kamar_model->get_by_id($id);

        if ($row) {
            $this->Tbl_kamar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kamar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
        }
    }
}