<?php $this->load->view('landing/partials/mainhead');

if (isset($isi)) {
	$this->load->view($isi);
}

$this->load->view('landing/partials/footer');
