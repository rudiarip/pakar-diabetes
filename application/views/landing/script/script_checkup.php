<script>
	let currentGejalaId;
	let riwayatGejala = ''; // Untuk melacak gejala yang sudah ditampilkan
	let currentDisease;
	let riwayatPenyakit = ''; // Untuk melacak penyakit yang sudah ditampilkan
	let gejalaYes = '';
	var riwayatResponse = {};

	$(document).ready(function() {

		$('#ya').on('click', function() {
			gejalaYes += currentGejalaId + ',';

			riwayatResponse[currentGejalaId] = 'ya';
			loadPertanyaan(currentGejalaId, 'ya', currentDisease);
		});

		$('#tidak').on('click', function() {
			riwayatResponse[currentGejalaId] = 'tidak';
			loadPertanyaan(currentGejalaId, 'tidak', currentDisease);
			
		});

		$('#btnRepeat').on('click', function() {
			loadPertanyaan();
			$('#btnRepeat').hide()

			currentGejalaId = null
			riwayatGejala = '';
			currentDisease = null;
			riwayatPenyakit = '';
			gejalaYes = '';
		});

		$('#btnMulai').on('click', function() {
			loadPertanyaan();
		});
	})

	function loadPertanyaan(id_gejala = null, jawaban = null, id_disease = null) {
		$.ajax({
			url: '<?= base_url('checkup/get_next_gejala'); ?>',
			type: 'POST',
			data: {
				id_gejala: id_gejala,
				jawaban: jawaban,
				riwayat_gejala: riwayatGejala,
				id_penyakit: id_disease,
				riwayat_penyakit: riwayatPenyakit,
				gejala_yes: gejalaYes,
				riwayatResponse: riwayatResponse
			},
			dataType: 'JSON',
			beforeSend: function() {
				$('#showKesimpulan').html(``)
				$('#showQuestion').hide()
				$('#btnJawab').hide()
				$('.opening').hide()
				$('#loadingPertanyaan').html(`<div class="spinner-grow text-warning" role="status"><span class="visually-hidden">Loading...</span></div>`)
			},
			success: function(response) {
				$('#loadingPertanyaan').html(``)

				if (response.status) {
					if (response.message == 'next') {
						$('#showQuestion').show()
						$('#btnJawab').show()

						$('#question').text(response.data.name_symptom);
						currentDisease = response.data.id_disease;
						currentGejalaId = response.data.id_symptom;
						riwayatGejala += currentGejalaId + ',';
						riwayatPenyakit += currentDisease + ',';
					} else if (response.message == 'stop') {
						if (response.kesimpulan.length > 0) {

							let data = response.kesimpulan

							var table = $('<table>').addClass('table table-bordered table-striped');
							var headerRow = $('<tr class="text-center">');
							headerRow.append($('<th>').text('No.'));
							headerRow.append($('<th>').text('Persentase'));
							headerRow.append($('<th>').text('Nama Penyakit'));
							headerRow.append($('<th>').text('Deskripsi'));
							headerRow.append($('<th>').text('Saran'));
							table.append(headerRow);

							let no = 1;
							$.each(data, function(index, item) {
								var row = $('<tr>');
								row.append($('<td>').text(no++));
								row.append($('<td>').text(item.persentase_terpenuhi + ` %`));
								row.append($('<td>').text(item.name_disease));
								row.append($('<td>').html(item.description));
								row.append($('<td>').html(item.solution));
								table.append(row);
							});

							$('#showKesimpulan').append(table);
							$('#showQuestion').show()
							$('#question').text('Silahkan scroll ke halaman bawah');
							$('#btnRepeat').show()
							$('html, body').animate({
								scrollTop: $(document).height()
							}, 'slow');
						} else {
							$('#showQuestion').show()
							$('#question').text('Mohon maaf penyakit tidak ditemukan');
							$('#btnRepeat').show()
						}

					}
				} else {
					$('.opening').show()
				}
			}
		});
	}
</script>
