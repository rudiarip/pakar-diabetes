<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/quill/quill.snow.css">
<link rel="stylesheet" href="<?= base_url('') ?>assets/libs/quill/quill.bubble.css">
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
							<th>Kode</th>
							<th>Nama Penyakit</th>
							<th>Deskripsi</th>
							<th>Solusi</th>
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
							<label for="kode_disease" class="form-label">Kode Penyakit <span style="color:red"> *</span></label>
							<input id="kode_disease" name="kode_disease" class="form-control form-input" type="text" placeholder="Kode Penyakit" required>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-group">
							<label for="name_disease" class="form-label">Nama Penyakit <span style="color:red"> *</span></label>
							<input id="name_disease" name="name_disease" class="form-control form-input" type="text" placeholder="Nama Penyakit" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="description" class="form-label">Deskripsi</label>
							<div id="editor2"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="solution" class="form-label">Solusi <span style="color:red"> *</span></label>
							<div id="editor"></div>
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