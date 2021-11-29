<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_poli_model extends CI_Model
{
    public $table = 'tbl_poli';
    public $id = 'id_layanan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // get all data
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        return $this->db->get_where($this->table,[$this->id => $id])->row();
    }

    function json(){
        $this->datatables->select('id_layanan, item');
        $this->datatables->from('tbl_poli');
        $this->datatables->add_column('action', anchor(site_url('poli/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('poli/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_layanan');
        return $this->datatables->generate();
    }
}