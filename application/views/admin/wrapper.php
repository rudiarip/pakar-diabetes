<?php $this->load->view('admin/partials/mainhead');

if (isset($isi)) {
	$this->load->view($isi);
}

$this->load->view('admin/partials/footer');
