<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
	}

	public function index()
	{
		$data = [
			'judul'		=> 'Laporan',
			'subjudul'	=> 'Hasil Pemeriksaan',
			'isi'       => 'admin/page/report',
			'script'    => 'admin/script/script_report'
		];

		$this->load->view('admin/wrapper', $data);
	}

	public function getdata()
	{
		$draw	= intval($this->input->post("draw"));
		$start 	= intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$search = $this->input->post('search');

		$this->db->distinct('tc.checkup_number');
		$this->db->select('tc.checkup_number, tud.nama_lengkap, tud.gender, tc.created_at, tud.tgl_lahir');
		$this->db->from('tbl_checkup tc');
		$this->db->join('tbl_user_detail tud', 'tc.id_user_detail=tud.id', 'left');

		if (!empty($search)) {
			$this->db->like('tc.checkup_number', $search);
			$this->db->or_like('tud.nama_lengkap', $search);
		}

		if ($this->session->userdata('logged') && $this->session->userdata('level') == 'pasien') {
			$this->db->where('tc.id_user_detail', $this->session->userdata('id_detail'));
		}

		$this->db->order_by('tc.created_at', 'DESC');
		$this->db->limit($length, $start);
		$query = $this->db->get();

		$data = array();
		$no = $start + 1;
		foreach ($query->result() as $key => $lists) {

			$hasil_pemeriksaan = '<button onclick="hasilPemeriksaan(\'' . $lists->checkup_number . '\')" class="btn btn-sm btn-success btn-wave waves-effect waves-light">
                        <i class="ri-search-eye-line align-middle me-2 d-inline-block"></i>Lihat
                    </button>';
			$riwayat_jawaban = '<button onclick="riwayatJawaban(\'' . $lists->checkup_number . '\')" class="btn btn-sm btn-info btn-wave waves-effect waves-light">
                        <i class="ri-search-eye-line align-middle me-2 d-inline-block"></i>Lihat
                    </button>';

			$data[$key][]  = $no;
			$data[$key][]  = date('d F Y', strtotime($lists->created_at));
			$data[$key][]  = $lists->checkup_number;
			$data[$key][]  = $lists->nama_lengkap;
			$data[$key][]  = $lists->gender;
			$data[$key][]  = $lists->tgl_lahir ? date('d F Y', strtotime($lists->tgl_lahir)) : '-';
			$data[$key][]  = $hasil_pemeriksaan;
			$data[$key][]  = $riwayat_jawaban;
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

	public function hasil_pemeriksaan()
	{
		$checkup_number = $this->input->post('checkup_number');

		$result = $this->db->select('td.kode_disease, td.name_disease, tc.percentage')
			->from('tbl_checkup tc')
			->join('tbl_diseases td', 'tc.id_disease=td.id_disease')
			->where('tc.checkup_number', $checkup_number)
			->get()->result();

		echo json_encode($result);
		return;
	}

	public function riwayat_jawaban()
	{
		$checkup_number = $this->input->post('checkup_number');

		$result = $this->db->select('ts.kode_symptom, ts.name_symptom, UPPER(tr.jawaban) AS jawaban')
			->from('tbl_response tr')
			->join('tbl_symptoms ts', 'tr.id_symptom=ts.id_symptom')
			->where('tr.checkup_number', $checkup_number)->order_by('tr.id_response')
			->get()->result();

		echo json_encode($result);
		return;
	}
}
