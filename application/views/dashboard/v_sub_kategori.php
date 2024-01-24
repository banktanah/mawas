<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Sub Kategori
			<small>Data Sub Kategori</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">


				


				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Sub Kategori</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSub"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
						</div>

						<div id="addSub" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<center><h4 class="modal-title"> Tambah Data Sub Kategori</h4></center>
									</div>
									<div class="modal-body">
										<form action="<?php echo base_url('dashboard/sub_act') ?>" method="post" enctype="multipart/form-data">											
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Kategori</label>
												<select class="form-control" name="kategori" required style="width:100%">
													<option value="">--Pilih--</option>
													<?php 
													$data = $this->db->query("SELECT * FROM kategori")->result();
													foreach ($data as $d) {
														?>
														<option value="<?php echo $d->kategori_id ?>"><?php echo $d->kategori_nama ?></option>
														<?php
													}
													?>
												</select>													
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Sub Kategori</label>		
												<input type="text" name="nama" required class="form-control" style="width:100%">
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Satuan</label>		
												<input type="text" name="satuan" required class="form-control" style="width:100%">
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
									<th>Kategori</th>
									<th>Sub Kategori</th>
									<th>Satuan</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($sub as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->kategori_nama; ?></td>
										<td><?php echo $p->nama ?></td>
										<td><?php echo $p->satuan ?></td>
										<td>
											
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSub<?php echo $p->sub_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusSub<?php echo $p->sub_id ?>"><i class="fa fa-trash"></i> </button>	


											<!-- edit data user -->
											<div id="editSub<?php echo $p->sub_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data kategori</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php echo base_url('dashboard/sub_update') ?>" method="post" enctype="multipart/form-data">

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Kategori</label>
																	<select class="form-control" name="kategori" required style="width:100%">
																		<option value="">--Pilih--</option>
																		<?php 
																		$data = $this->db->query("SELECT * FROM kategori")->result();
																		foreach ($data as $d) {
																			?>
																			<option <?php if($p->kategori==$d->kategori_id){echo "selected='selected'";} ?> value="<?php echo $d->kategori_id ?>"><?php echo $d->kategori_nama ?></option>
																			<?php
																		}
																		?>
																	</select>													
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama</label>	
																	<input type="hidden" name="id" value="<?php echo $p->sub_id ?>">	
																	<input type="text" name="nama" value="<?php echo $p->nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Satuan</label>	
																	<input type="text" name="satuan" value="<?php echo $p->satuan ?>" required class="form-control" style="width:100%">
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
											<div id="hapusSub<?php echo $p->sub_id ?>" class="modal fade" role="dialog">
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
															<a href="<?php echo base_url().'dashboard/sub_hapus/'.$p->sub_id; ?>" class="btn btn-primary">Hapus</a>
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