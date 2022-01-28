<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_desa_model extends CI_Model
{
    public $table = 'tbl_desa';
    public $id = 'id';
    public $order = 'DESC';

    function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function json()
    {
        $this->datatables->select("des.id, des.desa, kab.kabupaten, kec.kecamatan, prov.provinsi");
        $this->datatables->from("tbl_desa des");
        $this->datatables->join("tbl_kecamatan kec", "kec.id = des.id_kecamatan");
        $this->datatables->join("tbl_kabupaten kab", "kab.id = kec.id_kabupaten");
        $this->datatables->join("tbl_provinsi prov", "prov.id = kab.id_provinsi");
        $this->datatables->add_column('action', 
                anchor(site_url('desa/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('desa/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
            
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