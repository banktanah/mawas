<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Jabatan Pegawai
			<small>Data Jabatan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Jabatan Pegawai</h3>
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
										<center><h4 class="modal-title"> Tambah Jabatan Pegawai</h4></center>
									</div>
									<div class="modal-body">

										<form action="<?php echo base_url('jabatan/jabatan_act') ?>" method="post" enctype="multipart/form-data">											

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Nama Jabatan</label>		
												<input type="text" name="jabatan_nama" required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Tingkatan</label>		
												<input type="number" name="jabatan_level" required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Keterangan</label>		
												<textarea name="jabatan_desc" rows="4" class="form-control"></textarea>
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
									<th>Nama Jabatan</th>
									<th>Level Jabatan</th>
									<th>Keterangan</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($jabatans as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->jabatan_nama; ?></td>
										<td><?php echo $p->jabatan_level; ?></td>
										<td><?php echo $p->jabatan_desc; ?></td>
										<td>
											
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->jabatan_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->jabatan_id ?>"><i class="fa fa-trash"></i> </button>	


											<!-- edit data user -->
											<div id="editData<?php echo $p->jabatan_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Jabatan Pegawai</h4></center>
														</div>
														<div class="modal-body">

														<form action="<?php echo base_url('jabatan/jabatan_update') ?>" method="post" enctype="multipart/form-data">											

															<div class="form-group" style="width:100%">
																<label style="width: 100%;"> Nama Level</label>		
																<input type="hidden" value="<?=$p->jabatan_id;?>" name="id" required class="form-control" style="width:100%">
																<input type="text" value="<?=$p->jabatan_nama;?>" name="jabatan_nama" required class="form-control" style="width:100%">
															</div>
															<div class="form-group" style="width:100%">
																<label style="width: 100%;"> Tingkatan</label>		
																<input type="number" value="<?=$p->jabatan_level;?>" name="jabatan_level" required class="form-control" style="width:100%">
															</div>
															<div class="form-group" style="width:100%">
																<label style="width: 100%;"> Keterangan</label>		
																<textarea name="jabatan_desc" rows="4" class="form-control"><?=$p->jabatan_desc;?></textarea>
															</div>

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
															<a href="<?php echo base_url().'jabatan/jabatan_hapus/'.$p->jabatan_id; ?>" class="btn btn-primary">Hapus</a>
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