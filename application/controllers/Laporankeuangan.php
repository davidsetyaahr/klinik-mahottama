<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporankeuangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Transaksi_model');
        $this->load->model('Periksa_model');
        $this->load->model('Tbl_obat_alkes_bhp_model');
        $this->load->model('Tbl_tindakan_model');
        $this->load->model('Tbl_biaya_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->_rules();
        // $this->data['rekap_laporan'] = $this->input->post('rekap_laporan') != null ? $this->input->post('rekap_laporan') : '';
        $this->data['option_tahun'] = array();
		for($i = 2015;$i <= (int)date('Y');$i++){
			$this->data['option_tahun'][$i] = $i;
		}
        
        if ($this->form_validation->run() == TRUE) {
            $this->data['rekap_laporan'] = $this->input->post('rekap_laporan');
            $this->data['filter_tanggal'] =  $this->input->post('tanggal');
            $this->data['filter_bulan'] =  $this->input->post('bulan');
            $this->data['filter_tahun'] =  $this->input->post('tahun');
            $this->data['id_klinik'] = $this->input->post('id_klinik');
            $this->data['filters'] = '';
        } else {
            $this->data['rekap_laporan'] = set_value('rekap_laporan');
            $this->data['filter_tanggal'] =  set_value('tanggal');
            $this->data['filter_bulan'] =  set_value('bulan');$this->input->post('bulan');
            $this->data['filter_tahun'] =  set_value('tahun');;
            $this->data['id_klinik'] = set_value('id_klinik');;
            $this->data['filters'] = '';
        }
        $this->template->load('template','laporankeuangan/laporan_keuangan_list', $this->data);
    } 
    public function biaya_obat(){
        // $this->_rules();
        // $this->data['option_tahun'] = array();
        // for($i = 2015;$i <= (int)date('Y');$i++){
        //     $this->data['option_tahun'][$i] = $i;
        // }
        
        // if ($this->form_validation->run() == TRUE) {
        //     $this->data['rekap_laporan'] = $this->input->post('rekap_laporan');
        //     $this->data['filter_tanggal'] =  $this->input->post('tanggal');
        //     $this->data['filter_bulan'] =  $this->input->post('bulan');
        //     $this->data['filter_tahun'] =  $this->input->post('tahun');
        //     $this->data['id_klinik'] = $this->input->post('id_klinik');
        //     $this->data['filters'] = '';
        // } else {
        //     $this->data['rekap_laporan'] = set_value('rekap_laporan');
        //     $this->data['filter_tanggal'] =  set_value('tanggal');
        //     $this->data['filter_bulan'] =  set_value('bulan');$this->input->post('bulan');
        //     $this->data['filter_tahun'] =  set_value('tahun');;
        //     $this->data['id_klinik'] = set_value('id_klinik');;
        //     $this->data['filters'] = '';
        // }
        // $this->template->load('template','laporankeuangan/laporan_biaya_obat', $this->data);
        $data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat();
        // var_dump($data['obat']);
        $this->template->load('template','laporankeuangan/laporan_biaya_obat', $data);
    }

    public function biaya_alkes(){
        $data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_alkes1();
        $this->template->load('template','laporankeuangan/laporan_biaya_alkes', $data);
    }

    public function biaya_tindakan(){
        // $this->_rules();
        // $this->data['option_tahun'] = array();
        // for($i = 2015;$i <= (int)date('Y');$i++){
        //     $this->data['option_tahun'][$i] = $i;
        // }
        
        // if ($this->form_validation->run() == TRUE) {
        //     $this->data['rekap_laporan'] = $this->input->post('rekap_laporan');
        //     $this->data['filter_tanggal'] =  $this->input->post('tanggal');
        //     $this->data['filter_bulan'] =  $this->input->post('bulan');
        //     $this->data['filter_tahun'] =  $this->input->post('tahun');
        //     $this->data['id_klinik'] = $this->input->post('id_klinik');
            // $this->data['filters'] = '';
        // } else {
        //     $this->data['rekap_laporan'] = set_value('rekap_laporan');
        //     $this->data['filter_tanggal'] =  set_value('tanggal');
        //     $this->data['filter_bulan'] =  set_value('bulan');$this->input->post('bulan');
        //     $this->data['filter_tahun'] =  set_value('tahun');;
        //     $this->data['filters'] = '';
        //     $this->data['id_klinik'] = set_value('id_klinik');;
        // }
        $data['tindakan'] = $this->Tbl_tindakan_model->get_all();
        $this->template->load('template','laporankeuangan/laporan_biaya_tindakan', $data);
    }

    public function biaya_lainnya(){
        $data['biaya'] = $this->Tbl_biaya_model->get_all();

        $this->db->select('nama_dokter,id_dokter');
        $data['dokter'] = $this->db->get('tbl_dokter')->result();
        $this->template->load('template','laporankeuangan/laporan_biaya_lainnya', $data);
    }

    public function biaya_pemeriksaan(){
        // $this->_rules();
        // $this->data['option_tahun'] = array();
        // for($i = 2015;$i <= (int)date('Y');$i++){
        //     $this->data['option_tahun'][$i] = $i;
        // }
        
        // if ($this->form_validation->run() == TRUE) {
        //     $this->data['rekap_laporan'] = $this->input->post('rekap_laporan');
        //     $this->data['filter_tanggal'] =  $this->input->post('tanggal');
        //     $this->data['filter_bulan'] =  $this->input->post('bulan');
        //     $this->data['filter_tahun'] =  $this->input->post('tahun');
        //     $this->data['id_klinik'] = $this->input->post('id_klinik');
        //     $this->data['filters'] = '';
        // } else {
        //     $this->data['rekap_laporan'] = set_value('rekap_laporan');
        //     $this->data['filter_tanggal'] =  set_value('tanggal');
        //     $this->data['filter_bulan'] =  set_value('bulan');$this->input->post('bulan');
        //     $this->data['filter_tahun'] =  set_value('tahun');;
        //     $this->data['id_klinik'] = set_value('id_klinik');;
        //     $this->data['filters'] = '';
        // }
        $this->template->load('template','laporankeuangan/laporan_biaya_pemeriksaan');
    }

    public function biaya_poli(){
        $this->template->load('template','laporankeuangan/laporan_biaya_poli');
    }

    public function biaya_ugd(){
        $this->template->load('template','laporankeuangan/laporan_biaya_ugd');
    }

    public function biaya_rawat_inap(){
        $this->template->load('template','laporankeuangan/laporan_biaya_rawat_inap');
    }

    public function biaya_operasi(){
        $this->template->load('template','laporankeuangan/laporan_biaya_operasi');
    }

    public function biaya_lab(){
        $this->template->load('template','laporankeuangan/laporan_biaya_lab');
    }

    public function biaya_radiologi(){
        $this->template->load('template','laporankeuangan/laporan_biaya_radiologi');
    }
    
    public function json($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_keuangan($filter);
    }

    public function json_biaya_obat($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_biaya_obat($filter);
    }
    public function json_biaya_tindakan($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_biaya_tindakan($filter);
    }

    public function json_laporan_pemeriksaan($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_pemeriksaan($filter);
    }
    
    public function json_pemeriksaan_detail() {
        header('Content-Type: application/json');
        echo json_encode($this->Transaksi_model->json_detail_periksa($_GET['no_transaksi']));
    }

    // public function json_laporan_obat($filter = null, $dprks='Biaya Obat') {
    //     header('Content-Type: application/json');
    //     echo $this->Transaksi_model->json_laporan_biaya($filter, $dprks);
    // }

    public function json_laporan_obat($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_obat($filter);
    }

    public function json_laporan_alkes($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_alkes($filter);
    }

    public function json_laporan_tindakan($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_tindakan($filter);
    }

    public function json_laporan_biaya($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_biaya($filter);
    }

    public function json_detail_tindakan() {
        header('Content-Type: application/json');
        echo json_encode($this->Transaksi_model->json_detail_tindakan($_GET['no_pendaftaran']));
    }

    public function json_detail_obat() {
        header('Content-Type: application/json');
        echo json_encode($this->Transaksi_model->json_detail_obat($_GET['no_periksa']));
    }

    public function json_detail_periksa() {
        header('Content-Type: application/json');
        echo json_encode($this->Transaksi_model->json_detail_periksa($_GET['no_transaksi']));
    }
    

    public function json_biaya_pemeriksaan($filter = null) {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_biaya_pemeriksaan($filter);
    }

    public function json_biaya_poli($filter = null, $tiprks = '1') {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_keuangan($filter, $tiprks);
    }

        public function json_biaya_ugd($filter = null, $tiprks = '6') {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_keuangan($filter, $tiprks);
    }

        public function json_detail_ugd(){
        header('Content-Type: application/json');
        echo json_encode($this->Transaksi_model->json_detail_periksa($_GET['no_transaksi']));
    }

    public function json_detail_poli(){
        header('Content-Type: application/json');
        echo json_encode($this->Transaksi_model->json_detail_periksa($_GET['no_transaksi']));
    }

    public function json_detail_rawat_inap(){
        header('Content-Type: application/json');
        echo json_encode($this->Transaksi_model->json_detail_periksa($_GET['no_transaksi']));
    }

    public function json_biaya_rawat_inap($filter = null, $tiprks = '2') {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_keuangan($filter, $tiprks);
    }

    public function json_biaya_operasi($filter = null, $tiprks = '3') {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_keuangan($filter, $tiprks);
    }

    public function json_biaya_lab($filter = null, $tiprks = '4') {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_keuangan($filter, $tiprks);
    }

    public function json_biaya_radiologi($filter = null, $tiprks = '5') {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_laporan_keuangan($filter, $tiprks);
    }
    
    public function _rules() 
    {
        $this->form_validation->set_rules('id_klinik', 'Klinik', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    public function excel($filter = null)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-".$filter."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Klinik");
    	xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Debit");
    	xlsWriteLabel($tablehead, $kolomhead++, "Credit");

	    foreach ($this->Transaksi_model->get_laporan_keuangan($filter) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->klinik);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->amount_transaksi);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->debit);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->credit);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_poli($filter = null, $tiprks = '1')
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-poli"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Pendaftaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");

	    foreach ($this->Transaksi_model->ambil_laporan_keuangan($filter, $tiprks) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pendaftaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    
    public function excel_rawat_inap($filter = null, $tiprks = '2')
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-rawat-inap"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Pendaftaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");

	    foreach ($this->Transaksi_model->ambil_laporan_keuangan($filter, $tiprks) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pendaftaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_operasi($filter = null, $tiprks = '3')
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-operasi"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Pendaftaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");

	    foreach ($this->Transaksi_model->ambil_laporan_keuangan($filter, $tiprks) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pendaftaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_lab($filter = null, $tiprks = '4')
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-laboratorium"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Pendaftaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");

	    foreach ($this->Transaksi_model->ambil_laporan_keuangan($filter, $tiprks) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pendaftaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_rad($filter = null, $tiprks = '5')
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-radiologi"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Pendaftaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");

	    foreach ($this->Transaksi_model->ambil_laporan_keuangan($filter, $tiprks) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pendaftaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

        public function excel_ugd($filter = null, $tiprks = '6')
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-ugd"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Pendaftaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");

	    foreach ($this->Transaksi_model->ambil_laporan_keuangan($filter, $tiprks) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pendaftaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_biaya_obat($filter = null)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-obat"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Periksa");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Obat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
    	xlsWriteLabel($tablehead, $kolomhead++, "Total");

	    foreach ($this->Transaksi_model->json_laporan_obat($filter, $export=true) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_periksa);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_satuan);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_biaya_alkes($filter = null)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-bmhp"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Periksa");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Obat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
    	xlsWriteLabel($tablehead, $kolomhead++, "Total");

	    foreach ($this->Transaksi_model->json_laporan_alkes($filter, $export=true) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_periksa);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_satuan);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_biaya_lainnya($filter = null)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-biaya"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Periksa");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Biaya");
    	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
    	xlsWriteLabel($tablehead, $kolomhead++, "Total");

	    foreach ($this->Transaksi_model->json_laporan_biaya($filter, $export=true) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_periksa);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_biaya);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->biaya);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_biaya_pemeriksaan($filter = null)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-pemeriksaan"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Pendaftaran");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Transaksi");

	    foreach ($this->Transaksi_model->ambil_laporan_pemeriksaan($filter) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pendaftaran);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->amount_transaksi);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel_biaya_tindakan($filter = null)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_keuangan-tindakan"."-".date('Ymd').".xls";
        $judul = "laporan_keuangan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "No Periksa");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasien");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Tindakan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
    	xlsWriteLabel($tablehead, $kolomhead++, "Total");

	    foreach ($this->Transaksi_model->json_laporan_tindakan($filter, $export=true) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->no_periksa);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->tindakan);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->biaya);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->ttl);
    	    
    
    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}