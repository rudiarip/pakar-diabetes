<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>

	<!-- Meta Data -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Sistem Pakar </title>
	<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
	<meta name="Author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

	<!-- Favicon -->
	<link rel="icon" href="<?= base_url('') ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">

	<!-- Choices JS -->
	<script src="<?= base_url('') ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

	<!-- Main Theme Js -->
	<script src="<?= base_url('') ?>assets/js/main.js"></script>

	<!-- Bootstrap Css -->
	<link id="style" href="<?= base_url('') ?>assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Style Css -->
	<link href="<?= base_url('') ?>assets/css/styles.min.css" rel="stylesheet">

	<!-- Icons Css -->
	<link href="<?= base_url('') ?>assets/css/icons.css" rel="stylesheet">

	<!-- Node Waves Css -->
	<link href="<?= base_url('') ?>assets/libs/node-waves/waves.min.css" rel="stylesheet">

	<!-- Simplebar Css -->
	<link href="<?= base_url('') ?>assets/libs/simplebar/simplebar.min.css" rel="stylesheet">

	<!-- Color Picker Css -->
	<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/flatpickr/flatpickr.min.css">
	<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/@simonwep/pickr/themes/nano.min.css">

	<!-- Choices Css -->
	<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/choices.js/public/assets/styles/choices.min.css">
	<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/datatables.net-bs5/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/datatables.net-bs5/css/buttons.bootstrap5.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css">

</head>

<body>
	<div class="page">
		<?php $this->load->view('admin/partials/header'); ?>
		<?php $this->load->view('admin/partials/sidebar'); ?>

		<!-- Start::app-content -->
		<div class="main-content app-content">
			<div class="container-fluid">
				<?php $this->load->view('admin/partials/page-header'); ?>