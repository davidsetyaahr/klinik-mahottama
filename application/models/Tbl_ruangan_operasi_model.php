<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_ruangan_operasi_model extends CI_Model
{
    public $table = 'tbl_ruangan_operasi';
    public $id = 'id';
    public $order = 'DESC';


    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    public function json()
    {
        $this->datatables->select('id,nama, (case when status = "1" then "Terisi" else "Kosong" end) as status');
        $this->datatables->from('tbl_ruangan_operasi');
        $this->datatables->add_column('action', 
                anchor(site_url('ruangan_operasi/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('ruangan_operasi/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id'); 
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