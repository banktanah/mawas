<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Ganti Password
			<small>Ubah password anda</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Ganti Password</h3>
					</div>
					<div class="box-body">

						<?php
							$this->load->view('template/v_alert');
						?>

						<form method="post" action="<?php echo base_url('user/ganti_password_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Password Lama</label>
									<input type="password" name="password_lama" class="form-control" placeholder="Masukkan Password Lama Anda ..">
									<?php echo form_error('password_lama'); ?>
								</div>
								<hr>
								<div class="form-group">
									<label>Password Baru</label>
									<input type="password" name="password_baru" class="form-control" placeholder="Masukkan Password Baru ..">
									<?php echo form_error('password_baru'); ?>
								</div>
								<div class="form-group">
									<label>Konfirmasi Password Baru</label>
									<input type="password" name="konfirmasi_password" class="form-control" placeholder="Ulangi Password Baru ..">
									<?php echo form_error('konfirmasi_password'); ?>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-primary" value="Ganti Password">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>