<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
	}
	public function index()
	{
		echo "Masuk";
		exit;
		$data['slider']  = $this->db->query('SELECT * FROM slider ORDER BY id ASC')->result();
		$data['guru']  = $this->db->query('SELECT * FROM guru ORDER BY id ASC LIMIT 6')->result();
		$data['ekskul']  = $this->db->get('ekskul')->result();
		$data['foto']  = $this->db->query('SELECT * FROM foto ORDER BY id DESC LIMIT 10')->result();
		$data['siswa']  = $this->db->query('SELECT * FROM siswa ORDER BY id DESC ')->result();
		$data['jumlahsiswa']  = $this->db->query('SELECT SUM(jumlah) AS jumlahsiswa FROM siswa')->row();
		$data['sambutankepsek']  = $this->db->query('SELECT * FROM sambutan WHERE id = "1"  ')->row();
		$data['denah']  = $this->db->query('SELECT * FROM denah WHERE id = "1"  ')->row();
		$data['berita'] = $this->M_dashboard->get_datadashboard();
		$data['denahbangunan']  = $this->db->query('SELECT * FROM denahbangunan WHERE id = "1"  ')->row();



		$this->load->view('dashboard/page/dashboard', $data);
	}

	public function kirimpesan()
	{


		$data = array(
			'nama' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'subjek' => $this->input->post('subject'),
			'pesan' => $this->input->post('message'),
			'waktu' => date('Y-m-d H:i:s')
		);

		$simpan = $this->db->insert('kontak', $data);


		// kirim email dan simpan data ke database
		if ($simpan) {
			$this->session->set_flashdata('success_msg', 'Pesan Anda telah berhasil dikirim!');
		} else {
			$this->session->set_flashdata('error_msg', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.');
		}
		redirect('dashboard');
	}

	public function profil_sekolah()
	{


		$data = [
			'judul'		=> 'Profil',
			'subjudul'	=> 'Profil Sekolah ',
			'profil'     => $this->db->query('SELECT * FROM profil WHERE id = "1"  ')->row(),
		];

		$this->load->view('dashboard/page/profil', $data);
	}

	public function visi_misi()
	{

		$data = [
			'judul'		=> 'Profil',
			'subjudul'	=> 'Visi Misi Sekolah ',
			'visi'     => $this->db->query('SELECT * FROM visi WHERE id = "1"  ')->row(),
		];

		$this->load->view('dashboard/page/visimisi', $data);
	}

	public function guru()
	{

		$data = [
			'judul'		=> 'Informasi',
			'subjudul'	=> 'Guru',
			'guru'     => $this->db->query('SELECT * FROM guru ORDER BY id ASC ')->result(),
		];

		$this->load->view('dashboard/page/guru', $data);
	}

	public function video()
	{

		$data = [
			'judul'		=> 'Gellery',
			'subjudul'	=> 'Video',
			'video'     => $this->db->query('SELECT * FROM video ORDER BY id DESC ')->result(),
		];

		$this->load->view('dashboard/page/video', $data);
	}

	public function foto()
	{

		$data = [
			'judul'		=> 'Gellery',
			'subjudul'	=> 'Foto',
			'foto'     => $this->db->query('SELECT * FROM foto ORDER BY id DESC ')->result(),
		];

		$this->load->view('dashboard/page/foto', $data);
	}

	public function struktur_organisasi()
	{

		$data = [
			'judul'		=> 'Profil',
			'subjudul'	=> 'Struktur Organisasi Sekolah ',
			'struktur'     => $this->db->query('SELECT * FROM struktur WHERE id = "1"  ')->row(),
		];

		$this->load->view('dashboard/page/struktur', $data);
	}

	public function ekskuldetail($slug = "")
	{
		if (!$slug) {
			redirect('dashboard');
		}

		$cekdulu = $this->M_dashboard->get_ekskul_by_slug($slug);


		if ($cekdulu->num_rows() < 1) {
			redirect('my404');
		} else {
			$data = [
				'judul'		=> 'Ekstrakulikuler',
				'ekskul'   => $this->db->get('ekskul')->result()
			];
			$data['detail']   = $this->M_dashboard->get_ekskul_by_slug($slug)->row();
			$data['berita'] = $this->M_dashboard->get_datadashboard();
			$data['subjudul'] = $data['detail']->judul;

			$this->load->view('dashboard/page/detailekskul', $data);
		}
	}

	public function berita_list()
	{

		$data = [
			'judul'		=> 'Informasi',
			'subjudul'	=> 'Daftar Berita',

		];
		$config['base_url'] = site_url('berita-sekolah-list'); //site url
		$config['total_rows'] = $this->db->get('berita')->num_rows(); //total row
		$config['per_page'] = 6;  //show record per halaman
		$config["uri_segment"] = 2;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);


		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(1)) ? $this->uri->segment(2) : 0;


		$start = $this->uri->segment(2);
		$data['beritalists'] = $this->M_dashboard->get_all_post($config['per_page'], $start);


		$data['pagination'] = $this->pagination->create_links();

		$data['berita'] = $this->M_dashboard->get_datadashboard();
		$data['ekskul']  = $this->db->get("ekskul")->result();


		$this->load->view('dashboard/page/list_berita', $data);
	}





	public function beritadetail($slug = "")
	{
		if (!$slug) {
			redirect('dashboard');
		}

		$cekdulu = $this->M_dashboard->get_post_by_slug($slug);
		$data['berita'] = $this->M_dashboard->get_datadashboard();
		if ($cekdulu->num_rows() < 1) {
			redirect('my404');
		} else {
			$data = [
				'judul'		=> 'Berita Detail',
				'ekskul'   => $this->db->get('ekskul')->result()
			];

			$data['detail']   = $this->M_dashboard->get_post_by_slug($slug)->row();
			$data['berita'] = $this->M_dashboard->get_datadashboard();
			$data['subjudul'] = 'Berita Detail';
			$this->load->view('dashboard/page/detailberita', $data);
		}
	}
}
