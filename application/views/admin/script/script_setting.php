<script>
	$(document).ready(function() {
		tampildata();

		function tampildata() {
			var id = '1';
			$.ajax({
				type: "GET",
				url: "<?= base_url() ?>setting/showdata",
				dataType: "JSON",
				data: {
					id: id
				},
				success: function(response) {
					var data = response.data;

					$('[id="imglogo"]').attr("src", "<?= base_url() ?>assets/images/brand-logos/" + data.logo);
					$('[id="imglogo"]').attr("style",
						"border: 1px solid #4B49AC ; border-radius: 12px;");
					$('[name="kodedit"]').val(data.id);
					$('[name="alamat"]').val(data.alamat);
					$('[name="app_name"]').val(data.app_name);
					$('[name="email"]').val(data.email);
					$('[name="whatsapp"]').val(data.whatsapp);
				}
			});
			return false;

		}

		$.validator.setDefaults({
			submitHandler: function(form) {
				var formData = new FormData($(form)[0]);
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>setting/simpan",
					data: formData,
					processData: false,
					contentType: false,
					cache: false,
					async: false,


					success: function(response) {
						if (response == "success") {
							Swal.fire('Data berhasil disimpan', "", "success");
							tampildata();
						} else if (response == "error") {
							Swal.fire('Data Gagal disimpan', "", "error");
							tampildata();
						} else {
							Swal.fire('Data Gagal disimpan', "", "error");
							tampildata();
						}
					},
					error: function(response) {
						Swal.fire({
							icon: 'error',
							title: 'OOPS!!',
							text: 'Server Error!'
						});
					}
				});
			}
		});
		$('#inputform').validate({

			rules: {
				alamat: {
					required: true,
				},
				app_name: {
					required: true,
				},
				nama_klinik: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				whatsapp: {
					required: true,
					number: true
				},
				logo: {
					required: function() {
						return $("#kodedit").val() === "";
					}
				},
			},
			messages: {
				alamat: {
					required: 'masukkan Alamat',

				},
				app_name: {
					required: 'masukkan Nama Aplikasi',
				},
				whatsapp: {
					required: 'masukkan Nomor Whatsapp',
					number: 'Hanya Menerima Inputan Angka'
				},
				logo: {
					required: 'Pilih Gambar',


				},
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});

	})
</script>
