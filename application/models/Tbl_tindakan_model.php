<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_tindakan_model extends CI_Model
{
    public $table = 'tbl_tindakan';
    public $id = 'kode_tindakan';
    public $order = 'DESC';


    function get_all()
    {
        return $this->db->get('tbl_tindakan')->result();
    }


    public function json()
    {
        $this->datatables->select("ti.kode_tindakan,ti.tindakan,ti.biaya,tk.item");
        $this->datatables->from("tbl_tindakan ti");
        $this->datatables->join("tbl_kategori_tindakan tk", "ti.id_kategori = tk.id_kategori");
        $this->datatables->add_column('action', 
                anchor(site_url('tindakan/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('tindakan/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_tindakan');
            
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