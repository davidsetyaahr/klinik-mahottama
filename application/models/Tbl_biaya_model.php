<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_biaya_model extends CI_Model
{
    public $table = 'tbl_biaya';
    public $id = 'id_biaya';
    public $order = 'DESC';


    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
        // return $this->db->get('tbl_biaya')->result();
    }

    public function getBiaya($not=null,$where=null)
    {
        $this->db->select("b.id_biaya,b.id_kategori_biaya, b.is_id_dokter, case when b.is_id_dokter = '0' then '-' else d.nama_dokter end as nama_dokter, kb.item, b.nama_biaya, b.tipe_biaya, b.id_biaya_presentase, b.presentase, case when b.tipe_biaya = '1' then b.biaya else b.presentase / 100 * (select biaya from tbl_biaya where id_biaya = b.id_biaya_presentase) end as biaya, case when b.tipe_biaya='1' then 'Biaya Fix' else 'Biaya Persentase' end as tipe_biaya_text");
        $this->db->from("tbl_biaya b");
        $this->db->join("tbl_kategori_biaya kb", "b.id_kategori_biaya = kb.id_kategori_biaya");
        $this->db->join("tbl_dokter d", "b.is_id_dokter = d.id_dokter",'left');
        if($where!=null){
            $this->db->where($where);
        }
        if($not!=null){
            $this->db->where('id_biaya !=',$not);
        }
        $this->db->order_by('b.id_biaya','desc');
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
            $cekBtnDel = $this->db->get_where('tbl_biaya',['id_biaya_presentase' => $value->id_biaya])->num_rows()==0 ? anchor(site_url('biaya/delete/'.$value->id_biaya),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"') : '';
            $value->action = anchor(site_url('biaya/edit/'.$value->id_biaya),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
            ".$cekBtnDel;
        }
        return $sql;
    }

    public function getBiaya2($tipe='db')
    {
        $db = $tipe=='json' ? $this->datatables : $this->db;
        $db->select("b.id_biaya, kb.item, b.nama_biaya, b.tipe_biaya, case when b.tipe_biaya = '1' then b.biaya else b.presentase / 100 * (select biaya from tbl_biaya where id_biaya = b.id_biaya_presentase) end as biaya");
        $db->from("tbl_biaya b");
        $db->join("tbl_kategori_biaya kb", "b.id_kategori_biaya = kb.id_kategori_biaya");
        if($tipe=='json'){
            $this->datatables->add_column('action', 
                    anchor(site_url('biaya/edit/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                    ".anchor(site_url('biaya/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_biaya');
                
            return $this->datatables->generate();
        }
        else{
            return $this->db->get()->result();
        }
    }
    function getBiayaFix($not=null){
        $this->db->select('id_biaya,nama_biaya,biaya');
        $where = ['tipe_biaya' => '1'];
        if($not!=null){
            $where['id_biaya !='] = $not;
        }
        return $this->db->get_where('tbl_biaya',$where)->result();
    }
    public function insert($data)
    {
        $this->db->insert($this->table,$data);
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->select("b.*,case when b.tipe_biaya = '1' then b.biaya else b.presentase / 100 * (select biaya from tbl_biaya where id_biaya = b.id_biaya_presentase) end as biaya");
        $this->db->where($this->id, $id);
        return $this->db->get($this->table." b")->row();
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