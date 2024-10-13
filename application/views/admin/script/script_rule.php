<script src="<?= base_url() ?>assets/js/select2.min.js"></script>
<script>
	$(document).ready(function() {
		$("#id_symptom").select2({
			allowClear: true,
			dropdownParent: $('#id_symptom').closest('div'),
			placeholder: "Pilih Gejala"
		});

		$("#id_disease").select2({
			allowClear: true,
			dropdownParent: $('#id_disease').closest('div'),
			placeholder: "Pilih Penyakit"
		});

		tampildata();
		listGejala();
		listPenyakit();

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
					url: "<?php echo base_url('rules/getdata') ?>",
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
				url: "<?= base_url('rules/store') ?>",
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
				title: 'Yakin Menghapus data rules ini?',
				text: "Tekan ya jika anda yakin",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes'
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: '<?= base_url('rules/destroy') ?>',
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

		editData = (id, id_gejala, id_penyakit) => {
			$('#crudLabel').text('Edit Aturan')
			$('#id_edit').val(id);
			$('#id_symptom').val(id_gejala).trigger('change');
			$('#id_disease').val(id_penyakit).trigger('change');
			$('#crudModal').modal('show');
		}

		tambahData = () => {
			$('#crudLabel').text('Tambah Aturan')
			$('.form-select2').val('').trigger('change');
			$('#id_edit').val('')
			$('#crudModal').modal('show');
		}
	})

	listGejala = () => {
		$.ajax({
			type: "POST",
			url: "<?= base_url('symptom/listSymptom') ?>",
			dataType: "JSON",
			success: function(response) {
				if (response.status) {
					var html = `<option></option>`;
					var data = response.data
					$.each(data, function(index, item) {
						html += `<option value="${item.id_symptom}">${item.kode_symptom} - ${item.name_symptom}</option>`;
					});
					$('#id_symptom').html(html)
				} else {
					Swal.fire({
						icon: 'error',
						text: response.message,
						showConfirmButton: false,
						timer: 2000
					});
				}
			}
		});
	}

	listPenyakit = () => {
		$.ajax({
			type: "POST",
			url: "<?= base_url('disease/listDisease') ?>",
			dataType: "JSON",
			success: function(response) {
				if (response.status) {
					var html = `<option></option>`;
					var data = response.data
					$.each(data, function(index, item) {
						html += `<option value="${item.id_disease}">${item.kode_disease} - ${item.name_disease}</option>`;
					});
					$('#id_disease').html(html)
				} else {
					Swal.fire({
						icon: 'error',
						text: response.message,
						showConfirmButton: false,
						timer: 2000
					});
				}
			}
		});
	}
</script>