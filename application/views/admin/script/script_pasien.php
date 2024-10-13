<script>
	$(document).ready(function() {
		tampildata();

		function tampildata() {
			$('#showTable').DataTable({
				// dom: 'Blfrtip',
				// buttons: [
				//     'copy', 'csv', 'excel', 'pdf', 'print'
				// ],
				// lengthMenu: [
				//     [10, 25, 50, -1],
				//     ['10 Filas', '25 Filas', '50 Filas', 'Mostrar todo']
				// ],
				"responsive": true,
				"lengthChange": true,
				"autoWidth": true,
				"paging": true,
				"serverSide": true, // Enable server-side processing
				"searching": true, // Aktifkan fitur pencarian
				"language": {
					"processing": "Loading. Please wait..."
				},
				"ajax": {
					url: "<?php echo base_url() ?>pasien/getdata",
					type: "POST",
					data: function(d) {
						d.search = $('#showTable_filter input').val(); // Mengambil nilai pencarian dari input DataTable
					}
				},
			});
		}

		$('#inputform').submit(function(e) {
			e.preventDefault();

			$.ajax({
				type: "POST",
				url: "<?= base_url('pasien/store') ?>",
				data: new FormData(this),
				processData: false,
				contentType: false,
				dataType: 'JSON',
				beforeSend: function() {
					$('#btn-simpan').html('<span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>Loading...')
					$('#btn-simpan').attr('disabled', '');
				},
				success: function(response) {
					$('#btn-simpan').removeAttr('disabled', '');
					$("#btn-simpan").html('<i class="fas fa-save"></i> Simpan')
					if (response.status) {

						Swal.fire(response.message, "", "success");

						$('#showTable').DataTable().ajax.reload();
						$('#crudModal').modal('hide');
					} else {
						Swal.fire(response.message, "", "error");
					}
				},

				error: function(response) {
					$('#btn-simpan').removeAttr('disabled', '');
					$("#btn-simpan").html('<i class="fas fa-save"></i> Simpan')
					Swal.fire({
						type: 'error',
						title: 'OOPS!!',
						text: 'Server Error!'
					});
				}
			});
		});

		// showedit data
		$('#showTable').on('click', '.bedit', function() {
			var id = $(this).attr('data');
			$.ajax({
				type: "POST",
				url: "<?= base_url('pasien/showedit') ?>",
				dataType: "JSON",
				data: {
					id: id
				},
				dataType: 'JSON',
				beforeSend: function() {
					$('#crudLabel').text('Edit Pasien')
					$('#akun').hide();
					$('#username').removeAttr('required');
					$('#password').removeAttr('required');
				},
				success: function(response) {
					if (response.status) {
						var data = response.data

						$('#crudModal').modal('show');
						$('#id_edit').val(id);
						$('#nama_lengkap').val(data.nama_lengkap);
						$('#gender').val(data.gender);
						$('#tempat_lahir').val(data.tempat_lahir);
						$('#tgl_lahir').val(data.tgl_lahir);
						$('#no_telp').val(data.no_telp);
						$('#alamat').val(data.alamat);
						$('#status').val(data.status);

					} else {
						Swal.fire(response.message, "", "error");;
					}
				}
			});

		});

		$('#showTable').on('click', '.bhapus', function() {
			var id = $(this).attr('data');
			swal.fire({
				title: 'Yakin Menghapus data pasien ini?',
				text: "Tekan ya jika anda yakin",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes'
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: '<?= base_url('pasien/hapus_pasien') ?>',
						type: 'POST',
						dataType: 'json',
						data: {
							id: id
						},

						success: function(jqXHR, textStatus) {
							if (respon == "success") {
								Swal.fire("Data berhasil dihapus", "", "success");
								$('#showTable').DataTable().ajax.reload();
							} else {
								Swal.fire("Data gagal dihapus", "", "error");
							}
						},
						error: function(a, textStatus) {
							if (a.responseText == 'success') {
								$('#showTable').DataTable().ajax.reload();
								Swal.fire("Data berhasil dihapus", "", "success");

							} else if (a.responseText == 'ada') {

								Swal.fire("Data gagal dihapus", "", "error");

							}
						}

					});
				}
			});

		});

		tambahData = () => {
			$('#crudLabel').text('Tambah Pasien')
			$('.form-input').val('');
			$('#crudModal').modal('show');
			$('#akun').show();
			$('#status').val('Y');
			$('#username').attr('required', true);
			$('#password').attr('required', true);

		}

	})
</script>
