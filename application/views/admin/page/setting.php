<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header">
				<div class="card-title">
					<?= $subjudul ?>
				</div>
			</div>
			<div class="card-body">
				<form id="inputform" enctype="multipart/form-data">
					<input type="hidden" id="kodedit" name="kodedit">

					<div class="form-group mb-3">
						<label for="app_name">Nama Aplikasi</label>
						<input type="text" class="form-control " id="app_name" name="app_name" placeholder="Nama Aplikasi" required>
						</input>
					</div>
					<div class="form-group mb-3">
						<label for="email">Email</label>
						<input type="mail" class="form-control " id="email" name="email" placeholder="email" required>
						</input>
					</div>
					<div class="form-group mb-3">
						<label for="whatsapp">Whatsapp</label>
						<input type="number" class="form-control " id="whatsapp" name="whatsapp" placeholder="Whatsapp" required>
						</input>
					</div>

					<div class="form-group mb-3">
						<label for="alamat">Alamat</label>
						<input type="text" class="form-control " id="alamat" name="alamat" placeholder="Alamat" required>
						</input>
					</div>
					<div class="form-group mb-3">
						<label for="logo">Logo</label>
						<input type="file" accept="image/*" class="form-control" id="logo" name="logo" placeholder="Logo">
					</div>
					<div class="form-group mb-3">
						<img class="img-fluid h-50 w-50 " alt="" id="imglogo">
					</div>


					<button id="buttonku" name="buttonku" class="btn btn-md  btn-primary mr-2"><i class="fa fa-save menu-icon"> </i> Simpan</button>

				</form>
			</div>
		</div>
	</div>
</div>