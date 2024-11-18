<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged')) {
			redirect(base_url('login'));
		}

		if (!$this->session->userdata('app_name')) {
			$this->generate_setting();
		}
	}

	public function index()
	{
		$result = $this->db->query("SELECT 
				(SELECT COUNT(id_symptom) FROM tbl_symptoms WHERE deleted_at IS NULL) AS total_symptom,
				(SELECT COUNT(id_disease) FROM tbl_diseases WHERE deleted_at IS NULL) AS total_disease,
				(SELECT COUNT(id_rule) FROM tbl_rules) AS total_aturan,
				(SELECT COUNT(username) FROM tbl_login WHERE deleted_at IS NULL AND status = 'Y') AS total_username;
				")->row();

		$data = [
			'judul'		=> 'Dashboard',
			'subjudul'	=> '',
			'isi'       => 'admin/page/dashboard',
			'data'		=> $result
		];

		$this->load->view('admin/wrapper', $data);
	}
}
