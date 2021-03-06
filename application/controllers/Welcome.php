<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        //$this->load->view('table');
        $this->data['count_dokter'] = $this->get_count_dokter();
        $this->data['count_pasien'] = $this->get_count_pasien();
        $this->data['count_users'] = $this->get_count_user();
        $this->data['count_levels'] = $this->get_count_level();;
        $this->template->load('template', 'dashboard',$this->data);
    }
    
    function get_count_pasien(){
        $this->db->select('COUNT(*) as total');
        $data = $this->db->get('tbl_pasien')->row();
        return $data->total;
    }
    
    function get_count_dokter(){
        $this->db->select('COUNT(*) as total');
        $data = $this->db->get('tbl_dokter')->row();
        return $data->total;
    }
    
    function get_count_user(){
        $this->db->select('COUNT(*) as total');
        $data = $this->db->get('tbl_user')->row();
        return $data->total;
    }
    
    function get_count_level(){
        $this->db->select('COUNT(*) as total');
        $data = $this->db->get('tbl_user_level')->row();
        return $data->total;
    }

    public function form() {
        //$this->load->view('table');
        $this->template->load('template', 'form');
    }

    function autocomplate() {
        $this->db->like('nama_lengkap', $_GET['term']);
        $this->db->select('nama_lengkap');
        $products = $this->db->get('pegawai')->result();
        foreach ($products as $product) {
            $return_arr[] = $product->nama_lengkap;
        }

        echo json_encode($return_arr);
    }

    function pdf() {
        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK', 0, 1, 'C');
        $pdf->Output();
    }
    
    function barcode(){
        $this->load->library('barcode');
    }

}
