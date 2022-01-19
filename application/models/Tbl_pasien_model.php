<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pasien_model extends CI_Model
{

    public $table = 'tbl_pasien';
    public $id = 'no_rekam_medis';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function cekkodepasien(){
        $query = $this->db->query("SELECT MAX(no_rekam_medis) as nrm from tbl_pasien");
        $hasil = $query->row();
        return $hasil->nrm;
    }


    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    function json(){
        $this->datatables->select('nik,no_rekam_medis,no_id_pasien,nama_lengkap,golongan_darah,status_menikah,pekerjaan,alamat,kabupaten,nama_orang_tua_atau_istri,nomer_telepon,riwayat_alergi_obat');
        $this->datatables->from('tbl_pasien');
        $this->datatables->add_column('action', anchor(site_url('pasien/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-success btn-sm"')." 
                ".anchor(site_url('pasien/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'no_rekam_medis');
            
        return $this->datatables->generate();
    }
    function lastNoId(){
        $this->db->select('no_id_pasien');
        $this->db->from('tbl_pasien');
        $this->db->order_by('no_id_pasien','desc');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

    function get_pendaftaran($id){
        $this->db->select('*');
        $this->db->from('tbl_pasien pa');
        // $this->db->join('tbl_pendaftaran pe','pe.no_rekam_medis = pa.no_rekam_medis','left');
        $this->db->where('pa.no_rekam_medis', $id);
        return $this->db->get()->row();
    }

    function get_status($id){
        $this->db->select('*');
        $this->db->from('tbl_pendaftaran');
        // $this->db->join('tbl_pendaftaran pe','pe.no_rekam_medis = pa.no_rekam_medis','left');
        $this->db->where('no_pendaftaran', $id);
        return $this->db->get()->row();
    }
}

/* End of file Tbl_pasien_model.php */
/* Location: ./application/models/Tbl_pasien_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-03 15:02:10 */
/* http://harviacode.com */