<link href="<?= base_url('') ?>assets/css/select2.min.css" rel="stylesheet">
<!-- Start::row-1 -->
<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header">
				<div class="card-title">
					<?= $subjudul ?>
				</div>
			</div>
			<div class="card-body">
				<table id="showTable" class="table table-bordered text-nowrap" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeriksaan</th>
							<th>Nomor Pemeriksaan</th>
							<th>Nama</th>
							<th>Gender</th>
							<th>Tanggal Lahir</th>
							<th>Hasil Pemeriksaan</th>
							<th>Jawaban Pemeriksaan</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!--End::row-1 -->

<!-- MODAL CRUD-->
<div class="modal fade" id="crudModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="crudLabel"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<div id="showTablePemeriksaan"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
