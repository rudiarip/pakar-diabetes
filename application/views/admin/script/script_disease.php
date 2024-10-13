<!-- Quill Editor JS -->
<script src="<?= base_url('') ?>assets/libs/quill/quill.min.js"></script>
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
					url: "<?php echo base_url() ?>disease/getdata",
					type: "POST",
					data: function(d) {
						d.search = $('#showTable_filter input').val(); // Mengambil nilai pencarian dari input DataTable
					}
				},
			});
		}

		$('#inputform').submit(function(e) {
			e.preventDefault();

			var postData = new FormData(this);
			postData.append('solution', quill.root.innerHTML);
			postData.append('description', quill2.root.innerHTML);

			$.ajax({
				type: "POST",
				url: "<?= base_url('disease/store') ?>",
				data: postData,
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
				url: "<?= base_url('disease/showedit') ?>",
				dataType: "JSON",
				data: {
					id: id
				},
				dataType: 'JSON',
				beforeSend: function() {
					$('#crudLabel').text('Edit Penyakit');
				},
				success: function(response) {
					if (response.status) {
						var data = response.data

						$('#crudModal').modal('show');
						$('#id_edit').val(id);
						$('#kode_disease').val(data.kode_disease);
						$('#name_disease').val(data.name_disease);
						quill2.root.innerHTML = data.description;
						quill.root.innerHTML = data.solution;

					} else {
						Swal.fire(response.message, "", "error");;
					}
				}
			});

		});

		$('#showTable').on('click', '.bhapus', function() {
			var id = $(this).attr('data');
			swal.fire({
				title: 'Yakin Menghapus data penyakit ini?',
				text: "Tekan ya jika anda yakin",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes'
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: '<?= base_url('disease/hapus_') ?>',
						type: 'POST',
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


	})

	var toolbarOptions = [
		[{
			'header': [1, 2, 3, 4, 5, 6, false]
		}],
		[{
			'font': []
		}],
		['bold', 'italic', 'underline', 'strike'], // toggled buttons
		['blockquote', 'code-block'],

		[{
			'header': 1
		}, {
			'header': 2
		}], // custom button values
		[{
			'list': 'ordered'
		}, {
			'list': 'bullet'
		}],
		[{
			'script': 'sub'
		}, {
			'script': 'super'
		}], // superscript/subscript
		[{
			'indent': '-1'
		}, {
			'indent': '+1'
		}], // outdent/indent
		[{
			'direction': 'rtl'
		}], // text direction

		[{
			'size': ['small', false, 'large', 'huge']
		}], // custom dropdown

		[{
			'color': []
		}, {
			'background': []
		}], // dropdown with defaults from theme
		[{
			'align': []
		}],

		['clean'] // remove formatting button
	];
	var quill = new Quill('#editor', {
		modules: {
			toolbar: toolbarOptions
		},
		theme: 'snow'
	});

	var quill2 = new Quill('#editor2', {
		modules: {
			toolbar: toolbarOptions
		},
		theme: 'snow'
	});

	tambahData = () => {
		$('#crudLabel').text('Tambah Data Penyakit')
		$('.form-input').val('');
		$('#crudModal').modal('show');
		quill.root.innerHTML = '';
		quill2.root.innerHTML = '';
	}
</script>