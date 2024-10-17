<!-- Start::app-content -->
<div class="main-content landing-main">

	<!-- Start:: Section-1 -->
	<div class="landing-banner" id="home">
		<section class="section">
			<div class="container main-banner-container">
				<div class="row">
					<div class="col-xxl-7 col-xl-7 col-lg-7 col-md-8">
						<div class="py-lg-5">
							<div class="mb-3">
								<h5 class="fw-semibold text-fixed-white op-9">SISTEM PAKAR</h5>
							</div>
							<div class="opening">
								<p class="landing-banner-heading mb-3">Mari periksa kesehatanmu dengan <span class="text-secondary">kami !</span></p>
								<div class="fs-16 mb-5 text-fixed-white op-7">Kami dapat mendeteksi apakah kamu menderita diabetes.</div>
							</div>
							<div id="showQuestion" style="display: none;">
								<p class="landing-banner-heading"><span id="question"></span></p>
							</div>
							<div id="loadingPertanyaan"></div>
							<div class="opening">
								<?php if ($this->session->userdata('logged')) { ?>
									<button id="btnMulai" class="m-1 btn btn-primary"> Mulai Pemeriksaan <i class="ri-play-line align-middle"></i></button>
								<?php } else { ?>
									<a href="<?= base_url('login?referer=checkup') ?>" class="btn btn-wave btn-primary">
										Masuk untuk memulai pemeriksaan
									</a>
								<?php } ?>

							</div>
							<button style="display: none;" id="btnRepeat" class="btn btn-warning"> Ulangi Pemeriksaan <i class="ri-repeat-line align-middle"></i></button>
							<div id="btnJawab" style="display: none;">
								<button id="ya" class="m-1 btn btn-success"> YA <i class="ri-check-double-line align-middle"></i></button>
								<button id="tidak" class="m-1 btn btn-danger"> TIDAK <i class="ri-close-line align-middle"></i></button>
							</div>
						</div>
					</div>
					<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-4">
						<div class="text-end landing-main-image landing-heading-img">
							<img src="<?= base_url() ?>assets/images/landing.png" alt="" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- End:: Section-1 -->

	<?php if ($this->session->userdata('logged')) { ?>
		<!-- Start:: Section-2 -->
		<section class="section section-bg " id="statistics">
			<div class="container position-relative">
				<div class="text-center">
					<p class="fs-12 fw-semibold text-success mb-1"><span class="landing-section-heading">SISTEM PAKAR</span></p>
					<h3 class="fw-semibold mb-2">Kesimpulan</h3>
					<div class="row justify-content-center">
						<div class="col-xl-7">
							<p class="text-muted fs-15 mb-5 fw-normal">Hasil analisa akan tampil disini.</p>
						</div>
					</div>
				</div>
				<div class="row g-2 justify-content-center">
					<div class="col-xl-12">
						<div id="showKesimpulan"></div>
					</div>
				</div>
			</div>
		</section>
		<!-- End:: Section-2 -->
	<?php } ?>


	<div class="text-center landing-main-footer py-3">
		<span class="text-muted fs-15"> Copyright © <?= date('Y') ?>
			</a> All
			rights
			reserved
		</span>
	</div>

</div>
<!-- End::app-content -->
