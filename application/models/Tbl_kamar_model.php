<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_kamar_model extends CI_Model
{
    public $table = 'tbl_kamar';
    public $id = 'id_kamar';
    public $order = 'DESC';

    public function json()
    {
        $this->datatables->select('k.id_kamar, kk.nama, kk.harga, k.no_kamar, (CASE k.status WHEN 1 THEN "Terisi" ELSE "Kosong" END) as status');
        $this->datatables->from("tbl_kamar k");
        $this->datatables->join("tbl_kategori_kamar kk", "kk.id_kategori_kamar = k.id_kategori_kamar");
        $this->datatables->add_column('action', 
                anchor(site_url('kamar/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('kamar/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_kamar');
            
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

    public function get_kamar()
    {
        $this->db->select('k.id_kamar, kk.nama, k.no_kamar, kk.harga');
        $this->db->from('tbl_kamar k');
        $this->db->join('tbl_kategori_kamar kk','kk.id_kategori_kamar = k.id_kategori_kamar');
        $this->db->where('k.status','0');
        return $this->db->get()->result();
        // return $this->db->result();
    }

}