<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Aplikasi
			<small>Data Aplikasi</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Aplikasi</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addKategori"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
						</div>

						<?php
							$this->load->view('template/v_alert');
						?>

						<div id="addKategori" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<center><h4 class="modal-title"> Tambah Aplikasi</h4></center>
									</div>
									<div class="modal-body">

										<form action="<?php echo base_url('apps/apps_act') ?>" method="post" enctype="multipart/form-data">											

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Nama Aplikasi</label>		
												<input type="text" name="nama_apps" required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Url Aplikasi</label>		
												<input type="text" name="url_apps" required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Deskripsi</label>		
												<textarea name="desc_apps" rows="4" class="form-control"></textarea>
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
									<th>Aplikasi</th>
									<th>Url</th>
									<th>Deskripsi</th>
									<th width="13%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($apps as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->apps_nama; ?></td>
										<td><?php echo $p->apps_url; ?></td>
										<td><?php echo $p->apps_desc; ?></td>
										<td>
											
											<button title="Edit Data" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->apps_id ?>"><i class="fa fa-pencil"></i> </button>
											<a title="Akses Aplikasi" href="<?= base_url('akses/akses/'.$p->apps_id);?>" type="button" class="btn btn-warning btn-sm"><i class="fa fa-exclamation-triangle"></i></a>
											<button title="Hapus" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->apps_id ?>"><i class="fa fa-trash"></i> </button>	


											<!-- edit data user -->
											<div id="editData<?php echo $p->apps_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data Aplikasi</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php echo base_url('apps/apps_update') ?>" method="post" enctype="multipart/form-data">
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama Aplikasi</label>	
																	<input type="hidden" name="id" value="<?php echo $p->apps_id ?>">	
																	<input type="text" name="nama_apps" value="<?php echo $p->apps_nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Url Aplikasi</label>	
																	<input type="text" name="url_apps" value="<?php echo $p->apps_url ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Deskripsi</label>		
																	<textarea style="width:100%" name="desc_apps" rows="4" class="form-control"><?php echo $p->apps_desc; ?></textarea>
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
											<div id="hapusData<?php echo $p->apps_id ?>" class="modal fade" role="dialog">
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
															<a href="<?php echo base_url().'apps/apps_hapus/'.$p->apps_id; ?>" class="btn btn-primary">Hapus</a>
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