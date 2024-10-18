<div class="row">
	<div class="col-lg-3 col-sm-3 col-md-3 col-xl-3">
		<div class="card custom-card">
			<div class="card-body">
				<div class="row">
					<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon px-0">
						<span class="rounded p-3 bg-primary-transparent">
							<svg xmlns="http://www.w3.org/2000/svg" class="svg-white primary" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
								<g>
									<rect fill="none" height="24" width="24"></rect>
									<path d="M18,6h-2c0-2.21-1.79-4-4-4S8,3.79,8,6H6C4.9,6,4,6.9,4,8v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8C20,6.9,19.1,6,18,6z M12,4c1.1,0,2,0.9,2,2h-4C10,4.9,10.9,4,12,4z M18,20H6V8h2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V8h4v2c0,0.55,0.45,1,1,1s1-0.45,1-1V8 h2V20z"></path>
								</g>
							</svg>
						</span>
					</div>
					<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
						<div class="mb-2">Total Gejala</div>
						<div class="text-muted mb-1 fs-12">
							<span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
								<?= $data->total_symptom ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xl-3">
		<div class="card custom-card">
			<div class="card-body">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon secondary  px-0">
						<span class="rounded p-3 bg-secondary-transparent">
							<svg xmlns="http://www.w3.org/2000/svg" class="svg-white secondary" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
								<path d="M0,0h24v24H0V0z" fill="none"></path>
								<g>
									<path d="M19.5,3.5L18,2l-1.5,1.5L15,2l-1.5,1.5L12,2l-1.5,1.5L9,2L7.5,3.5L6,2v14H3v3c0,1.66,1.34,3,3,3h12c1.66,0,3-1.34,3-3V2 L19.5,3.5z M15,20H6c-0.55,0-1-0.45-1-1v-1h10V20z M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z"></path>
									<rect height="2" width="6" x="9" y="7"></rect>
									<rect height="2" width="2" x="16" y="7"></rect>
									<rect height="2" width="6" x="9" y="10"></rect>
									<rect height="2" width="2" x="16" y="10"></rect>
								</g>
							</svg>
						</span>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
						<div class="mb-2">Total Penyakit</div>
						<div class="text-muted mb-1 fs-12">
							<span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
								<?= $data->total_disease ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xl-3">
		<div class="card custom-card">
			<div class="card-body">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon success px-0">
						<span class="rounded p-3 bg-warning-transparent">
							<i class="ti ti-wave-square fs-16"></i>
						</span>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
						<div class="mb-2">Total Aturan</div>
						<div class="text-muted mb-1 fs-12">
							<span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
								<?= $data->total_aturan ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xl-3">
		<div class="card custom-card">
			<div class="card-body">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon success px-0">
						<span class="rounded p-3 bg-success-transparent">
							<i class="ti ti-users fs-16"></i>
						</span>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
						<div class="mb-2">Total User</div>
						<div class="text-muted mb-1 fs-12">
							<span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
								<?= $data->total_username ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
		<div class="card custom-card">
			<div class="card-body">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon warning px-0">
						<span class="rounded p-3 bg-warning-transparent">
							<svg xmlns="http://www.w3.org/2000/svg" class="svg-white warning" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
								<path d="M0 0h24v24H0V0z" fill="none"></path>
								<path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"></path>
							</svg>
						</span>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
						<div class="mb-2">Total Orders</div>
						<div class="text-muted mb-1 fs-12">
							<span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
								35,367
							</span>
						</div>
						<div>
							<span class="fs-12 mb-0">Increased by <span class="badge bg-success-transparent text-success mx-1">+2.5%</span> this month</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>
