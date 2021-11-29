<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_kategori_biaya_model extends CI_Model
{
    public $table = 'tbl_kategori_biaya';
    public $id = 'id_kategori_biaya';
    public $order = 'DESC';

    // get all data
    function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function json()
    {
        $this->datatables->select("id_kategori_biaya, item");
        $this->datatables->from($this->table);
        $this->datatables->add_column('action', 
                anchor(site_url('kategori_biaya/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('kategori_biaya/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_kategori_biaya');
            
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