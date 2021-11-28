<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_akun_model extends CI_Model
{

    public $table = 'tbl_akun';
    public $id = 'id_akun';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by('no_akun');
        return $this->db->get($this->table)->result();
    }

    function get_all_beban()
    {   
        $this->db->like('no_akun', '5', 'after');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_all_bank()
    {   
        $this->db->select('id_akun,no_akun,nama_akun');
        $this->db->where('id_main_akun', 20);
        $this->db->like('nama_akun', 'Bank', 'after');
        $this->db->order_by('nama_akun','asc');
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    function json(){
        $this->datatables->select('*, id_akun');
        $this->datatables->from('tbl_akun');
        $this->datatables->add_column('action', anchor(site_url('hrms/akun/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-success btn-sm"')." 
                ".anchor(site_url('hrms/akun/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_akun');
            
        return $this->datatables->generate();
    }
    function getTipe($id){
        $this->db->select_max('no_akun');
        $this->db->from('tbl_akun');
        $this->db->like('no_akun', $id, 'after');
        return $this->db->get()->row();
    }
    function getLevel($id){
        $this->db->select('*');
        $this->db->from('tbl_akun');
        $this->db->where('id_main_akun', $id);
        return $this->db->get()->result();
    }
    function getParent(){
        $this->db->where('level', 0);
        return $this->db->get('tbl_akun')->result();
    }
    function getNoAkun($id){
        $this->db->select('id_main_akun');
        $this->db->select_max('no_akun');
        $this->db->where('id_main_akun', $id);
        return $this->db->get('tbl_akun')->row();
    }
}

/* End of file Tbl_pasien_model.php */
/* Location: ./application/models/Tbl_pasien_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-03 15:02:10 */
/* http://harviacode.com */