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
							<a href="<?php echo base_url('kepala/transaksi_excel/').$idProject?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i>&nbsp Excel</a>							
							<a href="<?php echo base_url('kepala/transaksi_cetak/').$idProject?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i> &nbsp PDF</a>
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
										<th rowspan="2"><center>Keterangan</center></th>
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