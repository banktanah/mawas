<!-- Kepegawaian -->
<div id="addKarier<?php echo $pegawai->pegawai_id ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<center><h4 class="modal-title"> Update Karier Pegawai</h4></center>
			</div>
			<div class="modal-body" style="height: 420px; overflow-y: scroll;">
				<form id="newKarier<?php echo $pegawai->pegawai_id ?>" action="<?php echo base_url('karier/karier_act') ?>" method="post" enctype="multipart/form-data">
				    
                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Nama Lengkap</label>		
						<input type="text" value="<?php echo $pegawai->pegawai_nama; ?>" style="width:100%" name="pegawai_nama" disabled class="form-control">
                        <input type="hidden" value="<?php echo $pegawai->pegawai_id; ?>" style="width:100%" name="pegawai_id" class="form-control">
					</div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Status Pegawai</label>		
                        <select class="form-control" name="status_pegawai_id" required style="width: 100%;">
							<option value="">--Pilih Status--</option>
							<?php 
								$status = $this->db->query("SELECT * FROM master_pegawai_status")->result();
								foreach ($status as $st) {
							?>
							<option value="<?php echo $st->status_pegawai_id ?>"><?php echo $st->status_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Posisi</label>		
						<input type="text" style="width:100%" name="posisi_pegawai" required class="form-control">
					</div>

                    <div class="form-group" style="width:100%; margin-bottom:10px;">
						<label style="width: 100%;"> Penempatan/Proyek</label>		
						<select name="lokasi" id="lokasi<?php echo $pegawai->pegawai_id; ?>" required class="form-control" style="width:100%">
							<option value="">--Pilih Lokasi--</option>
                            <option value="9999">JAKARTA | Kantor Pusat</option>
							<?php
							foreach ($perolehans as $perolehan) {
							?>
							<option value="<?=$perolehan->perolehan_id?>"><?=$perolehan->kota_nama?> | <?=$perolehan->kelurahan?></option>
							<?php
							}
							?>
						</select>
					</div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label style="width: 100%;"> Atasan Langsung</label>		
                                <select class="form-control" name="pegawai_atasan_langsung" id="atasanLangsung<?php echo $pegawai->pegawai_id ?>" style="width: 100%;">
                                    <option value="">--Pilih Atasan--</option>
                                    <?php 
                                        $atasan = $this->db->query("SELECT * FROM pegawai WHERE is_active = 1 ORDER BY pegawai_nama")->result();
                                        foreach ($atasan as $al) {
                                    ?>
                                    <option value="<?php echo $al->pegawai_id ?>"><?php echo $al->pegawai_nama; ?></option>
                                    <?php
                                        }
                                    ?>													
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label style="width: 100%;">Atasan dari Atasan Langsung</label>		
                                <select class="form-control" name="pegawai_atasan_atasan" id="atasanAtasan<?php echo $pegawai->pegawai_id ?>" style="width: 100%;">
                                    <option value="">--Pilih Atasan--</option>
                                    <?php 
                                        foreach ($atasan as $aa) {
                                    ?>
                                    <option value="<?php echo $aa->pegawai_id ?>"><?php echo $aa->pegawai_nama; ?></option>
                                    <?php
                                        }
                                    ?>													
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Divisi</label>		
                        <select class="form-control" name="divisi_id" id="karierDivisi<?php echo $pegawai->pegawai_id ?>" onchange="changeDivisiBagian(<?=$pegawai->pegawai_id;?>)" style="width: 100%;">
							<option value="">--Pilih Divisi--</option>
							<?php 
								$divisi = $this->db->query("SELECT * FROM divisi ORDER BY divisi_nama")->result();
								foreach ($divisi as $dv) {
							?>
							<option value="<?php echo $dv->divisi_id ?>"><?php echo $dv->divisi_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Divisi Bagian</label>		
                        <select class="form-control" name="divisi_bagian_id" id="karierDivisiBagian<?php echo $pegawai->pegawai_id ?>" style="width: 100%;">
							<option value="">--Pilih Divisi Bagian--</option>												
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Jabatan</label>		
                        <select class="form-control" name="jabatan_id" id="jabatan<?php echo $pegawai->pegawai_id ?>" onchange="changeJabatan(<?=$pegawai->pegawai_id;?>)" style="width: 100%;">
							<option value="">--Pilih Jabatan--</option>
							<?php 
								$jabatan = $this->db->query("SELECT * FROM master_jabatan ORDER BY jabatan_level")->result();
								foreach ($jabatan as $jb) {
							?>
							<option value="<?php echo $jb->jabatan_id ?>"><?php echo $jb->jabatan_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" id="deputi<?php echo $pegawai->pegawai_id ?>" style="width:100%; margin-bottom: 15px;display:none;">
						<label style="width: 100%;"> Deputi</label>		
                        <select class="form-control" name="deputi_id" id="deputiInput<?php echo $pegawai->pegawai_id ?>" style="width: 100%;">
							<option value="">--Pilih Deputi--</option>
							<?php 
								$deputi = $this->db->query("SELECT * FROM deputi ORDER BY deputi_nama")->result();
								foreach ($deputi as $dp) {
							?>
							<option value="<?php echo $dp->deputi_id ?>"><?php echo $dp->deputi_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Level</label>		
                        <select class="form-control" name="level_id" style="width: 100%;">
							<option value="">--Pilih Level--</option>
							<?php 
								$level = $this->db->query("SELECT * FROM master_pegawai_level ORDER BY level")->result();
								foreach ($level as $lv) {
							?>
							<option value="<?php echo $lv->level_id ?>"><?php echo $lv->level_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label style="width: 100%;">Tanggal Mulai</label>				
                                <input type="date" style="width:100%" name="tgl_awal" required class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label style="width: 100%;">Tanggal Berakhir</label>				
                                <input type="date" style="width:100%" name="tgl_akhir" class="form-control">
                            </div>
                        </div>
                    </div>
									
					<br>
					<br>
				</form>
			</div>	
            <div class="modal-footer">
                <input type="submit" form="newKarier<?php echo $pegawai->pegawai_id ?>" value="Simpan" class="btn btn-primary">
            </div>										
		</div>		
	</div>
</div>