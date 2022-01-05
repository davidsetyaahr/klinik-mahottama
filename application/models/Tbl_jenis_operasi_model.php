<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_jenis_operasi_model extends CI_Model
{
    public $table = 'tbl_jenis_operasi';
    public $id = 'id_jenis_operasi';
    public $order = 'DESC';

    // get all data
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    public function json()
    {
        $this->datatables->select('id_jenis_operasi, nama_jenis_operasi');
        $this->datatables->from($this->table);
        $this->datatables->add_column('action', 
                anchor(site_url('jenis_operasi/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('jenis_operasi/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_jenis_operasi');
            
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
    
    function getBiayaOperasi()
    {
        $this->db->select('tbl_biaya_jenis_operasi.id,tbl_jenis_operasi.nama_jenis_operasi, tbl_biaya.biaya, tbl_biaya.nama_biaya');
        $this->db->from('tbl_biaya_jenis_operasi');
        $this->db->join('tbl_jenis_operasi', 'tbl_jenis_operasi.id_jenis_operasi = tbl_biaya_jenis_operasi.id_jenis_operasi');
        $this->db->join('tbl_biaya', 'tbl_biaya.id_biaya = tbl_biaya_jenis_operasi.id_biaya');
        return $this->db->get()->result();
    }

    function getIdOperasi($j_id)
    {
        $this->db->select("b.nama_biaya, b.tipe_biaya, b.id_biaya_presentase, b.presentase, case when b.tipe_biaya = '1' then b.biaya else b.presentase / 100 * (select biaya from tbl_biaya where id_biaya = b.id_biaya_presentase) end as biaya");
        $this->db->from('tbl_biaya_jenis_operasi bj');
        $this->db->join('tbl_jenis_operasi jo', 'jo.id_jenis_operasi = bj.id_jenis_operasi');
        $this->db->join('tbl_biaya b', 'b.id_biaya = bj.id_biaya');
        $this->db->where('bj.id_jenis_operasi', $j_id);
        $sql = $this->db->get()->result();
        foreach ($sql as $key => $value) {
            if($value->tipe_biaya=='2' && $value->biaya==0){ //cek row 1
                $get = $this->db->get_where('tbl_biaya',['id_biaya' => $value->id_biaya_presentase])->row();
                if($get->tipe_biaya=='2'){
                    $this->db->select('biaya');
                    $get2 = $this->db->get_where('tbl_biaya',['id_biaya' => $get->id_biaya_presentase])->row();
                    $biaya = $get->presentase / 100 * $get2->biaya;
                    $value->biaya = $value->presentase / 100 * $biaya;
                }
                else{
                    $value->biaya = $get->biaya;
                }
            }
        }
        return $sql;
    }

    function maxId(){
        $this->db->select('MAX(id) lastId');
        $this->db->from('tbl_biaya_jenis_operasi');
        return $this->db->get()->row();
    }

    public function jsonBiayaOpr()
    {
        $this->datatables->select('tbl_biaya_jenis_operasi.*, tbl_biaya.biaya, tbl_biaya.nama_biaya, tbl_jenis_operasi.nama_jenis_operasi');
        $this->datatables->from('tbl_biaya_jenis_operasi');
        $this->datatables->join('tbl_biaya', 'tbl_biaya.id_biaya = tbl_biaya_jenis_operasi.id_biaya');
        $this->datatables->join('tbl_jenis_operasi', 'tbl_jenis_operasi.id_jenis_operasi = tbl_biaya_jenis_operasi.id_jenis_operasi');
        $this->datatables->add_column('action', 
                anchor(site_url('jenis_biaya_operasi/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('jenis_biaya_operasi/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id'); 
        return $this->datatables->generate();
    }

    function getByIdOpr($id)
    {
        $this->db->where('tbl_biaya_jenis_operasi.id_jenis_operasi', $id);
        return $this->db->get('tbl_biaya_jenis_operasi')->row();
    }

    function deleteBiayaOpr($id)
    {
        $this->db->where('tbl_biaya_jenis_operasi.id_jenis_operasi', $id);
        $this->db->delete('tbl_biaya_jenis_operasi');
    }

    public function insertBiayaOpr($data)
    {
        $this->db->insert('tbl_biaya_jenis_operasi',$data);
    }

}