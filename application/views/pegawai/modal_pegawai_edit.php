											<!-- edit data pegawai -->
											<div id="editData<?php echo $pegawai->pegawai_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h3 class="modal-title"> Edit Data Pegawai</h3></center>
														</div>
														<div class="modal-body" style="height: 420px; overflow-y: scroll;">

															<form id="editPegawai<?php echo $pegawai->pegawai_id ?>" action="<?php echo base_url('pegawai/pegawai_update') ?>" method="post" enctype="multipart/form-data">
																<u><h4>BIODATA</h4></u>	
																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Nama Pegawai</label>	
																	<input type="hidden" name="id" value="<?php echo $pegawai->pegawai_id ?>">	
																	<input type="text" name="pegawai_nama" value="<?php echo $pegawai->pegawai_nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> N.I.K.</label>		
																	<input type="text" name="pegawai_nik" value="<?php echo $pegawai->pegawai_nik ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;">Tempat, Tanggal Lahir</label>		
																	<div class="row">
																		<div class="col-sm-8">
																			<input style="width: 100%;" type="text" value="<?php echo $pegawai->pegawai_tempat_lahir ?>" name="pegawai_tempat_lahir" required class="form-control">
																		</div>
																		<div class="col-sm-4">
																			<?php
																				$tglLahirE = date("Y-m-d", strtotime($pegawai->pegawai_tgl_lahir));
																				$tglGabungE = date("Y-m-d", strtotime($pegawai->pegawai_tgl_gabung));
																				if (!empty($pegawai->pegawai_tgl_keluar)) {
																					$tglKeluarE = date("Y-m-d", strtotime($pegawai->pegawai_tgl_keluar));
																				}
																				
																			?>
																			<input style="width: 100%;" type="date" value="<?php echo $tglLahirE; ?>" name="pegawai_tgl_lahir" required class="form-control">
																		</div>
																	</div>
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Jenis Kelamin</label>
																	<div class="row">
																		<div class="col-sm-3">
																			<input type="radio" id="l" name="pegawai_gender" value="L" <?php if($pegawai->pegawai_gender == "L"){echo "checked";} ?>>
																			<label for="html">Laki-laki</label>
																		</div>
																		<div class="col-sm-3">
																			<input type="radio" id="p" name="pegawai_gender" value="P" <?php if($pegawai->pegawai_gender == "P"){echo "checked";} ?>>
																			<label for="html">Perempuan</label>
																		</div>
																	</div>
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Pendidikan</label>		
																	<!-- <input type="text" name="provinsi" required class="form-control" style="width:100%"> -->
																	<?php $idProv = 0; ?>
																		<select class="form-control" name="pegawai_pendidikan" required style="width: 100%;">
																			<option value="">--Pilih Pendidikan--</option>
																			<?php 
																				$pendidikan = $this->db->query("SELECT * FROM master_pendidikan ORDER BY urutan")->result();
																					foreach ($pendidikan as $pd) {
																			?>
																			<option <?php if($pd->pendidikan_id == $pegawai->pendidikan_id){echo "selected";}?> value="<?php echo $pd->pendidikan_id ?>"><?php echo $pd->pendidikan_nama ?></option>
																	<?php
																		}
																	?>													
																		</select>
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Agama</label>	
																	<select style="width:100%" name="pegawai_agama" required class="form-control">
																		<option value="">--Pilih Agama--</option>
																		<option <?php if($pegawai->pegawai_agama == "Budha"){echo "selected";} ?> value="Budha">Budha</option>
																		<option <?php if($pegawai->pegawai_agama == "Hindu"){echo "selected";} ?> value="Hindu">Hindu</option>
																		<option <?php if($pegawai->pegawai_agama == "Islam"){echo "selected";} ?> value="Islam">Islam</option>
																		<option <?php if($pegawai->pegawai_agama == "Katolik"){echo "selected";} ?> value="Katolik">Katolik</option>
																		<option <?php if($pegawai->pegawai_agama == "Kristen"){echo "selected";} ?> value="Kristen">Kristen</option>
																		<option <?php if($pegawai->pegawai_agama == "Konghucu"){echo "selected";} ?> value="Konghucu">Konghucu</option>
																	</select>	
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Kewarganegaraan</label>	
																	<select style="width:100%" name="pegawai_kewarganegaraan" required class="form-control">
																		<option value="">--Pilih Kewarganegaraan--</option>
																		<option <?php if($pegawai->pegawai_kewarganegaraan == "Warga Negara Indonesia"){echo "selected";} ?> value="Warga Negara Indonesia">Warga Negara Indonesia</option>
																		<option <?php if($pegawai->pegawai_kewarganegaraan == "Warga Negara Asing"){echo "selected";} ?> value="Warga Negara Asing">Warga Negara Asing</option>
																	</select>	
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Status Pernikahan</label>	
																	<select style="width:100%" name="pegawai_pernikahan" required class="form-control">
																		<option value="">--Pilih Status--</option>
																		<option <?php if($pegawai->pegawai_pernikahan == "Menikah"){echo "selected";} ?> value="Menikah">Menikah</option>
																		<option <?php if($pegawai->pegawai_pernikahan == "Belum Menikah"){echo "selected";} ?> value="Belum Menikah">Belum Menikah</option>
																		<option <?php if($pegawai->pegawai_pernikahan == "Janda"){echo "selected";} ?> value="Janda">Janda</option>
																		<option <?php if($pegawai->pegawai_pernikahan == "Duda"){echo "selected";} ?> value="Duda">Duda</option>
																	</select>	
																</div>
																
																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Alamat</label>		
																	<textarea rows="4" cols="100" style="width:100%" name="pegawai_alamat" required class="form-control"><?php echo $pegawai->pegawai_alamat ?></textarea>
																	<div class="row">
																		<div class="col-sm-5">
																			<input type="text" style="width:100%" value="<?php echo $pegawai->pegawai_kota ?>" placeholder="Kabupaten/Kota" name="pegawai_kota" required class="form-control">
																		</div>
																		<div class="col-sm-4">
																			<input type="text" style="width:100%" value="<?php echo $pegawai->pegawai_provinsi ?>" placeholder="Provinsi" name="pegawai_provinsi" required class="form-control">
																		</div>
																		<div class="col-sm-3">
																			<input type="number" style="width:100%" value="<?php echo $pegawai->pegawai_pos ?>" placeholder="Kode POS" name="pegawai_pos" required class="form-control">
																		</div>
																	</div>
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> Nomor Telepon</label>		
																	<input type="number" value="<?php echo $pegawai->pegawai_telepon ?>" style="width:100%" name="pegawai_telepon" required class="form-control">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> E-Mail (Pribadi)</label>		
																	<input type="text" name="pegawai_email_pribadi" value="<?php echo $pegawai->pegawai_email_pribadi ?>" required class="form-control" style="width:100%">
																</div>

																<hr>
                    											<u><h4>KEPEGAWAIAN</h4></u>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> N. I. P.</label>		
																	<input type="text" value="<?php echo $pegawai->pegawai_nip ?>" style="width:100%" name="pegawai_nip" required class="form-control">
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<div class="row">
																		<div class="col-sm-6">
																			<label style="width: 100%;">Tanggal Bergabung</label>				
																			<input type="date" style="width:100%" value="<?php echo $tglGabungE;?>" name="pegawai_tgl_gabung" required class="form-control">
																		</div>
																		<div class="col-sm-6">
																			<label style="width: 100%;">Tanggal Keluar</label>				
																			<input type="date" style="width:100%" <?php if(!empty($pegawai->pegawai_tgl_keluar)){echo 'value="'.$tglKeluarE.'"';} ?> name="pegawai_tgl_keluar" class="form-control">
																		</div>
																	</div>
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> E-Mail (Kantor)</label>		
																	<input type="text" value="<?php echo $pegawai->pegawai_email_kantor ?>" style="width:100%" name="pegawai_email_kantor" required class="form-control">
																</div>

																<div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;"> N.P.W.P.</label>		
																	<input type="text" value="<?php echo $pegawai->pegawai_npwp ?>" style="width:100%" name="pegawai_npwp" required class="form-control">
																</div>

																<!-- <div class="form-group" style="width:100%; margin-bottom:15px;">
																	<label style="width: 100%;">Foto</label>				
																	<input type="file" style="width:100%" name="foto">
																	<small>Kosongkan jika tidak ingin diganti.</small>
																</div> -->

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;">Pas Photo</label>				
																	<input accept="image/*" type="file" style="width:100%" id="inputPic<?php echo $pegawai->pegawai_id ?>" name="foto" onchange="loadFile<?php echo $pegawai->pegawai_id ?>(event)">
																	<img src="<?php if(!empty($pegawai->pegawai_foto)){echo $pegawai->pegawai_foto;}?>" style="max-width: 200px; display: block; margin-top: 10px; position: relative; z-index: 10;" id="profilePic<?php echo $pegawai->pegawai_id ?>"/>
																	<button onclick="changePicPreview<?php echo $pegawai->pegawai_id ?>()" type="button" title="Hapus Foto" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
																</div>

																<br>
																<br>
																<!-- <input type="submit" value="Simpan" class="btn btn-primary"> -->
															</form>
														</div>	
														<div class="modal-footer">
															<input type="submit" form="editPegawai<?php echo $pegawai->pegawai_id ?>" value="Simpan" class="btn btn-primary">
														</div>										
													</div>
												</div>
											</div>