<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Profil
			<small>Update Profil Pengguna</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Update Profil</h3>
					</div>
					<div class="box-body">

						<?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "sukses"){
								echo "<div class='alert alert-success'>Profil telah diupdate!</div>";
							}
						}
						?>
						
						<?php foreach($profil as $p){ ?>

							<form method="post"  enctype="multipart/form-data" action="<?php echo base_url('dashboard/profil_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama .." value="<?php echo $p->user_nama; ?>" readonly>
										<?php echo form_error('nama'); ?>
									</div>
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" class="form-control" placeholder="Masukkan username .." value="<?php echo $p->user_username; ?>" readonly>
										<?php echo form_error('username'); ?>
									</div>									

									<div class="form-group">
										<label>Foto</label>
										<input type="file" name="foto">
										<?php echo form_error('foto'); ?>
										<small style="color: red;">Input jika akan diganti</small>
									</div>

								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Update">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>