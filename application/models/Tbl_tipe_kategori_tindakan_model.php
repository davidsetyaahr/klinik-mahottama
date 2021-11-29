<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_tipe_kategori_tindakan_model extends CI_Model
{
    public $table = 'tbl_kategori_tindakan';
    public $id = 'id_kategori';
    public $order = 'DESC';

    public function json()
    {
        $this->datatables->select("id_kategori, item");
        $this->datatables->from($this->table);
        $this->datatables->add_column('action', 
                anchor(site_url('tipe_kategori_tindakan/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('tipe_kategori_tindakan/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_kategori');
            
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
    // get all data
    function get_all()
    {
        return $this->db->get($this->table)->result();
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