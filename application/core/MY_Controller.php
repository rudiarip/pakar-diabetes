<?php class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function my_global_function($param)
	{
		return "Hello from base controller, " . $param . "!";
	}

	public function generate_setting()
	{
		$get = $this->db->get('tbl_setting')->row();
		$data = [
			'app_name'  => $get->app_name,
			'alamat'    => $get->alamat,
			'whatsapp'  => $get->whatsapp,
			'logo'      => $get->logo
		];

		$this->session->set_userdata($data);
	}
}
