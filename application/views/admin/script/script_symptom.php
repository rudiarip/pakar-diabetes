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
					url: "<?php echo base_url('symptom/getdata') ?>",
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
				url: "<?= base_url('symptom/store') ?>",
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

		$('#showTable').on('click', '.bhapus', function() {
			var id = $(this).attr('data');
			swal.fire({
				title: 'Yakin Menghapus data gejala ini?',
				text: "Tekan ya jika anda yakin",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes'
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: '<?= base_url('symptom/hapus_symptom') ?>',
						type: 'POST',
						dataType: 'json',
						data: {
							id: id
						},
						dataType: 'JSON',
						success: function(response) {
							if (response.status) {
								Swal.fire(response.message, "", "success");
								$('#showTable').DataTable().ajax.reload();
							} else {
								Swal.fire(response.message, "", "error");
							}
						}
					});
				}
			});

		});

		editData = (id, kode, nama) => {
			$('#crudLabel').text('Edit Gejala')
			$('#id_edit').val(id);
			$('#kode_symptom').val(kode);
			$('#name_symptom').val(nama);
			$('#crudModal').modal('show');
		}

		tambahData = () => {
			$('#crudLabel').text('Tambah Gejala')
			$('.form-input').val('');
			$('#crudModal').modal('show');
		}

	})
</script>