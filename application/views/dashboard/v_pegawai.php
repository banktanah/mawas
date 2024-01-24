<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pegawai
			<small>Data Pegawai</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importData"><i class="fa fa-plus"></i>  &nbsp Import</button>

				<div id="addData" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<center><h4 class="modal-title"> Tambah Pegawai</h4></center>
							</div>
							<div class="modal-body">

								<form action="<?php echo base_url('dashboard/pegawai_act') ?>" method="post" enctype="multipart/form-data">
									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> Nama Pegawai</label>		
										<input type="text" style="width:100%" name="pegawai_nama" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> N. I. P.</label>		
										<input type="text" style="width:100%" name="pegawai_nip" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Tanggal Lahir</label>				
										<input type="date" style="width:100%" name="pegawai_tgl_lahir" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> Jenis Kelamin</label>		
										<input type="radio" id="l" name="pegawai_gender" value="L">
										<label for="html">Laki-laki</label><br>
										<input type="radio" id="p" name="pegawai_gender" value="P">
										<label for="html">Perempuan</label><br>
									</div>
									

									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> Domisili</label>		
										<input type="text" style="width:100%" name="pegawai_domisili" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Pendidikan Terakhir</label>				
										<select class="form-control" name="pegawai_pendidikan" required style="width: 100%;">
											<option value="">--Pilih Pendidikan--</option>
											<?php 
												$edu = $this->db->query("select * from pendidikan")->result();
												foreach ($edu as $e) {
											?>
												<option value="<?php echo $e->pendidikan_id ?>"><?php echo $e->pendidikan_nama ?></option>
											<?php
												}
											?>													
										</select>
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Divisi</label>				
										<select class="form-control" name="pegawai_divisi" id="pegawai_divisi" required style="width: 100%;">
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
										<label style="width: 100%;">Divisi Bagian</label>				
										<select class="form-control" name="pegawai_divisi_bagian" id="pegawai_divisi_bagian" required style="width: 100%;">
											<option>--Pilih Bagian--</option>			
										</select>
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> E-Mail</label>		
										<input type="text" style="width:100%" name="pegawai_email" required class="form-control">
									</div>

									<!-- <div class="form-group" style="width:100%">
										<label style="width: 100%;">Jabatan</label>				
										<select class="form-control" name="pegawai_jabatan" required style="width: 100%;">
											<option value="">--Pilih Jabatan--</option>
											<?php 
												// $jab = $this->db->query("select * from jabatan")->result();
												// foreach ($jab as $j) {
											?>
											<option value="<?php //echo $j->jabatan_id ?>"><?php //echo $j->jabatan_nama ?></option>
											<?php
												//}
											?>													
										</select>
									</div> -->

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Status Kepegawaian</label>				
										<select class="form-control" name="pegawai_status" required style="width: 100%;">
											<option value="">--Pilih Status--</option>
											<?php 
												$sta = $this->db->query("select * from status_pegawai")->result();
												foreach ($sta as $s) {
											?>
											<option value="<?php echo $s->status_pegawai_id ?>"><?php echo $s->status_nama ?></option>
											<?php
												}
											?>													
										</select>
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Tanggal Bergabung</label>				
										<input type="date" style="width:100%" name="pegawai_tgl_gabung" required class="form-control">
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;"> Jabatan</label>		
										<select class="form-control" name="pegawai_jabatan" required style="width: 100%;">
											<option value="">--Pilih Jabatan--</option>
											<?php 
												$jab = $this->db->query("select * from jabatan_general order by jabatan_level asc")->result();
												foreach ($jab as $j) {
											?>
											<option value="<?php echo $j->jabatan_id ?>"><?php echo $j->jabatan_nama ?></option>
											<?php
												}
											?>
										</select>
									</div>

									<div class="form-group" style="width:100%">
										<label style="width: 100%;">Foto</label>				
										<input type="file" style="width:100%" name="foto">
									</div>
									
									<br>
									<br>
									<input type="submit" value="Simpan" class="btn btn-primary">
								</form>
							</div>											
						</div>
					</div>
				</div>				

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pegawai</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-bordered table-hover" id="table-datatable">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Foto</th>
									<th>Nama</th>
									<th>N.I.P.</th>
									<th>EMail</th>
									<th style="min-width: 90px;">Tanggal Lahir</th>
									<th style="min-width: 90px;">Jenis Kelamin</th>
									<th>Domisili</th>
									<th>Pendidikan</th>
									<th>Divisi</th>
									<th style="min-width: 80px;">Divisi Bagian</th>
									<!-- <th>Jabatan</th> -->
									<th>Status</th>
									<th style="min-width: 125px;">Tanggal Bergabung</th>
									<th style="min-width: 50px;">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($pegawai as $p){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td>
											<?php
												if (!empty($p->pegawai_foto)) {
											?>
												<center >
													<img src="<?= $p->pegawai_foto; ?>" style="height: 50px;" alt="foto_pegawai">
												</center>
											<?php
												}
											?>
										</td>
										<td><?php echo $p->pegawai_nama; ?></td>
										<td><?php echo $p->pegawai_nip; ?></td>	
										<td><?php echo $p->pegawai_email; ?></td>									
										<td><?php echo $p->pegawai_tgl_lahir; ?></td>
										<td>
											<?php 
												if ($p->pegawai_gender == "L") {
													echo "Laki-laki";
												}else {
													echo "Perempuan";
												}
											?>
										</td>
										<td><?php echo $p->pegawai_domisili ?></td>
										<td>
											<?php 
												$list_edu = $this->db->query("select * from pendidikan")->result();
												foreach ($list_edu as $ledu) {
													if ($ledu->pendidikan_id == $p->pegawai_pendidikan) {
														echo $ledu->pendidikan_nama;
													}
												}
											?>
										</td>
										<td>
											<?php 
												$list_div = $this->db->query("select * from divisi")->result();
												foreach ($list_div as $ldiv) {
													if ($ldiv->divisi_id == $p->pegawai_divisi) {
														echo $ldiv->divisi_nama;
													}
												}
											?>
										</td>
										<td>
											<?php 
												$list_div_bag = $this->db->query("select * from divisi_bagian")->result();
												foreach ($list_div_bag as $ldb) {
													if ($ldb->divisi_bagian_id == $p->pegawai_divisi_bagian) {
														echo $ldb->divisi_bagian_nama;
													}
												}
											?>
										</td>
										<!-- <td>
											<?php 
												// $list_jab = $this->db->query("select * from jabatan")->result();
												// foreach ($list_jab as $ljab) {
												// 	if ($ljab->jabatan_id == $p->pegawai_jabatan) {
												// 		echo $ljab->jabatan_nama;
												// 	}
												// }
											?>
										</td> -->
										<td>
											<?php 
												$list_sta = $this->db->query("select * from status_pegawai")->result();
												foreach ($list_sta as $lsta) {
													if ($lsta->status_pegawai_id == $p->pegawai_status) {
														echo $lsta->status_nama;
													}
												}
											?>
										</td>
										<td><?php echo $p->pegawai_tgl_gabung; ?></td>
										<td>
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editData<?php echo $p->pegawai_id ?>"><i class="fa fa-pencil"></i> </button>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->pegawai_id ?>"><i class="fa fa-trash"></i> </button>


											<!-- edit data pegawai -->
											<div id="editData<?php echo $p->pegawai_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data Pegawai</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php echo base_url('dashboard/pegawai_update') ?>" method="post" enctype="multipart/form-data">
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama Pegawai</label>	
																	<input type="hidden" name="id" value="<?php echo $p->pegawai_id ?>">	
																	<input type="text" name="pegawai_nama" value="<?php echo $p->pegawai_nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> N.I.P.</label>	
																	<input type="text" name="pegawai_nip" value="<?php echo $p->pegawai_nip ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Tanggal Lahir</label>				
																	<input type="date" style="width:100%" name="pegawai_tgl_lahir" value="<?php echo $p->pegawai_tgl_lahir ?>" required class="form-control">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Jenis Kelamin</label>		
																	<input type="radio" id="l" name="pegawai_gender" value="L" <?php if($p->pegawai_gender == "L"){echo "checked";} ?>>
																	<label for="html">Laki-laki</label><br>
																	<input type="radio" id="p" name="pegawai_gender" value="P" <?php if($p->pegawai_gender == "P"){echo "checked";} ?>>
																	<label for="html">Perempuan</label><br>
																</div>
																
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Domisili</label>		
																	<input type="text" style="width:100%" name="pegawai_domisili" value="<?php echo $p->pegawai_domisili ?>" required class="form-control">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Pendidikan Terakhir</label>				
																	<select class="form-control" name="pegawai_pendidikan" required style="width: 100%;">
																		<option value="">--Pilih Pendidikan--</option>
																		<?php 
																			$edue = $this->db->query("select * from pendidikan")->result();
																			foreach ($edue as $ee) {
																		?>
																			<option value="<?php echo $ee->pendidikan_id ?>" <?php if ($ee->pendidikan_id == $p->pegawai_pendidikan) {
																			echo "selected";} ?>><?php echo $ee->pendidikan_nama ?></option>
																		<?php
																			}
																		?>													
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Divisi</label>				
																	<select class="form-control" name="pegawai_divisi" id="pegawai_divisi" required style="width: 100%;">
																		<option value="">--Pilih Divisi--</option>
																		<?php 
																			$dive = $this->db->query("select * from divisi")->result();
																			foreach ($dive as $de) {
																		?>
																		<option value="<?php echo $de->divisi_id ?>" <?php if ($de->divisi_id == $p->pegawai_divisi) {
																		echo "selected";} ?>><?php echo $de->divisi_nama ?></option>
																		<?php
																			}
																		?>													
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Divisi Bagian</label>				
																	<select class="form-control" name="pegawai_divisi_bagian" id="pegawai_divisi_bagian" required style="width: 100%;">
																		<option value="">--Pilih Bagian--</option>
																		<?php 
																			$bage = $this->db->query("select * from divisi_bagian")->result();
																			foreach ($bage as $be) {
																		?>
																		<option value="<?php echo $be->divisi_bagian_id ?>" <?php if ($be->divisi_bagian_id == $p->pegawai_divisi_bagian) {
																		echo "selected";} ?>><?php echo $be->divisi_bagian_nama ?></option>
																		<?php
																			}
																		?>													
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> E-Mail</label>		
																	<input type="text" name="pegawai_email" value="<?php echo $p->pegawai_email ?>" required class="form-control" style="width:100%">
																</div>

																<!-- <div class="form-group" style="width:100%">
																	<label style="width: 100%;">Jabatan</label>				
																	<select class="form-control" name="pegawai_jabatan" required style="width: 100%;">
																		<option value="">--Pilih Jabatan--</option>
																		<?php 
																			// $jabe = $this->db->query("select * from jabatan")->result();
																			// foreach ($jabe as $je) {
																		?>
																		<option value="<?php //echo $je->jabatan_id ?>" <?php //if ($je->jabatan_id == $p->pegawai_jabatan) {
																		//echo "selected";} ?>><?php //echo $je->jabatan_nama ?></option>
																		<?php
																			//}
																		?>													
																	</select>
																</div> -->

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Status Kepegawaian</label>				
																	<select class="form-control" name="pegawai_status" required style="width: 100%;">
																		<option value="">--Pilih Status--</option>
																		<?php 
																			$stae = $this->db->query("select * from status_pegawai")->result();
																			foreach ($stae as $se) {
																		?>
																		<option value="<?php echo $se->status_pegawai_id ?>" <?php if ($se->status_pegawai_id == $p->pegawai_status) {
																		echo "selected";} ?>><?php echo $se->status_nama ?></option>
																		<?php
																			}
																		?>													
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Tanggal Bergabung</label>				
																	<input type="date" style="width:100%" name="pegawai_tgl_gabung" value="<?php echo $p->pegawai_tgl_gabung ?>" required class="form-control">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Jabatan</label>		
																	<select class="form-control" name="pegawai_jabatan" required style="width: 100%;">
																		<option value="">--Pilih Jabatan--</option>
																		<?php 
																			$jab = $this->db->query("select * from jabatan_general order by jabatan_level asc")->result();
																			foreach ($jab as $j) {
																		?>
																		<option value="<?php echo $j->jabatan_id ?>" <?php if($p->pegawai_level == $j->jabatan_id){ echo "selected";}?>><?php echo $j->jabatan_nama ?></option>
																		<?php
																			}
																		?>
																	</select>
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Foto</label>				
																	<input type="file" style="width:100%" name="foto">
																	<small>Kosongkan jika tidak ingin diganti.</small>
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
															<p>Yakin ingin menghapus data ini ?</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
															<a href="<?php echo base_url().'dashboard/pegawai_hapus/'.$p->pegawai_id; ?>" class="btn btn-primary">Hapus</a>
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