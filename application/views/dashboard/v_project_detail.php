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
						<h3 class="box-title">RENCANA BDP</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
							<a href="<?php echo base_url('dashboard/transaksi_excel/').$idProject?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i>&nbsp Excel</a>							
							<a href="<?php echo base_url('dashboard/transaksi_cetak/').$idProject?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i> &nbsp PDF</a>
						</div>

						
						<!-- Tambah data transaksi -->
						<div id="addData" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<center><h4 class="modal-title"> TAMBAH DATA TRANSAKSI PENGELUARAN</h4></center>
									</div>
									<div class="modal-body">

										<form action="<?php echo base_url('dashboard/transaksi_act') ?>" method="post" enctype="multipart/form-data">											

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> KATEGORI</label>
												<input type="hidden" name="id" value="<?php echo $p->project_id ?>">		
												<select class="form-control" name="kategori" id="kategori" required style="width: 100%;">
													<option value="">--Pilih--</option>
													<?php 
													$kat = $this->db->query("select * from kategori")->result();
													foreach ($kat as $d) {
														?>
														<option value="<?php echo $d->kategori_id ?>"><?php echo $d->kategori_nama ?></option>
														<?php
													}
													?>													
												</select>
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> SUB KATEGORI</label>		
												<select class="form-control" id="sub_kategori" name="sub_kategori" required style="width: 100%;">
													<option>No Selected</option>
												</select>
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;">VOLUME RENCANA</label>		
												<input type="number" name="rencana_volume" placeholder="Rp." required class="form-control" style="width:100%">
											</div>
											<div class="form-group" style="width:100%">
												<label style="width: 100%;">RENCANA HARGA SATUAN</label>		
												<input type="number" name="rencana_harga" placeholder="Rp." required class="form-control" style="width:100%">
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;">RENCANA JUMLAH HARGA</label>		
												<input type="number" name="rencana_jumlah" placeholder="Rp." required class="form-control" style="width:100%">
											</div>

											<div class="form-group" style="width:100%">
												<label style="width: 100%;"> KETERANGAN</label>
												<select class="form-control" name="keterangan" required style="width: 100%;">
													<option value="">--Pilih--</option>
													<option value="Selesai">Selesai</option>										
													<option value="Proses">Proses</option>			
												</select>
											</div>

											<br>
											<br>
											<input type="submit" value="Simpan" class="btn btn-primary">
										</form>
									</div>											
								</div>
							</div>
						</div>			
					</div>

					<div class="box-body">
						<div class="table-responsive">					
							<table class="table table-bordered">
								<thead>
									<tr>										
										<th rowspan="2" width="20%"><center>Uraian Pekerjaan</center></th>
										<th rowspan="2">Satuan</th>									
										<th colspan="4"><center>RENCANA BDP</center></th>
										<th colspan="4"><center>REALISASI BDP</center></th>
										<th rowspan="2"><center>Sisa Anggaran</center></th>
										<th rowspan="2"><center>Ket</center></th>
										<th rowspan="2" width="25%">Opsi</th>
										<th rowspan="2" width="25%"></th>
									</tr>
									<tr>
										<th>Volume</th>
										<th>Harga Satuan (Rp)</th>
										<th>Harga Jumlah (Rp)</th>
										<th>Total (Rp)</th>


										<th>Volume</th>
										<th>Harga Satuan (Rp)</th>
										<th>Harga Jumlah (Rp)</th>
										<th>Total (Rp)</th>
									</tr>	


								</thead>
								<tbody>
									<?php
									foreach ($data as $k) {
										$idKat = $k->transaksi_kategori;
										?>
										<tr>
											<td colspan="5"><b><?php echo $k->kategori_nama; ?></b></td>
											<?php
											$totx = $this->db->query("select sum(transaksi_rencana_jumlah) as total from transaksi where transaksi_project='$idProject' and transaksi_kategori='$idKat'")->row();
											$toty = $this->db->query("select sum(realisasi_jumlah_harga) as total from realisasi where realisasi_project='$idProject' and realisasi_kategori='$idKat'")->row();
											
											?>

											<td><b><?php echo number_format($totx->total) ?></b></td>
											<td colspan="3"></td>	
											<td><b><?php echo number_format($toty->total) ?></b></td>
											<td>
												<?php 
												$x = $totx->total;
												$y = $toty->total;
												$hasil = abs($x-$y);												
												?>
												<b><?php echo number_format($hasil) ?></b>
											</td>

										</tr>
										<?php 
										$sub = $this->db->query("select * from transaksi, sub_kategori where transaksi_project='$idProject' and transaksi_kategori='$idKat' and transaksi_sub_kategori=sub_id order by transaksi_kategori")->result();
										foreach ($sub as $s) {
											$idSub = $s->sub_id;
											$id_kategori = $s->transaksi_kategori;
											$id_transaksi = $s->transaksi_id;
											?>
											<tr>
												<td><?php echo $s->nama ?></td>
												<td><?php echo $s->satuan ?></td>
												<td><?php echo number_format($s->transaksi_rencana_volume) ?></td>												
												<?php
												$nilai = $this->db->query("select * from transaksi where transaksi_kategori='$idKat' and transaksi_sub_kategori='$idSub' and transaksi_project='$idProject' group by transaksi_kategori")->result();
												foreach ($nilai as $n) {
													
													?>
													<td><?php echo number_format($n->transaksi_rencana_harga) ?></td>
													<td><?php echo number_format($n->transaksi_rencana_jumlah) ?></td>
													<td></td>
													<td>
														<?php
														$real = $this->db->query("select sum(realisasi_volume) as tot from realisasi where realisasi_transaksi='$id_transaksi'")->result();
														foreach ($real as $r) {
															// code...
															?>															
															<?php echo "Rp.".number_format($r->tot) ?><br>

															<?php
														}

														?>
													</td>
													<td>
														<?php
														$real = $this->db->query("select sum(realisasi_harga_satuan) as tott from realisasi where realisasi_transaksi='$id_transaksi'")->result();
														foreach ($real as $r) {
															// code...
															?>															
															<?php echo "Rp.".number_format($r->tott) ?><br>

															<?php
														}

														?>
													</td>
													<td>
														<?php
														$real = $this->db->query("select sum(realisasi_jumlah_harga) as tottt from realisasi where realisasi_transaksi='$id_transaksi'")->result();
														foreach ($real as $r) {
															// code...
															?>															
															<?php echo "Rp.".number_format($r->tottt) ?><br>
															
															<?php
														}

														?>
													</td>
													
													
													<td></td>
													<td></td>
													<th><?php echo $n->transaksi_keterangan ?></th>
													<td>
														<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editData<?php echo $n->transaksi_id ?>"><i class="fa fa-pencil"></i> </button>
														<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $n->transaksi_id ?>"><i class="fa fa-trash"></i> </button>	

														<!-- edit data user -->
														<div id="editData<?php echo $n->transaksi_id ?>" class="modal fade" role="dialog">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<center><h4 class="modal-title"> Edit Data Transaksi</h4></center>
																	</div>
																	<div class="modal-body">

																		<form action="<?php echo base_url('dashboard/transaksi_update') ?>" method="post" enctype="multipart/form-data">											

																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;"> KATEGORI</label>
																				<input type="hidden" name="id_project" value="<?php echo $idProject ?>">
																				<input type="hidden" name="id_transaksi" value="<?php echo $n->transaksi_id ?>">		
																				<select class="form-control" name="kategori" id="kategori" required style="width: 100%;">
																					<option value="">--Pilih--</option>
																					<?php 
																					$kat = $this->db->query("select * from kategori")->result();
																					foreach ($kat as $d) {
																						?>
																						<option <?php if($n->transaksi_kategori == $d->kategori_id){echo "selected='selected'";} ?> value="<?php echo $d->kategori_id ?>"><?php echo $d->kategori_nama ?></option>
																						<?php
																					}
																					?>													
																				</select>
																			</div>

																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;"> SUB KATEGORI</label>																					
																				<select class="form-control" id="sub_kategori" name="sub_kategori" required style="width: 100%;">
																					<?php 
																					$sub = $this->db->query("select * from sub_kategori where kategori='$id_kategori'")->result();
																					foreach ($sub as $sb) {
																						?>
																						<option <?php if($n->transaksi_sub_kategori == $sb->sub_id){echo "selected='selected'";} ?> value="<?php echo $sb->sub_id ?>"><?php echo $sb->nama ?></option>
																						<?php
																					}
																					?>
																				</select>
																			</div>

																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;">VOLUME</label>		
																				<input type="number" name="rencana_volume" placeholder="Rp." value="<?php echo $n->transaksi_rencana_volume ?>" required class="form-control" style="width:100%">
																			</div>

																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;">RENCANA HARGA SATUAN</label>		
																				<input type="number" name="rencana_harga" placeholder="Rp." value="<?php echo $n->transaksi_rencana_harga ?>" required class="form-control" style="width:100%">
																			</div>

																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;">RENCANA JUMLAH HARGA</label>		
																				<input type="number" name="rencana_jumlah" placeholder="Rp." value="<?php echo $n->transaksi_rencana_jumlah ?>" required class="form-control" style="width:100%">
																			</div>


																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;"> KETERANGAN</label>
																				<select class="form-control" name="keterangan" required style="width: 100%;">
																					<option value="">--Pilih--</option>
																					<option <?php if($n->transaksi_keterangan == "Selesai"){echo "selected='selected'";} ?> value="Selesai">Selesai</option>										
																					<option <?php if($n->transaksi_keterangan == "Proses"){echo "selected='selected'";} ?> value="Proses">Proses</option>			
																				</select>
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
														<div id="hapusData<?php echo $n->transaksi_id ?>" class="modal fade" role="dialog">
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
																		<form action="<?php echo base_url('dashboard/transaksi_hapus') ?>" method="post" enctype="multipart/form-data">											

																			<div class="form-group" style="width:100%">																				
																				<input type="hidden" name="id_project" value="<?php echo $idProject ?>">
																				<input type="hidden" name="id_transaksi" value="<?php echo $n->transaksi_id ?>">																						
																			</div>

																			<button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
																			<input type="submit" value="Hapus" class="btn btn-danger">
																		</form>
																	</div>
																	
																</div>
															</div>
														</div>


													</td>
													<td>
													
														<a href="<?php echo base_url('dashboard/transaksi_detail/'.$idProject."/".$id_transaksi) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
														<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDataRealisasi<?php echo $n->transaksi_id ?>"><i class="fa fa-plus"></i> </button>

														<!-- Tambah data transaksi -->
														<div id="addDataRealisasi<?php echo $n->transaksi_id ?>" class="modal fade" role="dialog">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<center><h4 class="modal-title"> TAMBAH DATA REALISASI BDP</h4></center>
																	</div>
																	<div class="modal-body">

																		<form action="<?php echo base_url('dashboard/transaksi_realisasi') ?>" method="post" enctype="multipart/form-data">
																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;">VOLUME REALISASI</label>
																				<input type="hidden" name="id_project" value="<?php echo $idProject ?>">
																				<input type="hidden" name="id_kategori" value="<?php echo $n->transaksi_kategori ?>">
																				<input type="hidden" name="id_sub" value="<?php echo $n->transaksi_sub_kategori ?>">
																				<input type="hidden" name="id_transaksi" value="<?php echo $n->transaksi_id ?>">		
																				<input type="number" name="realisasi_volume" placeholder="Rp." class="form-control" style="width:100%">
																			</div>

																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;">REALISASI HARGA SATUAN</label>		
																				<input type="number" name="realisasi_harga" placeholder="Rp." class="form-control" style="width:100%">
																			</div>

																			<div class="form-group" style="width:100%">
																				<label style="width: 100%;">REALISASI JUMLAH HARGA</label>		
																				<input type="number" name="realisasi_jumlah" placeholder="Rp." class="form-control" style="width:100%">
																			</div>																			

																			<br>
																			<br>
																			<input type="submit" value="Simpan" class="btn btn-primary">
																		</form>
																	</div>											
																</div>
															</div>
														</div>
													</td>
													<?php
												}

												?>

											</tr>											
											<?php
										}


										?>
										
										

										<?php
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="5"><center>TOTAL</center></th>
										<th>
											<?php
											$cek = $this->db->query("select sum(transaksi_rencana_jumlah) as total_rencana from transaksi where transaksi_project='$idProject'")->row();
											echo number_format($cek->total_rencana);
											?>
										</th>
										<th colspan="3"></th>
										<th>
											<?php
											$cek = $this->db->query("select sum(realisasi_jumlah_harga) as total_realisasi from realisasi where realisasi_project='$idProject'")->row();
											echo number_format($cek->total_realisasi);
											?>
										</th>
										
									</tr>
								</tfoot>




							</table>
						</div>
						
					</div>
				</div>

			</div>

			

			
		</div>

	</section>

</div>