<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		// $this->load->helper(array('form', 'url'));
		// $this->load->helper('cookie');
		$this->load->library('form_validation');
		$this->load->library('session');

		// if (!$this->session->userdata('logged')) {
		// 	$this->session->set_flashdata('failed', 'Login Terlebih Dahulu');
		// 	redirect(base_url('login'));
		// }

		// if ($this->session->userdata('level') == 'pasien') {
		// 	redirect(base_url('dashboard_pasien'));
		// }

		// if ($this->session->userdata('level') == 'dokter') {
		// 	redirect(base_url('pemeriksaan'));
		// }
	}

	public function index()
	{
		$data = [
			'judul'		=> 'Master Data',
			'subjudul'	=> 'Pasien',
			'isi'       => 'admin/page/pasien',
			'script'    => 'admin/script/script_pasien'
		];

		$this->load->view('admin/wrapper', $data);
	}

	public function getdata()
	{
		$draw	= intval($this->input->post("draw"));
		$start 	= intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$search = $this->input->post('search');

		$this->db->select('tud.*, tl.username');
		$this->db->from('tbl_user_detail tud');
		$this->db->join('tbl_login tl', 'tl.id_detail=tud.id', 'left');

		if (!empty($search)) {
			$this->db->like('tud.nama_lengkap', $search);
			$this->db->or_like('tl.username', $search);
			$this->db->or_like('tud.no_telp', $search);
		}

		$this->db->where('tl.level', 'pasien');
		$this->db->where('tl.deleted_at', NULL);
		$this->db->order_by('tud.nama_lengkap', 'ASC');
		$this->db->limit($length, $start);
		$query = $this->db->get();

		$data = array();
		$no = $start + 1;
		$aksi = '';
		foreach ($query->result() as $key => $lists) {

			if ($lists->status == 'Y') {
				$status = '<span class="badge bg-success-transparent">Active</span>';
			} else {
				$status = '<span class="badge bg-light text-dark">Inactive</span>';
			}

			$aksi = '<div class="hstack gap-2 flex-wrap">
						<a href="javascript:void(0);" class="text-info fs-14 lh-1 bedit" data="' . $lists->id . '"><i class="ri-edit-line"></i></a>
						<a href="javascript:void(0);" class="text-danger fs-14 lh-1 bhapus" data="' . $lists->id . '"><i class="ri-delete-bin-5-line"></i></a>
					</div>';

			$data[$key][]  = $no;
			$data[$key][]  = $aksi;
			$data[$key][]  = $lists->username;
			$data[$key][]  = $lists->nama_lengkap;
			$data[$key][]  = $lists->gender;
			$data[$key][]  = $lists->tempat_lahir . ", " . date('d-m-Y', strtotime($lists->tgl_lahir));
			$data[$key][]  = $lists->alamat;
			$data[$key][]  = $lists->no_telp;
			$data[$key][]  = $status;
			$no++;
		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);

		echo json_encode($result);
		return;
	}

	function store()
	{
		$id_edit  		 = $this->input->post('id_edit');
		$username  		 = $this->input->post('username');
		$password   	 = $this->input->post('password');
		$nama_lengkap    = $this->input->post('nama_lengkap');
		$gender 		 = $this->input->post('gender');
		$tempat_lahir    = $this->input->post('tempat_lahir');
		$tgl_lahir 		 = $this->input->post('tgl_lahir');
		$no_telp  		 = $this->input->post('no_telp');
		$alamat 	 	 = $this->input->post('alamat');
		$status  	 	 = $this->input->post('status');
		$created_at		 = date('Y-m-d H:i:s');
		$created_by		 = $this->session->userdata('username') ?? 'System';

		if ($id_edit == '') {
			### Validasi username
			$cek = $this->db->where('username', $username)->get('tbl_login')->row();
			if ($cek) {
				$return = [
					'status' => FALSE,
					'message' => 'Maaf Username sudah terdaftar'
				];
				echo json_encode($return);
				return;
			}

			### Lakukan insert
			$param = array(
				'no_rm'			 => $this->generateRm(),
				'nama_lengkap' 	 => $nama_lengkap,
				'gender'  		 => $gender,
				'tempat_lahir'   => $tempat_lahir,
				'tgl_lahir'      => $tgl_lahir,
				'alamat' 		 => $alamat,
				'no_telp' 		 => $no_telp,
				'status' 		 => $status,
				'created_at'     => $created_at,
				'created_by'     => $created_by
			);

			$data = $this->db->insert('tbl_user_detail', $param);
			$idInsert = $this->db->insert_id();

			if ($idInsert) {
				$param2 = [
					'username' => $username,
					'password' => password_hash($password, PASSWORD_DEFAULT),
					'photo' => 'default.png',
					'level' => 'pasien',
					'status' => 'Y',
					'id_detail' => $idInsert,
					'created_at'  => $created_at,
					'created_by'  => $created_by
				];
				$data2 = $this->db->insert('tbl_login', $param2);
			}
		} else {
			### Lakukan update
			$param = array(
				'nama_lengkap' 	 => $nama_lengkap,
				'gender'  		 => $gender,
				'tempat_lahir'   => $tempat_lahir,
				'tgl_lahir'      => $tgl_lahir,
				'alamat' 		 => $alamat,
				'no_telp' 		 => $no_telp,
				'status' 		 => $status,
				'updated_at'     => $created_at,
				'updated_by'     => $created_by
			);

			$this->db->set($param);
			$this->db->where('id', $id_edit);
			$data = $this->db->update('tbl_user_detail');
		}

		if ($data) {
			$return = [
				'status' => TRUE,
				'message' => 'Berhasil'
			];
		} else {
			$return = [
				'status' => FALSE,
				'message' => 'Gagal'
			];
		}

		echo json_encode($return);
		return;
	}

	public function showedit()
	{
		$id   = $this->input->post('id');
		$user = $this->db->where('id', $id)->get('tbl_user_detail')->row();

		if ($user) {
			$return = [
				'status' => TRUE,
				'message' => 'Berhasil',
				'data' => $user
			];
		} else {
			$return = [
				'status' => FALSE,
				'message' => 'Gagal fetch data'
			];
		}

		echo json_encode($return);
		return;
	}

	public function hapus_pasien()
	{
		$id = $this->input->post('id');

		// $data = $this->db->query("DELETE FROM tbl_user_detail WHERE id = '$id' ");

		//Soft Delete
		$param = array(
			'deleted_at' => date('Y-m-d H:i:s'),
			'deleted_by' => $this->session->userdata('username') ?? 'System',
		);

		$this->db->where('id_detail', $id);
		$data = $this->db->update('tbl_login', $param);

		if ($data) {
			echo 'success';
		} else {
			echo 'error';
		}

		return;
	}

	private function generateRm()
	{
		$lastRecord = $this->db->select('no_rm')
			->order_by('no_rm', 'DESC')
			->limit(1)
			->get('tbl_user_detail')
			->row();

		if ($lastRecord) {
			$lastNumber = (int)$lastRecord->no_rm;
			$newNumber = $lastNumber + 1;
		} else {
			$newNumber = 10000000;
		}

		// Pastikan nomor memiliki 8 digit
		return str_pad($newNumber, 8, '0', STR_PAD_LEFT);
	}
}
