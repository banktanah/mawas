<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Project
			<small>Data Project</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">


				


				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Project</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
						</div>

						<div id="addData" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<center><h4 class="modal-title"> Tambah Data Project</h4></center>
									</div>
									<div class="modal-body">

										<form action="<?php echo base_url('dashboard/project_act') ?>" method="post" enctype="multipart/form-data">
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Nama Project</label>		
												<input type="text" name="nama" required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Lokasi</label>		
												<input type="text" name="lokasi" required class="form-control" style="width:100%">
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> Periode</label>		
												<input type="text" name="periode" required class="form-control" style="width:100%">
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
									<th>Project</th>
									<th>Lokasi</th>
									<th>Periode</th>									
									<th width="15%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($project as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->project_nama; ?></td>
										<td><?php echo $p->project_lokasi; ?></td>
										<td><?php echo $p->project_periode; ?></td>										
										<td>
											
											
											

											<a href="<?php echo base_url().'dashboard/project_detail/'.$p->project_id; ?>" class="btn btn-sm btn-primary">DETAIL</a>
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->project_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->project_id ?>"><i class="fa fa-trash"></i> </button>	


											



											<!-- edit data user -->
											<div id="editData<?php echo $p->project_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data Project</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php echo base_url('dashboard/project_update') ?>" method="post" enctype="multipart/form-data">
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama</label>	
																	<input type="hidden" name="id" value="<?php echo $p->project_id ?>">	
																	<input type="text" name="nama" value="<?php echo $p->project_nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Lokasi</label>		
																	<input type="text" name="lokasi" value="<?php echo $p->project_lokasi ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Periode</label>		
																	<input type="text" name="periode" required value="<?php echo $p->project_periode ?>" class="form-control" style="width:100%">
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
											<div id="hapusData<?php echo $p->project_id ?>" class="modal fade" role="dialog">
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
															<a href="<?php echo base_url().'dashboard/project_hapus/'.$p->project_id; ?>" class="btn btn-primary">Hapus</a>
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


