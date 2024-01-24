<!-- Kepegawaian -->
<div id="editKarier<?php echo $karier->karir_id ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="hideKarirModal(<?php echo $karier->karir_id ?>)">&times;</button>
				<center><h4 class="modal-title"> Edit Karier Pegawai</h4></center>
			</div>
			<div class="modal-body" style="height: 350px; overflow-y: scroll;">
				<form id="updateKarier<?php echo $karier->karir_id ?>" action="<?php echo base_url('karier/karier_edit/'.$karier->karir_id) ?>" method="post" enctype="multipart/form-data">
				    
                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Nama Lengkap</label>		
						<input type="text" value="<?php echo $pegawai->pegawai_nama; ?>" style="width:100%" name="pegawai_nama" disabled class="form-control">
                        <input type="hidden" value="<?php echo $pegawai->pegawai_id; ?>" style="width:100%" name="pegawai_id" disabled class="form-control">
					</div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Status Pegawai</label>		
                        <select class="form-control" name="status_pegawai_id" required style="width: 100%;">
							<option value="">--Pilih Status--</option>
							<?php 
								$status = $this->db->query("SELECT * FROM master_pegawai_status")->result();
								foreach ($status as $st) {
							?>
							<option value="<?php echo $st->status_pegawai_id ?>" <?php if($st->status_pegawai_id == $karier->status_pegawai_id){echo 'selected';} ?> ><?php echo $st->status_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Posisi</label>		
						<input type="text" style="width:100%" value="<?php echo $karier->posisi_pegawai;?>" name="posisi_pegawai" required class="form-control">
					</div>

                    <div class="form-group" style="width:100%; margin-bottom:10px;">
						<label style="width: 100%;"> Penempatan/Proyek</label>		
						<select name="lokasi" id="lokasiE<?php echo $karier->karir_id; ?>" required class="form-control" style="width:100%">
							<option value="">--Pilih Lokasi--</option>
                            <option value="9999" <?php if($karier->perolehan_id == "9999"){echo "selected";} ?>>JAKARTA | Kantor Pusat</option>
							<?php
							foreach ($perolehans as $perolehan) {
							?>
							<option value="<?=$perolehan->perolehan_id?>" <?php if($karier->perolehan_id == $perolehan->perolehan_id){echo "selected";} ?>><?=$perolehan->kota_nama?> | <?=$perolehan->kelurahan?></option>
							<?php
							}
							?>
						</select>
					</div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label style="width: 100%;"> Atasan Langsung</label>		
                                <select class="form-control" name="pegawai_atasan_langsung" id="atasanLangsungE<?php echo $karier->karir_id ?>" style="width: 100%;">
                                    <option value="">--Pilih Atasan--</option>
                                    <?php 
                                        $atasan = $this->db->query("SELECT * FROM pegawai WHERE is_active = 1 ORDER BY pegawai_nama")->result();
                                        foreach ($atasan as $al) {
                                    ?>
                                    <option value="<?php echo $al->pegawai_id ?>" <?php if($al->pegawai_id == $karier->pegawai_atasan_langsung){echo 'selected';} ?> ><?php echo $al->pegawai_nama; ?></option>
                                    <?php
                                        }
                                    ?>													
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label style="width: 100%;">Atasan dari Atasan Langsung</label>		
                                <select class="form-control" name="pegawai_atasan_atasan" id="atasanAtasanE<?php echo $karier->karir_id ?>" style="width: 100%;">
                                    <option value="">--Pilih Atasan--</option>
                                    <?php 
                                        foreach ($atasan as $aa) {
                                    ?>
                                    <option value="<?php echo $aa->pegawai_id ?>" <?php if($aa->pegawai_id == $karier->pegawai_atasan_atasan){echo 'selected';} ?>><?php echo $aa->pegawai_nama; ?></option>
                                    <?php
                                        }
                                    ?>													
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Divisi</label>		
                        <select class="form-control" name="divisi_id" id="karierDivisiE<?php echo $karier->karir_id ?>" onchange="changeDivisiBagianE(<?=$karier->karir_id;?>)" style="width: 100%;">
							<option value="">--Pilih Divisi--</option>
							<?php 
								$divisi = $this->db->query("SELECT * FROM divisi ORDER BY divisi_nama")->result();
								foreach ($divisi as $dv) {
							?>
							<option value="<?php echo $dv->divisi_id ?>" <?php if($dv->divisi_id == $karier->divisi_id){echo 'selected';} ?>><?php echo $dv->divisi_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Divisi Bagian</label>		
                        <select class="form-control" name="divisi_bagian_id" id="karierDivisiBagianE<?php echo $karier->karir_id ?>" style="width: 100%;">
							<option value="">--Pilih Divisi Bagian--</option>		
                            <?php 
                                $id_div = $karier->divisi_id;
								$div_bag = $this->db->query("SELECT * FROM divisi_bagian WHERE divisi_id = '$karier->divisi_id' ORDER BY divisi_bagian_nama")->result();
								foreach ($div_bag as $dvb) {
							?>
							<option value="<?php echo $dvb->divisi_bagian_id ?>" <?php if($dvb->divisi_bagian_id == $karier->divisi_bagian_id){echo 'selected';} ?>><?php echo $dvb->divisi_bagian_nama; ?></option>
                            <?php
                                }
                            ?>											
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
						<label style="width: 100%;"> Jabatan</label>		
                        <select class="form-control" name="jabatan_id" id="jabatanE<?php echo $karier->karir_id ?>" onchange="changeJabatanE(<?=$karier->karir_id;?>)" style="width: 100%;">
							<option value="">--Pilih Jabatan--</option>
							<?php 
								$jabatan = $this->db->query("SELECT * FROM master_jabatan ORDER BY jabatan_level")->result();
								foreach ($jabatan as $jb) {
							?>
							<option value="<?php echo $jb->jabatan_id ?>" <?php if($jb->jabatan_id == $karier->jabatan_id){echo 'selected';} ?>><?php echo $jb->jabatan_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" id="deputiE<?php echo $karier->karir_id ?>" style="width:100%; margin-bottom: 15px;display:none;">
						<label style="width: 100%;"> Deputi</label>		
                        <select class="form-control" name="deputi_id" id="deputiInputE<?php echo $karier->karir_id ?>" style="width: 100%;">
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
							<option value="<?php echo $lv->level_id ?>" <?php if($lv->level_id == $karier->level_id){echo 'selected';} ?>><?php echo $lv->level_nama; ?></option>
                            <?php
                                }
                            ?>													
						</select>
                    </div>

                    <div class="form-group" style="width:100%; margin-bottom: 15px;">
                        <div class="row">
                            <?php
                                $tglMulaiE = date("Y-m-d", strtotime($karier->tgl_awal));

                                if (!empty($karier->tgl_akhir)) {
                                    $tglKeluarE = date("Y-m-d", strtotime($karier->tgl_akhir));
                                }else {
                                    $tglKeluarE = "";
                                }          
                            ?>
                            <div class="col-sm-6">
                                <label style="width: 100%;">Tanggal Mulai</label>				
                                <input type="date" value="<?=$tglMulaiE;?>" style="width:100%" name="tgl_awal" required class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label style="width: 100%;">Tanggal Berakhir</label>				
                                <input type="date" <?php if(!empty($karier->tgl_akhir)){echo 'value="'.$tglKeluarE.'"';} ?> style="width:100%" name="tgl_akhir" class="form-control">
                            </div>
                        </div>
                    </div>
									
					<br>
					<br>
				</form>
			</div>	
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hideKarirModal(<?php echo $karier->karir_id ?>)">Batal</button>
                <input type="submit" form="updateKarier<?php echo $karier->karir_id ?>" value="Simpan" class="btn btn-primary">
            </div>										
		</div>		
	</div>
</div>