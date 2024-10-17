<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['judul'] =  'Login';
		$this->load->view('admin/auth/login', $data);
	}

	public function proses()
	{
		$referer 	= $this->input->post('referer');
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$user		= $this->db->select('tl.username, tl.password, tl.level, tl.id, tud.nama_lengkap as nama, tl.photo, tl.id_detail, tl.status')
			->join('tbl_user_detail tud', 'tl.id_detail=tud.id')
			->get_where('tbl_login tl', ['tl.username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {

				if ($user['status'] == 'Y') {
					$data = [
						'id'        => $user['id'],
						'level'     => $user['level'],
						'username'  => $user['username'],
						'nama'      => $user['nama'],
						'photo'     => $user['photo'],
						'id_detail' => $user['id_detail'],
					];

					$this->session->set_userdata('logged', TRUE);
					$this->session->set_userdata($data);

					//Update Last Login
					$paramUpdate = [
						'last_login' => date('Y-m-d H:i:s'),
					];

					$this->db->where('id', $user['id']);
					$this->db->update('tbl_login', $paramUpdate);

					if ($user['level'] == 'pasien') {
						$url = base_url();
					} else {
						$url = base_url('dashboard');
					}

					if ($referer !== '') {
						$url = base_url() . $referer;
					}

					$return = [
						'status' => TRUE,
						'message' => 'Login berhasil',
						'url' => $url
					];

					echo json_encode($return);
					return;
				} else {
					$return = [
						'status' => FALSE,
						'message' => 'Maaf akun anda terblokir!'
					];

					echo json_encode($return);
					return;
				}
			} else {
				$return = [
					'status' => FALSE,
					'message' => 'Username atau Password salah'
				];

				echo json_encode($return);
				return;
			}
		} else {
			$return = [
				'status' => FALSE,
				'message' => 'Username atau Password salah'
			];

			echo json_encode($return);
			return;
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url());
	}
}
