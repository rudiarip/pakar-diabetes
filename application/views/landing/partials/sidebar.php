<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

	<div class="container p-0">
		<!-- Start::main-sidebar -->
		<div class="main-sidebar">

			<!-- Start::nav -->
			<nav class="main-menu-container nav nav-pills sub-open">
				<div class="landing-logo-container">
					<div class="horizontal-logo">
						<a href="index.html" class="header-logo">
							<img src="<?= base_url() ?>upload/img/<?= $this->session->userdata('logo')?>" alt="logo" class="desktop-white">
						</a>
					</div>
				</div>
				<div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
						<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
					</svg></div>
				<ul class="main-menu">
					<!-- Start::slide -->
					<li class="slide">
						<a class="side-menu__item" href="<?= base_url() ?>">
							<span class="side-menu__label">Home</span>
						</a>
					</li>
					<?php if ($this->session->userdata('level') == 'pasien') { ?>
						<li class="slide">
							<a class="side-menu__item" href="<?= base_url('report') ?>">
								<span class="side-menu__label">Laporan</span>
							</a>
						</li>
					<?php } else if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'pakar') { ?>
						<li class="slide">
							<a class="side-menu__item" href="<?= base_url('dashboard') ?>">
								<span class="side-menu__label">Dashboard Admin</span>
							</a>
						</li>
					<?php } ?>
					<!-- End::slide -->

				</ul>
				<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
						<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
					</svg></div>
				<div class="d-lg-flex d-none">
					<div class="btn-list d-lg-flex d-none mt-lg-2 mt-xl-0 mt-0">
						<?php if ($this->session->userdata('logged')) { ?>
							<a href="<?= base_url('login/logout') ?>" class="btn btn-wave btn-primary">
								Keluar
							</a>
						<?php } else { ?>
							<a href="<?= base_url('login') ?>" class="btn btn-wave btn-primary">
								Masuk
							</a>
						<?php } ?>

					</div>
				</div>
			</nav>
			<!-- End::nav -->

		</div>
		<!-- End::main-sidebar -->
	</div>

</aside>
<!-- End::app-sidebar -->
