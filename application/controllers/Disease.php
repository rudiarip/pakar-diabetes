<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Disease extends CI_Controller
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

		// if ($this->session->userdata('level') == 'dokter') {
		// 	redirect(base_url('pemeriksaan'));
		// }
	}

	public function index()
	{
		$data = [
			'judul'		=> 'Master Data',
			'subjudul'	=> 'Penyakit',
			'isi'       => 'admin/page/disease',
			'script'    => 'admin/script/script_disease'
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
		$this->db->from('tbl_diseases');

		if (!empty($search)) {
			$this->db->like('kode_disease', $search);
			$this->db->or_like('name_disease', $search);
		}

		$this->db->where('deleted_at =', NULL);
		$this->db->order_by('kode_disease', 'ASC');
		$this->db->limit($length, $start);
		$query = $this->db->get();

		$data = array();
		$no = $start + 1;
		$aksi = '';
		foreach ($query->result() as $key => $lists) {

			$aksi = '<div class="hstack gap-2 flex-wrap">
						<a href="javascript:void(0);" class="text-info fs-14 lh-1 bedit" data="' . $lists->id_disease . '"><i class="ri-edit-line"></i></a>
						<a href="javascript:void(0);" class="text-danger fs-14 lh-1 bhapus" data="' . $lists->id_disease . '"><i class="ri-delete-bin-5-line"></i></a>
					</div>';

			$data[$key][]  = $no;
			$data[$key][]  = $aksi;
			$data[$key][]  = $lists->kode_disease;
			$data[$key][]  = $lists->name_disease;
			$data[$key][]  = $lists->description;
			$data[$key][]  = $lists->solution;
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
		$id_edit  		= $this->input->post('id_edit');
		$kode_disease  	= $this->input->post('kode_disease');
		$name_disease   = $this->input->post('name_disease');
		$description    = $this->input->post('description');
		$solution    	= $this->input->post('solution');
		$created_at		= date('Y-m-d H:i:s');
		$created_by		= $this->session->userdata('username') ?? 'System';

		if ($id_edit == '') {

			### Lakukan insert
			$param = array(
				'kode_disease' 	=> $kode_disease,
				'name_disease'  => $name_disease,
				'description'   => $description,
				'solution'   	=> $solution,
				'created_at'    => $created_at,
				'created_by'    => $created_by
			);

			$data = $this->db->insert('tbl_diseases', $param);
		} else {
			### Lakukan update
			$param = array(
				'kode_disease' 	=> $kode_disease,
				'name_disease'  => $name_disease,
				'description'   => $description,
				'solution'   	=> $solution,
				'updated_at'    => $created_at,
				'updated_by'    => $created_by
			);

			$this->db->set($param);
			$this->db->where('id_disease', $id_edit);
			$data = $this->db->update('tbl_diseases');
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
		$user = $this->db->where('id_disease', $id)->get('tbl_diseases')->row();

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

	public function hapus_()
	{
		$id  = $this->input->post('id');
		$cek = $this->db->where('id_disease', $id)->get('tbl_rules')->row();
		if ($cek) {
			$return = [
				'status' => FALSE,
				'message' => 'Gagal menghapus. Gejala terdaftar di rules'
			];
			echo json_encode($return);
			return;
		}
		// $data = $this->db->query("DELETE FROM tbl_diseases WHERE id_disease = '$id' ");

		//Soft Delete
		$param = array(
			'deleted_at' => date('Y-m-d H:i:s'),
			'deleted_by' => $this->session->userdata('username') ?? 'System',
		);

		$this->db->where('id_disease', $id);
		$data = $this->db->update('tbl_diseases', $param);

		if ($data) {
			$return = [
				'status' => TRUE,
				'message' => 'Berhasil menghapus penyakit'
			];
		} else {
			$return = [
				'status' => FALSE,
				'message' => 'Gagal menghapus penyakit'
			];
		}

		echo json_encode($return);
		return;
	}

	public function listDisease()
	{
		$data = $this->db->where('deleted_at =', NULL)->get('tbl_diseases')->result();

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
