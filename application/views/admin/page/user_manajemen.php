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
							<th>Username</th>
							<th>Nama Lengkap</th>
							<th>Jenis Kelamin</th>
							<th>Tempat & Tgl Lahir</th>
							<th>Alamat</th>
							<th>No. HP</th>
							<th>Status</th>
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
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="crudLabel"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form enctype="multipart/form-data" id="inputform">
				<input type="hidden" name="id_edit" id="id_edit" class="form-control form-input">
				<div class="modal-body">
					<div class="row" id="akun">
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label for="username" class="form-label">Username <span style="color:red"> *</span></label>
								<input id="username" name="username" class="form-control form-input" type="text" placeholder="Username" oninput="this.value = this.value.toLowerCase().replace(/\s+/g, '')">
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label for="password" class="form-label">Password <span style="color:red"> *</span></label>
								<input id="password" name="password" class="form-control form-input" type="password" placeholder="Password">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label for="nama_lengkap" class="form-label">Nama Lengkap <span style="color:red"> *</span></label>
								<input id="nama_lengkap" name="nama_lengkap" class="form-control form-input" type="text" placeholder="Nama Lengkap" required>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label for="gender" class="form-label">Jenis Kelamin <span style="color:red"> *</span></label>
								<select name="gender" id="gender" class="form-control form-input" required>
									<option value="" disabled selected>Pilih</option>
									<option value="Laki-laki">Laki-laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label for="tempat_lahir" class="form-label">Tempat Lahir <span style="color:red"> *</span></label>
								<input id="tempat_lahir" name="tempat_lahir" class="form-control form-input" type="text" placeholder="Masukkan Tempat Lahir" required>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label for="tgl_lahir" class="form-label">Tanggal Lahir <span style="color:red"> *</span></label>
								<input id="tgl_lahir" name="tgl_lahir" class="form-control form-input" type="date" required>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label for="no_telp" class="form-label">No Telepon <span style="color:red"> *</span></label>
								<input id="no_telp" name="no_telp" class="form-control form-input" type="number" placeholder="Masukkan Nomor HP" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 mb-3">
							<div class="form-group">
								<label for="alamat" class="form-label">Alamat</label>
								<textarea name="alamat" id="alamat" cols="" rows="1" class="form-control form-input" placeholder="Masukkan Alamat"></textarea>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label for="status" class="form-label">Status</label>
								<select name="status" id="status" class="form-control" required>
									<option value="Y" selected>Aktif</option>
									<option value="N">Non-Aktif</option>
								</select>
							</div>
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
