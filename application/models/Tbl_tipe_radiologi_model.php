<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_tipe_radiologi_model extends CI_Model
{
    public $table = 'tbl_tipe_periksa_radiologi';
    public $id = 'id_tipe';
    public $order = 'DESC';

    public function json()
    {
        $this->datatables->select("pr.id_tipe, pr.item, pr.harga, pr.nilai_normal, kr.nama_kategori");
        $this->datatables->from('tbl_tipe_periksa_radiologi pr');
        $this->datatables->join('tbl_kategori_periksa_lab_radiologi kr', 'pr.id_kategori=kr.id_kategori');
        $this->datatables->add_column('action', 
                anchor(site_url('tipe_radiologi/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('tipe_radiologi/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_tipe');
            
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

}