<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pegawai
			<small>Data Pegawai</small>
		</h1>
		<div class="pull-right" style="margin-top:-30px;">
			<select class="form-control" id="isActive" onchange="changePegawaiActive(this)">
				<?php
					// if (empty($active)) {
					// 	$filter_active = "";
					// }else {
					// 	$filter_active = $active;
					// }
				?>
				<option value="ALL" <?php if($active == "ALL"){echo "selected";} ?>>Semua Status</option>
				<option value="TRUE" <?php if($active == "TRUE"){echo "selected";} ?> >Karyawan Aktif</option>
				<option value="FALSE" <?php if($active == "FALSE"){echo "selected";} ?> >Karyawan Non Aktif</option>
			</select>
		</div>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				

				<?php
					$this->load->view('template/v_alert');
					$this->load->view('pegawai/modal_pegawai_add');
				?>				

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Diri</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
							<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importData"><i class="fa fa-file-excel-o"></i>  &nbsp Import</button>
						</div>
					</div>
					
					<div class="box-body">
						<table class="table table-bordered table-hover" id="table-pegawai">
							<thead style="background: #eaeaea;">
								<tr>
									<th width="1%">NO</th>
									<th style="min-width: 120px;"><input type="text" class="form-control input-sm filter-pegawai" id="search-nama" placeholder="Nama Pegawai"></th>
									<th><input type="text" class="form-control input-sm filter-pegawai" id="search-nik" placeholder="N.I.K."></th>
									<th style="min-width: 140px;"><input type="text" class="form-control input-sm filter-pegawai" id="search-ttl" placeholder="Tempat Tanggal Lahir"></th>
									<th style="min-width: 90px;"><input type="text" class="form-control input-sm filter-pegawai" id="search-jk" placeholder="Jenis Kelamin"></th>
									<th><input type="text" class="form-control input-sm filter-pegawai" id="search-edu" placeholder="Pendidikan"></th>
									<th><input type="text" class="form-control input-sm filter-pegawai" id="search-ag" placeholder="Agama"></th>
									<th><input type="text" class="form-control input-sm filter-pegawai" id="search-kw" placeholder="Kewarganegaraan"></th>
									<th style="min-width: 115px;"><input type="text" class="form-control input-sm filter-pegawai" id="search-spn" placeholder="Status Pernikahan"></th>
									<th style="min-width: 150px;"><input type="text" class="form-control input-sm filter-pegawai" id="search-adr" placeholder="Alamat"></th>
									<th style="min-width: 125px;">Tanggal Bergabung</th>
									<th style="min-width: 100px;">Tanggal Keluar</th>
									<th style="min-width: 100px;"><input type="text" class="form-control input-sm filter-pegawai" id="search-mail" placeholder="E-Mail (Pribadi)"></th>
									<th style="min-width: 100px;">Status Pegawai</th>
									<th style="min-width: 50px;">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($pegawais as $p){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><a href="#" data-toggle="modal" data-target="#kepegawaian<?php echo $p->pegawai_id ?>" data-backdrop="static"><?php echo $p->pegawai_nama; ?></a></td>
										<td><?php echo $p->pegawai_nik; ?></td>	
										<?php
											$tgl_lahir = date("d-m-Y", strtotime($p->pegawai_tgl_lahir));
										?>
										<td><?php echo $p->pegawai_tempat_lahir.", ".$tgl_lahir; ?></td>
										<td>
											<?php 
												if ($p->pegawai_gender == "L") {
													echo "Laki-laki";
												}else {
													echo "Perempuan";
												}
											?>
										</td>
										<td><?php echo $p->pendidikan_nama ?></td></td>
										<td><?php echo $p->pegawai_agama ?></td>
										<td><?php echo $p->pegawai_kewarganegaraan ?></td>
										<td><?php echo $p->pegawai_pernikahan ?></td>
										<td><?php echo $p->pegawai_alamat ?></td>
										<?php
											$tgl_gabung = date("d-m-Y", strtotime($p->pegawai_tgl_gabung));
											if (!empty($p->pegawai_tgl_keluar)) {
												$tgl_keluar = date("d-m-Y", strtotime($p->pegawai_tgl_keluar));
											}else {
												$tgl_keluar = "-";
											}
										?>
										<td><?php echo $tgl_gabung; ?></td>
										<td><?php echo $tgl_keluar; ?></td>
										<td><?php echo $p->pegawai_email_pribadi; ?></td>
										<td><?php if($p->is_active){echo "Aktif";}else{echo "Non Aktif";} ?></td>
										<td> 
											
											<?php
												if ($p->is_active) {
											?>

											<button type="button" title="Edit Data" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->pegawai_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" title="Nonaktifkan" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#nonaktifData<?php echo $p->pegawai_id ?>"><i class="fa fa-briefcase"></i> </button>
											
											<?php
												}else {
											?>
											<button type="button" title="Aktifkan Pegawai" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#aktifkanData<?php echo $p->pegawai_id ?>"><i class="fa fa-briefcase"></i> </button>
											<button type="button" title="Hapus" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->pegawai_id ?>"><i class="fa fa-trash"></i> </button>
											<?php
												}
											?>
											

											<?php
												$data['pegawai'] = $p;
												$this->load->view('pegawai/modal_pegawai_edit', $data);
												$this->load->view('pegawai/modal_kepegawaian', $data);
												$this->load->view('pegawai/modal_karier_add', $data);
											?>

											<!-- Nonaktifkan data pegawai -->
											<div id="nonaktifData<?php echo $p->pegawai_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
															

														</div>
														<div class="modal-body">
															<p>Yakin ingin menonaktifkan pegawai ini ?</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
															<a href="<?php echo base_url().'pegawai/pegawai_deactivate/'.$p->pegawai_id; ?>" class="btn btn-primary">Nonaktifkan</a>
														</div>
													</div>
												</div>
											</div>
											
											<!-- Aktifkan data pegawai -->
											<div id="aktifkanData<?php echo $p->pegawai_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
															

														</div>
														<div class="modal-body">
															<p>Yakin ingin mengaktifkan kembali pegawai ini ?</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
															<a href="<?php echo base_url().'pegawai/pegawai_activate/'.$p->pegawai_id; ?>" class="btn btn-success">Aktifkan</a>
														</div>
													</div>
												</div>
											</div>

											<!-- Hapus data pegawai -->
											<div id="hapusData<?php echo $p->pegawai_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
															

														</div>
														<div class="modal-body">
															<p>Yakin ingin menghapus pegawai ini?</p>
															<i>Seluruh data beserta riwayat pegawai akan terhapus.</i>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
															<a href="<?php echo base_url().'pegawai/pegawai_hapus/'.$p->pegawai_id; ?>" class="btn btn-primary">Hapus</a>
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