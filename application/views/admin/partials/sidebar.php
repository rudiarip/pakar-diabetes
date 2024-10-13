<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

	<!-- Start::main-sidebar-header -->
	<div class="main-sidebar-header">
		<a href="index.html" class="header-logo">
			<img src="<?= base_url('') ?>assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
			<img src="<?= base_url('') ?>assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
			<img src="<?= base_url('') ?>assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
			<img src="<?= base_url('') ?>assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
		</a>
	</div>
	<!-- End::main-sidebar-header -->

	<!-- Start::main-sidebar -->
	<div class="main-sidebar" id="sidebar-scroll">

		<!-- Start::nav -->
		<nav class="main-menu-container nav nav-pills flex-column sub-open">
			<div class="slide-left" id="slide-left">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
					<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
				</svg>
			</div>
			<ul class="main-menu">
				<!-- Start::slide__category -->
				<li class="slide__category"><span class="category-name">Main</span></li>
				<!-- End::slide__category -->

				<!-- Start::slide -->
				<li class="slide">
					<a href="javascript:void(0);" class="side-menu__item">
						<i class="bx bx-home side-menu__icon"></i>
						<span class="side-menu__label">Dashboards</span>
					</a>
				</li>
				<!-- End::slide -->

				<!-- Start::slide__category -->
				<li class="slide__category"><span class="category-name">Pages</span></li>
				<!-- End::slide__category -->

				<!-- Start::slide -->
				<li class="slide has-sub <?= $this->uri->segment(1) == 'pasien' ||  $this->uri->segment(1) == 'pakar' ||  $this->uri->segment(1) == 'symptom' ||  $this->uri->segment(1) == 'disease' ? "active open" : "" ?>">
					<a href="javascript:void(0);" class="side-menu__item <?= $this->uri->segment(1) == 'pasien' ||  $this->uri->segment(1) == 'pakar' ||  $this->uri->segment(1) == 'symptom' ||  $this->uri->segment(1) == 'disease' ? "active" : "" ?>">
						<i class="bx bx-file-blank side-menu__icon"></i>
						<span class="side-menu__label">Master Data</span>
						<i class="fe fe-chevron-right side-menu__angle"></i>
					</a>
					<ul class="slide-menu child1">
						<li class="slide side-menu__label1">
							<a href="javascript:void(0)">Master Data</a>
						</li>
						<li class="slide">
							<a href="<?= base_url('pasien') ?>" class="side-menu__item <?= $this->uri->segment(1) === 'pasien' ? "active" : "" ?>">Pasien</a>
						</li>

						<li class="slide">
							<a href="<?= base_url('pakar') ?>" class="side-menu__item <?= $this->uri->segment(1) === 'pakar' ? "active" : "" ?>">Pakar</a>
						</li>

						<li class="slide">
							<a href="<?= base_url('symptom') ?>" class="side-menu__item <?= $this->uri->segment(1) === 'symptom' ? "active" : "" ?>">Gejala</a>
						</li>

						<li class="slide">
							<a href="<?= base_url('disease') ?>" class="side-menu__item <?= $this->uri->segment(1) === 'disease' ? "active" : "" ?>">Penyakit</a>
						</li>
					</ul>
				</li>


				<li class="slide">
					<a href="<?= base_url('rules') ?>" class="side-menu__item <?= $this->uri->segment(1) == 'rules' ? "active" : "" ?>">
						<i class="bx bx-cog side-menu__icon"></i>
						<span class="side-menu__label">Master Rules</span>
					</a>
				</li>
				<!-- End::slide -->

			</ul>
			<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
					<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
				</svg></div>
		</nav>
		<!-- End::nav -->

	</div>
	<!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->