<script>
	$(document).ready(function() {
		tampildata()

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
					url: "<?php echo base_url('report/getdata') ?>",
					type: "POST",
					data: function(d) {
						d.search = $('#showTable_filter input').val(); // Mengambil nilai pencarian dari input DataTable
					}
				},
			});
		}
	})

	hasilPemeriksaan = (checkup_number) => {
		$.ajax({
			type: "POST",
			url: "<?= base_url('report/hasil_pemeriksaan') ?>",
			data: {
				checkup_number: checkup_number
			},
			dataType: "JSON",
			beforeSend: function() {
				$('#showTablePemeriksaan').html('');
			},
			success: function(response) {
				$('#crudModal').modal('show');
				$('#crudLabel').text('Hasil Pemeriksaan');

				var table = $('<table>').addClass('table table-bordered table-striped');
				var headerRow = $('<tr class="text-center">');
				headerRow.append($('<th>').text('No.'));
				headerRow.append($('<th>').text('Kode Penyakit'));
				headerRow.append($('<th>').text('Nama Penyakit'));
				headerRow.append($('<th>').text('Persentase'));
				table.append(headerRow);

				let no = 1;
				$.each(response, function(index, item) {
					var row = $('<tr>');
					row.append($('<td>').text(no++));
					row.append($('<td>').text(item.kode_disease));
					row.append($('<td>').text(item.name_disease));
					row.append($('<td>').html(item.percentage + ` %`));
					table.append(row);
				});

				$('#showTablePemeriksaan').append(table);
			}
		});
	}

	riwayatJawaban = (checkup_number) => {
		$.ajax({
			type: "POST",
			url: "<?= base_url('report/riwayat_jawaban') ?>",
			data: {
				checkup_number: checkup_number
			},
			dataType: "JSON",
			beforeSend: function() {
				$('#showTablePemeriksaan').html('');
			},
			success: function(response) {
				$('#crudModal').modal('show');
				$('#crudLabel').text('Riwayat Jawaban');

				var table = $('<table>').addClass('table table-bordered table-striped');
				var headerRow = $('<tr class="text-center">');
				headerRow.append($('<th>').text('No.'));
				headerRow.append($('<th>').text('Kode Gejala'));
				headerRow.append($('<th>').text('Nama Gejala'));
				headerRow.append($('<th>').text('Jawaban'));
				table.append(headerRow);

				let no = 1;
				$.each(response, function(index, item) {
					var row = $('<tr>');
					row.append($('<td>').text(no++));
					row.append($('<td>').text(item.kode_symptom));
					row.append($('<td>').text(item.name_symptom));
					row.append($('<td>').html(item.jawaban));
					table.append(row);
				});

				$('#showTablePemeriksaan').append(table);
			}
		});
	}
</script>
