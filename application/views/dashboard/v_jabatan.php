<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Jabatan
			<small>Data Jabatan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">


				


				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Jabatan</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addKategori"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
						</div>

						<div id="addKategori" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<center><h4 class="modal-title"> Tambah Jabatan</h4></center>
									</div>
									<div class="modal-body">

										<form action="<?php echo base_url('dashboard/jabatan_act') ?>" method="post" enctype="multipart/form-data">											

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Nama Jabatan</label>		
												<input type="text" name="nama_jabatan" required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;">Bekerja Untuk</label>				
												<select class="form-control" name="under_jabatan" required style="width: 100%;">
													<option value="">--Pilih Atasan--</option>
													<option value="0">Tertinggi</option>
													<?php 
														$jab = $this->db->query("select * from jabatan")->result();
														foreach ($jab as $j) {
													?>
													<option value="<?php echo $j->jabatan_id ?>"><?php echo $j->jabatan_nama ?></option>
													<?php
														}
													?>													
												</select>
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;">Pemangku Jabatan</label>				
												<select class="form-control" name="pegawai_jabatan" required style="width: 100%;">
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
												<label style="width: 100%;"> Deskripsi</label>		
												<textarea name="desc_jabatan" rows="4" class="form-control"></textarea>
											</div>
										
											<br>
											<input type="submit" value="Simpan" class="btn btn-primary">
										</form>
									</div>											
								</div>
							</div>
						</div>		
					</div>

					<div class="box-body">
						<table class="table table-bordered" id="table-datatable">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Jabatan</th>
									<th>Bekerja Untuk</th>
									<th>Deskripsi</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($jabatan as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->jabatan_nama; ?></td>
										<td>
											<?php 
												$jab_data = $this->db->query("select * from jabatan")->result(); 
												foreach ($jab_data as $jd) {
													if ($jd->jabatan_id == $p->jabatan_id && $jd->jabatan_level > 1) {
														$atasan = $this->db->query("select * from jabatan where jabatan_id = '$jd->jabatan_under'")->row();
														echo $atasan->jabatan_nama;
													}
												}
											?>
										</td>
										<td><?php echo $p->jabatan_deskripsi; ?></td>
										<td>
											
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->jabatan_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->jabatan_id ?>"><i class="fa fa-trash"></i> </button>	


											<!-- edit data user -->
											<div id="editData<?php echo $p->jabatan_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data Jabatan</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php echo base_url('dashboard/jabatan_update') ?>" method="post" enctype="multipart/form-data">
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama Jabatan</label>	
																	<input type="hidden" name="id" value="<?php echo $p->jabatan_id ?>">	
																	<input type="text" name="nama_jabatan" value="<?php echo $p->jabatan_nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Bekerja Untuk</label>				
																	<select class="form-control" name="under_jabatan" required style="width: 100%;">
																		<option value="">--Pilih Atasan--</option>
																		<option value="0">Tertinggi</option>
																		<?php 
																			$jab = $this->db->query("select * from jabatan")->result();
																			foreach ($jab as $j) {
																		?>
																		<option value="<?php echo $j->jabatan_id ?>" <?php if($j->jabatan_id == $p->jabatan_under){echo "selected";} ?>><?php echo $j->jabatan_nama ?></option>
																		<?php
																			}
																		?>													
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Pemangku Jabatan</label>				
																	<select class="form-control" name="pegawai_jabatan" required style="width: 100%;">
																		<option value="">--Pilih Pegawai--</option>
																		<?php 
																			$peg = $this->db->query("select * from pegawai")->result();
																			foreach ($peg as $pg) {
																		?>
																		<option value="<?php echo $pg->pegawai_id ?>" <?php if($pg->pegawai_id == $p->pegawai_id){echo "selected";} ?>><?php echo $pg->pegawai_nama ?></option>
																		<?php
																			}
																		?>													
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Deskripsi</label>		
																	<textarea style="width:100%" name="desc_jabatan" rows="4" class="form-control"><?php echo $p->jabatan_deskripsi; ?></textarea>
																</div>
																
																<br>
																<br>
																<input type="submit" value="Simpan" class="btn btn-primary">
															</form>
														</div>											
													</div>
												</div>
											</div>	


											<!-- Hapus data user -->
											<div id="hapusData<?php echo $p->jabatan_id ?>" class="modal fade" role="dialog">
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
															<a href="<?php echo base_url().'dashboard/jabatan_hapus/'.$p->jabatan_id; ?>" class="btn btn-primary">Hapus</a>
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