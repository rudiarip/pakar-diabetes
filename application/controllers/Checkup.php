<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkup extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('app_name')) {
			$this->generate_setting();
		}
	}

	public function index()
	{
		$data = [
			'judul'		=> 'Pemeriksaan',
			'subjudul'	=> '',
			'isi'       => 'landing/page/checkup',
			'script'    => 'landing/script/script_checkup'
		];

		$this->load->view('landing/wrapper', $data);
	}

	public function get_next_gejala()
	{
		$id_penyakit 	  = $this->input->post('id_penyakit'); // current
		$id_gejala 		  = $this->input->post('id_gejala'); // current
		$jawaban 		  = $this->input->post('jawaban'); //ya atau tidak
		$riwayat_gejala   = $this->input->post('riwayat_gejala');
		$riwayat_penyakit = $this->input->post('riwayat_penyakit');
		$gejala_yes       = $this->input->post('gejala_yes');
		$riwayatResponse  = $this->input->post('riwayatResponse');

		if (!$id_gejala) {
			$result = $this->db->query("SELECT tr.id_rule, td.kode_disease, ts.kode_symptom, tr.id_symptom, ts.name_symptom, tr.id_disease
			FROM tbl_rules tr
			JOIN tbl_symptoms ts ON tr.id_symptom=ts.id_symptom
			JOIN tbl_diseases td ON tr.id_disease=td.id_disease
			ORDER BY td.kode_disease ASC, ts.kode_symptom ASC LIMIT 1")->row();

			if ($result) {
				$return = [
					'status' => TRUE,
					'message' => 'next',
					'data' => $result
				];
			} else {
				$return = [
					'status' => FALSE,
					'message' => 'failed'
				];
			}
		} else if ($jawaban == 'ya') {
			$riwayat_gejala = explode(',', $riwayat_gejala);

			$result = $this->db->select('tr.id_rule, td.kode_disease, ts.kode_symptom, tr.id_symptom, ts.name_symptom, tr.id_disease')
				->from('tbl_rules tr')
				->join('tbl_symptoms ts', 'tr.id_symptom=ts.id_symptom')
				->join('tbl_diseases td', 'tr.id_disease=td.id_disease')
				->where('tr.id_disease', (int)$id_penyakit)
				->where_not_in('tr.id_symptom', $riwayat_gejala)
				->order_by('td.kode_disease', 'ASC')->order_by('ts.kode_symptom', 'ASC')->get()->row();

			if ($result) {
				$return = [
					'status' => TRUE,
					'message' => 'next',
					'data' => $result
				];
			} else {
				$gejala_yes = explode(',', $gejala_yes);

				$kesimpulan = $this->db->select('p.name_disease, p.description,p.solution,p.id_disease,p.id_disease, CAST((COUNT(r.id_symptom) / total_gejala.total) * 100 AS UNSIGNED) AS persentase_terpenuhi')
					->from('tbl_rules r')
					->join('tbl_diseases p', 'r.id_disease = p.id_disease')
					->join('(SELECT id_disease, COUNT(*) as total FROM tbl_rules GROUP BY id_disease) total_gejala', 'total_gejala.id_disease = r.id_disease')
					->where_in('r.id_symptom', $gejala_yes)
					->group_by('p.id_disease')
					->having('persentase_terpenuhi >=', 70)
					->order_by('persentase_terpenuhi', 'DESC')->get()->result();

				if ($kesimpulan) {
					$this->storeKesimpulan($kesimpulan, $riwayatResponse);
				}

				$return = [
					'status' => TRUE,
					'message' => 'stop',
					'kesimpulan' => $kesimpulan
				];
			}
		} else if ($jawaban == 'tidak') {
			$riwayat_penyakit = explode(',', $riwayat_penyakit);
			$riwayat_gejala   = explode(',', $riwayat_gejala);

			$result = $this->db->select('tr.id_rule, td.kode_disease, ts.kode_symptom, tr.id_symptom, ts.name_symptom, tr.id_disease')
				->from('tbl_rules tr')
				->join('tbl_symptoms ts', 'tr.id_symptom=ts.id_symptom')
				->join('tbl_diseases td', 'tr.id_disease=td.id_disease')
				->where_not_in('tr.id_disease', $riwayat_penyakit)
				->where_not_in('tr.id_symptom', $riwayat_gejala)
				->order_by('td.kode_disease', 'ASC')->order_by('ts.kode_symptom', 'ASC')->get()->row();

			if ($result) {
				$return = [
					'status' => TRUE,
					'message' => 'next',
					'data' => $result
				];
			} else {

				$gejala_yes = explode(',', $gejala_yes);

				$kesimpulan = $this->db->select('p.name_disease, p.description,p.solution,p.id_disease, CAST((COUNT(r.id_symptom) / total_gejala.total) * 100 AS UNSIGNED) AS persentase_terpenuhi')
					->from('tbl_rules r')
					->join('tbl_diseases p', 'r.id_disease = p.id_disease')
					->join('(SELECT id_disease, COUNT(*) as total FROM tbl_rules GROUP BY id_disease) total_gejala', 'total_gejala.id_disease = r.id_disease')
					->where_in('r.id_symptom', $gejala_yes)
					->group_by('p.id_disease')
					->having('persentase_terpenuhi >=', 70)
					->order_by('persentase_terpenuhi', 'DESC')->get()->result();

				if ($kesimpulan) {
					$this->storeKesimpulan($kesimpulan, $riwayatResponse);
				}

				$return = [
					'status' => TRUE,
					'message' => 'stop',
					'kesimpulan' => $kesimpulan
				];
			}
		}

		echo json_encode($return);
		return;
	}

	private function storeKesimpulan($kesimpulan, $response)
	{
		$checkup_number = 'C-' . time();
		$id_user_detail = $this->session->userdata('id_detail') ?? 1;
		$created_by   	= $this->session->userdata('username') ?? 'system';
		$created_at   	= date('Y-m-d H:i:s');

		### Simpan ke tbl_checkup
		$rowK = [];
		$allK = [];
		foreach ($kesimpulan as $k) {
			$rowK['checkup_number'] = $checkup_number;
			$rowK['id_user_detail'] = $id_user_detail;
			$rowK['id_disease'] = $k->id_disease;
			$rowK['percentage'] = $k->persentase_terpenuhi;
			$rowK['created_at'] = $created_at;
			$rowK['created_by'] = $created_by;

			$allK[] = $rowK;
		}
		$this->db->insert_batch('tbl_checkup', $allK);
		###############

		### Simpan ke history response
		$rowR = [];
		$allR = [];
		foreach ($response as $k => $r) {
			// if ((int)$r !== 0) {
			$rowR['checkup_number'] = $checkup_number;
			$rowR['id_user_detail'] = $id_user_detail;
			$rowR['id_symptom'] = $k;
			$rowR['jawaban'] = $r;
			$rowR['created_at'] = $created_at;
			$rowR['created_by'] = $created_by;

			$allR[] = $rowR;
			// }
		}
		$this->db->insert_batch('tbl_response', $allR);
		###############################
	}
}
