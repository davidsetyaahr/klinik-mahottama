<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
    public $id_klinik;
    
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pendaftaran_model');
        $this->load->model('Pendaftaran_online_model');
		$this->load->model('Master_sequence_model');
		$this->load->model('Tbl_dokter_model');
		$this->load->model('Tbl_pasien_model');
		$this->load->model('Tbl_kabupaten_model');
		$this->load->model('User_model');
		$this->load->model('Tbl_wilayah_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		
		$this->id_klinik = $this->session->userdata('id_klinik');
    }

    public function index()
    {
        $this->template->load('template','pendaftaran/pendaftaran_list');
    }
    
    public function create(){
        $this->_rules();
				
        if ($this->form_validation->run() == TRUE) {
            $no_pendaftaran = $this->Master_sequence_model->set_code_by_master_seq_code("NOPENDAFTARAN");
            
			$data_pasien = array(
				'no_rekam_medis'    => $this->input->post('no_rekam_medis'),
				'no_id_pasien'		=> $this->input->post('no_id'),
				'nama_lengkap'      => $this->input->post('nama_lengkap'),
				'nik'               => $this->input->post('nik'),
				'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
				'golongan_darah'    => $this->input->post('golongan_darah'),
				'status_menikah'    => $this->input->post('status_menikah'),
				'pekerjaan'      	=> $this->input->post('pekerjaan'),
				'id_kabupaten' 		=> $this->input->post('id_kabupaten'),
				'id_kecamatan' 		=> $this->input->post('id_kecamatan'),
				'id_desa' 		=> $this->input->post('id_desa'),
				'id_dusun' 		=> $this->input->post('id_dusun'),
				'rt' 		=> $this->input->post('rt'),
				'rw' 		=> $this->input->post('rw'),
				'jenis_kelamin' 		=> $this->input->post('jenis_kelamin'),
				'agama' 		=> $this->input->post('agama'),
				'pendidikan' 		=> $this->input->post('pendidikan'),
				'umur' 		=> $this->input->post('umur'),
				'nama_kk' 		=> $this->input->post('nama_kk'),
				// 'tgl_masuk' 		=> $this->input->post('tgl_masuk'),
				'nama_orang_tua_atau_istri'      =>  $this->input->post('nama_orangtua_atau_istri'),
				'nomer_telepon'     =>  $this->input->post('nomor_telepon'),
                'dtm_crt' => date("Y-m-d H:i:s",  time()),
                'dtm_upd' => date("Y-m-d H:i:s",  time()),
			);
			
            $data_pendaftaran = array(
				'no_pendaftaran' => $this->Master_sequence_model->set_code_by_master_seq_code("NOPENDAFTARAN", true),
				'no_rekam_medis' => $this->input->post('no_rekam_medis'),
				'id_dokter' => $this->input->post('nama_dokter'),
				'id_klinik' => $this->id_klinik,
				'id_poli' => !empty($this->input->post('id_poli')) ? $this->input->post('id_poli') : '0',
                'is_pasien'     =>  $this->input->post('is_pasien'),
                'tindakan'     =>  $this->input->post('tindakan'),
                'dtm_crt' => date("Y-m-d H:i:s",  time()),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
	        );

			$row = $this->Tbl_pasien_model->get_by_id($this->input->post('no_rekam_medis'));
			if($row == null)
			{
				$this->Tbl_pasien_model->insert($data_pasien);
				$master_code = $this->Master_sequence_model->set_code_by_master_seq_code("NOREKAMMEDIS", true);
			} else {
			    $this->Tbl_pasien_model->update($row->no_rekam_medis, $data_pasien);
			}
			$this->Pendaftaran_model->insert($data_pendaftaran);
            $periksaLanjutan = array(
                'no_pendaftaran' => $data_pendaftaran['no_pendaftaran'],
                'tipe_periksa' => $this->input->post('tipe_periksa'),
                'tanggal' => date('Y-m-d H:i:s'),
                'is_periksa' => '1',
            );
            $this->db->insert('tbl_periksa_lanjutan',$periksaLanjutan);
			
			//Cek status dokter, jika kosong maka isi no_pendaftaran
			$dokter = $this->Tbl_dokter_model->get_by_id($this->input->post('nama_dokter'));
            // var_dump($dokter);
			if($dokter->no_pendaftaran == null || trim($dokter->no_pendaftaran) == '' ){
			    $this->Tbl_dokter_model->update($this->input->post('nama_dokter'), array(
			        'no_pendaftaran' => $no_pendaftaran,
			        'dtm_upd' => date("Y-m-d H:i:s",  time())
			    ));
			}
			
			//Set session sukses
            $this->session->set_flashdata('message', 'Data pendaftaran berhasil disimpan, No Rekam Medis ' . $this->input->post('no_rekam_medis'));
            $this->session->set_flashdata('message_type', 'success');
			redirect(site_url('pendaftaran/label-pasien/'.$this->input->post('no_rekam_medis')));
        } else {	
            $pasien_existing = null;
            if($this->session->flashdata('no_rekam_medis') != null)
                $pasien_existing = $this->Tbl_pasien_model->get_pendaftaran($this->session->flashdata('no_rekam_medis'));
            
            
			$this->data['message'] = $this->session->flashdata('message');
			
			$this->db->where('no_id_pasien', set_value('no_id'));
			$dataPasien = $this->db->get('tbl_pasien')->row();
            $lastNoId = $this->Tbl_pasien_model->lastNoId();
            if(count((array)$lastNoId)==1){
                $id = (int)$lastNoId['no_id_pasien'];
                $nextId = $id+1;
                $this->data['no_id_pasien'] = sprintf('%06s',$nextId);
            }
            else{
                $this->data['no_id_pasien'] = '000001';
            }
			$this->data['no_rekam_medis_default'] = $this->data['no_id_pasien'];
			$this->data['no_rekam_medis'] = $pasien_existing != null ? $pasien_existing->no_rekam_medis : ($dataPasien != null ? set_value('no_rekam_medis') : $this->data['no_rekam_medis_default']);
			$this->data['no_id'] = $pasien_existing != null ? $pasien_existing->no_id_pasien : $this->data['no_id_pasien'];
			$this->data['nama_lengkap'] = $pasien_existing != null ? $pasien_existing->nama_lengkap : set_value('nama_lengkap');
			$this->data['nik'] = $pasien_existing != null ? $pasien_existing->nik : set_value('nik');
			$this->data['tanggal_lahir'] = $pasien_existing != null ? $pasien_existing->tanggal_lahir : set_value('tanggal_lahir');
			$this->data['golongan_darah'] = $pasien_existing != null ? $pasien_existing->golongan_darah : set_value('golongan_darah');
			$this->data['status_menikah'] = $pasien_existing != null ? $pasien_existing->status_menikah : set_value('status_menikah');
			$this->data['pekerjaan'] = $pasien_existing != null ? $pasien_existing->pekerjaan : set_value('pekerjaan');
			$this->data['alamat'] = $pasien_existing != null ? $pasien_existing->alamat : set_value('alamat');
			$this->data['id_kabupaten'] = $pasien_existing != null ? $pasien_existing->id_kabupaten : set_value('id_kabupaten');
			$this->data['rt'] = $pasien_existing != null ? $pasien_existing->rt : set_value('rt');
			$this->data['rw'] = $pasien_existing != null ? $pasien_existing->rw : set_value('rw');
			$this->data['id_dusun'] = $pasien_existing != null ? $pasien_existing->id_dusun : set_value('id_dusun');
			$this->data['id_desa'] = $pasien_existing != null ? $pasien_existing->id_desa : set_value('id_desa');
			$this->data['id_kecamatan'] = $pasien_existing != null ? $pasien_existing->id_kecamatan : set_value('id_desa');
			$this->data['nama_orangtua_atau_istri'] = $pasien_existing != null ? $pasien_existing->nama_orang_tua_atau_istri : set_value('nama_orangtua_atau_istri');
			$this->data['nomor_telepon'] = $pasien_existing != null ? $pasien_existing->nomer_telepon : set_value('nomor_telepon');
            $this->data['is_pasien'] = $pasien_existing != null ? '0' : '1';
            // $this->data['tindakan'] = $pasien_existing != null ? $pasien_existing->tindakan : set_value('tindakan');
            $this->data['jenis_kelamin'] = $pasien_existing != null ? $pasien_existing->jenis_kelamin : set_value('jenis_kelamin');
            $this->data['agama'] = $pasien_existing != null ? $pasien_existing->agama : set_value('agama');
            $this->data['pendidikan'] = $pasien_existing != null ? $pasien_existing->pendidikan : set_value('pendidikan');
            $this->data['umur'] = $pasien_existing != null ? $pasien_existing->umur : set_value('umur');
            $this->data['nama_kk'] = $pasien_existing != null ? $pasien_existing->nama_kk : set_value('nama_kk');
            // $this->data['tgl_masuk'] = $pasien_existing != null ? $pasien_existing->tgl_masuk : set_value('tgl_masuk');
			$this->data['nama_dokter'] = set_value('nama_dokter');	
			// $this->data['tipe_periksa'] = $pasien_existing != null ? $pasien_existing->tipe_periksa : set_value('tipe_periksa');
            $this->data['poli'] = $this->db->get('tbl_poli')->result();
			$this->data['allKabupaten'] = $this->db->get("tbl_kabupaten")->result();
			// $this->data['option_dokter'] = array();
			// $this->data['option_dokter'][''] = 'Pilih Dokter';
			// foreach ($this->Tbl_dokter_model->get_all_jaga($this->id_klinik) as $dokter){
                // 	$this->data['option_dokter'][$dokter->id_dokter] = $dokter->nama_dokter;
                // }
            $this->data['dokter'] = $this->Tbl_dokter_model->get_all_jaga($this->id_klinik);
                
			//Set session error
            if($this->input->post('no_rekam_medis')){
                $this->session->set_flashdata('message', 'Terdapat error input, silahkan cek ulang');
                $this->session->set_flashdata('message_type', 'danger');
            }
		}
        // print_r($this->data['tindakan']);
        // print_r($pasien_existing);
        // print_r($pasien_existing->tindakan);
        $this->template->load('template','pendaftaran/create', $this->data);
    }

    public function getDokter()
    {
        $this->db->select('id_dokter,nama_dokter,id_poli');
        $this->db->where(['is_jaga' => '1']);
        if($_GET['id_poli']!=0){
            $this->db->where(['id_poli' => $_GET['id_poli']]);
        }
        $dokter = $this->db->get('tbl_dokter',)->result_array();
        echo json_encode($dokter);
    }
    
    public function pencarian(){
            $this->data['option_dokter'] = array();
			$this->data['option_dokter'][''] = 'Pilih Dokter';
			foreach ($this->Tbl_dokter_model->get_all_jaga($this->id_klinik) as $dokter){
				$this->data['option_dokter'][$dokter->id_dokter] = $dokter->nama_dokter;
			}
			$this->data['nama_dokter'] = set_value('nama_dokter');	
			
        $this->template->load('template','pendaftaran/tbl_pasien_list', $this->data);
    }
    
    public function pencarian_json(){
        header('Content-Type: application/json');
        echo $this->Pendaftaran_model->json_pencarian();
    }
    
    public function existing($no_rekam_medis){
        $this->session->set_flashdata('no_rekam_medis', $no_rekam_medis);
        
        //Set session sukses
        $this->session->set_flashdata('message', 'Pencarian Berhasil dengan No Rekam Medis : ' . $no_rekam_medis . ', Tekan Tombol Simpan Pendaftaran untuk melanjutkan pendaftaran');
        $this->session->set_flashdata('message_type', 'success');
        
        redirect(site_url('pendaftaran/create'));
    }
    
    public function batal($no_pendaftaran){
        $this->Pendaftaran_model->update($no_pendaftaran, array(
            "is_periksa" => 2,
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        ));
        
        //Set session sukses
        $this->session->set_flashdata('message', 'Data pendaftaran berhasil dibatalkan, No Pendaftaran ' . $no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');
        
        redirect(site_url('pendaftaran'));
    }
    
    public function tunda($no_pendaftaran){
        $this->Pendaftaran_model->update($no_pendaftaran, array(
            "is_periksa" => 3,
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        ));
        
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($no_pendaftaran);
        //Cek apakah diperiksa atau tidak
        $dokter = $this->Tbl_dokter_model->get_by_no_pendaftaran($data_pendaftaran->id_dokter,$no_pendaftaran);
        if($dokter != null){
            $this->Tbl_dokter_model->update($data_pendaftaran->id_dokter, array(
                "no_pendaftaran" => null,
                "dtm_upd" => date("Y-m-d H:i:s",  time())
            ));
        }
        
        //Set session sukses
        $this->session->set_flashdata('message', 'Data pendaftaran berhasil ditunda, No Pendaftaran ' . $no_pendaftaran);
        $this->session->set_flashdata('message_type', 'success');
        
        redirect(site_url('pendaftaran'));
    }
    
    public function periksa($no_pend){
        $this->Pendaftaran_model->update($no_pend, array(
            "is_periksa" => 0,
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        ));
        
        $data_pendaftaran = $this->Pendaftaran_model->get_by_id($no_pend);
        
        $this->Tbl_dokter_model->update($data_pendaftaran->id_dokter, array(
            "no_pendaftaran" => $no_pend,
            "dtm_upd" => date("Y-m-d H:i:s",  time())
        ));
        
        //Set session sukses
        $this->session->set_flashdata('message', 'Data pendaftaran berhasil dubah, No Pendaftaran ' . $no_pend);
        $this->session->set_flashdata('message_type', 'success');
        redirect(site_url('pendaftaran'));
    }
    
    function ubah_status_dokter($id_dokter){
        $dokter = $this->Tbl_dokter_model->get_by_id($id_dokter);
        if($dokter->is_jaga == 1){
            $this->Tbl_dokter_model->update($id_dokter, array("is_jaga" => 0, "dtm_upd" => date("Y-m-d H:i:s",  time()),
                "no_pendaftaran" => null
            ));
            //Set session sukses
            $this->session->set_flashdata('message', 'Dokter ' . $dokter->nama_dokter . ' status dokter telah dinonaktifkan');
            $this->session->set_flashdata('message_type', 'success');
        } else if ($dokter->is_jaga == 0){
            $this->Tbl_dokter_model->update($id_dokter, array("is_jaga" => 1, "dtm_upd" => date("Y-m-d H:i:s",  time())
            ));
            
            //Get user
            $user = $this->User_model->get_by_id_dokter($id_dokter);
            if($user != null){
                $id_user = $user->id_users;
                $this->User_model->update($id_user, array(
                    'id_klinik' => $this->id_klinik,
                    "dtm_upd" => date("Y-m-d H:i:s",  time()),
                    "usr_upd" => $this->session->userdata('email')
                ));
            }
            //Set session sukses
            $this->session->set_flashdata('message', 'Dokter ' . $dokter->nama_dokter . ' status dokter telah diaktifkan');
            $this->session->set_flashdata('message_type', 'success');
        }
            
        redirect(site_url('pendaftaran/create'));
    }
    
	function autocomplate_no_id_pasien(){
        $this->db->like('no_id_pasien', $_GET['term']);
        $this->db->select('no_id_pasien');
        $dataPasien = $this->db->get('tbl_pasien')->result();
        foreach ($dataPasien as $pasien) {
            $return_arr[] = $pasien->no_id_pasien;
        }
        echo json_encode($return_arr);
    }
    
    function autofill(){
        $no_id = $_GET['no_id'];
        $this->db->where('no_id_pasien',$no_id);
        $pasien = $this->db->get('tbl_pasien')->row_array();
        $data = array(
            'no_rekam_medis'    => $pasien['no_rekam_medis'],
			'nama_lengkap'      =>  $pasien['nama_lengkap'],
			'tanggal_lahir'      =>  $pasien['tanggal_lahir'],
			'golongan_darah'      =>  $pasien['golongan_darah'],
			'status_menikah'      =>  $pasien['status_menikah'],
			'pekerjaan'      =>  $pasien['pekerjaan'],
			'alamat'      =>  $pasien['alamat'],
			'kabupaten' => $pasien['kabupaten'],
			'rt' => $pasien['rt'],
			'rw' => $pasien['rw'],
			'nama_orangtua_atau_istri'      =>  $pasien['nama_orang_tua_atau_istri'],
			'nomor_telepon'      =>  $pasien['nomer_telepon'],
		);
        echo json_encode($data);
    }
    
    public function _rules() 
    {
        $this->form_validation->set_rules('no_rekam_medis', 'No Rekam Medis', 'trim|required');
    	$this->form_validation->set_rules('no_id', 'No ID Pasien', 'trim|required');
    	$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
    	$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
    	// $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
    // 	$this->form_validation->set_rules('golongan_darah', 'Golongan Darah', 'trim|required');
    	// $this->form_validation->set_rules('status_menikah', 'Status Menikah', 'trim|required');
    	// $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
    	$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim|required');
    	$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim|required');
    	$this->form_validation->set_rules('id_desa', 'Desa', 'trim|required');
    	// $this->form_validation->set_rules('id_dusun', 'Dusun', 'trim|required');
    	// $this->form_validation->set_rules('rt', 'RT', 'trim|required');
    	// $this->form_validation->set_rules('rw', 'RW', 'trim|required');
    	// $this->form_validation->set_rules('nama_orangtua_atau_istri', 'Nama Orantua atau Istri', 'trim|required');
    	$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'trim|required');
		$this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'trim|required');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    public function json(){
        header('Content-Type: application/json');
        echo $this->Pendaftaran_model->json($this->id_klinik);
    }
    
    public function json2(){
        header('Content-Type: application/json');
        echo $this->Pendaftaran_model->json2($this->id_klinik);
    }
    
    public function json_status_dokter(){
        header('Content-Type: application/json');
        echo $this->Pendaftaran_model->json_status_dokter($this->id_klinik);
    }
    
    public function json_status_dokter2(){
        header('Content-Type: application/json');
        echo $this->Pendaftaran_model->json_status_dokter2();
    }

    // pendaftaran pasien
    public function pendaftaran_pasien(){
        $this->_rules();
		$recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);	
        if ($this->form_validation->run() == TRUE && isset($response['failed']) || $this->form_validation->run() == TRUE &&  $response['success'] == TRUE) {
        // if ($this->form_validation->run() == TRUE){
            $no_pendaftaran = $this->Master_sequence_model->set_code_by_master_seq_code("NOPENDAFTARAN");
            
			$data_pasien = array(
				'no_rekam_medis'    => $this->input->post('no_rekam_medis'),
				'no_id_pasien'		=> $this->input->post('no_id'),
				'nama_lengkap'      => $this->input->post('nama_lengkap'),
				'nik'               => $this->input->post('nik'),
				'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
				'golongan_darah'    => $this->input->post('golongan_darah'),
				'status_menikah'    => $this->input->post('status_menikah'),
				'pekerjaan'      	=> $this->input->post('pekerjaan'),
				'alamat'      		=> $this->input->post('alamat'),
				'kabupaten' 		=> $this->input->post('kabupaten'),
				'rt' 		=> $this->input->post('rt'),
				'rw' 		=> $this->input->post('rw'),
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
			if($row == null)
			{
				$this->Tbl_pasien_model->insert($data_pasien);
				$master_code = $this->Master_sequence_model->set_code_by_master_seq_code("NOREKAMMEDIS", true);
			} else {
			    $this->Tbl_pasien_model->update($row->no_rekam_medis, $data_pasien);
			}
			$this->Pendaftaran_model->insert($data_pendaftaran);
			
			//Cek status dokter, jika kosong maka isi no_pendaftaran
			$dokter = $this->Tbl_dokter_model->get_by_id($this->input->post('nama_dokter'));
			if($dokter->no_pendaftaran == null || trim($dokter->no_pendaftaran) == '' ){
			    $this->Tbl_dokter_model->update($this->input->post('nama_dokter'), array(
			        'no_pendaftaran' => $no_pendaftaran,
			        'dtm_upd' => date("Y-m-d H:i:s",  time())
			    ));
			}
			
			//Set session sukses
            $this->session->set_flashdata('message', 'Data pendaftaran berhasil disimpan, No Rekam Medis ' . $this->input->post('no_rekam_medis'));
            $this->session->set_flashdata('message_type', 'success');
            
			redirect(site_url('pendaftaran/pendaftaran_pasien'));
        } else {	
            $pasien_existing = null;
            if($this->session->flashdata('no_rekam_medis') != null)
                $pasien_existing = $this->Tbl_pasien_model->get_by_id($this->session->flashdata('no_rekam_medis'));
			
			$this->data['message'] = $this->session->flashdata('message');
			
			$this->db->where('no_id_pasien', set_value('no_id'));
			$dataPasien = $this->db->get('tbl_pasien')->row();
			$this->data['no_rekam_medis_default'] = $this->Master_sequence_model->set_code_by_master_seq_code("NOREKAMMEDIS");
			
			$this->data['no_rekam_medis'] = $pasien_existing != null ? $pasien_existing->no_rekam_medis : ($dataPasien != null ? set_value('no_rekam_medis') : $this->data['no_rekam_medis_default']);
			$this->data['no_id'] = $pasien_existing != null ? $pasien_existing->no_id_pasien : set_value('no_id');
			$this->data['nama_lengkap'] = $pasien_existing != null ? $pasien_existing->nama_lengkap : set_value('nama_lengkap');
			$this->data['nik'] = $pasien_existing != null ? $pasien_existing->nik : set_value('nik');
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
			$this->data['tipe_periksa'] = $pasien_existing != null ? $pasien_existing->tipe_periksa : set_value('tipe_periksa');
			$this->data['nama_dokter'] = set_value('nama_dokter');	
            $this->data['captcha'] = $this->recaptcha->getWidget();
            $this->data['script_captcha'] = $this->recaptcha->getScriptTag();
			
			// $this->data['option_dokter'] = array();
			// $this->data['option_dokter'][''] = 'Pilih Dokter';
			// foreach ($this->Tbl_dokter_model->get_all_jaga($this->id_klinik) as $dokter){
                // 	$this->data['option_dokter'][$dokter->id_dokter] = $dokter->nama_dokter;
                // }
            $this->data['dokter'] = $this->Tbl_dokter_model->get_all_jaga($this->id_klinik);
                
			//Set session error
            if($this->input->post('no_rekam_medis')){
                $this->session->set_flashdata('message', 'Terdapat error input, silahkan cek ulang');
                $this->session->set_flashdata('message_type', 'danger');
            }
		}
        
        $this->load->view('pendaftaran/daftar', $this->data);


    }

    public function list_pendaftar_online(){
        $this->template->load('template','pendaftaran/pendaftar_online_list');
    }

    public function json_pendaftaran() {
        header('Content-Type: application/json');
        echo $this->Pendaftaran_online_model->json();
    }

    public function read_pendaftar_online($id)
    {
        $row = $this->Pendaftaran_online_model->get_by_id($id);
        if ($row){
            $data = array(
                'nama_lengkap' => $row->nama_lengkap,
                'nik' => $row->nik,
                'tanggal_lahir' => $row->tanggal_lahir,
                'golongan_darah' => $row->golongan_darah,
                'status_menikah' => $row->status_menikah,
                'pekerjaan' => $row->pekerjaan,
                'alamat' => $row->alamat,
                'kabupaten' => $row->kabupaten,
                'rt' => $row->rt,
                'rw' => $row->rw,
                'nama_orangtua_atau_istri' => $row->nama_orangtua_atau_istri,
                'nomer_telepon' => $row->nomer_telepon,
                'tipe_periksa' => $row->tipe_periksa,
            );
            $this->template->load('template','pendaftaran/pendaftar_online_list', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pendaftaran'));
        }
    }

    public function delete_pendaftar_online($id) 
    {
        $row = $this->Pendaftaran_online_model->get_by_id($id);

        if ($row) {
            $this->Pendaftaran_online_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pendaftaran/list_pendaftar_online'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pendaftaran/list_pendaftar_online'));
        }
    }

    public function detail(){
        $detail = $this->Pendaftaran_online_model->detail_pendaftar_online();
        header('Content-Type: application/json');
        echo json_encode($detail);
    }

    public function delete_data_online($id){
        $row = $this->Pendaftaran_online_model->get_by_id($id);   
    }

    public function update_data_online(){
        $daridbpasien = $this->Tbl_pasien_model->cekkodepasien();
        $nourut = substr($daridbpasien, 3);
        $noRekamMedisSekarang = str_pad($nourut+1, 6, 0, STR_PAD_LEFT);
        $daridbpendaftaran = $this->Pendaftaran_model->cekkodependaftaran();
        $nourutpendaftaran = substr($daridbpendaftaran, 3);
        $noPendaftaranSekarang = str_pad($nourutpendaftaran+1, 6, 0, STR_PAD_LEFT);
        
        switch ($this->input->post('tipe_periksa')){
            case "Periksa Medis":
                $tipe_periksa = "1";
                break;
            case "Imunisasi Anak":
                $tipe_periksa = "2";
                break;
            case "Kontrol Kehamilan":
                $tipe_periksa = "3";
                break;
            case "Periksa Gigi":
                $tipe_periksa = "4";
                break;
            case "Periksa Jasa":
                $tipe_periksa = "5";
                break;
            case "Periksa Lab":
                $tipe_periksa = "6";
                break;
        }
        if($this->input->post('is_pasien') == ''){
            $data_pasien = array(
                'no_rekam_medis'    => $noRekamMedisSekarang,
                'no_id_pasien'		=> $this->input->post('no_id'),
                'nama_lengkap'      => $this->input->post('nama_lengkap'),
                'nik'               => $this->input->post('nik'),
                'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
                'golongan_darah'    => $this->input->post('golongan_darah'),
                'status_menikah'    => $this->input->post('status_menikah'),
                'pekerjaan'      	=> $this->input->post('pekerjaan'),
                'alamat'      		=> $this->input->post('alamat'),
                'kabupaten' 		=> $this->input->post('kabupaten'),
                'rt' 		=> $this->input->post('rt'),
                'rw' 		=> $this->input->post('rw'),
                'nama_orang_tua_atau_istri'      =>  $this->input->post('nama_orang_tua_atau_istri'),
                'nomer_telepon'     =>  $this->input->post('nomer_telepon'),
            );
            $data_pendaftaran = array(
                'no_pendaftaran' => $noPendaftaranSekarang,
                'no_rekam_medis' => $noRekamMedisSekarang,
                'id_dokter' => $this->input->post('id_dokter'),
                'id_klinik' => $this->id_klinik,
                'tipe_periksa' => $tipe_periksa,
            );
            $this->Pendaftaran_model->insert($data_pendaftaran);
            $this->Tbl_pasien_model->insert($data_pasien);
        }else{
            $data_pendaftaran = array(
                'no_pendaftaran' => $noPendaftaranSekarang,
                'no_rekam_medis' => $this->input->post('no_rekam_medis'),
                'id_dokter' => $this->input->post('id_dokter'),
                'id_klinik' => $this->id_klinik,
                'tipe_periksa' => $tipe_periksa,
            );
            $this->Pendaftaran_model->insert($data_pendaftaran);
        }
        $this->Pendaftaran_online_model->delete($this->input->post('id_pendaftaran'));
         // Set session sukses
         $this->session->set_flashdata('message', 'Data pendaftaran berhasil didaftarkan');
         $this->session->set_flashdata('message_type', 'success');
         // $this->template->load('template','pendaftaran/list_pendaftar_online');
         redirect(site_url('pendaftaran/list_pendaftar_online'));
    }

    public function addKab1()
    {
        $this->db->insert('tbl_kabupaten', ['kabupaten' => $_POST['kabupaten']]);
        $insert_id = $this->db->insert_id();
        echo $insert_id;
    }
    public function addKab()
    {
        $data = array(
            'kabupaten' => $_POST['kabupaten']
        );
        $this->Tbl_kabupaten_model->insert($data);
        echo json_encode(array(
            "statusCode"=>200,
            'Kabupaten' => $data
        ));
    }

    public function getSelectedInputDusun()
    {
        $data['kecamatan'] = $this->db->get_where("tbl_kecamatan",['id_kabupaten' => $_GET['id_kabupaten']])->result();
        $data['desa'] = $this->db->get_where("tbl_desa",['id_kecamatan' => $_GET['id_kecamatan']])->result();
        $data['dusun'] = $this->db->get_where("tbl_dusun",['id_desa' => $_GET['id_desa']])->result();

        echo json_encode($data);
    }    
        
}