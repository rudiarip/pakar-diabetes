<!-- app-header -->
<header class="app-header">

	<!-- Start::main-header-container -->
	<div class="main-header-container container-fluid">

		<!-- Start::header-content-left -->
		<div class="header-content-left">

			<!-- Start::header-element -->
			<div class="header-element">
				<div class="horizontal-logo">
					<a href="index.html" class="header-logo">
						<img src="../assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
						<img src="../assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
					</a>
				</div>
			</div>
			<!-- End::header-element -->

			<!-- Start::header-element -->
			<div class="header-element">
				<!-- Start::header-link -->
				<a href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
					<span class="open-toggle">
						<i class="ri-menu-3-line fs-20"></i>
					</span>
				</a>
				<!-- End::header-link -->
			</div>
			<!-- End::header-element -->

		</div>
		<!-- End::header-content-left -->

		<!-- Start::header-content-right -->
		<div class="header-content-right">

			<!-- Start::header-element -->
			<div class="header-element align-items-center">
				<!-- Start::header-link|switcher-icon -->
				<div class="btn-list d-lg-none d-block">
					<?php if ($this->session->userdata('logged')) { ?>
						<a href="<?= base_url('login/logout') ?>" class="btn btn-primary-light">
							Keluar
						</a>
					<?php } else { ?>
						<a href="<?= base_url('login') ?>" class="btn btn-primary-light">
							Masuk
						</a>
						<a href="<?= base_url('sign-up') ?>" class="btn btn-primary-light">
							Daftar
						</a>
					<?php } ?>
				</div>
				<!-- End::header-link|switcher-icon -->
			</div>
			<!-- End::header-element -->

		</div>
		<!-- End::header-content-right -->

	</div>
	<!-- End::main-header-container -->

</header>
<!-- /app-header -->
