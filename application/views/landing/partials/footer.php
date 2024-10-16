</div>

<div class="scrollToTop">
	<span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
</div>
<div id="responsive-overlay"></div>

<!-- Popper JS -->
<script src="<?= base_url() ?>assets/libs/@popperjs/core/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Color Picker JS -->
<script src="<?= base_url() ?>assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- Choices JS -->
<script src="<?= base_url() ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- Swiper JS -->
<script src="<?= base_url() ?>assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- Defaultmenu JS -->
<script src="<?= base_url() ?>assets/js/defaultmenu.min.js"></script>

<!-- Internal Landing JS -->
<script src="<?= base_url() ?>assets/js/landing.js"></script>

<!-- Node Waves JS-->
<script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>

<!-- Sticky JS -->
<script src="<?= base_url() ?>assets/js/sticky.js"></script>

<script src="<?= base_url('') ?>assets/js/jquery-3.6.1.min.js"></script>

<?php
if (isset($script)) {
	$this->load->view($script);
}
?>

</body>

</html>
