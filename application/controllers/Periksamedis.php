<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Periksamedis extends CI_Controller
{

    public $id_dokter;
    public $id_klinik;
    public $no_pendaftaran;
    public $master_ref_code_anamnesi = 'ANAMNESI';
    public $master_ref_code_alergiobat = 'ALERGIOBAT';
    public $master_ref_code_diagnosa = 'DIAGNOSA';
    public $master_ref_code_tindakan = 'TINDAKAN';
    public $master_ref_code_anjuranobat = 'ANJURANOBAT';
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pendaftaran_model');
        $this->load->model('Tbl_pasien_model');
        $this->load->model('Tbl_obat_alkes_bhp_model');
        $this->load->model('akuntansi/Transaksi_akuntansi_model');
        // 		$this->load->model('Tbl_tindakan_model');
        $this->load->model('Transaksi_obat_model');
        $this->load->model('Periksa_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Tbl_dokter_model');
        $this->load->model('Tbl_kamar_model');
        $this->load->model('Tbl_jenis_operasi_model');
        $this->load->model('Tbl_ruangan_operasi_model');
        $this->load->model('Tbl_alat_operasi_model');
        $this->load->model('Master_reference_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->model('Master_sequence_model');

        $this->load->model('Tbl_diagnosa_icd10_model');
        $this->load->model('Tbl_periksa_diagnosa_model');
        $this->load->model('Tbl_imunisasi_model');
        $this->load->model('Tbl_biaya_model');

        date_default_timezone_set('Asia/Jakarta');


        $this->id_dokter = $this->session->userdata('id_dokter');
        $this->id_klinik = $this->session->userdata('id_klinik');
        if ($this->id_dokter == 0) {
            $this->no_pendaftaran = $this->session->userdata('no_pendaftaran');
        } else {
            $dokter = $this->Tbl_dokter_model->get_by_id($this->id_dokter);
            $this->no_pendaftaran = $dokter != null ? $dokter->no_pendaftaran : null;
        }
    }

    public function index()
    {
        if ($this->no_pendaftaran == null) {
            $this->session->set_flashdata('message', 'Tidak ada pemeriksaan, silahkan pilih di Daftar Antrian');
            $this->session->set_flashdata('message_type', 'danger');
            redirect(site_url('periksamedis/antrian'));
        }

        $periksaLanjutan = $this->db->get_where('tbl_periksa_lanjutan', ['no_pendaftaran' => $this->no_pendaftaran,'is_periksa' => '1'])->row();
        if(count((array)$periksaLanjutan)==0){
            redirect(base_url() . "periksamedis/antrian");
        }
        else{
            if ($periksaLanjutan->tipe_periksa == '1') {
                //poli
                redirect(base_url() . "periksamedis/poli");
            } else if ($periksaLanjutan->tipe_periksa == '2') {
                //rawat inap
                redirect(base_url() . "periksamedis/rawat_inap");
            } else if ($periksaLanjutan->tipe_periksa == '3') {
                //operasi
                redirect(base_url() . "periksamedis/operasi");
            } else if ($periksaLanjutan->tipe_periksa == '4') {
                //lab
                redirect(site_url('periksamedis/periksa_lab/'));
            } else if ($periksaLanjutan->tipe_periksa == '5') {
                //radiologi
                redirect(site_url('periksamedis/periksa_radiologi/'));
            }
        }
    }

    function poli()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);

        $getIdPeriksaLanjutan = $this->Periksa_model->getIdPeriksaLanjutan($this->no_pendaftaran,'1');
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $date_now = date('Ymd', time());
        $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);

        $this->_rules();
        if ($this->form_validation->run() == TRUE) {

            $obat_detail_value = '';
            $obat_detail = $this->input->post('obat');
            if ($obat_detail != null) {
                for ($i = 0; $i < count($obat_detail); $i++) {
                    if ($obat_detail[$i] != '') {
                        $nama_obat = $this->Tbl_obat_alkes_bhp_model->get_by_id($obat_detail[$i])->nama_barang;

                        $obat_detail_value .= $nama_obat . ', ';
                    }
                }
            }
            $sktNomor = $_POST['is_cetak_surat']=='1' ? $this->input->post('nomor_skt') . "/" . date('m') . "/KR/SK/" . date('y') : '';

            $data_periksa = array(
                'no_periksa' => $this->input->post('no_periksa'),
                'no_pendaftaran' => $data_pendaftaran->no_pendaftaran,
                'no_rekam_medis' => $data_pendaftaran->no_rekam_medis,
                'anamnesi' => rtrim($this->input->post('anamnesi'), ", "),
                'diagnosa' => rtrim($this->input->post('diagnosa'), ", "),
                // 'tindakan' => rtrim($this->input->post('tindakan'), ", "),
                'is_surat_ket_sakit' => $this->input->post('is_cetak_surat') != null ? $this->input->post('is_cetak_surat') : 0,
                'nomor_skt' => $sktNomor,
                'tujuan_surat' => $this->input->post('is_cetak_surat') == 1 ? $this->input->post('tujuan_surat') : '',
                'tanggal_mulai' => $this->input->post('is_cetak_surat') == 1 ? $this->input->post('tanggal_mulai') : null,
                'lama_istirahat_surat' => $this->input->post('is_cetak_surat') == 1 ? $this->input->post('lama_istirahat_surat') : 0,
                'id_dokter' => $data_pendaftaran->id_dokter,
                'note_dokter' => $this->input->post('note_dokter'),
                'note_apoteker' => $this->input->post('note_apoteker'),
                'obat_detail' => rtrim($obat_detail_value, ", "),
            );

            $getIdPeriksaLanjutan = $this->Periksa_model->getIdPeriksaLanjutan($this->no_pendaftaran,'1');
            //input inventory barang
            $kode_receipt = 'RCP' . time();
            $data = array(
                'id_inventory'  => $kode_receipt,
                'inv_type'      => 'TRX_STUFF',
                'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
                'id_klinik'     => $this->id_klinik,
            );

            $insert = $this->Transaksi_obat_model->insert('tbl_inventory', $data);


            $post_alkes = $this->input->post('alat_kesehatan');
            $post_alkes_jml = $this->input->post('jml_alat_kesehatan');
            $data_periksa_d_alkes = array();
            $no_periksa = $this->input->post('no_periksa');

            $total_jual_alkes = 0;
            for ($i = 0; $i < count($post_alkes); $i++) {
                if ($post_alkes[$i] != null || $post_alkes[$i] != '') {
                    $total_jual_alkes += $_POST['harga_alkes'][$i];
                    $data_periksa_d_alkes[] = array(
                        'no_periksa' => $this->input->post('no_periksa'),
                        'no_pendaftaran' => $data_pendaftaran->no_pendaftaran,
                        'kode_barang' => $post_alkes[$i],
                        'jumlah' => $post_alkes_jml[$i],
                        'harga_satuan' => $_POST['harga_alkes'][$i] / $post_alkes_jml[$i],
                        'tipe_periksa' => '1'
                    );

                    $detailInv = array(
                        'id_inventory' => $kode_receipt,
                        'kode_barang' => $post_alkes[$i],
                        'jumlah' => $post_alkes_jml[$i],
                        'harga' => $_POST['harga_alkes'][$i] / $post_alkes_jml[$i],
                    );
                    $insert = $this->Transaksi_obat_model->insert('tbl_inventory_detail', $detailInv);
                }
            }
            $this->jurnal_otomatis_alkes($total_jual_alkes, $no_periksa); //jurnal otomatis akuntansi untuk pendapatan


            $dataobat = array();

            $post_obat = $this->input->post('obat');
            $post_obat_jml = $this->input->post('jml_obat');
            $post_obat_anjuran = $this->input->post('anjuran_obat');
            $post_obat_ket = $this->input->post('ket_obat');
            $post_obat_penggunaan = $this->input->post('kegunaan_obat');
            $total_jual = 0;
            $total_jual_obat = 0;

            $data_periksa_d_obat = array();
            for ($i = 0; $i < count($post_obat); $i++) {
                $kode_barang = $post_obat[$i];
                $data_periksa_d_obat[] = array(
                    'no_pendaftaran' => $data_pendaftaran->no_pendaftaran,
                    'no_periksa' => $this->input->post('no_periksa'),
                    'kode_barang' => $post_obat[$i],
                    'jumlah' => $post_obat_jml[$i],
                    'harga_satuan' => $_POST['harga_obat'][$i] / $post_obat_jml[$i],
                    'anjuran' => $post_obat_anjuran[$i],
                    'keterangan' => $post_obat_ket[$i],
                    'penggunaan_obat' => $post_obat_penggunaan[$i],
                    'tipe_periksa' =>'1'
                );

                $data_detail = array(
                    'id_inventory' => $kode_receipt,
                    'kode_barang' => $kode_barang,
                    'jumlah' => $post_obat_jml[$i],
                    'harga' => $_POST['harga_obat'][$i] / $post_obat_jml[$i],
                );
                $this->Transaksi_obat_model->insert('tbl_inventory_detail', $data_detail);
                $total_jual_obat += $_POST['harga_obat'][$i];
            }
            $subsidi_obat = $this->input->post('subsidi_harga');
            // $grand_total_obat=$this->input->post('grandtotal_harga');
            $grand_total_obat = $total_jual_obat - $subsidi_obat;
            // $total_jual_obat=$this->input->post('total_harga');
            $hpp = $grand_total_obat + $total_jual_alkes;
            $this->jurnal_otomatis_obat($hpp, $no_periksa, $grand_total_obat); //jurnal otomatis akuntansi untuk pendapatan

            $post_cek_fisik = $this->input->post('cek_fisik');
            $post_cek_fisik_value = $this->input->post('cek_fisik_value');
            $data_periksa_d_fisik = array(
                array(
                    'no_periksa' => $this->input->post('no_periksa'),
                    'nama_periksa_fisik' => 'Berat Badan',
                    'nilai_periksa_fisik' => $this->input->post('berat_badan'),
                ),
                array(
                    'no_periksa' => $this->input->post('no_periksa'),
                    'nama_periksa_fisik' => 'Tinggi Badan',
                    'nilai_periksa_fisik' => $this->input->post('tinggi_badan'),
                ),
                array(
                    'no_periksa' => $this->input->post('no_periksa'),
                    'nama_periksa_fisik' => 'Tekanan Darah',
                    'nilai_periksa_fisik' => $this->input->post('tekanan_darah'),
                ),
                array(
                    'no_periksa' => $this->input->post('no_periksa'),
                    'nama_periksa_fisik' => 'Suhu Tubuh',
                    'nilai_periksa_fisik' => $this->input->post('suhu_tubuh'),
                ),
            );
            for ($i = 0; $i < count($post_cek_fisik); $i++) {
                if ($post_cek_fisik[$i] != null || $post_cek_fisik[$i] != '') {
                    $data_periksa_d_fisik[] = array(
                        'no_periksa' => $this->input->post('no_periksa'),
                        'nama_periksa_fisik' => $post_cek_fisik[$i],
                        'nilai_periksa_fisik' => $post_cek_fisik_value[$i],
                    );
                }
            }

            $data_periksa_d_tindakan = [];
            foreach ($_POST['tindakan'] as $key => $value) {
                $data_periksa_d_tindakan[] = array(
                    'no_pendaftaran' => $data_pendaftaran->no_pendaftaran,
                    'no_periksa' => $this->input->post('no_periksa'),
                    'kode_tindakan' => $value,
                    'jumlah' =>$_POST['qty_tindakan'][$key],
                    'biaya' => $_POST['biaya_tindakan'][$key],
                    'tipe_periksa' =>'1'
                );
            }

            //d_periksa_biaya
            $periksa_d_biaya = [];
            foreach ($_POST['id_biaya'] as $key => $value) {
                $periksa_d_biaya[] = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'no_periksa' => $this->input->post('no_periksa'),
                    'id_biaya' => $value,
                    'jumlah' => $_POST['qty_biaya'][$key],
                    'biaya' => $_POST['biaya'][$key],
                    'tipe_periksa' => '1',
                );
        }

            //Insert into tbl_periksa
            $this->Periksa_model->insert($data_periksa, $data_periksa_d_alkes, $data_periksa_d_obat, $data_periksa_d_fisik,$data_periksa_d_tindakan,$periksa_d_biaya);


            //Set Riwayat Alergi Obat Pasien
            $pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
            if ($pasien != null) {
                $this->Tbl_pasien_model->update($data_pendaftaran->no_rekam_medis, array(
                    'riwayat_alergi_obat' => $this->input->post('riwayat_alergi_obat'),
                    'dtm_upd' => date("Y-m-d H:i:s",  time())
                ));
            }


            //Insert Master Ref Anamnesi
            $master_ref_anamnesi = $this->split_string($this->input->post('anamnesi'), ',');
            for ($i = 0; $i < count($master_ref_anamnesi); $i++) {
                $master_ref = $this->Master_reference_model->get_by_value($master_ref_anamnesi[$i]['value'], $this->master_ref_code_anamnesi);
                if ($master_ref == null) {
                    $this->Master_reference_model->insert(array(
                        'master_ref_code' => $this->master_ref_code_anamnesi,
                        'master_ref_value' => $master_ref_anamnesi[$i]['value'],
                        'master_ref_name' => $master_ref_anamnesi[$i]['name']
                    ));
                }
            }
            //Insert Master Ref Alergi Obat
            $master_ref_alergiobat = $this->split_string($this->input->post('riwayat_alergi_obat'), ',');
            for ($i = 0; $i < count($master_ref_alergiobat); $i++) {
                $master_ref = $this->Master_reference_model->get_by_value($master_ref_alergiobat[$i]['value'], $this->master_ref_code_alergiobat);
                if ($master_ref == null) {
                    $this->Master_reference_model->insert(array(
                        'master_ref_code' => $this->master_ref_code_alergiobat,
                        'master_ref_value' => $master_ref_alergiobat[$i]['value'],
                        'master_ref_name' => $master_ref_alergiobat[$i]['name']
                    ));
                }
            }
            //Insert Master Ref Diagnosa
            $master_ref_diagnosa = $this->split_string($this->input->post('diagnosa'), ',');
            for ($i = 0; $i < count($master_ref_diagnosa); $i++) {
                $master_ref = $this->Master_reference_model->get_by_value($master_ref_diagnosa[$i]['value'], $this->master_ref_code_diagnosa);
                if ($master_ref == null) {
                    $this->Master_reference_model->insert(array(
                        'master_ref_code' => $this->master_ref_code_diagnosa,
                        'master_ref_value' => $master_ref_diagnosa[$i]['value'],
                        'master_ref_name' => $master_ref_diagnosa[$i]['name']
                    ));
                }
            }
            // //Insert Master Ref Tindakan
            // $master_ref_tindakan = $this->split_string($this->input->post('tindakan'), ',');
            // for ($i = 0; $i < count($master_ref_tindakan); $i++) {
            //     $master_ref = $this->Master_reference_model->get_by_value($master_ref_tindakan[$i]['value'], $this->master_ref_code_tindakan);
            //     if ($master_ref == null) {
            //         $this->Master_reference_model->insert(array(
            //             'master_ref_code' => $this->master_ref_code_tindakan,
            //             'master_ref_value' => $master_ref_tindakan[$i]['value'],
            //             'master_ref_name' => $master_ref_tindakan[$i]['name']
            //         ));
            //     }
            // }

            //Insert Periksa Diagnosa
            foreach ($_POST['id_diagnosa'] as $id) {
                $arr = array(
                    'no_periksa' => $this->input->post('no_periksa'),
                    'id_diagnosa' => $id
                );

                $this->Tbl_periksa_diagnosa_model->insert($arr);
            }
            $updatePendaftaran = array(
                'is_periksa' => 1,
                'dtm_upd' => date("Y-m-d H:i:s",  time())
            );

            if ($_POST['pemeriksaan_selanjutnya'] != '0') {
                $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '0'], ['no_pendaftaran' => $data_pendaftaran->no_pendaftaran]);
                $periksaLanjutan = array(
                    'no_pendaftaran' => $data_pendaftaran->no_pendaftaran,
                    'tipe_periksa' => $_POST['pemeriksaan_selanjutnya'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'is_periksa' => '1',
                );
                $this->db->insert('tbl_periksa_lanjutan', $periksaLanjutan);
            } else {
                $updatePendaftaran['is_closed'] = '1';
            }
            $this->Pendaftaran_model->update($this->no_pendaftaran, $updatePendaftaran);
            
            if($_POST['pemeriksaan_selanjutnya']==0){
                //Get Next Antrian
                $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
                $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
                $this->Tbl_dokter_model->update($this->id_dokter, array(
                    "no_pendaftaran" => $next_antrian,
                    "dtm_upd" => date("Y-m-d H:i:s",  time())
                ));
            }
            
            //TRANSAKSI
            $date_now_trx = date('Y-m-d', time());
            $data_transkasi = array(
                'kode_transaksi' => 'PRKSPLI',
                'id_klinik' => $data_pendaftaran->id_klinik,
                'no_transaksi' => $this->input->post('no_periksa'),
                'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
                'tgl_transaksi' => $date_now_trx,
                'status_transaksi' => 0,
            );
            // $this->Transaksi_model->insert($data_transkasi);
            $this->db->insert('tbl_transaksi', $data_transkasi);

            $lastIdTp = $this->db->select_max('id_transaksi')->from('tbl_transaksi')->get()->row();
            $data_transaksi_d = array(
                array(
                    'id_transaksi' => $lastIdTp->id_transaksi,
                    'deskripsi' => 'Biaya Obat',
                    'amount_transaksi' => $total_jual_obat,
                    'dc' => 'd'
                ),
                array(
                    'id_transaksi' => $lastIdTp->id_transaksi,
                    'deskripsi' => 'Biaya BMHP',
                    'amount_transaksi' => $total_jual_alkes,
                    'dc' => 'd'
                ),
                array(
                    'id_transaksi' => $lastIdTp->id_transaksi,
                    'deskripsi' => 'Biaya Tindakan ',
                    'amount_transaksi' => $_POST['totalBiayaTindakan'],
                    'dc' => 'd'
                ),
                array(
                    'id_transaksi' => $lastIdTp->id_transaksi,
                    'deskripsi' => 'Biaya Lainnya',
                    'amount_transaksi' => $_POST['totalBiaya'],
                    'dc' => 'd'
                ),

            );

            $amountSubsidi = $this->input->post('ket_obat_obatan') == 0 ? ($this->input->post('subsidi_harga') != '' ? $this->input->post('subsidi_harga') : 0) : $this->input->post('total_harga');

            if($amountSubsidi!=0){
                $data_transaksi_d[] = array(
                    'id_transaksi' => $lastIdTp->id_transaksi,
                    'deskripsi' => 'Subsidi Obat-obatan',
                    'amount_transaksi' => $amountSubsidi,
                    'dc' => 'c'
                );
            }

            //Insert into tbl_transaksi
            for($i = 0; $i < count($data_transaksi_d); $i++){
                // $data_transaksi_d[$i]['id_transaksi'] = $insert_id;
                $this->db->insert('tbl_transaksi_d',$data_transaksi_d[$i]);
            }


            //Set session sukses
            $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
            $this->session->set_flashdata('message_type', 'success');

            redirect(site_url('periksamedis'));
        } else {
            $this->data['no_periksa'] = 'PRKSPLI' . '/' . $data_pendaftaran->no_pendaftaran . '/' . $date_now . '/' . $data_pendaftaran->no_rekam_medis;
            if (isset($data_pasien)) {
                $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
                $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
                $this->data['riwayat_alergi_obat'] = $data_pasien->riwayat_alergi_obat;
            }
            $this->data['anamnesies'] = $this->get_master_ref($this->master_ref_code_anamnesi);
            $this->data['alergi_obat'] = $this->get_master_ref($this->master_ref_code_alergiobat);
            $this->data['diagnosa'] = $this->get_master_ref($this->master_ref_code_diagnosa);
            // $this->data['tindakan'] = $this->get_master_ref($this->master_ref_code_tindakan);
            $this->data['alkes_option'] = array();
            $this->data['alkes_option'][''] = 'Pilih Alat Kesehatan';
            $alkes_opt_js = array();
            foreach ($this->Tbl_obat_alkes_bhp_model->get_all_alkes1($this->id_klinik) as $alkes) {
                $this->data['alkes_option'][$alkes->kode_barang] = $alkes->nama_barang;
                $alkes_opt_js[] = array(
                    'value' => $alkes->kode_barang,
                    'label' => $alkes->nama_barang
                );
            }
            $this->data['alkes_option_js'] = json_encode($alkes_opt_js);
            $this->data['biaya'] = $this->Tbl_biaya_model->getBiaya();
            $this->data['tindakan'] = $this->db->get('tbl_tindakan')->result();
            $this->data['obat_option'] = array();
            $this->data['obat_option'][''] = 'Pilih Obat';
            $obat_opt_js = array();
            foreach ($this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik) as $obat) {
                $this->data['obat_option'][$obat->kode_barang] = $obat->nama_barang;
                $obat_opt_js[] = array(
                    'value' => $obat->kode_barang,
                    'label' => $obat->nama_barang
                );
            }
            $this->data['obat_option_js'] = json_encode($obat_opt_js);
            $this->data['anjuran_obat'] = $this->get_master_ref($this->master_ref_code_anjuranobat);

            $this->data['alkes'] = $this->get_all_alkes();
            $this->data['obat'] = $this->get_all_obat();

            $this->data['diagnosa_icd10'] = $this->Tbl_diagnosa_icd10_model->getAll();
            $this->data['master_tindakan'] = $this->db->query('select * from tbl_tindakan order by cast(kode_tindakan as SIGNED INTEGER) asc ')->result();

            //Set session error
            if ($this->input->post('no_periksa')) {
                $this->session->set_flashdata('message', 'Terdapat error input, silahkan cek ulang');
                $this->session->set_flashdata('message_type', 'danger');
            }
        }
        $nomor = 1;
        $getLastNomorSK = $this->Periksa_model->getLastNomor();
        if (count($getLastNomorSK) > 0) {
            $getNomor = explode('/', $getLastNomorSK[0]->nomor_skt);
            if (count($getNomor) == 5) {
                $nomor = (int)$getNomor[0] + 1;
            }
        }
        $this->data['nomor_skt'] = sprintf("%04s", $nomor);

        $this->template->load('template', 'rekam_medis/form_rekam_medis', $this->data);
    }

    public function addItemBiaya()
    {
        $this->data['biaya'] = $this->Tbl_biaya_model->getBiaya();
        $this->data['no'] = $_GET['no'];
        $this->load->view('rekam_medis/loop-pilihan-biaya', $this->data);
    }

    public function newItemLoopAlat()
    {
        $this->data['alat'] = $this->Tbl_alat_operasi_model->get_all();
        $this->data['no'] = $_GET['no'];
        $this->load->view('loop/loop-pilihan-alat-operasi', $this->data);
    }

    public function addICD()
    {
        $this->db->insert('tbl_diagnosa_icd10', ['code' => $_POST['code'], 'diagnosa' => $_POST['diagnosa']]);
        $insert_id = $this->db->insert_id();
        echo $insert_id;
    }
    private function jurnal_otomatis_alkes($total_jual_alkes, $no_periksa,$isEdit=null)
    {
        if($isEdit==null){
            $data_trx = array(
                'deskripsi'     => 'Penjualan BMHP dari Nomor Pemeriksaan '.$no_periksa,
                'tanggal'       => date('Y-m-d'),
            );
            $insert = $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi', $data_trx);
        }
        else{
            $insert = true;
        }
        if ($insert) {
            if($isEdit==null){
                $id_last = $this->db->select_max('id_trx_akun')->from('tbl_trx_akuntansi')->get()->row();

                // //hpp 
                // $data = array(
                //     'id_trx_akun'   => $id_last->id_trx_akun,
                //     'id_akun'       => 65,
                //     'jumlah'        => $total_jual_alkes,
                //     'tipe'          => 'DEBIT',
                //     'keterangan'    => 'lawan',
                // );
                // $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);

                //persediaan obat berkurang (tanpa diskon)
                $data = array(
                    'id_trx_akun'   => $id_last->id_trx_akun,
                    'id_akun'       => 59,
                    'jumlah'        => $total_jual_alkes,
                    'tipe'          => 'KREDIT',
                    'keterangan'    => 'akun',
                );
                $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);
            }
            else{
                $this->db->select('id_trx_akun');
                $getIdTrx = $this->db->get_where('tbl_trx_akuntansi',['deskripsi' => 'Penjualan BMHP dari Nomor Pemeriksaan ' . $no_periksa])->row();
                                
                // $this->db->update('tbl_trx_akuntansi_detail',['jumlah' => $total_jual_alkes],['id_trx_akun' => $getIdTrx->id_trx_akun,'id_akun' => '65']);
                
                $this->db->update('tbl_trx_akuntansi_detail',['jumlah' => $total_jual_alkes],['id_trx_akun' => $getIdTrx->id_trx_akun,'id_akun' => '59']);
            }
        }
    }
    private function jurnal_otomatis_obat($hpp,$no_periksa, $total_jual,$isEdit=null)
    {
        if($isEdit==null){
            $data_trx = array(
                'deskripsi'     => 'Penjualan Obat dari Nomor Pemeriksaan '.$no_periksa,
                'tanggal'       => date('Y-m-d'),
            );
            $insert = $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi', $data_trx);
        }
        else{
            $insert = true;
        }
        if ($insert) {
            if($isEdit==null){
                $id_last = $this->db->select_max('id_trx_akun')->from('tbl_trx_akuntansi')->get()->row();

                // //hpp (tanpa diskon)
                // $data = array(
                //     'id_trx_akun'   => $id_last->id_trx_akun,
                //     'id_akun'       => 65,
                //     'jumlah'        => $total_jual,
                //     'tipe'          => 'DEBIT',
                //     'keterangan'    => 'lawan',
                // );
                // $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);

                //persediaan obat berkurang (tanpa diskon)
                $data = array(
                    'id_trx_akun'   => $id_last->id_trx_akun,
                    'id_akun'       => 58,
                    'jumlah'        => $total_jual,
                    'tipe'          => 'KREDIT',
                    'keterangan'    => 'akun',
                );
                $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);

                // if($subsidi_obat!=0){
                //     //diskon untuk penjualan obat
                //     $data = array(
                //         'id_trx_akun'   => $id_last->id_trx_akun,
                //         'id_akun'       => 64,
                //         'jumlah'        => $subsidi_obat,
                //         'tipe'          => 'DEBIT',
                //         'keterangan'    => 'akun',
                //     );
                //     $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);
                // }
            }
            else{
                $this->db->select('id_trx_akun');
                $getIdTrx = $this->db->get_where('tbl_trx_akuntansi',['deskripsi' => 'Penjualan Obat dari Nomor Pemeriksaan ' . $no_periksa])->row();
                
                // $this->db->update('tbl_trx_akuntansi_detail',['jumlah' => $total_jual],['id_trx_akun' => $getIdTrx->id_trx_akun,'id_akun' => '65']);
                
                $this->db->update('tbl_trx_akuntansi_detail',['jumlah' => $total_jual],['id_trx_akun' => $getIdTrx->id_trx_akun,'id_akun' => '58']);
                
                
                // if($subsidi_obat!=0){
                //     $cekInsSubsidi = $this->db->get_where('tbl_trx_akuntansi_detail',['id_trx_akun' => $getIdTrx->id_trx_akun,'id_akun' => '64'])->num_rows();
                    
                //     if($cekInsSubsidi==0){
                //         $data = array(
                //             'id_trx_akun'   => $getIdTrx->id_trx_akun,
                //             'id_akun'       => 64,
                //             'jumlah'        => $subsidi_obat,
                //             'tipe'          => 'DEBIT',
                //             'keterangan'    => 'akun',
                //         );
                //         $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);
                //     }
                //     else{
                //         $this->db->update('tbl_trx_akuntansi_detail',['jumlah' => $subsidi_obat],['id_trx_akun' => $getIdTrx->id_trx_akun,'id_akun' => '64']);
                //     }
                // }
            }
        }
    }
    private function jurnal_otomatis_pemeriksaan($biaya_tindakan, $biaya_pemeriksaan, $no_periksa)
    {
        if ($biaya_pemeriksaan != 0 || $biaya_tindakan != 0) {
            $total = ($biaya_pemeriksaan != null ? $biaya_pemeriksaan : 0) + ($biaya_tindakan != null ? $biaya_tindakan : 0);
            $data_trx = array(
                'deskripsi'     => 'Pendapatan dari Nomor Pemeriksaan ' . $no_periksa,
                'tanggal'       => date('Y-m-d'),
            );
            $insert = $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi', $data_trx);
            if ($insert) {
                $id_last = $this->db->select_max('id_trx_akun')->from('tbl_trx_akuntansi')->get()->row();
                if ($biaya_tindakan != 0) {
                    $data = array(
                        'id_trx_akun'   => $id_last->id_trx_akun,
                        'id_akun'       => 63,
                        'jumlah'        => $biaya_tindakan,
                        'tipe'          => 'KREDIT',
                        'keterangan'    => 'akun',
                    );
                    $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);
                }
                if ($biaya_pemeriksaan != 0) {
                    $data = array(
                        'id_trx_akun'   => $id_last->id_trx_akun,
                        'id_akun'       => 62,
                        'jumlah'        => $biaya_pemeriksaan,
                        'tipe'          => 'KREDIT',
                        'keterangan'    => 'akun',
                    );
                    $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);
                }
                $data = array(
                    'id_trx_akun'   => $id_last->id_trx_akun,
                    'id_akun'       => 20,
                    'jumlah'        => $total,
                    'tipe'          => 'DEBIT',
                    'keterangan'    => 'lawan',
                );
                $this->Transaksi_akuntansi_model->insert('tbl_trx_akuntansi_detail', $data);
            }
        }
    }
    private function getIdAkun($id)
    {
        $getAkun = $this->db->where('id_akun', $id)->get('tbl_akun')->row();
        return $getAkun;
    }
    public function antrian()
    {
        $this->template->load('template', 'rekam_medis/antrian_list');
    }

    public function riwayat()
    {
        $this->template->load('template', 'rekam_medis/riwayat_periksamedis');
    }

    public function riwayat_detail($no_rekam_medis)
    {
        $data['no_rekam_medis'] = $no_rekam_medis;
        $this->template->load('template', 'rekam_medis/riwayat_periksamedis_detail', $data);
    }

    public function sksehat()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('umur', 'Umur', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'trim|required');
        $this->form_validation->set_rules('berat_badan', 'Berat Badan', 'trim|required');
        $this->form_validation->set_rules('golongan_darah', 'Golongan Darah', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('buta_warna', 'Buta Warna', 'trim|required');
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $this->load->model('Tbl_sksehat_model');
        $getLastNomor = $this->Tbl_sksehat_model->getLastNomor();
        $nomor = 1;
        if (count($getLastNomor) > 0) {
            $getNomor = explode('/', $getLastNomor[0]->nomor);
            if (count($getNomor) == 5) { // if kode format baru
                $nomor = (int)$getNomor[0] + 1;
            }
        }
        $data['nomor'] = sprintf("%04s", $nomor);
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post();
            $romawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
            $post['nomor'] = $this->input->post('nomor') . "/" . $romawi[date('n')] . "/KR/SH/" . date('y');
            $post['tgl_cetak'] = date('Y-m-d');
            $post['id_dokter'] = $this->id_dokter;
            $this->Tbl_sksehat_model->insert($post);

            //insert to transaksi
            //insert transaksi detail
            $tr = array(
                'kode_transaksi' => "SH",
                'id_klinik' => $this->id_klinik,
                'no_transaksi' => $post['nomor'],
                'tgl_transaksi' => date('Y-m-d'),
                'status_transaksi' => 0,
                'atas_nama' => $post['nama'],
            );
            $trDetail = array(
                [
                    'no_transaksi' => $post['nomor'],
                    'deskripsi' => 'Biaya Pemeriksaan',
                    'amount_transaksi' => biayaSK('sksehat'),
                    'dc' => 'd'
                ]
            );
            $this->Transaksi_model->insert($tr, $trDetail);
            //insert akuntansi
            //insert detail akuntansi
            $trAkuntansi = array(
                'deskripsi' => 'Biaya Pemeriksaan ' . $post['nomor'],
                'tanggal' => date('Y-m-d'),
            );

            $trAkuntansiDetail = array(
                [
                    'id_akun' => 62,
                    'jumlah' => biayaSK('sksehat'),
                    'tipe' => 'KREDIT',
                    'keterangan' => 'akun'
                ],
                [
                    'id_akun' => 20,
                    'jumlah' => biayaSK('sksehat'),
                    'tipe' => 'DEBIT',
                    'keterangan' => 'lawan'
                ],
            );
            $this->Transaksi_akuntansi_model->insertWithDetail($trAkuntansi, $trAkuntansiDetail);


            redirect(base_url() . "periksamedis/cetak_sksehat?nomor=" . $post['nomor']);
        } else {
            $this->template->load('template', 'rekam_medis/sksehat_form', $data);
        }

        // $this->load->view('rekam_medis/cetak_surat_ket_sehat');
    }

    public function cetak_sksehat()
    {
        $this->load->model('Tbl_sksehat_model');
        $data = $this->Tbl_sksehat_model->getDetail($_GET['nomor']);
        $data['jenis_kelamin'] = $data['jenis_kelamin'] == 'L' ? 'Laki Laki' : 'Perempuan';
        $this->load->view('rekam_medis/cetak_surat_ket_sehat', $data);
    }

    public function periksa($no_pend)
    {
        if ($this->id_dokter != 0) {
            $this->Tbl_dokter_model->update($this->id_dokter, array(
                "no_pendaftaran" => $no_pend,
                "dtm_upd" => date("Y-m-d H:i:s",  time())
            ));
        } else {
            $this->session->set_userdata(['no_pendaftaran' => $no_pend]);
        }
        if ($_GET['tipe'] == '1') {
            redirect(site_url('periksamedis/poli'));
        } else if ($_GET['tipe'] == '2') {
            redirect(site_url('periksamedis/rawat_inap/'));
        } else if ($_GET['tipe'] == '3') {
            redirect(site_url('periksamedis/operasi/'));
            // redirect(site_url('periksamedis/kontrol_kehamilan/'));
        } else if ($_GET['tipe'] == '4') {
            redirect(site_url('periksamedis/periksa_lab/'));
        } else if ($_GET['tipe'] == '5') {
            redirect(site_url('periksamedis/periksa_radiologi/'));
        }
    }
    public function periksa_jasa()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $date_now = date('Ymd', time());

        if (isset($data_pasien)) {
            $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
            $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
        }

        $this->data['no_periksa'] = $data_pendaftaran->no_pendaftaran . '/' . $date_now . '/' . $data_pendaftaran->no_rekam_medis;
        $this->data['jasa_lainnya'] = $this->db->get('tbl_tipe_periksa_jasa')->result();

        $this->template->load('template', 'periksa-jasa/periksa-jasa', $this->data);
    }
    public function save_periksa_jasa()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);

        $data_transaksi = array(
            'kode_transaksi' => 'PRKSJSA',
            'id_klinik' => $this->id_klinik,
            'no_transaksi' => $this->input->post('no_periksa'),
            'tgl_transaksi' => date('Y-m-d', time()),
            'status_transaksi' => 0,
        );

        $data_transaksi_d = array();
        $tindakan = "";
        foreach ($this->input->post('periksa_jasa') as $key => $value) {
            $this->db->select('item,harga');
            $jasa = $this->db->get_where('tbl_tipe_periksa_jasa', ['id_tipe' => $value])->row();
            $arr = array(
                'no_transaksi' => $data_transaksi['no_transaksi'],
                'deskripsi' => 'Biaya Tindakan ' . $jasa->item,
                'amount_transaksi' => $jasa->harga,
                'dc' => 'd'
            );
            array_push($data_transaksi_d, $arr);
            $tindakan .= $jasa->item . ";";
        }

        $periksa = array(
            'no_periksa' => $this->input->post('no_periksa'),
            'no_pendaftaran' => $this->no_pendaftaran,
            'no_rekam_medis' => $data_pendaftaran->no_rekam_medis,
            'tindakan' => $tindakan,
            'is_surat_ket_sakit' => 0,
            'id_dokter' => $this->id_dokter,
            'is_ambil_obat' => 0,
        );
        $this->db->insert('tbl_periksa', $periksa);

        $this->Transaksi_model->insert($data_transaksi, $data_transaksi_d);

        //Set status pendaftaran is_periksa = 1
        $this->Pendaftaran_model->update($this->no_pendaftaran, array(
            'is_periksa' => 1,
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        ));

        //Get Next Antrian
        $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
        $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
        $this->Tbl_dokter_model->update($this->id_dokter, array(
            "no_pendaftaran" => $next_antrian,
            "dtm_upd" => date("Y-m-d H:i:s",  time())
        ));

        //Set session sukses
        $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');

        redirect(site_url('periksamedis'));
    }
    public function periksa_lab()
    {
        $getIdPeriksaLanjutan = $this->Periksa_model->getIdPeriksaLanjutan($this->no_pendaftaran,'4'); 
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran->no_pendaftaran);
        $xa = explode("/", $nop->no_periksa, 2);

        if (isset($data_pasien)) {
            $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
            $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
        }

        // $this->data['no_periksa'] = $data_pendaftaran->no_pendaftaran . '/' . $date_now . '/' . $data_pendaftaran->no_rekam_medis;
        $getPeriksaLab = $this->Periksa_model->countPeriksaLanjutan($this->no_pendaftaran,'4');
        $newPeriksaLab = $getPeriksaLab+1;
        $kodePrks = $getPeriksaLab==0 ? 'PRKSLAB' : 'PRKSLAB'.$newPeriksaLab; 
        $this->data['no_periksa'] = $kodePrks. '/' . $xa[1];

        $this->data['periksa_lab'] = $this->db->get('tbl_tipe_periksa_lab')->result();
        $this->data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 1);
        $this->data['tindakan'] = $this->db->get('tbl_tindakan')->result();
        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);
        $this->data['biaya'] = $this->Tbl_biaya_model->getBiaya();        
        $this->template->load('template', 'periksa-lab/periksa-lab', $this->data);
    }
    public function newItemLab()
    {
        $this->data['periksa_lab'] = $this->db->get('tbl_tipe_periksa_lab')->result();
        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);
        $this->data['no'] = $_GET['no'];
        $this->load->view('periksa-lab/loop-pilihan-lab', $this->data);
    }

    public function jenisOpr(){
        $this->data['operasi'] = $this->Tbl_jenis_operasi_model->getIdOperasi($_GET['id_jenis']);
        echo json_encode($this->data['operasi']);
    }

    public function save_periksa_lab()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran->no_pendaftaran);
        $xa = explode("/", $nop->no_periksa, 2);
        $no_rm = 'PRKSLAB' . '/' . $xa[1];

        $data_transaksi_d = array();

        //insert periksa lab
        $periksaLab = array(
            'no_pendaftaran' => $this->no_pendaftaran,
            'no_periksa' => $this->input->post('no_periksa'),
        );
        $this->db->insert('tbl_periksa_lab', $periksaLab);
        foreach ($this->input->post('periksa_lab') as $key => $value) {
            $this->db->select('item,harga');
            $lab = $this->db->get_where('tbl_tipe_periksa_lab', ['id_tipe' => $value])->row();

            $this->db->select('max(id_periksa_lab) lastId');
            $lastIdTlab = $this->db->get('tbl_periksa_lab')->row();

            $periksaLabDetail = array(
                'id_periksa_lab' => $lastIdTlab->lastId,
                'id_tipe' => $value,
                'biaya' => $lab->harga,
                'hasil' => $_POST['hasil'][$key],
            );
            $this->db->insert('tbl_periksa_lab_detail', $periksaLabDetail);
        }

        $getIdPeriksaLanjutan = $this->Periksa_model->getIdPeriksaLanjutan($this->no_pendaftaran,'4'); 

        // input inventory barang
        $kode_receipt1 = 'RCP' . time();
        $tb_inv1 = array(
            'id_inventory'  => $kode_receipt1,
            'inv_type'      => 'TRX_STUFF',
            'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
            'id_klinik'     => $this->id_klinik,
        );
        $this->Transaksi_obat_model->insert('tbl_inventory', $tb_inv1);

        //periksa_d_obat
        foreach ($_POST['kode_obat'] as $key => $value) {
            $det_inv1 = array(
                'id_inventory' => $kode_receipt1,
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_obat'][$key],
                'harga' => $_POST['harga_obat'][$key],
            );
            $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);
            
            $periksa_d_obat = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_obat'][$key],
                'harga_satuan' => $_POST['harga_obat'][$key],
                'tipe_periksa' => '4',
            );
            $this->db->insert('tbl_periksa_d_obat',$periksa_d_obat);
        }

        //periksa_d_alkes
        foreach ($_POST['kode_alkes'] as $key => $value) {
            $det_inv1 = array(
                'id_inventory' => $kode_receipt1,
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_alkes'][$key],
                'harga' => $_POST['harga_alkes'][$key],
            );
            $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);
            
            $periksa_d_alkes = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_alkes'][$key],
                'harga_satuan' => $_POST['harga_alkes'][$key],
                'tipe_periksa' => '4',
            );
            $this->db->insert('tbl_periksa_d_alkes',$periksa_d_alkes);
        }

        //d_periksa_tindakan
        foreach ($_POST['tindakan'] as $key => $value) {
            $periksa_d_tindakan = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_tindakan' => $value,
                'jumlah' => $_POST['qty_tindakan'][$key],
                'biaya' => $_POST['biaya_tindakan'][$key],
                'tipe_periksa' => '4',
            );
            $this->db->insert('tbl_periksa_d_tindakan',$periksa_d_tindakan);
        }

        //d_periksa_biaya
        foreach ($_POST['id_biaya'] as $key => $value) {
            $periksa_d_biaya = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'id_biaya' => $value,
                'jumlah' => $_POST['qty_biaya'][$key],
                'biaya' => $_POST['biaya'][$key],
                'tipe_periksa' => '4',
            );
            $this->db->insert('tbl_periksa_d_biaya',$periksa_d_biaya);
        }
        
        $updatePendaftaran = array(
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        );

        $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '0'], ['no_pendaftaran' => $this->no_pendaftaran]);
        if ($_POST['pemeriksaan_selanjutnya'] != '0') {
            if($_POST['pemeriksaan_selanjutnya']=='4'){ // jika tetap di Laboratorium
                $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '1'], ['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => $_POST['pemeriksaan_selanjutnya']]);
            }
            else{
                $periksaLanjutan = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'tipe_periksa' => $_POST['pemeriksaan_selanjutnya'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'is_periksa' => '1',
                );
                $this->db->insert('tbl_periksa_lanjutan', $periksaLanjutan);
            }
        } else {
            $updatePendaftaran['is_closed'] = '1';
        }

        $this->Pendaftaran_model->update($this->no_pendaftaran, $updatePendaftaran);
        
        // TRANSAKSI
        $data_transaksi = array(
            'kode_transaksi' => 'PRKSLAB',
            'id_klinik' => $this->id_klinik,
            'no_transaksi' => $this->input->post('no_periksa'),
            'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
            'tgl_transaksi' => date('Y-m-d', time()),
            'status_transaksi' => 0,
        );
        $this->db->insert('tbl_transaksi', $data_transaksi);

        $lastIdLab = $this->db->select_max('id_transaksi')->from('tbl_transaksi')->get()->row();
        if($_POST['totalLab']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdLab->id_transaksi,
                'deskripsi' => 'Biaya Periksa Lab',
                'amount_transaksi' => $_POST['totalLab'],
                'dc' => 'd'
            );
        }
        
        if($_POST['totalObat']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdLab->id_transaksi,
                'deskripsi' => 'Biaya Obat',
                'amount_transaksi' => $_POST['totalObat'],
                'dc' => 'd'
            );
        }
        
        if($_POST['totalAlkes']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdLab->id_transaksi,
                'deskripsi' => 'Biaya BMHP',
                'amount_transaksi' => $_POST['totalAlkes'],
                'dc' => 'd'
            );
        }

        if($_POST['totalTindakan']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdLab->id_transaksi,
                'deskripsi' => 'Biaya Tindakan',
                'amount_transaksi' => $_POST['totalTindakan'],
                'dc' => 'd'
            );
        }
        
        if($_POST['totalBiaya']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdLab->id_transaksi,
                'deskripsi' => 'Biaya Lainnya',
                'amount_transaksi' => $_POST['totalBiaya'],
                'dc' => 'd'
            );
        }

        for($i = 0; $i < count($data_transaksi_d); $i++){
            $this->db->insert('tbl_transaksi_d',$data_transaksi_d[$i]);
        }

        //insert akuntansi
        $this->jurnal_otomatis_alkes($_POST['totalAlkes'],$data_transaksi['id_transaksi']);
        $hpp = $_POST['totalObat']+$_POST['totalAlkes'];
        $this->jurnal_otomatis_obat($hpp,$data_transaksi['id_transaksi'],$_POST['totalObat']);
        
        
        if($_POST['pemeriksaan_selanjutnya']=='0'){
            //Get Next Antrian
            $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
            $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
            $this->Tbl_dokter_model->update($this->id_dokter, array(
                "no_pendaftaran" => $next_antrian,
                "dtm_upd" => date("Y-m-d H:i:s",  time())
            ));
        }


        //Set session sukses
        $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');

        redirect(site_url('periksamedis'));
    }

    public function periksa_radiologi()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran->no_pendaftaran);
        $xr = explode("/", $nop->no_periksa, 2);
        $xf = 'PRKSRAD' . '/' . $xr[1];

        if (isset($data_pasien)) {
            $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
            $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
        }
        // $this->data['no_periksa'] = $data_pendaftaran->no_pendaftaran . '/' . $date_now . '/' . $data_pendaftaran->no_rekam_medis;
        $getPeriksaRad = $this->Periksa_model->countPeriksaLanjutan($this->no_pendaftaran,'5');
        $newPeriksaRad = $getPeriksaRad+1;
        $kodePrks = $getPeriksaRad==0 ? 'PRKSRAD' : 'PRKSRAD'.$newPeriksaRad;

        $this->data['no_periksa'] =  $kodePrks.'/'. $xr[1];
        // $this->data['no_periksa'] = $this->Tbl_pasien_model->get_detail_by_h_id($nop->no_pendaftaran);


        $this->data['periksa_radiologi'] = $this->db->get('tbl_tipe_periksa_radiologi')->result();
        $this->data['periksa_radiologi'] = $this->db->get('tbl_tipe_periksa_radiologi')->result();
        $this->data['biaya'] = $this->Tbl_biaya_model->getBiaya();
        $this->data['tindakan'] = $this->db->get('tbl_tindakan')->result();
        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);
        $this->data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 1);

        $this->template->load('template', 'periksa-radiologi/periksa-radiologi', $this->data);
    }

    public function newItemRadiologi()
    {
        $this->data['periksa_radiologi'] = $this->db->get('tbl_tipe_periksa_radiologi')->result();
        $this->data['no'] = $_GET['no'];
        $this->load->view('periksa-radiologi/loop-pilihan-radiologi', $this->data);
    }

    public function save_periksa_radiologi(){
        $data_pendaftaran_radiologi = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran_radiologi->no_pendaftaran);        

        // insert periksa radiologi
        $periksaRadiologi = array(
            'no_pendaftaran' => $this->no_pendaftaran,
            'no_periksa' => $this->input->post('no_periksa'),
        );
        $this->db->insert('tbl_periksa_radiologi', $periksaRadiologi);
        
        // insert periksa radiologi detail
        foreach ($this->input->post('periksa_radiologi') as $key => $value) {
            $this->db->select('item,harga');
            $radiologi = $this->db->get_where('tbl_tipe_periksa_radiologi', ['id_tipe' => $value])->row();

            $this->db->select('max(id_periksa_radiologi) lastId');
            $lastIdRad = $this->db->get('tbl_periksa_radiologi')->row();
            $periksaRadiologi = array(
                'id_periksa_radiologi' => $lastIdRad->lastId,
                'id_tipe' => $value,
                'biaya' => $radiologi->harga,
                'hasil' => $_POST['hasil'][$key],
            );
            $this->db->insert('tbl_periksa_radiologi_detail', $periksaRadiologi);
        }

        $getIdPeriksaLanjutan = $this->Periksa_model->getIdPeriksaLanjutan($this->no_pendaftaran,'5'); 
        // insert inventory barang
        $kode_receipt1 = 'RCP' . time();
        $tb_inv1 = array(
            'id_inventory'  => $kode_receipt1,
            'inv_type'      => 'TRX_STUFF',
            'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
            'id_klinik'     => $this->id_klinik,
        );
        $this->Transaksi_obat_model->insert('tbl_inventory', $tb_inv1);

        // periksa d_obat
        foreach ($_POST['kode_obat'] as $key => $value) {
            $det_inv1 = array(
                'id_inventory' => $kode_receipt1,
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_obat'][$key],
                'harga' => $_POST['harga_obat'][$key],
            );
            $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);

            $periksa_d_obat = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_obat'][$key],
                'harga_satuan' => $_POST['harga_obat'][$key],
                'tipe_periksa' => '5',
            );
            $this->db->insert('tbl_periksa_d_obat',$periksa_d_obat);
        }

        // periksa d_alkes
        foreach ($_POST['kode_alkes'] as $key => $value) {
            $det_inv1 = array(
                'id_inventory' => $kode_receipt1,
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_alkes'][$key],
                'harga' => $_POST['harga_alkes'][$key],
            );
            $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);
            
            $periksa_d_alkes = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_alkes'][$key],
                'harga_satuan' => $_POST['harga_alkes'][$key],
                'tipe_periksa' => '5',
            );
            $this->db->insert('tbl_periksa_d_alkes',$periksa_d_alkes);
        }

        //d_periksa_tindakan
        foreach ($_POST['tindakan'] as $key => $value) {
            $periksa_d_tindakan = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_tindakan' => $value,
                'jumlah' => $_POST['qty_tindakan'][$key],
                'biaya' => $_POST['biaya_tindakan'][$key],
                'tipe_periksa' => '5',
            );
            $this->db->insert('tbl_periksa_d_tindakan',$periksa_d_tindakan);
        }

        //d_periksa_biaya
        foreach ($_POST['id_biaya'] as $key => $value) {
            $periksa_d_biaya = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'id_biaya' => $value,
                'jumlah' => $_POST['qty_biaya'][$key],
                'biaya' => $_POST['biaya'][$key],
                'tipe_periksa' => '5',
            );
            $this->db->insert('tbl_periksa_d_biaya',$periksa_d_biaya);
        }

        $updatePendaftaran = array(
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        );

        $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '0'], ['no_pendaftaran' => $this->no_pendaftaran]);
        if ($_POST['pemeriksaan_selanjutnya'] != '0') {
            if($_POST['pemeriksaan_selanjutnya']=='5'){ // jika tetap di radiologi
                $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '1'], ['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => $_POST['pemeriksaan_selanjutnya']]);
            }
            else{
                $periksaLanjutan = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'tipe_periksa' => $_POST['pemeriksaan_selanjutnya'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'is_periksa' => '1',
                );
                $this->db->insert('tbl_periksa_lanjutan', $periksaLanjutan);
            }
        } else {
            $updatePendaftaran['is_closed'] = '1';
        }

        $this->Pendaftaran_model->update($this->no_pendaftaran, $updatePendaftaran);

        // TRANSAKSI
        $data_transaksi = array(
            'kode_transaksi' => 'PRKSRAD',
            'id_klinik' => $this->id_klinik,
            'no_transaksi' => $this->input->post('no_periksa'),
            'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
            'tgl_transaksi' => date('Y-m-d', time()),
            'status_transaksi' => 0,
        );
        $this->db->insert('tbl_transaksi', $data_transaksi);

        $data_transaksi_d = array();

        $lastId = $this->db->select_max('id_transaksi')->from('tbl_transaksi')->get()->row();
        if($_POST['totalRadiologi']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastId->id_transaksi,
                'deskripsi' => 'Biaya Periksa Radiologi',
                'amount_transaksi' => $_POST['totalRadiologi'],
                'dc' => 'd'
            );
        }
        
        if($_POST['totalObat']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastId->id_transaksi,
                'deskripsi' => 'Biaya Obat',
                'amount_transaksi' => $_POST['totalObat'],
                'dc' => 'd'
            );
        }
        
        if($_POST['totalAlkes']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastId->id_transaksi,
                'deskripsi' => 'Biaya BMHP',
                'amount_transaksi' => $_POST['totalAlkes'],
                'dc' => 'd'
            );
        }

        if($_POST['totalTindakan']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastId->id_transaksi,
                'deskripsi' => 'Biaya Tindakan',
                'amount_transaksi' => $_POST['totalTindakan'],
                'dc' => 'd'
            );
        }
        
        if($_POST['totalBiaya']!=0){
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastId->id_transaksi,
                'deskripsi' => 'Biaya Lainnya',
                'amount_transaksi' => $_POST['totalBiaya'],
                'dc' => 'd'
            );
        }

        for($i = 0; $i < count($data_transaksi_d); $i++){
            $this->db->insert('tbl_transaksi_d',$data_transaksi_d[$i]);
        }

        //insert akuntansi
        $hpp = $_POST['totalObat']+$_POST['totalAlkes'];
        $this->jurnal_otomatis_alkes($_POST['totalAlkes'],$data_transaksi['no_transaksi']);
        $this->jurnal_otomatis_obat($hpp,$data_transaksi['no_transaksi'],$_POST['totalObat']);
        

        if($_POST['pemeriksaan_selanjutnya']=='0'){
        //Get Next Antrian
        $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
        $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
        $this->Tbl_dokter_model->update($this->id_dokter, array(
            "no_pendaftaran" => $next_antrian,
            "dtm_upd" => date("Y-m-d H:i:s",  time())
        ));
    }


        //Set session sukses
        $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');

        redirect(site_url('periksamedis'));
    }

    public function newItemLoopObat()
    {
        $this->data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 1);
        $this->data['no'] = $_GET['no'];
        $this->load->view('loop/loop-pilihan-obat', $this->data);
    }

    public function newItemLoopAlkes()
    {
        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);
        $this->data['no'] = $_GET['no'];
        $this->load->view('loop/loop-pilihan-alkes', $this->data);
    }

    public function newItemLoopTindakan()
    {
        $this->data['tindakan'] = $this->db->get('tbl_tindakan')->result();
        $this->data['no'] = $_GET['no'];
        if(isset($_GET['isPoli'])){
            $this->data['isPoli'] = true;
        }
        $this->load->view('loop/loop-pilihan-tindakan', $this->data);
    }

    public function operasi()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran->no_pendaftaran);
        $xr = explode("/", $nop->no_periksa, 2);
        if (isset($data_pasien)) {
            $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
            $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
        }

        // $this->data['no_periksa'] = $data_pendaftaran->no_pendaftaran . '/' . $date_now . '/' . $data_pendaftaran->no_rekam_medis;
        $getPeriksaOperasi = $this->Periksa_model->countPeriksaLanjutan($this->no_pendaftaran,'3');
        $newPeriksaOpr = $getPeriksaOperasi+1;
        $kodePrks = $getPeriksaOperasi==0 ? 'PRKSOPR' : 'PRKSOPR'.$newPeriksaOpr;

        $this->data['no_periksa'] = $kodePrks. '/' . $xr[1];;
        $this->data['tindakan'] = $this->db->get('tbl_tindakan')->result();
        $this->data['jenis'] = $this->db->get('tbl_jenis_operasi')->result();
        $this->data['operasi'] = $this->Tbl_jenis_operasi_model->getBiayaOperasi();
        $this->data['last'] = $this->Tbl_jenis_operasi_model->maxId();
        $this->data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 1);
        $this->data['biaya'] = $this->Tbl_biaya_model->getBiaya();
        $this->data['alat'] = $this->Tbl_alat_operasi_model->get_all();
        $this->data['ruangan'] = $this->Tbl_ruangan_operasi_model->getRoomEmpty();
        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);
        $this->template->load('template', 'operasi/operasi', $this->data);
    }

    public function save_periksa_operasi()
    {
        $data_pendaftaran_operasi = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran_operasi->no_pendaftaran);
        
        
        // insert periksa operasi
        foreach ($this->input->post('periksa_operasi') as $key => $value) {
            $periksaOperasi = array(
            'no_pendaftaran' => $this->no_pendaftaran,
            'no_periksa' => $this->input->post('no_periksa'),
            'id_jenis_operasi' => $value,
            'id_ruangan' => $_POST['ruangan'][$key],
            'biaya_ok' => $this->input->post('biaya_ok'),
            );
            // $roomEmpty = $this->Tbl_ruangan_operasi_model->get_by_id($_POST['ruangan'][$key]);
            // $updateRoom = array(
            //     'status' => '1',
            // );
        $this->db->insert('tbl_periksa_operasi', $periksaOperasi);
        // $this->Tbl_ruangan_operasi_model->update($roomEmpty->id, $updateRoom);
        }
        
        $getIdPeriksaLanjutan = $this->Periksa_model->getIdPeriksaLanjutan($this->no_pendaftaran,'3'); 
        // insert inventory barang
        $kode_receipt1 = 'RCP' . time();
        $tb_inv1 = array(
            'id_inventory' => $kode_receipt1,
            'inv_type' => 'TRX_STUFF',
            'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
            'id_klinik' => $this->id_klinik,
        );
        $this->Transaksi_obat_model->insert('tbl_inventory', $tb_inv1);
        
        // periksa d_obat
        foreach ($_POST['kode_obat'] as $key => $value) {
            $det_inv1 = array(
                'id_inventory' => $kode_receipt1,
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_obat'][$key],
                'harga' => $_POST['harga_obat'][$key],
            );
        $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);
        
            $periksa_d_obat = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_obat'][$key],
                'harga_satuan' => $_POST['harga_obat'][$key],
                'tipe_periksa' => '3',
            );
        $this->db->insert('tbl_periksa_d_obat', $periksa_d_obat);
        }
        
        // periksa d_alkes
        foreach ($_POST['kode_alkes'] as $key => $value) {
            $det_inv1 = array(
                'id_inventory' => $kode_receipt1,
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_alkes'][$key],
                'harga' => $_POST['harga_alkes'][$key],
            );
        $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);
        
        $periksa_d_alkes = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_alkes'][$key],
                'harga_satuan' => $_POST['harga_alkes'][$key],
                'tipe_periksa' => '3',
            );
        $this->db->insert('tbl_periksa_d_alkes', $periksa_d_alkes);
        }
        
        //d_periksa_alat
        foreach ($_POST['id_alat'] as $key => $value) {
            $periksa_d_alat = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'id_alat' => $value,
                'jumlah' => $_POST['qty_alat'][$key],
            );
            // $getIdAlat = $this->Tbl_alat_operasi_model->get_by_id($value);
            $this->db->insert('tbl_periksa_operasi_d_alat',$periksa_d_alat);
            // $stockUpdate = array(
            //     'stok_terpakai' => $getIdAlat->stok_terpakai + $_POST['qty_alat'][$key],
            //     'stok_tidak_terpakai' => $getIdAlat->stok_tidak_terpakai - $_POST['qty_alat'][$key],
            // );
            // $this->Tbl_alat_operasi_model->update($getIdAlat->id, $stockUpdate);
        }
        
        //d_periksa_biaya
        foreach ($_POST['id_biaya'] as $key => $value) {
            $periksa_d_biaya = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
                'id_biaya' => $value,
                'jumlah' => $_POST['qty_biaya'][$key],
                'biaya' => $_POST['biaya'][$key],
                'tipe_periksa' => '3',
            );
        $this->db->insert('tbl_periksa_d_biaya', $periksa_d_biaya);
        }

        $updatePendaftaran = array(
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        );

        $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '0'], ['no_pendaftaran' => $this->no_pendaftaran]);
        if ($_POST['pemeriksaan_selanjutnya'] != '0') {
            if($_POST['pemeriksaan_selanjutnya']=='3'){ // jika tetap di Operasi
                $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '1'], ['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => $_POST['pemeriksaan_selanjutnya']]);
            }
            else{
                $periksaLanjutan = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'tipe_periksa' => $_POST['pemeriksaan_selanjutnya'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'is_periksa' => '1',
                );
                $this->db->insert('tbl_periksa_lanjutan', $periksaLanjutan);
            }
        } else {
            $updatePendaftaran['is_closed'] = '1';
        }
        
        $this->Pendaftaran_model->update($this->no_pendaftaran, $updatePendaftaran);

                // TRANSAKSI
        $data_transaksi = array(
            'kode_transaksi' => 'PRKSOPR',
            'id_klinik' => $this->id_klinik,
            'no_transaksi' => $this->input->post('no_periksa'),
            'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
            'tgl_transaksi' => date('Y-m-d', time()),
            'status_transaksi' => 0,
        );
        $this->db->insert("tbl_transaksi",$data_transaksi);

        $data_transaksi_d = array();
        
        $lastIdOpr = $this->db->select_max('id_transaksi')->from('tbl_transaksi')->get()->row();
        if ($_POST['totalObat'] != 0) {
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdOpr->id_transaksi,
                'deskripsi' => 'Biaya Obat',
                'amount_transaksi' => $_POST['totalObat'],
                'dc' => 'd'
            );
        }
        
        if ($_POST['totalAlkes'] != 0) {
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdOpr->id_transaksi,
                'deskripsi' => 'Biaya BMHP',
                'amount_transaksi' => $_POST['totalAlkes'],
                'dc' => 'd'
            );  
        }
        
        if ($_POST['biaya_ok'] != 0) {
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdOpr->id_transaksi,
                'deskripsi' => 'Biaya OK',
                'amount_transaksi' => $_POST['biaya_ok'],
                'dc' => 'd'
            );
        }
        
        if ($_POST['totalBiaya'] != 0) {
            $data_transaksi_d[] = array(
                'id_transaksi' => $lastIdOpr->id_transaksi,
                'deskripsi' => 'Biaya Lainnya',
                'amount_transaksi' => $_POST['totalBiaya'],
                'dc' => 'd'
            );
        }

        for($i = 0; $i < count($data_transaksi_d); $i++){
            $this->db->insert('tbl_transaksi_d',$data_transaksi_d[$i]);
        }
        
        
        //insert akuntansi
        $hpp = $_POST['totalObat']+$_POST['totalAlkes'];

        $this->jurnal_otomatis_alkes($_POST['totalAlkes'], $data_transaksi['no_transaksi']);
        $this->jurnal_otomatis_obat($hpp,$data_transaksi['no_transaksi'], $_POST['totalObat']);
        
        
        
        if($_POST['pemeriksaan_selanjutnya']=='0'){
        //Get Next Antrian
        $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
        $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
        $this->Tbl_dokter_model->update($this->id_dokter, array(
            "no_pendaftaran" => $next_antrian,
            "dtm_upd" => date("Y-m-d H:i:s", time())
        ));
    }
        
        
        //Set session sukses
        $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');
        
        redirect(site_url('periksamedis'));
    }
    public function getKamarByKategori()
    {
        $status=isset($_GET['status']) ? $_GET['status'] : 0;
        $kategori = $_GET['id_kategori'];
        echo json_encode($this->Tbl_kamar_model->getKamarByKategori($status,$kategori));
    }

    public function rawat_inap()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran->no_pendaftaran);
        $xa = explode("/", $nop->no_periksa, 2);

        if (isset($data_pasien)) {
            $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
            $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
        }

        $cekRawatInap = $this->db->get_where('tbl_periksa_rawat_inap',['no_pendaftaran' => $this->no_pendaftaran])->num_rows();
        if($cekRawatInap==1){
            $this->data['getKamar'] = $this->Periksa_model->oldKamarRawatInap($this->no_pendaftaran);
            
            $this->data['getBiaya'] = $this->Periksa_model->oldBiaya($this->no_pendaftaran,'2');

            $this->data['getTindakan'] = $this->Periksa_model->oldTindakan($this->no_pendaftaran,'2');
            
            $this->data['getObat'] = $this->Periksa_model->oldObat($this->no_pendaftaran,'2');

            $this->data['getAlkes'] = $this->Periksa_model->oldAlkes($this->no_pendaftaran,'2');
            
            $this->data['edit'] = true;
        }
        else{
            $this->data['edit'] = false;
        }
        $this->data['no_periksa'] = 'PRKSRAI' . '/' . $xa[1];

        $this->data['biaya'] = $this->Tbl_biaya_model->getBiaya();
        $this->data['kamar'] = $this->db->get('tbl_kategori_kamar')->result();
        $this->data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 1);
        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);
        $this->data['tindakan'] = $this->db->get('tbl_tindakan')->result();
        $this->template->load('template', 'rawat-inap/rawat-inap', $this->data);
    }
    public function save_rawat_inap()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $date_now = date('Ymd', time());
        $nop = $this->Periksa_model->getId($data_pendaftaran->no_pendaftaran);
        $no_rm = 'PRKSRAI' . '/' . $nop->no_periksa;

        if(empty($_POST['isEdit'])){
            //insert periksa lab
            $periksaRawatInap = array(
                'no_pendaftaran' => $this->no_pendaftaran,
                'no_periksa' => $this->input->post('no_periksa'),
            );
            $this->db->insert('tbl_periksa_rawat_inap', $periksaRawatInap);

            $this->db->select('max(id_periksa_rawat_inap) lastId');
            $getLastId = $this->db->get('tbl_periksa_rawat_inap')->row();

            $lastIdRawatInap = $getLastId->lastId;
        }
        else{
            $this->db->select('id_periksa_rawat_inap');
            $getIdPeriksaRawatInap = $this->db->get_where('tbl_periksa_rawat_inap',['no_pendaftaran' => $this->no_pendaftaran])->row();
            $lastIdRawatInap = $getIdPeriksaRawatInap->id_periksa_rawat_inap;
        }
        $getIdPeriksaLanjutan = $this->Periksa_model->getIdPeriksaLanjutan($this->no_pendaftaran,'2'); 

        $data_transaksi = array(
            'kode_transaksi' => 'PRKSRAI',
            'id_klinik' => $this->id_klinik,
            'no_transaksi' => $this->input->post('no_periksa'),
            'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
            'tgl_transaksi' => date('Y-m-d', time()),
            'status_transaksi' => 0,
        );

        //insert rwawat inap detail  (old and new)
        if(isset($_POST['id_kamar'])){
            foreach ($this->input->post('id_kamar') as $key => $value) {
                $periksaRawatInapDetail = array(
                    'id_periksa_rawat_inap' => $lastIdRawatInap,
                    'id_kamar' => $value,
                    'biaya_per_hari' => $_POST['harga_kamar'][$key],
                    'jml_hari' => $_POST['hari'][$key],
                );
                $this->db->insert('tbl_periksa_rawat_inap_detail', $periksaRawatInapDetail);

                $this->db->update('tbl_kamar',['status' => '1'],['id_kamar' => $value]);
            }
        }

        //update id_kamar (old only)
        if(isset($_POST['upd_id_kamar_id'])){
            foreach ($_POST['upd_id_kamar_id'] as $key => $value) {
                $this->db->update('tbl_periksa_rawat_inap_detail',['id_kamar' => $_POST['upd_id_kamar_val'][$key]],['id_detail' => $value]);
            }
        }

        //update jml hari (old only)
        if(isset($_POST['upd_jml_hari_id'])){
            foreach ($_POST['upd_jml_hari_id'] as $key => $value) {
                $this->db->update('tbl_periksa_rawat_inap_detail',['biaya_per_hari' => $_POST['old_harga_kamar'][$key],'jml_hari' => $_POST['upd_jml_hari_val'][$key]],['id_detail' => $value]);
            }
        }
        
        //delete rawat inap detail  (old only)
        if(isset($_POST['del_id_detail_rawat_inap'])){
            foreach ($_POST['del_id_detail_rawat_inap'] as $key => $value) {
                $this->db->delete('tbl_periksa_rawat_inap_detail',['id_detail' => $value]);
            }
        }

        // input inventory barang
        if(empty($_POST['isEdit'])){
            $kode_receipt1 = 'RCP' . time();
            $tb_inv1 = array(
                'id_inventory'  => $kode_receipt1,
                'inv_type'      => 'TRX_STUFF',
                'id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa,
                'id_klinik'     => $this->id_klinik,
            );
            $this->Transaksi_obat_model->insert('tbl_inventory', $tb_inv1);
        }
        else{
            $this->db->select('id_inventory');
            $getKodeReceipt = $this->db->get_where('tbl_inventory',['id_periksa_lanjutan' => $getIdPeriksaLanjutan->id_periksa])->row();
            // print_r($getKodeReceipt);
            $kode_receipt1 = $getKodeReceipt->id_inventory;
        }
        
        //insert periksa_d_obat (old and new)
        if(isset($_POST['kode_obat'])){
            foreach ($_POST['kode_obat'] as $key => $value) {
                $det_inv1 = array(
                    'id_inventory' => $kode_receipt1,
                    'kode_barang' => $value,
                    'jumlah' => $_POST['jml_obat'][$key],
                    'harga' => $_POST['harga_obat'][$key],
                );
                $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);
                
                $periksa_d_obat = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'no_periksa' => $data_transaksi['no_transaksi'],
                    'kode_barang' => $value,
                    'jumlah' => $_POST['jml_obat'][$key],
                    'harga_satuan' => $_POST['harga_obat'][$key],
                    'tipe_periksa' => '2',
                );
                $this->db->insert('tbl_periksa_d_obat',$periksa_d_obat);
            }
        }

        //update qty periksa obat (old only)
        if(isset($_POST['upd_qty_obat_id'])){
            foreach ($_POST['upd_qty_obat_id'] as $key => $value) {
                $jmlObat = $_POST['upd_qty_obat_val'][$key];
                $kodeObat = $_POST['upd_qty_obat_kode'][$key];
                $this->db->update('tbl_inventory_detail',['jumlah' => $jmlObat],['id_inventory' => $kode_receipt1,'kode_barang' => $kodeObat]);
                $this->db->update('tbl_periksa_d_obat',['jumlah' => $jmlObat],['id_periksa_d_obat' => $value]);
            }
        }
        
        //delete periksa obat (old only)
        if(isset($_POST['del_id_detail_obat'])){
            foreach ($_POST['del_id_detail_obat'] as $key => $value) {
                $kodeObat = $_POST['del_id_detail_obat_kode'][$key];
                $this->db->delete('tbl_inventory_detail',['id_inventory' => $kode_receipt1,'kode_barang' => $kodeObat]);
                $this->db->delete('tbl_periksa_d_obat',['id_periksa_d_obat' => $value]);
            }       
        }

        //insert periksa_d_alkes (old and new)
        if(isset($_POST['kode_alkes'])){
            foreach ($_POST['kode_alkes'] as $key => $value) {
                $det_inv1 = array(
                    'id_inventory' => $kode_receipt1,
                    'kode_barang' => $value,
                    'jumlah' => $_POST['jml_alkes'][$key],
                    'harga' => $_POST['harga_alkes'][$key],
                );
                $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);
                
                $periksa_d_alkes = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'no_periksa' => $data_transaksi['no_transaksi'],
                    'kode_barang' => $value,
                    'jumlah' => $_POST['jml_alkes'][$key],
                    'harga_satuan' => $_POST['harga_alkes'][$key],
                    'tipe_periksa' => '2',
                );
                $this->db->insert('tbl_periksa_d_alkes',$periksa_d_alkes);
            }
        }

        //update qty periksa obat (old only)
        if(isset($_POST['upd_qty_alkes_id'])){
            foreach ($_POST['upd_qty_alkes_id'] as $key => $value) {
                $jmlAlkes = $_POST['upd_qty_alkes_val'][$key];
                $kodeAlkes = $_POST['upd_qty_alkes_kode'][$key];
                $this->db->update('tbl_inventory_detail',['jumlah' => $jmlAlkes],['id_inventory' => $kode_receipt1,'kode_barang' => $kodeAlkes]);
                $this->db->update('tbl_periksa_d_alkes',['jumlah' => $jmlAlkes],['id_periksa_d_alkes' => $value]);
            }
        }
        
        //delete periksa Alkes (old only)
        if(isset($_POST['del_id_detail_alkes'])){
            foreach ($_POST['del_id_detail_alkes'] as $key => $value) {
                $kodeAlkes = $_POST['del_id_detail_alkes_kode'][$key];
                $this->db->delete('tbl_inventory_detail',['id_inventory' => $kode_receipt1,'kode_barang' => $kodeAlkes]);
                $this->db->delete('tbl_periksa_d_alkes',['id_periksa_d_alkes' => $value]);
            }       
        }

    
        //insert d_periksa_tindakan (old and new)
        if(isset($_POST['tindakan'])){
            foreach ($_POST['tindakan'] as $key => $value) {
                $periksa_d_tindakan = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'no_periksa' => $data_transaksi['no_transaksi'],
                    'kode_tindakan' => $value,
                    'jumlah' => $_POST['qty_tindakan'][$key],
                    'biaya' => $_POST['biaya_tindakan'][$key],
                    'tipe_periksa' => '2',
                );
                $this->db->insert('tbl_periksa_d_tindakan',$periksa_d_tindakan);
            }
        }

        //update d_periksa_tindakan (old only)
        if(isset($_POST['upd_qty_tindakan_id'])){
            foreach ($_POST['upd_qty_tindakan_id'] as $key => $value) {
                $this->db->update('tbl_periksa_d_tindakan',['jumlah' => $_POST['upd_qty_tindakan_val'][$key]],['id_periksa_d_tindakan' => $value]);
            }
        }

        //delete d_periksa_tindakan (old only)
        if(isset($_POST['del_id_detail_tindakan'])){
            foreach ($_POST['del_id_detail_tindakan'] as $key => $value) {
                $this->db->delete('tbl_periksa_d_tindakan',['id_periksa_d_tindakan' => $value]);
            }
        }

        // //d_periksa_tindakan (new only)
        // if(empty($_POST['isEdit'])){
        //     foreach ($_POST['tindakan'] as $key => $value) {
        //         $this->db->select('biaya');
        //         $tindakan = $this->db->get_where('tbl_tindakan',['kode_tindakan' => $value])->row();
        //         $periksa_d_tindakan = array(
        //             'no_pendaftaran' => $this->no_pendaftaran,
        //             'no_periksa' => $data_transaksi['no_transaksi'],
        //             'kode_tindakan' => $value,
        //             'biaya' => $tindakan->biaya,
        //             'tipe_periksa' => '2',
        //         );
        //         $this->db->insert('tbl_periksa_d_tindakan',$periksa_d_tindakan);
        //     }
        // }
        // else{ //d_periksa_tindakan (old only)
        //     if(isset($_POST['is_tindakan_update'])){
        //         foreach ($_POST['tindakan'] as $key => $value) {
        //             $cekTindakan = $this->db->get_where('tbl_periksa_d_tindakan',['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => '2','kode_tindakan' => $value])->num_rows();
        //             if($cekTindakan==0){
        //                 $this->db->select('biaya');
        //                 $tindakan = $this->db->get_where('tbl_tindakan',['kode_tindakan' => $value])->row();
        //                 $periksa_d_tindakan = array(
        //                     'no_pendaftaran' => $this->no_pendaftaran,
        //                     'no_periksa' => $data_transaksi['no_transaksi'],
        //                     'kode_tindakan' => $value,
        //                     'biaya' => $tindakan->biaya,
        //                     'tipe_periksa' => '2',
        //                 );
        //                 $this->db->insert('tbl_periksa_d_tindakan',$periksa_d_tindakan);
        //             }
        //         }
        //         $this->db->select('kode_tindakan');
        //         $getTindakanRawatInap =  $this->db->get_where('tbl_periksa_d_tindakan',['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => '2'])->result();

        //         foreach ($getTindakanRawatInap as $key => $value) {
        //             if(!in_array($value->kode_tindakan,$_POST['tindakan'])){
        //                 $this->db->delete('tbl_periksa_d_tindakan',['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => '2','kode_tindakan' => $value->kode_tindakan]);
        //             }
        //         }
        //     }
        // }

        //insert d_periksa_biaya (old and new)
        if(isset($_POST['id_biaya'])){
            foreach ($_POST['id_biaya'] as $key => $value) {
                $periksa_d_biaya = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'no_periksa' => $data_transaksi['no_transaksi'],
                    'id_biaya' => $value,
                    'jumlah' => $_POST['qty_biaya'][$key],
                    'biaya' => $_POST['biaya'][$key],
                    'tipe_periksa' => '2',
                );
                $this->db->insert('tbl_periksa_d_biaya',$periksa_d_biaya);
            }
        }

        //update d_periksa_biaya (old only)
        if(isset($_POST['upd_qty_biaya_id'])){
            foreach ($_POST['upd_qty_biaya_id'] as $key => $value) {
                $this->db->update('tbl_periksa_d_biaya',['jumlah' => $_POST['upd_qty_biaya_val'][$key]],['id_periksa_d_biaya' => $value]);
            }
        }

        //delete d_periksa_biaya (old only)
        if(isset($_POST['del_id_detail_biaya'])){
            foreach ($_POST['del_id_detail_biaya'] as $key => $value) {
                $this->db->delete('tbl_periksa_d_biaya',['id_periksa_d_biaya' => $value]);
            }
        }

        $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '0'], ['no_pendaftaran' => $this->no_pendaftaran]);

        $updatePendaftaran = array(
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        );
        
        if ($_POST['pemeriksaan_selanjutnya'] != '0') {
            if($_POST['pemeriksaan_selanjutnya']=='2'){ // jika tetap di rawat inap
                $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '1'], ['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => $_POST['pemeriksaan_selanjutnya']]);
            }
            else{
                $periksaLanjutan = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'tipe_periksa' => $_POST['pemeriksaan_selanjutnya'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'is_periksa' => '1',
                );
                $this->db->insert('tbl_periksa_lanjutan', $periksaLanjutan);
            }
        } else {
            $updatePendaftaran['is_closed'] = '1';
        }
        
        $this->Pendaftaran_model->update($this->no_pendaftaran, $updatePendaftaran);

        $data_transaksi_d = array();

        if(empty($_POST['isEdit'])){
            $this->db->insert('tbl_transaksi',$data_transaksi);
            $lastId = $this->db->select_max('id_transaksi')->from('tbl_transaksi')->get()->row();
            if($_POST['totalKamar']!=0){
                $data_transaksi_d[] = array(
                    'id_transaksi' => $lastId->id_transaksi,
                    'deskripsi' => 'Biaya Kamar Rawat Inap',
                    'amount_transaksi' => $_POST['totalKamar'],
                    'dc' => 'd'
                );
            }
            
            if($_POST['totalObat']!=0){
                $data_transaksi_d[] = array(
                    'id_transaksi' => $lastId->id_transaksi,
                    'deskripsi' => 'Biaya Obat',
                    'amount_transaksi' => $_POST['totalObat'],
                    'dc' => 'd'
                );
            }
            
            if($_POST['totalAlkes']!=0){
                $data_transaksi_d[] = array(
                    'id_transaksi' => $lastId->id_transaksi,
                    'deskripsi' => 'Biaya BMHP',
                    'amount_transaksi' => $_POST['totalAlkes'],
                    'dc' => 'd'
                );
            }
    
            if($_POST['totalTindakan']!=0){
                $data_transaksi_d[] = array(
                    'id_transaksi' => $lastId->id_transaksi,
                    'deskripsi' => 'Biaya Tindakan',
                    'amount_transaksi' => $_POST['totalTindakan'],
                    'dc' => 'd'
                );
            }
            
            if($_POST['totalBiaya']!=0){
                $data_transaksi_d[] = array(
                    'id_transaksi' => $lastId->id_transaksi,
                    'deskripsi' => 'Biaya Lainnya',
                    'amount_transaksi' => $_POST['totalBiaya'],
                    'dc' => 'd'
                );
            }

            for($i = 0; $i < count($data_transaksi_d); $i++){
                $this->db->insert('tbl_transaksi_d',$data_transaksi_d[$i]);
            }
        }
        else{
            $this->db->query("update tbl_transaksi_d td join tbl_transaksi t on td.id_transaksi = t.id_transaksi set td.amount_transaksi = '".$_POST['totalKamar']."' where t.id_periksa_lanjutan = '".$getIdPeriksaLanjutan->id_periksa."' and deskripsi = 'Biaya Kamar Rawat Inap' ");

            $this->db->query("update tbl_transaksi_d td join tbl_transaksi t on td.id_transaksi = t.id_transaksi set td.amount_transaksi = '".$_POST['totalObat']."' where t.id_periksa_lanjutan = '".$getIdPeriksaLanjutan->id_periksa."' and deskripsi = 'Biaya Obat' ");

            $this->db->query("update tbl_transaksi_d td join tbl_transaksi t on td.id_transaksi = t.id_transaksi set td.amount_transaksi = '".$_POST['totalAlkes']."' where t.id_periksa_lanjutan = '".$getIdPeriksaLanjutan->id_periksa."' and deskripsi = 'Biaya BMHP' ");

            $this->db->query("update tbl_transaksi_d td join tbl_transaksi t on td.id_transaksi = t.id_transaksi set td.amount_transaksi = '".$_POST['totalTindakan']."' where t.id_periksa_lanjutan = '".$getIdPeriksaLanjutan->id_periksa."' and deskripsi = 'Biaya Tindakan' ");

            $this->db->query("update tbl_transaksi_d td join tbl_transaksi t on td.id_transaksi = t.id_transaksi set td.amount_transaksi = '".$_POST['totalBiaya']."' where t.id_periksa_lanjutan = '".$getIdPeriksaLanjutan->id_periksa."' and deskripsi = 'Biaya Lainnya' ");
        }


        //insert akuntansi
        $paramJurnal = isset($_POST['isEdit']) ? 'edit' : null;
        $hpp = $_POST['totalObat']+$_POST['totalAlkes'];

        $this->jurnal_otomatis_alkes($_POST['totalAlkes'],$data_transaksi['no_transaksi'],$paramJurnal);
        $this->jurnal_otomatis_obat($hpp,$data_transaksi['no_transaksi'],$_POST['totalObat'],$paramJurnal);
        

        $updatePendaftaran = array(
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        );

        $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '0'], ['no_pendaftaran' => $this->no_pendaftaran]);
        if ($_POST['pemeriksaan_selanjutnya'] != '0') {
            if($_POST['pemeriksaan_selanjutnya']=='2'){ // jika tetap di rawat inap
                $this->db->update('tbl_periksa_lanjutan', ['is_periksa' => '1'], ['no_pendaftaran' => $this->no_pendaftaran,'tipe_periksa' => $_POST['pemeriksaan_selanjutnya']]);
            }
            else{
                $periksaLanjutan = array(
                    'no_pendaftaran' => $this->no_pendaftaran,
                    'tipe_periksa' => $_POST['pemeriksaan_selanjutnya'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'is_periksa' => '1',
                );
                $this->db->insert('tbl_periksa_lanjutan', $periksaLanjutan);
            }
        } else {
            $updatePendaftaran['is_closed'] = '1';
        }
        
        $this->Pendaftaran_model->update($this->no_pendaftaran, $updatePendaftaran);

        if($_POST['pemeriksaan_selanjutnya']=='0'){
            //Get Next Antrian
            $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
            $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
            $this->Tbl_dokter_model->update($this->id_dokter, array(
                "no_pendaftaran" => $next_antrian,
                "dtm_upd" => date("Y-m-d H:i:s",  time())
            ));
        }


        //Set session sukses
        $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');

        redirect(site_url('periksamedis'));


    }

    public function newItemRawatInap()
    {
        $this->data['no'] = $_GET['no'];
        $this->data['kamar'] = $this->db->get('tbl_kategori_kamar')->result();
        $this->load->view('rawat-inap/loop-pilihan-kamar', $this->data);
    }

    public function newItemBiaya()
    {
        $this->data['biaya'] = $this->Tbl_biaya_model->getBiaya();
        $this->data['no'] = $_GET['no'];
        $this->load->view('rawat-inap/loop-pilihan-biaya', $this->data);
    }

    public function imunisasi()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $fields = array('macam_persalinan', 'pelayanan_persalinan', 'anak_ke', 'tempat_persalinan', 'asi', 'hb0', 'bcg', 'polio1', 'pentabio1', 'polio2', 'pentabio2', 'polio3', 'pentabio3', 'polio4', 'campak', 'je', 'pentabio_booster', 'campak_booster');
        for ($i = 1; $i <= 10; $i++) {
            array_push($fields, 'vitA' . $i);
        }
        for ($i = 1; $i <= 5; $i++) {
            array_push($fields, 'obat_cacing' . $i);
        }

        if (isset($data_pasien)) {
            $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
            $this->data['no_id_pasien'] = $data_pasien->no_id_pasien;
        }

        $this->data['no_rekam_medis'] = $data_pendaftaran->no_rekam_medis;

        $this->data['cek_imunisasi'] = $this->Tbl_imunisasi_model->get_where(['no_rekam_medis' => $this->data['no_rekam_medis']]);
        if (count($this->data['cek_imunisasi']) == 0) {
            for ($i = 0; $i < count($fields); $i++) {
                $this->data[$fields[$i]] = '';
            }
        } else {
            for ($i = 0; $i < count($fields); $i++) {
                $this->data[$fields[$i]] = $this->data['cek_imunisasi'][0][$fields[$i]];
            }
        }
        $this->data['master_tindakan'] = $this->db->query('select * from tbl_tindakan where tipe = "1" order by cast(kode_tindakan as SIGNED INTEGER) asc ')->result();

        $this->template->load('template', 'imunisasi-anak/periksa-imunisasi', $this->data);
    }
    public function save_imunisasi()
    {
        $cek_imunisasi = $this->Tbl_imunisasi_model->get_where(['no_rekam_medis' => $_POST['no_rekam_medis']]);
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $date_now = date('Ymd', time());
        $no_periksa = $data_pendaftaran->no_pendaftaran . '/' . $date_now . '/' . $data_pendaftaran->no_rekam_medis;

        $data_transaksi = array(
            'kode_transaksi' => 'IMUNISASI',
            'id_klinik' => $this->id_klinik,
            'no_transaksi' => $no_periksa,
            'tgl_transaksi' => date('Y-m-d', time()),
            'status_transaksi' => 0,
        );

        $data_transaksi_d = array();
        $tindakan = "";
        foreach ($this->input->post('tindakan') as $key => $value) {
            $this->db->select('tindakan,biaya');
            $getTindakan = $this->db->get_where('tbl_tindakan', ['kode_tindakan' => $value])->row();
            $arr = array(
                'no_transaksi' => $data_transaksi['no_transaksi'],
                'deskripsi' => 'Biaya Tindakan ' . $getTindakan->tindakan,
                'amount_transaksi' => $getTindakan->biaya,
                'dc' => 'd'
            );
            array_push($data_transaksi_d, $arr);
            $tindakan .= $getTindakan->tindakan . ";";
        }

        $periksa = array(
            'no_periksa' => $no_periksa,
            'no_pendaftaran' => $this->no_pendaftaran,
            'no_rekam_medis' => $data_pendaftaran->no_rekam_medis,
            'tindakan' => $tindakan,
            'is_surat_ket_sakit' => 0,
            'id_dokter' => $this->id_dokter,
            'is_ambil_obat' => 0,
        );
        $this->db->insert('tbl_periksa', $periksa);

        $this->Transaksi_model->insert($data_transaksi, $data_transaksi_d);
        //Set status pendaftaran is_periksa = 1
        $this->Pendaftaran_model->update($this->no_pendaftaran, array(
            'is_periksa' => 1,
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        ));

        //Get Next Antrian
        $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
        $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
        $this->Tbl_dokter_model->update($this->id_dokter, array(
            "no_pendaftaran" => $next_antrian,
            "dtm_upd" => date("Y-m-d H:i:s",  time())
        ));

        $post = $_POST;
        unset($post['tindakan']);

        if (count($cek_imunisasi) == 0) {
            $this->db->insert('tbl_imunisasi', $post);
        } else {
            $this->db->update('tbl_imunisasi', $post, ['no_rekam_medis' => $data_pendaftaran->no_rekam_medis]);
        }


        //Set session sukses
        $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');

        redirect(site_url('periksamedis'));
    }
    public function kontrol_kehamilan()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_pendaftaran->no_rekam_medis);
        $date_now = date('Ymd', time());
        $this->data['no_rekam_medis'] = $data_pendaftaran->no_rekam_medis;
        $this->data['no_periksa'] = $data_pendaftaran->no_pendaftaran . '/' . $date_now . '/' . $data_pendaftaran->no_rekam_medis;
        
        if (isset($data_pasien)) {
            $this->data['nama_lengkap'] = $data_pasien->nama_lengkap;
            $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
        }
        $this->data['periksa_lab'] = $this->db->get('tbl_tipe_periksa_lab')->result();
        $this->data['obat'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false);
        $this->data['master_tindakan'] = $this->db->query('select * from tbl_tindakan where tipe = "1" order by cast(kode_tindakan as SIGNED INTEGER) asc ')->result();

        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);

        $this->template->load('template', 'kontrol-kehamilan/periksa-kontrol-kehamilan', $this->data);
    }
    public function newItemAlkes()
    {
        $this->data['periksa_kehamilan'] = $this->db->get('tbl_kontrol_kehamilan')->result();
        $this->data['alkes'] = $this->Tbl_obat_alkes_bhp_model->get_all_obat($this->id_klinik, false, 2);
        $this->data['no'] = $_GET['no'];
        $this->load->view('kontrol-kehamilan/input-field-alkes', $this->data);
    }
    public function save_kontrol_kehamilan()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);

        $data_transaksi = array(
            'kode_transaksi' => 'KNTRKEHAMILAN',
            'id_klinik' => $this->id_klinik,
            'no_transaksi' => $this->input->post('no_periksa'),
            'tgl_transaksi' => date('Y-m-d', time()),
            'status_transaksi' => 0,
        );

        $data_transaksi_d = array();
        $tindakan = "";
        foreach ($this->input->post('tindakan') as $key => $value) {
            $this->db->select('tindakan,biaya');
            $getTindakan = $this->db->get_where('tbl_tindakan', ['kode_tindakan' => $value])->row();
            $arr = array(
                'no_transaksi' => $data_transaksi['no_transaksi'],
                'deskripsi' => 'Biaya Tindakan ' . $getTindakan->tindakan,
                'amount_transaksi' => $getTindakan->biaya,
                'dc' => 'd'
            );
            array_push($data_transaksi_d, $arr);
            $tindakan .= $getTindakan->tindakan . ";";
        }

        foreach ($this->input->post('periksa_lab') as $key => $value) {
            $this->db->select('item,harga');
            $getLab = $this->db->get_where('tbl_tipe_periksa_lab', ['id_tipe' => $value])->row();

            $arr = array(
                'no_transaksi' => $data_transaksi['no_transaksi'],
                'deskripsi' => 'Biaya Tindakan ' . $getLab->item,
                'amount_transaksi' => $getLab->harga,
                'dc' => 'd'
            );
            array_push($data_transaksi_d, $arr);
            $tindakan .= $getTindakan->tindakan . ";";
        }

        $periksa = array(
            'no_periksa' => $this->input->post('no_periksa'),
            'no_pendaftaran' => $this->no_pendaftaran,
            'no_rekam_medis' => $data_pendaftaran->no_rekam_medis,
            'tindakan' => $tindakan,
            'is_surat_ket_sakit' => 0,
            'id_dokter' => $this->id_dokter,
            'is_ambil_obat' => 0,
        );
        $this->db->insert('tbl_periksa', $periksa);

        $post = $_POST;
        unset($post['nama_lengkap']);
        unset($post['alamat']);
        unset($post['tindakan']);
        unset($post['periksa_lab']);
        unset($post['kode_alkes']);
        unset($post['jml_alkes']);
        $this->db->insert('tbl_kontrol_kehamilan', $post);


        //input inventory barang FE
        $kode_receipt1 = 'RCP' . time();
        $tb_inv1 = array(
            'id_inventory'  => $kode_receipt1,
            'inv_type'      => 'TRX_STUFF',
            'id_klinik'     => $this->id_klinik,
        );
        $this->Transaksi_obat_model->insert('tbl_inventory', $tb_inv1);

        $getObat1 = $this->Tbl_obat_alkes_bhp_model->get_detail_obat($post['fe']);
        $det_inv1 = array(
            'id_inventory' => $kode_receipt1,
            'kode_barang' => $post['fe'],
            'jumlah' => $post['jml_fe'],
            'harga' => $getObat1->harga,
            'diskon' => $getObat1->diskon,
            'tgl_exp' => $getObat1->tgl_exp,
        );
        $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv1);

        //input inventory barang alkes
        $kode_receipt2 = 'RCP' . strtotime(date('Y-m-d H:i:s', time() + 1));
        $tb_inv2 = array(
            'id_inventory'  => $kode_receipt2,
            'inv_type'      => 'TRX_STUFF',
            'id_klinik'     => $this->id_klinik,
        );
        $this->Transaksi_obat_model->insert('tbl_inventory', $tb_inv2);

        $totalBiayaAlkes = 0;
        foreach ($_POST['kode_alkes'] as $key => $value) {
            $getObat2 = $this->Tbl_obat_alkes_bhp_model->get_detail_obat($value);
            $det_inv2 = array(
                'id_inventory' => $kode_receipt2,
                'kode_barang' => $value,
                'jumlah' => $_POST['jml_alkes'][$key],
                'harga' => $getObat2->harga,
                'diskon' => $getObat2->diskon,
                'tgl_exp' => $getObat2->tgl_exp,
            );
            $this->Transaksi_obat_model->insert('tbl_inventory_detail', $det_inv2);
            $this->db->insert('alkes_kontrol_kehamilan', ['no_periksa' => $periksa['no_periksa'], 'kode_barang' => $value, 'jml_barang' => $det_inv2['jumlah']]);
            $totalBiayaAlkes += ($getObat2->harga * $_POST['jml_alkes'][$key]) - $getObat2->diskon;
        }
        //insert akuntansi
        //insert detail akuntansi
        $trAkuntansi = array(
            'deskripsi' => 'Biaya Pemeriksaan ' . $periksa['no_periksa'],
            'tanggal' => date('Y-m-d'),
        );

        $trAkuntansiDetail = array(
            [ //kas bertambah
                'id_akun'       => 20,
                'jumlah'        => $totalBiayaAlkes,
                'tipe'          => 'DEBIT',
                'keterangan'    => 'lawan',
            ],
            [ //hpp
                'id_akun'       => 65,
                'jumlah'        => $totalBiayaAlkes,
                'tipe'          => 'DEBIT',
                'keterangan'    => 'lawan',
            ],
            [ //persediaan obat berkurang
                'id_akun'       => 59,
                'jumlah'        => $totalBiayaAlkes,
                'tipe'          => 'KREDIT',
                'keterangan'    => 'akun',
            ],
            [ //pendapatan dari penjualan obat
                'id_akun'       => 41,
                'jumlah'        => $totalBiayaAlkes,
                'tipe'          => 'KREDIT',
                'keterangan'    => 'akun',
            ]
        );
        $this->Transaksi_akuntansi_model->insertWithDetail($trAkuntansi, $trAkuntansiDetail);

        $totalBiayaObat = ($getObat1->harga * $post['jml_fe']) - $getObat1->diskon;

        $this->jurnal_otomatis_obat($totalBiayaObat, 0, $totalBiayaObat, $periksa['no_periksa'], $totalBiayaObat); //jurnal otomatis         

        $data_periksa_d_obat = array(
            array(
                'no_periksa' => $periksa['no_periksa'],
                'kode_barang' => $post['fe'],
                'jumlah' => $post['jml_fe'],
                'anjuran' => '',
                'keterangan' => '',
                'penggunaan_obat' => ''
            ),
        );

        foreach ($data_periksa_d_obat as $key => $value) {
            $this->db->insert('tbl_periksa_d_obat', $value);
        }


        $arrBiayaObat = array(
            'no_transaksi' => $periksa['no_periksa'],
            'deskripsi' => 'Total Obat-obatan',
            'amount_transaksi' => $totalBiayaObat,
            'dc' => 'd'
        );
        array_push($data_transaksi_d, $arrBiayaObat);

        $this->Transaksi_model->insert($data_transaksi, $data_transaksi_d);

        //Set status pendaftaran is_periksa = 1
        $this->Pendaftaran_model->update($this->no_pendaftaran, array(
            'is_periksa' => 1,
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        ));

        //Get Next Antrian
        $data_antrian = $this->Pendaftaran_model->get_next_antrian($this->id_dokter);
        $next_antrian = $data_antrian != null ? $data_antrian->no_pendaftaran : null;
        $this->Tbl_dokter_model->update($this->id_dokter, array(
            "no_pendaftaran" => $next_antrian,
            "dtm_upd" => date("Y-m-d H:i:s",  time())
        ));

        //Set session sukses
        $this->session->set_flashdata('message', 'Data pemeriksaan berhasil disimpan, No Pendaftaran ' . $this->no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');

        redirect(site_url('periksamedis'));
    }

    function split_string($string, $delimiter)
    {
        $string_split = explode($delimiter, $string);
        $return = array();
        for ($i = 0; $i < count($string_split); $i++) {
            if (trim($string_split[$i]) != '') {
                $return[] = array(
                    'value' => strtolower(trim(str_replace(' ', '', $string_split[$i]))),
                    'name' => trim($string_split[$i])
                );
            }
        }
        return $return;
    }

    function get_wilayah($kode)
    {
        $this->db->where('kode', $kode);
        $data = $this->db->get('tbl_wilayah')->row();
        return $data->nama;
    }

    function get_master_ref($master_code)
    {
        $this->db->where('master_ref_code', $master_code);
        $this->db->select('master_ref_value, master_ref_name');
        $datas = $this->db->get('tbl_master_reference')->result();
        $projects = array();
        foreach ($datas as $data) {
            $projects[] = array(
                'value' => $data->master_ref_value,
                'label' => $data->master_ref_name
            );
        }
        return json_encode($projects);
    }

    function get_all_tindakan()
    {
        $datas = $this->Tbl_tindakan_model->get_all();
        $projects = array();
        foreach ($datas as $data) {
            $projects[] = array(
                'value' => $data->kode_tindakan,
                'label' => $data->nama_tindakan
            );
        }
        return json_encode($projects);
    }

    function get_all_alkes()
    {
        $data_alkes = $this->Tbl_obat_alkes_bhp_model->get_all_obat(null, false, 2);
        $projects = array();
        foreach ($data_alkes as $alkes) {
            $projects[] = array(
                'kode_barang'   => $alkes->kode_barang,
                'stok_barang'   => $alkes->stok_barang,
                'harga'         => $alkes->harga_jual,
            );
        }
        return json_encode($projects);
    }

    function get_all_obat($obatAda = false, $json = true)
    {
        $data_alkes = $this->Tbl_obat_alkes_bhp_model->get_all_obat();
        $projects = array();
        foreach ($data_alkes as $alkes) {
            $add = true;
            if ($obatAda) {
                if ($alkes->stok_barang == 0) {
                    $add = false;
                }
            }

            if ($add) {
                $projects[] = array(
                    'nama_barang'   => $alkes->nama_barang,
                    'kode_barang'   => $alkes->kode_barang,
                    'stok_barang'   => $alkes->stok_barang,
                    'harga'         => $alkes->harga_jual,
                );
            }
        }
        if (!$json) {
            return $projects;
        } else {
            return json_encode($projects);
        }
    }

    function _rules()
    {
        $this->form_validation->set_rules('no_periksa', 'No Periksa', 'trim|required');
        $this->form_validation->set_rules('anamnesi', 'Anamnesi', 'trim|required');
        $this->form_validation->set_rules('riwayat_alergi_obat', 'Riwayat Alergi Obat', 'trim|required');
        $this->form_validation->set_rules('diagnosa', 'Diagnosa', 'trim|required');
        // $this->form_validation->set_rules('tindakan', 'Tindakan', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function json_by_id()
    {
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($this->no_pendaftaran);

        header('Content-Type: application/json');
        echo $this->Periksa_model->json($data_pendaftaran->no_rekam_medis);
    }

    public function json_antrian($tipePeriksa = 1)
    {
        header('Content-Type: application/json');
        // echo $this->Pendaftaran_model->json_antrian($this->id_dokter,$tipe);
        echo $this->Pendaftaran_model->json_antrian($this->id_dokter, $tipePeriksa);
    }

    public function json_riwayat()
    {
        header('Content-Type: application/json');
        // echo $this->Periksa_model->json_riwayat($this->id_dokter);
        echo json_encode($this->Periksa_model->json_riwayat($this->id_dokter));
    }

    public function json_riwayat_detail($no_rekam_medis)
    {
        header('Content-Type: application/json');
        echo $this->Periksa_model->json_riwayat_detail($this->id_dokter, $no_rekam_medis);
    }

    public function detail()
    {
        $no_periksa = $_GET['id'];
        $data_periksa = $this->Periksa_model->get_by_id($no_periksa);
        if (is_null($data_periksa))
            redirect(site_url('periksamedis'));

        //Data Periksa
        $this->data['no_periksa'] = $data_periksa->no_periksa;
        $this->data['anamnesi'] = $data_periksa->anamnesi;
        $this->data['diagnosa'] = $data_periksa->diagnosa;
        $this->data['tindakan'] = $data_periksa->tindakan;
        // $this->data['nama_dokter'] = $data_periksa->id_dokter;
        $this->data['note_dokter'] = $data_periksa->note_dokter;
        $this->data['tgl_periksa'] = $data_periksa->dtm_crt;

        //Get Data Pasien
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data_periksa->no_rekam_medis);
        //Data Pasien
        $this->data['no_rekam_medis'] = $data_pasien->no_rekam_medis;
        $this->data['no_id_pasien'] = $data_pasien->no_id_pasien;
        $this->data['nama_pasien'] = $data_pasien->nama_lengkap;
        $this->data['alamat'] = $data_pasien->alamat . ', ' . $data_pasien->kelurahan . ', ' . $data_pasien->kecamatan . ', ' . $data_pasien->kabupaten;

        //Get Data Periksa D Fisik
        $data_periksa_d_fisik = $this->Periksa_model->get_d_fisik_by_id($data_periksa->no_periksa);
        $this->data['periksa_d_fisik'] = $data_periksa_d_fisik;

        //Get Data Periksa D Alkes
        $data_periksa_d_alkes = $this->Periksa_model->get_d_alkes_by_id($data_periksa->no_periksa);
        $this->data['periksa_d_alkes'] = $data_periksa_d_alkes;

        //Get Data Periksa D Obat
        $data_periksa_d_obat = $this->Periksa_model->get_d_obat_by_id($data_periksa->no_periksa);
        $this->data['periksa_d_obat'] = $data_periksa_d_obat;

        //Get Data Dokter
        $data_dokter = $this->Tbl_dokter_model->get_by_id($data_periksa->id_dokter);
        $this->data['nama_dokter'] = $data_dokter->nama_dokter;

        $this->template->load('template', 'rekam_medis/periksamedis_detail', $this->data);
    }
    public function cetak_surat_ket_lab()
    {
        $this->db->select('p.nama_lengkap,p.tanggal_lahir,p.alamat');
        $this->db->join('tbl_pasien p', 'pr.no_rekam_medis = p.no_rekam_medis');
        $data['pasien'] = $this->db->get_where('tbl_periksa pr', ['no_periksa' => $_GET['id']])->row();

        $this->db->select('l.hasil,t.item,t.nilai_normal,t.diet,p.dtm_crt');
        $this->db->join('tbl_tipe_periksa_lab t', 'l.id_tipe = t.id_tipe');
        $this->db->join('tbl_periksa p', 'l.no_periksa = p.no_periksa');
        $data['lab'] =  $this->db->get_where('tbl_periksa_lab l', ['l.no_periksa' => $_GET['id']])->result();


        // tanggal lahir
        $tanggal = new DateTime($data['pasien']->tanggal_lahir);

        // tanggal hari ini
        $today = new DateTime('today');

        // tahun
        $y = $today->diff($tanggal)->y;

        $data['umur'] = $y;

        $this->load->view('rekam_medis/cetak_surat_ket_lab', $data);
    }

    public function cetak_surat_ket_sakit()
    {
        $id = $_GET['id'];
        $this->db->select('tbl_periksa.no_rekam_medis as nomor_rekam_medis,tbl_periksa.*,tbl_pasien.*,tbl_transaksi.*,tbl_periksa.nomor_skt,tbl_periksa.dtm_crt as tgl_periksa,tbl_dokter.nama_dokter,tbl_klinik.nama as klinik,tbl_klinik.alamat as alamat_klinik');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_periksa', 'tbl_transaksi.no_transaksi=tbl_periksa.no_periksa', 'left');
        $this->db->join('tbl_pasien', 'tbl_periksa.no_rekam_medis=tbl_pasien.no_rekam_medis', 'left');
        $this->db->join('tbl_dokter', 'tbl_periksa.id_dokter=tbl_dokter.id_dokter', 'left');
        $this->db->join('tbl_klinik', 'tbl_transaksi.id_klinik=tbl_klinik.id_klinik', 'left');

        $this->db->where('tbl_periksa.no_periksa', $id);
        $data = $this->db->get()->row();
        //Get Data Pasien
        $data_pasien = $this->Tbl_pasien_model->get_by_id($data->nomor_rekam_medis);


        $this->data['nama_klinik'] = $data->klinik;
        $this->data['alamat_klinik'] = $data->alamat_klinik;
        $this->data['no_transaksi'] = $data->no_transaksi;
        $this->data['tujuan_surat'] = $data->tujuan_surat;
        $this->data['nama_pasien'] = $data->nama_lengkap;
        $this->data['pekerjaan'] = $data->pekerjaan;
        // tanggal lahir
        $tanggal = new DateTime($data_pasien->tanggal_lahir);

        // tanggal hari ini
        $today = new DateTime('today');

        // tahun
        $y = $today->diff($tanggal)->y;
        $this->data['umur'] = $y;

        $this->data['alamat'] = $data_pasien->alamat . ' ' . $data_pasien->kabupaten . ' ' . 'RT ' . $data_pasien->rt . ' ' . 'RW ' . $data_pasien->rw;
        $this->data['lama_istirahat'] = $data->lama_istirahat_surat;

        $date = new DateTime($data->tanggal_mulai);
        $tgl_periksa = $date->format('d/m/Y');
        $date2 = new DateTime($data->tanggal_mulai);
        $date2->add(new DateInterval('P' . ($data->lama_istirahat_surat - 1) . 'D'));
        $tgl_periksa2 = $date2->format('d/m/Y');
        $this->data['tgl_periksa'] = $tgl_periksa;
        $this->data['tgl_periksa2'] = $tgl_periksa2;
        $this->data['diagnosa'] = $data->diagnosa;
        $this->data['tgl_cetak'] = date("d M Y",  time());
        $this->data['dokter'] = $data->nama_dokter;
        $this->data['nomor'] = $data->nomor_skt;
        $this->load->view('rekam_medis/cetak_surat_ket_sakit', $this->data);
    }

    public function daftar_baru()
    {
        // $this->_rules_daftar_baru();

        if ($this->form_validation->run() == TRUE) {
            $no_pendaftaran = $this->Master_sequence_model->set_code_by_master_seq_code("NOPENDAFTARAN");

            $data_pasien = array(
                'no_rekam_medis'    => $this->input->post('no_rekam_medis'),
                'no_id_pasien'        => $this->input->post('no_id'),
                'nik'               => $this->input->post('nik'),
                'nama_lengkap'      => $this->input->post('nama_lengkap'),
                'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
                'golongan_darah'    => $this->input->post('golongan_darah'),
                'status_menikah'    => $this->input->post('status_menikah'),
                'pekerjaan'          => $this->input->post('pekerjaan'),
                'alamat'              => $this->input->post('alamat'),
                'kabupaten'         => $this->input->post('kabupaten'),
                'rt'         => $this->input->post('rt'),
                'rw'         => $this->input->post('rw'),
                'nama_orang_tua_atau_istri'      =>  $this->input->post('nama_orangtua_atau_istri'),
                'nomer_telepon'     =>  $this->input->post('nomor_telepon'),
            );

            $data_pendaftaran = array(
                'no_pendaftaran' => $this->Master_sequence_model->set_code_by_master_seq_code("NOPENDAFTARAN", true),
                'no_rekam_medis' => $this->input->post('no_rekam_medis'),
                'id_dokter' => $this->input->post('nama_dokter'),
                'id_klinik' => $this->id_klinik,
                'tipe_periksa' => $this->input->post('tipe_periksa'),
            );

            $row = $this->Tbl_pasien_model->get_by_id($this->input->post('no_rekam_medis'));
            if ($row == null) {
                $this->Tbl_pasien_model->insert($data_pasien);
                $master_code = $this->Master_sequence_model->set_code_by_master_seq_code("NOREKAMMEDIS", true);
            } else {
                $this->Tbl_pasien_model->update($row->no_rekam_medis, $data_pasien);
            }
            $this->Pendaftaran_model->insert($data_pendaftaran);

            //Cek status dokter, jika kosong maka isi no_pendaftaran
            $dokter = $this->Tbl_dokter_model->get_by_id($this->input->post('nama_dokter'));
            if ($dokter->no_pendaftaran == null || trim($dokter->no_pendaftaran) == '') {
                $this->Tbl_dokter_model->update($this->input->post('nama_dokter'), array(
                    'no_pendaftaran' => $no_pendaftaran,
                    'dtm_upd' => date("Y-m-d H:i:s",  time())
                ));
            }

            //Set session sukses
            $this->session->set_flashdata('message', 'Data pendaftaran berhasil disimpan, No Rekam Medis ' . $this->input->post('no_rekam_medis'));
            $this->session->set_flashdata('message_type', 'success');

            redirect(site_url('periksamedis'));
        } else {
            $pasien_existing = null;
            if ($this->session->flashdata('no_rekam_medis') != null)
                $pasien_existing = $this->Tbl_pasien_model->get_by_id($this->session->flashdata('no_rekam_medis'));

            $this->data['message'] = $this->session->flashdata('message');

            $this->db->where('no_id_pasien', set_value('no_id'));
            $dataPasien = $this->db->get('tbl_pasien')->row();
            $this->data['no_rekam_medis_default'] = $this->Master_sequence_model->set_code_by_master_seq_code("NOREKAMMEDIS");

            $this->data['no_rekam_medis'] = $pasien_existing != null ? $pasien_existing->no_rekam_medis : ($dataPasien != null ? set_value('no_rekam_medis') : $this->data['no_rekam_medis_default']);
            $this->data['no_id'] = $pasien_existing != null ? $pasien_existing->no_id_pasien : set_value('no_id');
            $this->data['nik'] = $pasien_existing != null ? $pasien_existing->nik : set_value('nik');
            $this->data['nama_lengkap'] = $pasien_existing != null ? $pasien_existing->nama_lengkap : set_value('nama_lengkap');
            $this->data['tanggal_lahir'] = $pasien_existing != null ? $pasien_existing->tanggal_lahir : set_value('tanggal_lahir');
            $this->data['golongan_darah'] = $pasien_existing != null ? $pasien_existing->golongan_darah : set_value('golongan_darah');
            $this->data['status_menikah'] = $pasien_existing != null ? $pasien_existing->status_menikah : set_value('status_menikah');
            $this->data['pekerjaan'] = $pasien_existing != null ? $pasien_existing->pekerjaan : set_value('pekerjaan');
            $this->data['alamat'] = $pasien_existing != null ? $pasien_existing->alamat : set_value('alamat');
            $this->data['kabupaten'] = $pasien_existing != null ? $pasien_existing->kabupaten : set_value('kabupaten');
            $this->data['rt'] = $pasien_existing != null ? $pasien_existing->rt : set_value('rt');
            $this->data['rw'] = $pasien_existing != null ? $pasien_existing->rw : set_value('rw');
            $this->data['nama_orangtua_atau_istri'] = $pasien_existing != null ? $pasien_existing->nama_orang_tua_atau_istri : set_value('nama_orangtua_atau_istri');
            $this->data['nomor_telepon'] = $pasien_existing != null ? $pasien_existing->nomer_telepon : set_value('nomor_telepon');
            $this->data['nama_dokter'] = $this->id_dokter;
            $this->data['dokter'] = $this->Tbl_dokter_model->get_all_jaga($this->id_klinik);

            //Set session error
            if ($this->input->post('no_rekam_medis')) {
                $this->session->set_flashdata('message', 'Terdapat error input, silahkan cek ulang');
                $this->session->set_flashdata('message_type', 'danger');
            }
        }

        $this->template->load('template', 'rekam_medis/daftar_baru', $this->data);
    }

    public function pencarian()
    {
        $this->template->load('template', 'rekam_medis/tbl_pasien_list');
    }

    public function existing($no_rekam_medis)
    {
        $this->session->set_flashdata('no_rekam_medis', $no_rekam_medis);

        //Set session sukses
        $this->session->set_flashdata('message', 'Pencarian Berhasil dengan No Rekam Medis : ' . $no_rekam_medis . ', Tekan Tombol Simpan Pendaftaran untuk melanjutkan pendaftaran');
        $this->session->set_flashdata('message_type', 'success');

        redirect(site_url('periksamedis/daftar_baru'));
    }

    public function pencarian_json()
    {
        header('Content-Type: application/json');
        echo $this->Pendaftaran_model->json_pencarian_by_dokter();
    }

    public function _rules_daftar_baru()
    {
        $this->form_validation->set_rules('no_rekam_medis', 'No Rekam Medis', 'trim|required');
        $this->form_validation->set_rules('no_id', 'No ID Pasien', 'trim|required');
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('status_menikah', 'Status Menikah', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required');
        $this->form_validation->set_rules('rt', 'RT', 'trim|required');
        $this->form_validation->set_rules('rw', 'RW', 'trim|required');
        $this->form_validation->set_rules('nama_orangtua_atau_istri', 'Nama Orantua atau Istri', 'trim|required');
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'trim|required');
        $this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function biayask()
    {
        $this->form_validation->set_rules('sksehat', 'Surat Keterangan Sehat', 'trim|required');
        $this->form_validation->set_rules('sksakit', 'Surat Keterangan Sakit', 'trim|required');
        $this->form_validation->set_rules('rapid_antigen', 'Rapid Antigen Covid-19', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');


        if ($this->form_validation->run() == true) {
            $this->db->update('tbl_biaya_sk', $this->input->post());

            $this->session->set_flashdata('success', 'Biaya Berhasil Diperbarui');

            redirect(base_url() . "biayask");
        } else {
            if (isset($_POST['sksehat'])) {
                $data = array(
                    'sksehat' => set_value('sksehat'),
                    'sksakit' => set_value('sksakit'),
                    'rapid_antigen' => set_value('rapid_antigen'),
                );
            } else {
                $data = array(
                    'sksehat' => biayaSK('sksehat'),
                    'sksakit' => biayaSK('sksakit'),
                    'rapid_antigen' => biayaSK('rapid_antigen'),
                );
            }
        }

        $this->template->load('template', 'rekam_medis/biayask', $data);
    }
}
