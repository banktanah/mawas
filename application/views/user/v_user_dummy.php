<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User
			<small>Akun Pegawai</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<div class="pull-right">	
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
				</div>

				<?php
					$this->load->view('template/v_alert');
				?>

				<div id="addData" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<center><h4 class="modal-title"> Tambah Akun</h4></center>
							</div>
							<div class="modal-body" style="height: 420px; overflow-y: scroll;">

								<form id="addAkun" action="<?php echo base_url('user/user_dummy_act') ?>" method="post" enctype="multipart/form-data">
									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> Nama User</label>	
										<input type="text" style="width:100%" name="nama" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Username</label>				
										<input type="text" style="width:100%" name="username" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Password</label>				
										<input type="Password" style="width:100%" name="password" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Akses MAWAS</label>				
										<select class="form-control" name="level" required>
											<option value="">--Pilih--</option>
											<option value="Superadmin">Superadmin</option>
											<option value="Admin">Admin</option>
											<option value="Pegawai">Pegawai</option>
										</select>
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Pas Photo</label>				
										<input accept="image/*" type="file" style="width:100%" id="inputPic" name="foto" onchange="loadFile(event)">
										<img style="max-width: 200px; display: block; margin-top: 10px; position: relative; z-index: 10;" id="profilePic"/>
										<button onclick="changePicPreview()" type="button" title="Hapus Foto" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
									</div>
									
									<br>
									<br>
									<!-- <input type="submit" value="Simpan" class="btn btn-primary"> -->
								</form>
							</div>
							<div class="modal-footer">
								<input type="submit" form="addAkun" value="Simpan" class="btn btn-primary">
							</div>											
						</div>
					</div>
				</div>				

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User Dummy</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered" id="table-datatable">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama</th>
									<th>E-Mail</th>
									<th width="15%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($user as $p){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->user_nama; ?></td>										
										<td><?php echo $p->user_username; ?></td>
										
										<td>
											<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->user_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->user_id ?>" <?php if($p->user_id == 1){echo "disabled";} ?>><i class="fa fa-trash"></i> </button>


											<!-- edit data user -->
											<div id="editData<?php echo $p->user_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data User</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php echo base_url('user/user_update') ?>" method="post" enctype="multipart/form-data">
																<div class="form-group" style="width:100%; margin-bottom: 15px;">
																	<label style="width: 100%;"> Nama</label>	
																	<input type="hidden" name="id" value="<?php echo $p->user_id ?>">	
																	<input type="text" name="nama" value="<?php echo $p->user_nama ?>" required class="form-control" style="width:100%" readonly>
																</div>

																<div class="form-group" style="width:100%; margin-bottom: 15px;">
																	<label style="width: 100%;">Username</label>				
																	<input type="text" style="width:100%" name="username" value="<?php echo $p->user_username ?>" required readonly class="form-control">
																</div>

																<div class="form-group" style="width:100%; margin-bottom: 15px;">
																	<label style="width: 100%;">Akses MAWAS</label>				
																	<select class="form-control" name="level" style="width:100%" required>
																		<option value="">--Pilih--</option>
																		<option <?php if($p->hrm_level=="Superadmin"){echo "selected";} ?> value="Superadmin">Superadmin</option>
																		<option <?php if($p->hrm_level=="Admin"){echo "selected";} ?> value="Admin">Admin</option>
																		<option <?php if($p->hrm_level=="Pegawai"){echo "selected";} ?> value="Pegawai">Pegawai</option>
																	</select>
																</div>

																<div class="form-group" style="width:100%; margin-bottom: 15px;">
																	<label style="width: 100%;">Password</label>				
																	<input type="Password" style="width:100%" name="password" class="form-control">
																	<small style="color: red;">*input jika akan diganti</small>
																</div>

																<br>
																<input type="submit" value="Simpan" class="btn btn-primary">
															</form>
														</div>											
													</div>
												</div>
											</div>


											<!-- Hapus data user -->
											<div id="hapusData<?php echo $p->user_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
															

														</div>
														<div class="modal-body">
															<p>Yakin ingin menghapus data ini ?</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
															<a href="<?php echo base_url().'user/user_hapus/'.$p->user_id; ?>" class="btn btn-primary">Hapus</a>
														</div>
													</div>
												</div>
											</div>	
											
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						

					</div>
				</div>

			</div>
		</div>

	</section>

</div>