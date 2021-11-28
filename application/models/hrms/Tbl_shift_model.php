<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_shift_model extends CI_Model
{

    public $table = 'tbl_shift';
    public $id = 'id_shift';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('*, tbl_shift.id_shift');
        $this->datatables->from('tbl_shift');
        $this->datatables->join('tbl_klinik','tbl_klinik.id_klinik=tbl_shift.id_klinik');
        $this->datatables->add_column('action', anchor(site_url('hrms/shift/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('hrms/shift/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_shift');
        return $this->datatables->generate();
    }

    // get all
    function get_all($id_klinik)
    {
        $this->db->where('id_klinik', $id_klinik);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    function get_all_jaga($id_klinik = null)
    {
        // $this->db->order_by($this->id, $this->order);
        $this->db->from('tbl_dokter');
        $this->db->join('tbl_user','tbl_dokter.id_dokter=tbl_user.id_dokter', 'left');
        $this->db->where('is_jaga', 1);
        if($id_klinik != null)
            $this->db->where('tbl_user.id_klinik', $id_klinik);
            
        return $this->db->get()->result();
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

}

/* End of file Tbl_dokter_model.php */
/* Location: ./application/models/Tbl_dokter_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */