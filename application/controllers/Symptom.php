<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Symptom extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		// $this->load->helper(array('form', 'url'));
		// $this->load->helper('cookie');
		$this->load->library('form_validation');
		$this->load->library('session');

		if (!$this->session->userdata('logged')) {
			redirect(base_url('login'));
		}

		if ($this->session->userdata('level') == 'pasien') {
			redirect(base_url());
		}
	}

	public function index()
	{
		$data = [
			'judul'		=> 'Master Data',
			'subjudul'	=> 'Gejala',
			'isi'       => 'admin/page/symptom',
			'script'    => 'admin/script/script_symptom'
		];

		$this->load->view('admin/wrapper', $data);
	}

	public function getdata()
	{
		$draw	= intval($this->input->post("draw"));
		$start 	= intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$search = $this->input->post('search');

		$this->db->select('*');
		$this->db->from('tbl_symptoms');

		if (!empty($search)) {
			$this->db->like('kode_symptom', $search);
			$this->db->or_like('name_symptom', $search);
		}

		$this->db->where('deleted_at =', NULL);
		$this->db->order_by('kode_symptom', 'ASC');
		$this->db->limit($length, $start);
		$query = $this->db->get();

		$data = array();
		$no = $start + 1;
		$aksi = '';
		foreach ($query->result() as $key => $lists) {

			$str = "'" . $lists->id_symptom . "', '" . $lists->kode_symptom . "', '" . $lists->name_symptom . "'";
			$aksi = '<div class="hstack gap-2 flex-wrap">
						<a href="javascript:void(0);" class="text-info fs-14 lh-1" onclick="editData(' . $str . ')"><i class="ri-edit-line"></i></a>
						<a href="javascript:void(0);" class="text-danger fs-14 lh-1 bhapus" data="' . $lists->id_symptom . '"><i class="ri-delete-bin-5-line"></i></a>
					</div>';

			$data[$key][]  = $no;
			$data[$key][]  = $aksi;
			$data[$key][]  = $lists->kode_symptom;
			$data[$key][]  = $lists->name_symptom;
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
		$kode_symptom    = $this->input->post('kode_symptom');
		$name_symptom    = $this->input->post('name_symptom');
		$created_at		 = date('Y-m-d H:i:s');
		$created_by		 = $this->session->userdata('username') ?? 'System';

		if ($id_edit == '') {
			### Validasi kode_symptom
			$cek = $this->db->where('kode_symptom', $kode_symptom)->get('tbl_symptoms')->row();
			if ($cek) {
				$return = [
					'status' => FALSE,
					'message' => 'Maaf Kode sudah terdaftar'
				];
				echo json_encode($return);
				return;
			}

			### Lakukan insert
			$param = array(
				'kode_symptom' 	 => $kode_symptom,
				'name_symptom'   => $name_symptom,
				'created_at'     => $created_at,
				'created_by'     => $created_by
			);

			$data = $this->db->insert('tbl_symptoms', $param);
		} else {
			### Lakukan update
			$param = array(
				'kode_symptom' 	 => $kode_symptom,
				'name_symptom'   => $name_symptom,
				'updated_at'     => $created_at,
				'updated_by'     => $created_by
			);

			$this->db->set($param);
			$this->db->where('id_symptom', $id_edit);
			$data = $this->db->update('tbl_symptoms');
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

	public function hapus_symptom()
	{
		$id = $this->input->post('id');
		$cek = $this->db->where('id_symptom', $id)->get('tbl_rules')->row();
		if ($cek) {
			$return = [
				'status' => FALSE,
				'message' => 'Gagal menghapus. Gejala terdaftar di rules'
			];
			echo json_encode($return);
			return;
		}

		// $data = $this->db->query("DELETE FROM tbl_symptoms WHERE id_symptom = '$id' ");

		//Soft Delete
		$param = array(
			'deleted_at' => date('Y-m-d H:i:s'),
			'deleted_by' => $this->session->userdata('username') ?? 'System',
		);

		$this->db->where('id_symptom', $id);
		$data = $this->db->update('tbl_symptoms', $param);

		if ($data) {
			$return = [
				'status' => TRUE,
				'message' => 'Berhasil menghapus gejala'
			];
		} else {
			$return = [
				'status' => FALSE,
				'message' => 'Gagal menghapus gejala'
			];
		}

		echo json_encode($return);
		return;
	}

	public function listSymptom()
	{
		$data = $this->db->where('deleted_at =', NULL)->get('tbl_symptoms')->result();

		if ($data) {
			$return = [
				'status' => TRUE,
				'message' => 'Berhasil',
				'data' => $data
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
}
