<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-click" data-menu-position="fixed" data-theme-mode="light">

<head>

	<!-- Meta Data -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> <?= $this->session->userdata('app_name') ?> <?= $judul ? '| ' . $judul : '' ?> </title>
	<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
	<meta name="Author" content="Spruko Technologies Private Limited">

	<!-- Favicon -->
	<link rel="icon" href="<?= base_url() ?>upload/img/<?= $this->session->userdata('logo')?>" type="image/x-icon">

	<!-- Bootstrap Css -->
	<link id="style" href="<?= base_url() ?>assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Style Css -->
	<link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet">

	<!-- Icons Css -->
	<link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet">

	<!-- Node Waves Css -->
	<link href="<?= base_url() ?>assets/libs/node-waves/waves.min.css" rel="stylesheet">

	<!-- SwiperJS Css -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/libs/swiper/swiper-bundle.min.css">

	<!-- Color Picker Css -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/libs/flatpickr/flatpickr.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/libs/@simonwep/pickr/themes/nano.min.css">

	<!-- Choices Css -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/libs/choices.js/public/assets/styles/choices.min.css">

	<script>
		if (localStorage.ynexlandingdarktheme) {
			document.querySelector("html").setAttribute("data-theme-mode", "dark")
		}
		if (localStorage.ynexlandingrtl) {
			document.querySelector("html").setAttribute("dir", "rtl")
			document.querySelector("#style")?.setAttribute("href", "<?= base_url() ?>assets/libs/bootstrap/css/bootstrap.rtl.min.css");
		}
	</script>


</head>

<body class="landing-body">

	<div class="landing-page-wrapper">
		<?php $this->load->view('landing/partials/header'); ?>
		<?php $this->load->view('landing/partials/sidebar'); ?>
