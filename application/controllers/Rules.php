<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rules extends CI_Controller
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
			'judul'		=> 'Master',
			'subjudul'	=> 'Rules',
			'isi'       => 'admin/page/rule',
			'script'    => 'admin/script/script_rule'
		];

		$this->load->view('admin/wrapper', $data);
	}

	public function getdata()
	{
		$draw	= intval($this->input->post("draw"));
		$start 	= intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$search = $this->input->post('search');

		$this->db->select('tr.id_rule, td.id_disease, td.kode_disease, td.name_disease, ts.id_symptom, ts.kode_symptom, ts.name_symptom');
		$this->db->from('tbl_rules tr');
		$this->db->join('tbl_diseases td', 'tr.id_disease=td.id_disease', 'left');
		$this->db->join('tbl_symptoms ts', 'tr.id_symptom=ts.id_symptom', 'left');

		if (!empty($search)) {
			$this->db->like('td.kode_disease', $search);
			$this->db->or_like('td.name_disease', $search);
			$this->db->or_like('ts.kode_symptom', $search);
			$this->db->or_like('ts.name_symptom', $search);
		}

		$this->db->order_by('td.kode_disease', 'ASC');
		$this->db->order_by('ts.kode_symptom', 'ASC');
		$this->db->order_by('tr.id_rule', 'ASC');
		$this->db->limit($length, $start);
		$query = $this->db->get();

		$data = array();
		$no = $start + 1;
		$aksi = '';
		foreach ($query->result() as $key => $lists) {

			$str = "'" . $lists->id_rule . "', '" . $lists->id_symptom . "', '" . $lists->id_disease . "'";
			$aksi = '<div class="hstack gap-2 flex-wrap">
						<a href="javascript:void(0);" class="text-info fs-14 lh-1" onclick="editData(' . $str . ')"><i class="ri-edit-line"></i></a>
						<a href="javascript:void(0);" class="text-danger fs-14 lh-1 bhapus" data="' . $lists->id_rule . '"><i class="ri-delete-bin-5-line"></i></a>
					</div>';

			$data[$key][]  = $no;
			$data[$key][]  = $aksi;
			$data[$key][]  = $lists->kode_disease;
			$data[$key][]  = $lists->name_disease;
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
		$id_edit  		= $this->input->post('id_edit');
		$id_symptom    	= $this->input->post('id_symptom');
		$id_disease    	= $this->input->post('id_disease');
		$created_at		= date('Y-m-d H:i:s');
		$created_by		= $this->session->userdata('username') ?? 'System';

		if ($id_edit == '') {
			### Lakukan pengecekan
			$cek = $this->db->where('id_symptom', $id_symptom)->where('id_disease', $id_disease)->get('tbl_rules')->row();
			if ($cek) {
				$return = [
					'status' => FALSE,
					'message' => 'Maaf Gejala dan penyakit sudah terdaftar'
				];
				echo json_encode($return);
				return;
			}

			### Lakukan insert
			$param = array(
				'id_symptom' 	 => $id_symptom,
				'id_disease'     => $id_disease,
				'created_at'     => $created_at,
				'created_by'     => $created_by
			);

			$data = $this->db->insert('tbl_rules', $param);
		} else {
			### Lakukan update
			$param = array(
				'id_symptom' 	 => $id_symptom,
				'id_disease'     => $id_disease,
				'updated_at'     => $created_at,
				'updated_by'     => $created_by
			);

			$this->db->set($param);
			$this->db->where('id_rule', $id_edit);
			$data = $this->db->update('tbl_rules');
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

	public function destroy()
	{
		$id = $this->input->post('id');

		$data = $this->db->query("DELETE FROM tbl_rules WHERE id_rule = '$id' ");

		//Soft Delete
		// $param = array(
		// 	'deleted_at' => date('Y-m-d H:i:s'),
		// 	'deleted_by' => $this->session->userdata('username') ?? 'System',
		// );

		// $this->db->where('id_symptom', $id);
		// $data = $this->db->update('tbl_symptoms', $param);

		if ($data) {
			$return = [
				'status' => TRUE,
				'message' => 'Berhasil menghapus'
			];
		} else {
			$return = [
				'status' => FALSE,
				'message' => 'Gagal menghapus'
			];
		}

		echo json_encode($return);
		return;
	}
}
