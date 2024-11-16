<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->logo = FCPATH . "assets/images/brand-logos/";

        if (!$this->session->userdata('logged')) {
            $this->session->set_flashdata('failed', 'Login Terlebih Dahulu');
            redirect(base_url('login'));
        }

        if ($this->session->userdata('level') == 'pasien') {
            redirect(base_url('dashboard_pasien'));
        }

        if ($this->session->userdata('level') == 'dokter') {
            redirect(base_url('pemeriksaan'));
        }
    }
    public function index()
    {
        $data = [
            'judul'     => '',
            'subjudul'  => 'Setting Aplikasi ',
            'isi'       => 'admin/page/setting',
            'script'    => 'admin/script/script_setting'
        ];
        $this->load->view('admin/wrapper', $data);
    }

    public function showdata()
    {
        $result = $this->db->get_where('tbl_setting', ['id' => '1'])->row();
		$hasil = [
			'status' => TRUE,
			'message' => 'success',
			'data' => $result
		];
        echo json_encode($hasil);
        return;
    }

    private function _configUpload()
    {
        $config['upload_path'] = $this->logo;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload');
        $this->upload->initialize($config);
    }

    private function _compressImg($name)
    {
        $config['image_library']    = 'gd2';
        $config['source_image']     = $this->logo . $name;
        $config['create_thumb']     = FALSE;
        $config['maintain_ratio']   = TRUE;
        $config['quality']          = '80%';
        $config['new_image']        = $this->logo . $name;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }


    function simpan()
    {
        $kodedit     = $this->input->post('kodedit');
        $app_name    = $this->input->post('app_name');
        $alamat      = $this->input->post('alamat');
        $email       = $this->input->post('email');
        $whatsapp    = $this->input->post('whatsapp');
        $cariold     = $this->db->get_where('tbl_setting', array('id' => $kodedit))->row();
        if (!empty($_FILES['logo']['name'])) {
            $oldimg = $cariold->logo;
            if ($oldimg) {
                if (is_file($this->logo . $oldimg)) {
                    unlink($this->logo . $oldimg);
                }
            }
            $this->_configUpload();

            if ($this->upload->do_upload('logo')) {
                $img = $this->upload->data();

                //Compress Image
                $this->_compressImg($img['file_name']);

                $gambar = $img['file_name'];
            } else {
                echo 'gagalgambar';
                $gambar = "gagalupload";
            }
            $data = array(
                'alamat'        => $alamat,
                'logo'          => $gambar,
                'app_name'      => $app_name,
                'whatsapp'      => $whatsapp,
                'email'         => $email,
                'updated_at'    => date('Y-m-d H:i:s'),
                'updated_by'    => $this->session->userdata('username')

            );
        } else {

            $data = array(
                'alamat'        => $alamat,
                'app_name'      => $app_name,
                'whatsapp'      => $whatsapp,
                'email'         => $email,
                'updated_at'    => date('Y-m-d H:i:s'),
                'updated_by'    => $this->session->userdata('username')
            );
        }

        $this->db->where('id', $kodedit);
        $simpan = $this->db->update('tbl_setting', $data);

        if ($simpan) {
            echo 'success';
        } else {
            echo 'error';
        }

        return;
    }
}
