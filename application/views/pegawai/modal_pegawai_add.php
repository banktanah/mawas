<div id="addData" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<center><h3 class="modal-title"> Tambah Pegawai</h4></center>
			</div>
	        <div class="modal-body" style="height: 420px; overflow-y: scroll;">
				<form id="addPegawai" action="<?php echo base_url('pegawai/pegawai_act') ?>" method="post" enctype="multipart/form-data">
				    <u><h4>BIODATA</h4></u>	
                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Nama Lengkap</label>		
						<input type="text" style="width:100%" name="pegawai_nama" required class="form-control">
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> N.I.K.</label>		
						<input type="text" style="width:100%" name="pegawai_nik" required class="form-control">
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;">Tempat, Tanggal Lahir</label>		
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="text" name="pegawai_tempat_lahir" required class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <input type="date" name="pegawai_tgl_lahir" required class="form-control">
                            </div>
                        </div>
					</div>

					<div class="form-group" style="width:100%">
						<label style="width: 100%;"> Jenis Kelamin</label>		
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" id="l" name="pegawai_gender" value="L">
						        <label for="html">Laki-laki</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="radio" id="p" name="pegawai_gender" value="P">
                                <label for="html">Perempuan</label>
                            </div>
                        </div>
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Pendidikan</label>		
						<!-- <input type="text" name="provinsi" required class="form-control" style="width:100%"> -->
                        <?php $idProv = 0; ?>
                            <select class="form-control" name="pegawai_pendidikan" required style="width: 100%;">
								<option value="">--Pilih Pendidikan--</option>
								<?php 
									$pendidikan = $this->db->query("SELECT * FROM master_pendidikan ORDER BY urutan")->result();
										foreach ($pendidikan as $pd) {
								?>
								<option value="<?php echo $pd->pendidikan_id ?>"><?php echo $pd->pendidikan_nama ?></option>
						<?php
							}
						?>													
							</select>
                    </div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Agama</label>	
                        <select style="width:100%" name="pegawai_agama" required class="form-control">
                            <option value="">--Pilih Agama--</option>
                            <option value="Budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>	
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Kewarganegaraan</label>	
                        <select style="width:100%" name="pegawai_kewarganegaraan" required class="form-control">
                            <option value="">--Pilih Kewarganegaraan--</option>
                            <option value="Warga Negara Indonesia">Warga Negara Indonesia</option>
                            <option value="Warga Negara Asing">Warga Negara Asing</option>
                        </select>	
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Status Pernikahan</label>	
                        <select style="width:100%" name="pegawai_pernikahan" required class="form-control">
                            <option value="">--Pilih Status--</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Janda">Janda</option>
                            <option value="Duda">Duda</option>
                        </select>	
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Alamat/Domisili</label>	
                        <textarea rows="4" cols="100" style="width:100%" name="pegawai_alamat" required class="form-control"></textarea>
                        <div class="row">
                            <div class="col-sm-5">
                                <input type="text" style="width:100%" placeholder="Kabupaten/Kota" name="pegawai_kota" required class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" style="width:100%" placeholder="Provinsi" name="pegawai_provinsi" required class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" style="width:100%" placeholder="Kode POS" name="pegawai_pos" required class="form-control">
                            </div>
                        </div>
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Nomor Telepon</label>		
						<input type="number" style="width:100%" name="pegawai_telepon" required class="form-control">
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> E-Mail (Pribadi)</label>		
						<input type="text" style="width:100%" name="pegawai_email_pribadi" required class="form-control">
					</div>

                    <hr>
                    <u><h4>KEPEGAWAIAN</h4></u>
									
                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> N. I. P.</label>		
						<input type="text" style="width:100%" name="pegawai_nip" required class="form-control">
					</div>

                    <div class="form-group" style="width:100%">
                        <div class="row">
                            <div class="col-sm-6">
                                <label style="width: 100%;">Tanggal Bergabung</label>				
                                <input type="date" style="width:100%" name="pegawai_tgl_gabung" required class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label style="width: 100%;">Tanggal Keluar</label>				
                                <input type="date" style="width:100%" name="pegawai_tgl_keluar" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> E-Mail (Kantor)</label>		
						<input type="text" style="width:100%" name="pegawai_email_kantor" required class="form-control">
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> N.P.W.P.</label>		
						<input type="text" style="width:100%" name="pegawai_npwp" required class="form-control">
					</div>

					<!-- <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Status Pegawai</label>	
                        <select style="width:100%" name="pegawai_status" required class="form-control">
                            <option value="">--Pilih Status--</option>
                            <option value="1">Tetap</option>
                            <option value="2">Kontrak</option>
                            <option value="3">Magang</option>
                            <option value="4">Outsource</option>
                        </select>	
					</div>

                    <div class="form-group" style="width:100%">
						<label style="width: 100%;"> Posisi</label>		
						<input type="text" style="width:100%" name="pegawai_posisi" required class="form-control">
					</div>

					<div class="form-group" style="width:100%">
						<label style="width: 100%;">Divisi</label>				
						<select class="form-control" name="pegawai_divisi" id="pegawai_divisi" required style="width: 100%;">
							<option value="">--Pilih Divisi--</option>
							<?php 
								// $div = $this->db->query("select * from divisi")->result();
								// foreach ($div as $d) {
							?>
							<option value="<?php //echo $d->divisi_id ?>"><?php //echo $d->divisi_nama ?></option>
							<?php
								//}
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
						<label style="width: 100%;"> Level</label>	
                        <select style="width:100%" name="pegawai_level" required class="form-control">
                            <option value="">--Pilih Level--</option>
                            <option value="1">Staff</option>
                            <option value="2">Junior Staff</option>
                            <option value="3">Senior Stafd</option>
                            <option value="4">Junior Officer</option>
                            <option value="4">Senior Officer</option>
                            <option value="4">Assistent Manager</option>
                            <option value="4">Manager</option>
                        </select>	
					</div> -->

					<div class="form-group" style="width:100%">
						<label style="width: 100%;">Pas Photo</label>				
						<input accept="image/*" type="file" style="width:100%" id="inputPic" name="foto" onchange="loadFile(event)">
                        <img style="max-width: 200px; display: block; margin-top: 10px; position: relative; z-index: 10;" id="profilePic"/>
                        <button onclick="changePicPreview()" type="button" title="Hapus Foto" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
					</div>
									
					<br>
					<br>
				</form>
			</div>	
            <div class="modal-footer">
                <input type="submit" form="addPegawai" value="Simpan" class="btn btn-primary">
            </div>										
		</div>
	</div>
</div>