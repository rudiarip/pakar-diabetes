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
				<button type="button" class="btn btn-secondary btn-sm shadow-sm btn-wave waves-effect waves-light mb-2" onclick="tambahData()">
					Tambah Data
				</button>
				<table id="showTable" class="table table-bordered text-nowrap" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Aksi</th>
							<th>Kode Penyakit</th>
							<th>Nama Penyakit</th>
							<th>Kode Gejala</th>
							<th>Nama Gejala</th>
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
			<form enctype="multipart/form-data" id="inputform">
				<input type="hidden" name="id_edit" id="id_edit" class="form-control form-input">
				<div class="modal-body">
					<div class="col-md-12 mb-3">
						<div class="form-group">
							<label for="id_symptom" class="form-label">Gejala <span style="color:red"> *</span></label>
							<select class="form-control form-select2" id="id_symptom" name="id_symptom" required></select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="id_disease" class="form-label">Penyakit <span style="color:red"> *</span></label>
							<select class="form-control form-select2" id="id_disease" name="id_disease" required></select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
						Close
					</button>
					<button type="submit" class="btn btn-primary " id="btn-simpan"><i class="fas fa-save"></i>
						Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>