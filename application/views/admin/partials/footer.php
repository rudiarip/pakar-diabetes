</div>
</div>
<!-- End::app-content -->

<!-- Footer Start -->
<footer class="footer mt-auto py-3 bg-white text-center">
	<div class="container">
		<span class="text-muted"> Copyright © <span id="year"><?= date('Y') ?></span> <a
				href="javascript:void(0);" class="text-dark fw-semibold"></a>.
			Designed with <span class="bi bi-heart-fill text-danger"></span> All
			rights
			reserved
		</span>
	</div>
</footer>
<!-- Footer End -->

</div>

<script src="<?= base_url('') ?>assets/js/jquery-3.6.1.min.js"></script>

<?php $this->load->view('admin/partials/commonjs'); ?>

<script src="<?= base_url('') ?>assets/libs/datatables.net-bs5/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('') ?>assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url('') ?>assets/libs/datatables.net-bs5/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<?php
if (isset($script)) {
	$this->load->view($script);
}
?>

</body>

</html>