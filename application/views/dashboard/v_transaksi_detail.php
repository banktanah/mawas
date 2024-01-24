<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Detail Data Project
			<small>Data Project</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Identitas Project</h3>
					</div>
					<div class="box-body">						
						<div class="table-responsive">													
							<table class="table table-bordered table-hover">
								<?php 
								$idProject="";
								foreach ($project as $p) {
									?>
									<tr>
										<th width="%">Nama</th>
										<th width="1px">:</th>
										<td><?php echo $p->project_nama ?></td>
									</tr>
									<tr>
										<th width="20%">Lokasi</th>
										<th width="1px">:</th>
										<td><?php echo $p->project_lokasi ?></td>
									</tr>

									<tr>
										<th width="20%">Periode</th>
										<th width="1px">:</th>
										<td><?php echo $p->project_periode ?></td>
									</tr>

									<?php	
									$idProject = $p->project_id;
								}
								?>
								
							</table>
						</div>
					</div>
				</div>
			</div>		
		</div>


		<div class="row">

			<div class="col-lg-12">			
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">REALISASI BDP</h3>
						<div class="pull-right">

							<a href="<?php echo base_url('dashboard/project_detail/').$idProject?>" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i>&nbsp Kembali</a>														
						</div>


					</div>

					<div class="box-body">
						<div class="table-responsive">					
							<table class="table table-bordered">
								<thead>
									<tr>										
										<th rowspan="2" width="20%"><center>Uraian Pekerjaan</center></th>
										<th rowspan="2">Satuan</th>				
										<th colspan="3"><center>REALISASI BDP</center></th>										
										<th rowspan="2" width="10%">Opsi</th>										
									</tr>
									<tr>
										<th>Volume</th>
										<th>Harga Satuan (Rp)</th>
										<th>Harga Jumlah (Rp)</th>
									</tr>	


								</thead>
								<tbody>
									<?php
									foreach ($data as $k) {
										$idKat = $k->realisasi_kategori;
										$idtransaksi = $k->realisasi_transaksi;
										?>
										<tr>
											<td colspan="5"><b><?php echo $k->kategori_nama; ?></b></td>
										</tr>
										<?php 
										$sub = $this->db->query("select * from realisasi, sub_kategori where realisasi_project='$idProject' and realisasi_kategori='$idKat' and realisasi_sub_kategori=sub_id and realisasi_transaksi='$idtransaksi' order by realisasi_kategori")->result();
										foreach ($sub as $s) {
											$idSub = $s->sub_id;
											$id_kategori = $s->realisasi_kategori;
											$id_realisasi = $s->realisasi_id;
											?>
											<tr>
												<td><?php echo $s->nama ?></td>
												<td><?php echo $s->satuan ?></td>
												<td><?php echo "Rp.".number_format($s->realisasi_volume) ?></td>
												<td><?php echo "Rp.".number_format($s->realisasi_harga_satuan) ?></td>						
												<td><?php echo "Rp.".number_format($s->realisasi_jumlah_harga) ?></td>	
												<td>
													<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editData<?php echo $s->realisasi_id ?>"><i class="fa fa-pencil"></i> </button>
													<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $s->realisasi_id ?>"><i class="fa fa-trash"></i> </button>


													<!-- edit data user -->
													<div id="editData<?php echo $s->realisasi_id ?>" class="modal fade" role="dialog">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<center><h4 class="modal-title"> Edit Data Realisasi</h4></center>
																</div>
																<div class="modal-body">

																	<form action="<?php echo base_url('dashboard/realisasi_update') ?>" method="post" enctype="multipart/form-data">


																		<div class="form-group" style="width:100%">
																			<label style="width: 100%;">VOLUME</label>
																			<input type="hidden" name="id_project" value="<?php echo $idProject ?>">
																			<input type="hidden" name="id_realisasi" value="<?php echo $s->realisasi_id ?>">	
																			<input type="hidden" name="id_transaksi" value="<?php echo $s->realisasi_transaksi ?>">	

																			<input type="number" name="realisasi_volume" placeholder="Rp." value="<?php echo $s->realisasi_volume ?>" required class="form-control" style="width:100%">
																		</div>


																		<div class="form-group" style="width:100%">
																			<label style="width: 100%;">REALISASI HARGA SATUAN</label>
																			<input type="number" name="realisasi_harga" placeholder="Rp." value="<?php echo $s->realisasi_harga_satuan ?>" required class="form-control" style="width:100%">
																		</div>

																		<div class="form-group" style="width:100%">
																			<label style="width: 100%;">REALISASI JUMLAH HARGA</label>		
																			<input type="number" name="realisasi_jumlah" placeholder="Rp." value="<?php echo $s->realisasi_jumlah_harga ?>" required class="form-control" style="width:100%">
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
													<div id="hapusData<?php echo $s->realisasi_id ?>" class="modal fade" role="dialog">
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
																	<form action="<?php echo base_url('dashboard/realisasi_hapus') ?>" method="post" enctype="multipart/form-data">											

																		<div class="form-group" style="width:100%">																				
																			<input type="hidden" name="id_project" value="<?php echo $idProject ?>">
																			<input type="hidden" name="id_realisasi" value="<?php echo $s->realisasi_id ?>">	
																			<input type="hidden" name="id_transaksi" value="<?php echo $s->realisasi_transaksi ?>">																						
																		</div>

																		<button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
																		<input type="submit" value="Hapus" class="btn btn-danger">
																	</form>
																</div>

															</div>
														</div>
													</div>
												</td>																							

											</tr>											
											<?php
										}


										?>
										
										

										<?php
									}
									?>
								</tbody>
								

							</table>
						</div>
						
					</div>
				</div>

			</div>

			

			
		</div>

	</section>

</div>