<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

	<!-- Meta Data -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Sistem Pakar <?= $judul ? '| ' . $judul : '' ?> </title>
	<meta name="Description" content="Sistem Pakar">
	<!-- Favicon -->
	<link rel="icon" href="<?= base_url() ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">

	<!-- Main Theme Js -->
	<script src="<?= base_url() ?>assets/js/authentication-main.js"></script>

	<!-- Bootstrap Css -->
	<link id="style" href="<?= base_url() ?>assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Style Css -->
	<link href="<?= base_url() ?>assets/css/styles.min.css" rel="stylesheet">

	<!-- Icons Css -->
	<link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css">

</head>

<body>

	<div class="container">
		<div class="row justify-content-center align-items-center authentication authentication-basic h-100">
			<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
				<div class="my-5 d-flex justify-content-center">
					<a href="index.html">
						<img src="<?= base_url() ?>assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
						<img src="<?= base_url() ?>assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
					</a>
				</div>
				<div class="card custom-card">
					<div class="card-body p-5">
						<p class="h5 fw-semibold mb-2 text-center">Login</p>
						<!-- <p class="mb-4 text-muted op-7 fw-normal text-center">Welcome back Jhon !</p> -->
						<div class="row gy-3">
							<form id="inputform">
								<div class="col-xl-12 mb-2">
									<label for="username" class="form-label text-default">Username</label>
									<input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username" required>
								</div>
								<div class="col-xl-12 mb-2">
									<label for="password" class="form-label text-default d-block">Password</label>
									<div class="input-group">
										<input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="password" required>
										<button class="btn btn-light" type="button" onclick="createpassword('password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
									</div>
								</div>
								<div class="col-xl-12 d-grid mt-2">
									<button type="submit" id="btn-simpan" class="btn btn-lg btn-primary">Masuk</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Custom-Switcher JS -->
	<script src="<?= base_url() ?>assets/js/custom-switcher.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
	<!-- Show Password JS -->
	<script src="<?= base_url() ?>assets/js/show-password.js"></script>
	<script src="<?= base_url('') ?>assets/js/jquery-3.6.1.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#inputform').submit(function(e) {
				e.preventDefault();

				var formData = new FormData(this);
				formData.append(`referer`, `<?= $_GET['referer'] ?? ''?>`)

				$.ajax({
					type: "POST",
					url: "<?= base_url('login/proses') ?>",
					data: formData,
					processData: false,
					contentType: false,
					dataType: 'JSON',
					beforeSend: function() {
						$('#btn-simpan').html('<span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>Loading...')
						$('#btn-simpan').attr('disabled', '');
					},
					success: function(response) {
						$('#btn-simpan').removeAttr('disabled', '');
						$("#btn-simpan").html('Masuk')

						if (response.status) {

							window.location = response.url;

						} else {
							Swal.fire(response.message, "", "error");
						}
					},

					error: function(response) {
						$('#btn-simpan').removeAttr('disabled', '');
						$("#btn-simpan").html('Masuk')
						Swal.fire({
							type: 'error',
							title: 'OOPS!!',
							text: 'Server Error!'
						});
					}
				});
			});
		});
	</script>

</body>

</html>
