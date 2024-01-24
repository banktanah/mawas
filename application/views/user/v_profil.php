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
							$this->load->view('template/v_alert');
						?>
						
						<?php foreach($profil as $p){ ?>

							<form method="post"  enctype="multipart/form-data" action="<?php echo base_url('user/profil_update') ?>">
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

									<!-- <div class="form-group">
										<label>Foto</label>
										<input type="file" name="foto">
										<?php //echo form_error('foto'); ?>
										<small style="color: red;">Input jika akan diganti</small>
									</div> -->

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Foto</label>				
										<input accept="image/*" type="file" style="width:100%" id="inputPic<?php echo $p->pegawai_id ?>" name="foto" onchange="loadFile<?php echo $p->pegawai_id ?>(event)">
										<img src="<?php if(!empty($p->foto_path)){echo $p->foto_path;}?>" style="max-width: 200px; display: block; margin-top: 10px; position: relative; z-index: 10;" id="profilePic<?php echo $p->pegawai_id ?>"/>
										<button onclick="changePicPreview<?php echo $p->pegawai_id ?>()" type="button" title="Hapus Foto" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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