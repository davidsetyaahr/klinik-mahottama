<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_jenis_operasi_model extends CI_Model
{
    public $table = 'tbl_jenis_operasi';
    public $id = 'id_jenis_operasi';
    public $order = 'DESC';

    // get all data
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    public function json()
    {
        $this->datatables->select('id_jenis_operasi, nama_jenis_operasi');
        $this->datatables->from($this->table);
        $this->datatables->add_column('action', 
                anchor(site_url('jenis_operasi/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('jenis_operasi/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_jenis_operasi');
            
        return $this->datatables->generate();
    }
    public function insert($data)
    {
        $this->db->insert($this->table,$data);
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    function getBiayaOperasi()
    {
        $this->db->select('tbl_biaya_jenis_operasi.*,tbl_jenis_operasi.nama_jenis_operasi, tbl_biaya.biaya, tbl_biaya.nama_biaya');
        $this->db->from('tbl_biaya_jenis_operasi');
        $this->db->join('tbl_jenis_operasi', 'tbl_jenis_operasi.id_jenis_operasi = tbl_biaya_jenis_operasi.id_jenis_operasi');
        $this->db->join('tbl_biaya', 'tbl_biaya.id_biaya = tbl_biaya_jenis_operasi.id_biaya');
        // $this->db->group_by('tbl_biaya_jenis_operasi.id_jenis_operasi');
        return $this->db->get()->result();
    }

}