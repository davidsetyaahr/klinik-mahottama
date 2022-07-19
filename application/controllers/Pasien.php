<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_pasien_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'pasien/tbl_pasien_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tbl_pasien_model->json();
    }

    public function label($id)
    {
        $this->data['pasien'] = $this->Tbl_pasien_model->get_by_id($id);
        $desa = $this->db->get_where('tbl_desa',['id' => $this->data['pasien']->id_desa])->row();
        $kecamatan = $this->db->get_where('tbl_kecamatan',['id' => $this->data['pasien']->id_kecamatan])->row();
        $this->data['alamat'] = $desa->desa." ".$kecamatan->kecamatan;
        // $data = $this->Tbl_pasien_model->get_by_id($id);
        // var_dump($data);
        $this->load->view('pasien/label_pasien', $this->data);
    }

    public function read($id)
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);
        if ($row) {
            $data = array(
                'no_rekamedis' => $row->no_rekamedis,
                'nama_pasien' => $row->nama_pasien,
                'jenis_kelamin' => $row->jenis_kelamin,
                'golongan_darah' => $row->golongan_darah,
                'tempat_lahir' => $row->tempat_lahir,
                'tanggal_lahir' => $row->tanggal_lahir,
                'nama_ibu' => $row->nama_ibu,
                'alamat' => $row->alamat,
                'id_agama' => $row->id_agama,
                'status_menikah' => $row->status_menikah,
                'no_hp' => $row->no_hp,
                'id_pekerjaan' => $row->id_pekerjaan,
            );
            $this->template->load('template', 'pasien/tbl_pasien_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }

    public function update($id)
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);

        if ($row) {
            $this->data['allKabupaten'] = $this->db->get("tbl_kabupaten")->result();
            $this->data['getKecamatan'] = $this->db->get_where("tbl_kecamatan", ['id_kabupaten' => $row->id_kabupaten])->result();
            $this->data['getDesa'] = $this->db->get_where("tbl_desa", ['id_kecamatan' => $row->id_kecamatan])->result();
            $this->data['getDusun'] = $this->db->get_where("tbl_dusun", ['id_desa' => $row->id_desa])->result();

            $this->data['action'] = site_url('pasien/update_action');
            $this->data['no_rekam_medis'] = set_value('no_rekam_medis', $row->no_rekam_medis);
            $this->data['no_id'] = set_value('no_id', $row->no_id_pasien);
            $this->data['nama_lengkap'] = set_value('nama_lengkap', $row->nama_lengkap);
            $this->data['golongan_darah'] = set_value('golongan_darah', $row->golongan_darah);
            $this->data['status_menikah'] = set_value('status_menikah', $row->status_menikah);
            $this->data['pekerjaan'] = set_value('pekerjaan', $row->pekerjaan);
            $this->data['alamat'] = set_value('alamat', $row->alamat);
            $this->data['id_kabupaten'] = set_value('id_kabupaten', $row->id_kabupaten);
            $this->data['id_kecamatan'] = set_value('id_kecamatan', $row->id_kecamatan);
            $this->data['id_desa'] = set_value('id_desa', $row->id_desa);
            $this->data['id_dusun'] = set_value('id_dusun', $row->id_dusun);
            $this->data['rt'] = set_value('rt', $row->rt);
            $this->data['rw'] = set_value('rw', $row->rw);
            $this->data['nama_orangtua_atau_istri'] = set_value('nama_orangtua_atau_istri', $row->nama_orang_tua_atau_istri);
            $this->data['nomor_telepon'] = set_value('nomor_telepon', $row->nomer_telepon);

            $this->template->load('template', 'pasien/tbl_pasien_form', $this->data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_rekam_medis', TRUE));
        } else {
            $data = array(
                'no_rekam_medis'    => $this->input->post('no_rekam_medis'),
                'no_id_pasien'        => $this->input->post('no_id'),
                'nama_lengkap'      => $this->input->post('nama_lengkap'),
                'golongan_darah'    => $this->input->post('golongan_darah'),
                'status_menikah'    => $this->input->post('status_menikah'),
                'pekerjaan'          => $this->input->post('pekerjaan'),
                'alamat'              => $this->input->post('alamat'),
                'id_kabupaten'         => $this->input->post('id_kabupaten'),
                'id_kecamatan'         => $this->input->post('id_kecamatan'),
                'id_desa'            => $this->input->post('id_desa'),
                'id_dusun'             => $this->input->post('id_dusun'),
                'rt'                 => $this->input->post('rt'),
                'rw'                 => $this->input->post('rw'),
                'nama_orang_tua_atau_istri'      =>  $this->input->post('nama_orangtua_atau_istri'),
                'nomer_telepon'     =>  $this->input->post('nomor_telepon'),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
            );

            $this->Tbl_pasien_model->update($this->input->post('no_rekam_medis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pasien'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pasien_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pasien'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_rekam_medis', 'No Rekam Medis', 'trim|required');
        $this->form_validation->set_rules('no_id', 'No ID Pasien', 'trim|required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        // $this->form_validation->set_rules('golongan_darah', 'Golongan Darah', 'trim|required');
        $this->form_validation->set_rules('status_menikah', 'Status Menikah', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
        // $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim|required');
        $this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('id_desa', 'Desa', 'trim|required');
        $this->form_validation->set_rules('nama_orangtua_atau_istri', 'Nama Orantua atau Istri', 'trim|required');
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function cetak_kartu($no_rekam_medis)
    {
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = 'assets/'; //string, the default is application/cache/
        $config['errorlog']     = 'assets/'; //string, the default is application/logs/
        $config['imagedir']     = 'assets/images/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $getNoRm = $this->Tbl_pasien_model->get_rm($no_rekam_medis);
        $image_name = str_replace('/', '-', $getNoRm->no_rekam_medis) . '.png'; //buat name dari qr code sesuai dengan no rekam medis

        $params['data'] = base_url() . "pasien/cetak_kartu/" . $getNoRm->no_rekam_medis; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $post['qr_code'] = $image_name;

        $data['pasien'] = $this->Tbl_pasien_model->get_cetak_id($no_rekam_medis);
        $data['detail'] = $this->Tbl_pasien_model->get_rm($no_rekam_medis);
        $this->load->view('pasien/form_cetak_id', $data);
    }
    public function map($no_rm)
    {
        $this->db->select("p.nama_lengkap,p.nama_orang_tua_atau_istri,du.nama_dusun,p.rt,p.rw,de.desa,kec.kecamatan,kab.kabupaten,p.nomer_telepon,riwayat_alergi_obat,p.no_rekam_medis");
        $this->db->join("tbl_kabupaten kab", "p.id_kabupaten = kab.id", 'left');
        $this->db->join("tbl_kecamatan kec", "p.id_kecamatan = kec.id", 'left');
        $this->db->join("tbl_desa de", "p.id_desa = de.id", 'left');
        $this->db->join("tbl_dusun du", "p.id_dusun = du.id", 'left');
        $data['pasien'] = $this->db->get_where("tbl_pasien p", ['p.no_rekam_medis' => $no_rm])->row();
        $this->load->view("pasien/map", $data);
    }
}

/* End of file Pasien.php */
/* Location: ./application/controllers/Pasien.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-03 15:02:10 */
/* http://harviacode.com */