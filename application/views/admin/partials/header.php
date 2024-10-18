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
 						<img src="<?= base_url('') ?>assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
 						<img src="<?= base_url('') ?>assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
 						<img src="<?= base_url('') ?>assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
 						<img src="<?= base_url('') ?>assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
 					</a>
 				</div>
 			</div>
 			<!-- End::header-element -->

 			<!-- Start::header-element -->
 			<div class="header-element">
 				<!-- Start::header-link -->
 				<a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
 				<!-- End::header-link -->
 			</div>
 			<!-- End::header-element -->

 		</div>
 		<!-- End::header-content-left -->

 		<!-- Start::header-content-right -->
 		<div class="header-content-right">

 			<!-- Start::header-element -->
 			<div>
 				<a href="<?= base_url() ?>" class="mt-3 me-3 btn btn-success btn-sm"> Mulai Pemeriksaan <i class="ri-play-line align-middle"></i></a>
 			</div>
 			<div class="header-element">
 				<!-- Start::header-link|dropdown-toggle -->
 				<a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
 					<div class="d-flex align-items-center">
 						<div class="me-sm-2 me-0">
 							<img src="<?= base_url('upload/fotoprofile/') . $this->session->userdata('photo') ?>" alt="img" width="32" height="32" class="rounded-circle">
 						</div>
 						<div class="d-sm-block d-none">
 							<p class="fw-semibold mb-0 lh-1"><?= $this->session->userdata('nama') ?? 'Name' ?></p>
 							<span class="op-7 fw-normal d-block fs-11"><?= $this->session->userdata('level') ? strtoupper($this->session->userdata('level')) : 'Level' ?></span>
 						</div>
 					</div>
 				</a>
 				<!-- End::header-link|dropdown-toggle -->
 				<ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
 					<!-- <li><a class="dropdown-item d-flex" href="<= base_url('profile') ?>"><i class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li> -->
 					<li><a class="dropdown-item d-flex" href="<?= base_url('login/logout') ?>"><i class="ti ti-logout fs-18 me-2 op-7"></i>Keluar</a></li>
 				</ul>
 			</div>
 			<!-- End::header-element -->

 		</div>
 		<!-- End::header-content-right -->

 	</div>
 	<!-- End::main-header-container -->

 </header>
 <!-- /app-header -->
