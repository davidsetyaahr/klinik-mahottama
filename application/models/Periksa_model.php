<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Periksa_model extends CI_Model
{

    public $table = 'tbl_periksa';
    public $id = 'no_periksa';
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

    function getId($nop){
        $this->db->where('no_pendaftaran', $nop);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_id($id,$select="")
    {
        if($select!=""){
            $this->db->select($select);
        }
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by no daftar
    function get_by_no_daftar($no_daftar,$select="")
    {
        if($select!=""){
            $this->db->select($select);
        }
        $this->db->where('no_pendaftaran', $no_daftar);
        return $this->db->get($this->table)->row();
    }
    
    function get_d_fisik_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get('tbl_periksa_d_fisik')->result();
    }
    
    function get_d_obat_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_periksa_d_obat');
        $this->db->join('tbl_obat_alkes_bhp', 'tbl_periksa_d_obat.kode_barang = tbl_obat_alkes_bhp.kode_barang');
        $this->db->where($this->id, $id);
        return $this->db->get()->result();
    }
    
    function get_d_obat_by_no_daftar($no_daftar)
    {
        $this->db->select('*');
        $this->db->from('tbl_periksa_d_obat');
        $this->db->join('tbl_obat_alkes_bhp', 'tbl_periksa_d_obat.kode_barang = tbl_obat_alkes_bhp.kode_barang');
        $this->db->where('no_pendaftaran', $no_daftar);
        return $this->db->get()->result();
    }
    
    function get_d_obat_tebus_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_periksa_d_obat');
        $this->db->join('tbl_obat_alkes_bhp', 'tbl_periksa_d_obat.kode_barang = tbl_obat_alkes_bhp.kode_barang');
        $this->db->where($this->id, $id);
        $this->db->where('is_tebus', 1);
        return $this->db->get()->result();
    }
    
    function get_d_alkes_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_periksa_d_alkes');
        $this->db->join('tbl_obat_alkes_bhp', 'tbl_periksa_d_alkes.kode_barang = tbl_obat_alkes_bhp.kode_barang');
        $this->db->where($this->id, $id);
        return $this->db->get()->result();
    }

    function insert($data, $data_d_alkes, $data_d_obat, $data_d_fisik,$data_d_tindakan,$data_d_biaya)
    {
        $this->db->insert($this->table, $data);
        
        for($i = 0; $i < count($data_d_alkes); $i++){
            $this->db->insert('tbl_periksa_d_alkes',$data_d_alkes[$i]);
        }
        
        for($i = 0; $i < count($data_d_obat); $i++){
            $this->db->insert('tbl_periksa_d_obat',$data_d_obat[$i]);
        }
        
        for($i = 0; $i < count($data_d_fisik); $i++){
            $this->db->insert('tbl_periksa_d_fisik',$data_d_fisik[$i]);
        }

        for($i = 0; $i < count($data_d_tindakan); $i++){
            $this->db->insert('tbl_periksa_d_tindakan',$data_d_tindakan[$i]);
        }

        for($i = 0; $i < count($data_d_biaya); $i++){
            $this->db->insert('tbl_periksa_d_biaya',$data_d_biaya[$i]);
        }
    }


    function insert_d_obat($data_d_obat){
        for($i = 0; $i < count($data_d_obat); $i++){
            $this->db->insert('tbl_periksa_d_obat',$data_d_obat[$i]);
        }
    }

    public function getLastNomor()
    {
        $this->db->select('nomor_skt');
        $this->db->order_by('nomor_skt','desc');
        $this->db->limit(1);
        return $this->db->get($this->table,['MONTH(dtm_crt)' => date('m'),'YEAR(dtm_crt)' => date('Y')])->result();
    }
    
    function insert_periksa_d_alkes($data)
    {
        $this->db->insert('tbl_periksa_d_alkes', $data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    
    function update_periksa_d_obat($id, $data)
    {
        $this->db->where('id_periksa_d_obat', $id);
        $this->db->update('tbl_periksa_d_obat', $data);
    }
    
    // datatables
    function json($no_rekam_medis = null) {
        $this->datatables->select('dtm_crt as tgl_periksa, no_periksa,anamnesi,diagnosa,obat_detail');
        $this->datatables->from('tbl_periksa');
        
        if($no_rekam_medis != null)
            $this->datatables->where('no_rekam_medis', $no_rekam_medis);
        // $this->datatables->add_column('action',anchor(site_url('periksamedis/detail?id=$1'),'Detail', array('class' => 'btn btn-danger btn-sm','target'=>'_blank')),'no_periksa');
        return $this->datatables->generate();
    }
    
    function json_riwayat($id_dokter = null) {
        // $this->datatables->select('MAX(p.no_rekam_medis) AS no_rekam_medis, MAX(p.no_periksa) as no_periksa, MAX(ps.nama_lengkap) as nama_pasien, MAX(k.nama) as klinik, MAX(d.nama_dokter) as nama_dokter, MAX(p.anamnesi) AS anamnesi, MAX(p.diagnosa) AS diagnosa, MAX(p.tindakan) AS tindakan, MAX(p.obat_detail) AS obat_detail, MAX(p.dtm_crt) as tgl_periksa,(CASE MAX(p.is_ambil_obat) WHEN 1 THEN "Selesai" ELSE "Obat Belum Diambil" END) as status, (CASE MAX(p.is_surat_ket_sakit) WHEN 1 THEN "" ELSE "disabled" END) as is_cetak');
        // $this->datatables->from('tbl_periksa p');
        // $this->datatables->join('tbl_pasien ps','p.no_rekam_medis=ps.no_rekam_medis','left');
        // $this->datatables->join('tbl_pendaftaran pd','p.no_pendaftaran=pd.no_pendaftaran','left');
        // $this->datatables->join('tbl_klinik k','pd.id_klinik=k.id_klinik','left');
        // $this->datatables->join('tbl_dokter d','p.id_dokter=d.id_dokter','left');
        // $this->datatables->group_by('p.no_rekam_medis');
        // $this->datatables->add_column('action',anchor(site_url('periksamedis/riwayat_detail/$1'),'Detail', array('class' => 'btn btn-info btn-sm')),'no_rekam_medis');
        
        // if($id_dokter != null)
        //     $this->datatables->where('p.id_dokter',$id_dokter);
        // return $this->datatables->generate();
        $data=$this->db->query('SELECT MAX(p.no_rekam_medis) AS no_rekam_medis, MAX(p.no_periksa) AS no_periksa, MAX(ps.nama_lengkap) as nama_pasien, MAX(k.nama) as klinik, MAX(d.nama_dokter) as nama_dokter, MAX(p.anamnesi) AS anamnesi, MAX(p.diagnosa) AS diagnosa, MAX(p.tindakan) AS tindakan, MAX(p.obat_detail) AS obat_detail, MAX(p.dtm_crt) as tgl_periksa,(CASE MAX(p.is_ambil_obat) WHEN 1 THEN "Selesai" ELSE "Obat Belum Diambil" END) as status, (CASE MAX(p.is_surat_ket_sakit) WHEN 1 THEN "" ELSE "disabled" END) as is_cetak
            FROM `tbl_periksa` `p`
            LEFT JOIN `tbl_pasien` `ps` ON `p`.`no_rekam_medis`=`ps`.`no_rekam_medis`
            LEFT JOIN `tbl_pendaftaran` `pd` ON `p`.`no_pendaftaran`=`pd`.`no_pendaftaran`
            LEFT JOIN `tbl_klinik` `k` ON `pd`.`id_klinik`=`k`.`id_klinik`
            LEFT JOIN `tbl_dokter` `d` ON `p`.`id_dokter`=`d`.`id_dokter`
            '.($id_dokter != 0 ? "WHERE `p`.`id_dokter` = ".$id_dokter : "").'
            GROUP BY `p`.`no_rekam_medis`')->result();
        return $data;
    }
    
    function json_riwayat_detail($id_dokter = null, $no_rekam_medis) {
        $this->datatables->select('p.no_periksa, ps.nama_lengkap as nama_pasien, k.nama as klinik, d.nama_dokter as nama_dokter, p.anamnesi, p.diagnosa, p.tindakan, p.obat_detail,p.dtm_crt as tgl_periksa,(CASE p.is_ambil_obat WHEN 1 THEN "Selesai" ELSE "Obat Belum Diambil" END) as status, (CASE p.is_surat_ket_sakit WHEN 1 THEN "" ELSE "disabled" END) as is_cetak');
        $this->datatables->from('tbl_periksa p');
        $this->datatables->join('tbl_pasien ps','p.no_rekam_medis=ps.no_rekam_medis','left');
        $this->datatables->join('tbl_pendaftaran pd','p.no_pendaftaran=pd.no_pendaftaran','left');
        $this->datatables->join('tbl_klinik k','pd.id_klinik=k.id_klinik','left');
        $this->datatables->join('tbl_dokter d','p.id_dokter=d.id_dokter','left');
        $this->datatables->where('p.no_rekam_medis', $no_rekam_medis);
        $this->datatables->add_column('action',/*anchor(site_url('periksamedis/detail?id=$1'),'Detail', array('class' => 'btn btn-danger btn-sm','target'=>'_blank')) ." ".*/anchor(site_url('periksamedis/cetak_surat_ket_sakit?id=$1'),'Cetak Surat Ket. Sakit', array('class' => 'btn btn-info btn-sm $2','target'=>'_blank')),'no_periksa,is_cetak');
        
        if($id_dokter != null)
            $this->datatables->where('p.id_dokter',$id_dokter);
        return $this->datatables->generate();
    }

    function json_history()
    {
        $this->datatables->select('tbl_pendaftaran.no_pendaftaran,nik,pa.no_rekam_medis,no_id_pasien,nama_lengkap,golongan_darah,status_menikah,pekerjaan,kab.kabupaten,nama_orang_tua_atau_istri,nomer_telepon,riwayat_alergi_obat');
        $this->datatables->from('tbl_pasien pa');
        $this->datatables->join('tbl_pendaftaran','tbl_pendaftaran.no_rekam_medis=pa.no_rekam_medis','left');
        $this->datatables->join('tbl_kabupaten kab','kab.id=pa.id_kabupaten', 'left');
        $this->datatables->join('tbl_kecamatan kec','kec.id=pa.id_kecamatan', 'left');
        $this->datatables->join('tbl_desa des','des.id=pa.id_desa', 'left');
        $this->datatables->join('tbl_dusun dus','dus.id=pa.id_dusun', 'left');
        $this->datatables->where('tbl_pendaftaran.is_bayar', '1');
        $this->datatables->group_by('pa.no_rekam_medis');
        $this->datatables->add_column('action', anchor(site_url('periksamedis/history_detail/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-info btn-sm"'), 'no_rekam_medis');
            
        return $this->datatables->generate();
    }

    function json_history_detail($no_rekam_medis)
    {
        $this->datatables->select('pe.no_periksa, pe.dtm_crt, pe.no_pendaftaran, pe.no_rekam_medis, pe.no_pendaftaran');
        $this->datatables->from('tbl_periksa pe');
        $this->datatables->where('pe.no_rekam_medis', $no_rekam_medis);
        $this->datatables->add_column('action', anchor('#','<i class="fa fa-eye" aria-hidden="true"></i>',"class='btn btn-info btn-sm' data-toggle='modal' data-target='#myModal' onClick='javasciprt: cekDetail(\"$1\")'"), 'no_pendaftaran');
            
        return $this->datatables->generate();
    }
    
    function json_detail_check($no_pendaftaran)
    {
        $this->db->select('pe.no_rekam_medis,pl.no_pendaftaran, pe.no_periksa, (CASE WHEN pl.tipe_periksa = 1 THEN "POLI" WHEN pl.tipe_periksa = 2 THEN "RAWAT INAP" WHEN pl.tipe_periksa = 3 THEN "OPERASI" WHEN pl.tipe_periksa = 4 THEN "LABORATORIUM" WHEN pl.tipe_periksa = 5 THEN "RADIOLOGI" ELSE "UGD" END) as pos');
        $this->db->from('tbl_periksa_lanjutan pl');
        $this->db->join('tbl_periksa pe','pe.no_pendaftaran = pl.no_pendaftaran');
        $this->db->where('pl.no_pendaftaran', $no_pendaftaran);
        return $this->db->get()->result_array();
    }

    function json_check($no_pendaftaran)
    {
        $this->db->select('t.no_transaksi as no_periksa, (CASE WHEN l.tipe_periksa = 1 THEN "POLI" WHEN l.tipe_periksa = 2 THEN "RAWAT INAP" WHEN l.tipe_periksa = 3 THEN "OPERASI" WHEN l.tipe_periksa = 4 THEN "LABORATORIUM" WHEN l.tipe_periksa = 5 THEN "RADIOLOGI" ELSE "UGD" END) as pos');
        $this->db->from('tbl_transaksi t');
        $this->db->join('tbl_transaksi_d td','t.id_transaksi = td.id_transaksi');
        $this->db->join('tbl_periksa_lanjutan l','t.id_periksa_lanjutan = l.id_periksa');
        $this->db->join('tbl_pendaftaran p','l.no_pendaftaran = p.no_pendaftaran');
        $this->db->where('p.no_pendaftaran', $no_pendaftaran);
        $this->db->group_by('l.tipe_periksa');
        $this->db->order_by('l.tipe_periksa','asc');
        return $this->db->get()->result_array();
    }

    function get_no_periksa($no_rekam_medis){
        $this->db->select('t.no_transaksi as no_periksa');
        $this->db->from('tbl_transaksi t');
        $this->db->join('tbl_transaksi_d td','t.id_transaksi = td.id_transaksi');
        $this->db->join('tbl_periksa_lanjutan l','t.id_periksa_lanjutan = l.id_periksa');
        $this->db->join('tbl_pendaftaran p','l.no_pendaftaran = p.no_pendaftaran');
        $this->db->where('p.no_rekam_medis', $no_rekam_medis);
        $this->db->where('l.tipe_periksa', '1');
        $this->db->group_by('l.tipe_periksa');
        return $this->db->get()->row();
    }

    function get_detail_obat($no_periksa)
    {
        $this->db->select('ob.nama_barang as item, do.jumlah');
        $this->db->join('tbl_obat_alkes_bhp ob','ob.kode_barang = do.kode_barang');
        $this->db->where('do.no_periksa', $no_periksa);
        return $this->db->get('tbl_periksa_d_obat do')->result();
    }

    function get_detail_alkes($no_periksa)
    {
        $this->db->select('ob.nama_barang as item, da.jumlah');
        $this->db->join('tbl_obat_alkes_bhp ob','ob.kode_barang = da.kode_barang');
        $this->db->where('da.no_periksa', $no_periksa);
        return $this->db->get('tbl_periksa_d_alkes da')->result();
    }

    function get_detail_tindakan($no_periksa)
    {
        $this->db->select('tn.tindakan as item, dt.jumlah');
        $this->db->join('tbl_tindakan tn', 'tn.kode_tindakan=dt.kode_tindakan');
        $this->db->where('dt.no_periksa', $no_periksa);
        return $this->db->get('tbl_periksa_d_tindakan dt')->result();
    }
    
    function get_detail_biaya($no_periksa)
    {
        $this->db->select('b.nama_biaya as item, db.jumlah');
        $this->db->join('tbl_biaya b','b.id_biaya = db.id_biaya');
        $this->db->where('db.no_periksa', $no_periksa);
        return $this->db->get('tbl_periksa_d_biaya db')->result();
    }


    public function oldKamarRawatInap($noPendaftaran)
    {
        $this->db->select('rid.id_detail,k.id_kategori_kamar,rid.id_kamar,k.no_kamar,rid.biaya_per_hari,rid.jml_hari,kk.nama nama_kategori');
        $this->db->from('tbl_periksa_rawat_inap_detail rid');
        $this->db->join('tbl_periksa_rawat_inap ri','rid.id_periksa_rawat_inap = ri.id_periksa_rawat_inap');
        $this->db->join('tbl_kamar k','rid.id_kamar = k.id_kamar');
        $this->db->join('tbl_kategori_kamar kk','k.id_kategori_kamar = kk.id_kategori_kamar');
        $this->db->where('ri.no_pendaftaran',$noPendaftaran);
        return $this->db->get()->result();
    }
    function oldBiaya($noPendaftaran,$tipePeriksa){
        $this->db->select('pb.id_biaya,pb.jumlah,pb.biaya,b.nama_biaya,pb.id_periksa_d_biaya');
        $this->db->join('tbl_biaya b','pb.id_biaya = b.id_biaya');
        return $this->db->get_where('tbl_periksa_d_biaya pb',['pb.no_pendaftaran' => $noPendaftaran,'tipe_periksa' => $tipePeriksa])->result();
    }
    function oldTindakan($noPendaftaran,$tipePeriksa){
        $this->db->select('pt.kode_tindakan,pt.jumlah,pt.biaya,t.tindakan,pt.id_periksa_d_tindakan');
        $this->db->join('tbl_tindakan t','pt.kode_tindakan = t.kode_tindakan');
        return $this->db->get_where('tbl_periksa_d_tindakan pt',['pt.no_pendaftaran' => $noPendaftaran,'tipe_periksa' => $tipePeriksa])->result();
    }
    function oldObat($noPendaftaran,$tipePeriksa){
        $this->db->select('pdo.kode_barang,pdo.jumlah,pdo.harga_satuan,o.nama_barang,pdo.id_periksa_d_obat');
        $this->db->join('tbl_obat_alkes_bhp o','pdo.kode_barang = o.kode_barang');
        return $this->db->get_where('tbl_periksa_d_obat pdo',['pdo.no_pendaftaran' => $noPendaftaran,'pdo.tipe_periksa' => $tipePeriksa])->result();
    }
    function oldAlkes($noPendaftaran,$tipePeriksa){
        $this->db->select('pda.kode_barang,pda.jumlah,pda.harga_satuan,o.nama_barang,pda.id_periksa_d_alkes');
        $this->db->join('tbl_obat_alkes_bhp o','pda.kode_barang = o.kode_barang');
        return $this->db->get_where('tbl_periksa_d_alkes pda',['pda.no_pendaftaran' => $noPendaftaran,'pda.tipe_periksa' => $tipePeriksa])->result();
    }
    public function countPeriksaLanjutan($noPendaftaran,$tipePeriksa){
        return $this->db->get_where('tbl_periksa_lanjutan',['no_pendaftaran' => $noPendaftaran,'tipe_periksa' => $tipePeriksa, 'is_periksa' => '0'])->num_rows();
    }
    public function getIdPeriksaLanjutan($noPendaftaran,$tipePeriksa)
    {
        $this->db->select('id_periksa');
        return $this->db->get_where('tbl_periksa_lanjutan',['no_pendaftaran' => $noPendaftaran,'tipe_periksa' => $tipePeriksa, 'is_periksa' => '1'])->row(); 
    }

}
