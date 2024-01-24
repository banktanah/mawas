<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Divisi Bagian
			<small>Data Divisi Bagian</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">


				


				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Divisi Bagian</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addKategori"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
						</div>

						<div id="addKategori" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<center><h4 class="modal-title"> Tambah Bagian</h4></center>
									</div>
									<div class="modal-body">

										<form action="<?php echo base_url('dashboard/divisi_bagian_act') ?>" method="post" enctype="multipart/form-data">											

											<div class="form-group" style="width:100%">
												<label style="width: 100%;">Divisi</label>				
												<select class="form-control" name="divisi_id" required style="width: 100%;">
													<option value="">--Pilih Divisi--</option>
													<?php 
														$div = $this->db->query("select * from divisi")->result();
														foreach ($div as $d) {
													?>
													<option value="<?php echo $d->divisi_id ?>"><?php echo $d->divisi_nama ?></option>
													<?php
														}
													?>													
												</select>
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Nama Bagian</label>		
												<input type="text" name="nama_divisi_bagian" required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Deskripsi</label>		
												<textarea name="desc_divisi_bagian" rows="4" class="form-control"></textarea>
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
									<th>Divisi</th>
									<th>Bagian</th>
									<th>Deskripsi</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($divisi_bagian as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td>
											<?php $div_data = $this->db->query("select * from divisi")->result(); 
												foreach ($div_data as $dn) {
													if ($dn->divisi_id == $p->divisi_id) {
														echo $dn->divisi_nama;
													}
												}
											?>
										</td>
										<td><?php echo $p->divisi_bagian_nama; ?></td>
										<td><?php echo $p->divisi_bagian_deskripsi; ?></td>
										<td>
											
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->divisi_bagian_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->divisi_bagian_id ?>"><i class="fa fa-trash"></i> </button>	


											<!-- edit data user -->
											<div id="editData<?php echo $p->divisi_bagian_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data Divisi Bagian</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php echo base_url('dashboard/divisi_bagian_update') ?>" method="post" enctype="multipart/form-data">
																
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Divisi</label>		
																	<select class="form-control" name="divisi_id" required style="width: 100%;">
																		<option value="">--Pilih Divisi--</option>
																		<?php 
																			$div = $this->db->query("select * from divisi")->result();
																			foreach ($div as $d) {
																		?>
																			<option value="<?php echo $d->divisi_id ?>" <?php if($d->divisi_id == $p->divisi_bagian_id){echo "selected";} ?>><?php echo $d->divisi_nama ?></option>
																		<?php
																			}
																		?>													
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama Divisi Bagian</label>	
																	<input type="hidden" name="id" value="<?php echo $p->divisi_bagian_id ?>">	
																	<input type="text" name="nama_divisi_bagian" value="<?php echo $p->divisi_bagian_nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Deskripsi</label>		
																	<textarea style="width:100%" name="desc_divisi_bagian" rows="4" class="form-control"><?php echo $p->divisi_bagian_deskripsi; ?></textarea>
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
											<div id="hapusData<?php echo $p->divisi_bagian_id ?>" class="modal fade" role="dialog">
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
															<a href="<?php echo base_url().'dashboard/divisi_bagian_hapus/'.$p->divisi_bagian_id; ?>" class="btn btn-primary">Hapus</a>
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