<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_wilayah_model extends CI_Model
{

    public $table = 'tbl_wilayah';
    public $id = 'kode';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function get_all_city()
    {
        $sql = 'SELECT kode,nama FROM tbl_wilayah WHERE CHAR_LENGTH(kode)=5'; 
        
        $sql .= ' ORDER BY nama';
        $result = $this->db->query($sql);
        
        return $result->result();
    }
    
    function get_all_kecamatan()
    {
        $sql = 'SELECT kode,nama FROM tbl_wilayah WHERE CHAR_LENGTH(kode)=8'; 
        
        $sql .= ' ORDER BY nama';
        $result = $this->db->query($sql);
        
        return $result->result();
    }
    
    function get_all_kelurahan(){
        $sql = 'SELECT kode,nama FROM tbl_wilayah WHERE CHAR_LENGTH(kode)=13'; 
        
        $sql .= ' ORDER BY nama';
        $result = $this->db->query($sql);
        
        return $result->result();
    }
    

}

/* End of file Tbl_tindakan_model.php */
/* Location: ./application/models/Tbl_tindakan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-17 18:17:58 */
/* http://harviacode.com */