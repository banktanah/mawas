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
				
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
				
				<div id="addData" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<center><h4 class="modal-title"> Tambah Akun</h4></center>
							</div>
							<div class="modal-body">

								<form action="<?php echo base_url('dashboard/user_act') ?>" method="post" enctype="multipart/form-data">
									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> Nama Pegawai</label>	
										<select class="form-control" name="nama" required style="width: 100%;">
											<option value="">--Pilih Pegawai--</option>
											<?php 
												$peg = $this->db->query("select * from pegawai")->result();
												foreach ($peg as $pg) {
											?>
											<option value="<?php echo $pg->pegawai_id ?>"><?php echo $pg->pegawai_nama ?></option>
											<?php
												}
											?>													
										</select>
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">E-Mail</label>				
										<input type="text" style="width:100%" name="username" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Password</label>				
										<input type="Password" style="width:100%" name="password" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Akses HRM</label>				
										<select class="form-control" name="level" required>
											<option value="">--Pilih--</option>
											<option value="Admin">Izinkan Akses (Admin)</option>
											<option value="Pegawai">Dilarang Akses</option>
										</select>
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Foto</label>				
										<input type="file" style="width:100%" name="foto">
									</div>
									
									<br>
									<br>
									<input type="submit" value="Simpan" class="btn btn-primary">
								</form>
							</div>											
						</div>
					</div>
				</div>				

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User</h3>
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

															<form action="<?php echo base_url('dashboard/user_update') ?>" method="post" enctype="multipart/form-data">
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama</label>	
																	<input type="hidden" name="id" value="<?php echo $p->user_id ?>">	
																	<input type="text" name="nama" value="<?php echo $p->user_nama ?>" required class="form-control" style="width:100%" readonly>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Username</label>				
																	<input type="text" style="width:100%" name="username" value="<?php echo $p->user_username ?>" required class="form-control">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Admin HRM</label>				
																	<select class="form-control" name="level" style="width:100%" required>
																		<option value="">--Pilih--</option>
																		<option <?php if($p->user_level=="Admin"){echo "selected='selected'";} ?> value="Admin">Admin HRM</option>
																		<option <?php if($p->user_level=="Pegawai"){echo "selected='selected'";} ?> value="Pegawai">Pegawai</option>
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Password</label>				
																	<input type="Password" style="width:100%" name="password" class="form-control">
																	<p style="color: red;">*input jika akan diganti</p>
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
															<a href="<?php echo base_url().'dashboard/user_hapus/'.$p->user_id; ?>" class="btn btn-primary">Hapus</a>
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