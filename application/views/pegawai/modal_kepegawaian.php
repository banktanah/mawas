<!-- Kepegawaian -->
<div id="kepegawaian<?php echo $pegawai->pegawai_id ?>" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 1080px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<center><h4 class="modal-title"> Data Kepegawaian</h4></center>
			</div>
			<div class="modal-body" style="height: 420px; overflow: auto;">
                <div>
                    <table border="0" width="100%">
                        <tr>
                            <th rowspan="3" style="width: 115px;">
                                <img style="width: 100px; border: 3px solid grey;" src="<?= $pegawai->pegawai_foto?>" alt="pas_photo">
                            </th>
                            <th>
                                <h4><?= $pegawai->pegawai_nama;?></h4>
                            </th>
                        </tr>
                        <tr>
                            <th><small><?= $pegawai->pegawai_nip;?></small></th>
                        </tr>
                        <tr>
                            <th><p><?= $pegawai->pegawai_email_kantor;?></p></th>
                        </tr>
                    </table>
                </div>
                <br>
                <br>
                <div>
                    <?php
                        $karier = $this->db->select('t1.*, t2.*, t3.*, t4.*, t5.*, t6.*, t7.*, t8.pegawai_nama as atasan_langsung, t9.pegawai_nama as atasan_atasan')
                                ->from('pegawai_karir as t1')
                                ->where('t1.pegawai_id', $pegawai->pegawai_id)
                                ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                                ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                                ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                                ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                                ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                                ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                                ->join('pegawai as t8', 't1.pegawai_atasan_langsung = t8.pegawai_id', 'LEFT')
                                ->join('pegawai as t9', 't1.pegawai_atasan_atasan = t9.pegawai_id', 'LEFT')
                                ->order_by("tgl_awal", "DESC")
                                ->get()
                                ->result();
                    ?>
                    <table class="table table-bordered table-hover">
                        <?php
                            foreach ($karier as $k) {
                            
                                $tgl_awal = date("d-m-Y", strtotime($k->tgl_awal));
                            
                                if (!empty($k->tgl_akhir)) {
                                    $tgl_akhir = date("d-m-Y", strtotime($k->tgl_akhir));
                                    $tgl_berakhir = date("Y-m-d", strtotime($k->tgl_akhir));
                                }else {
                                    $tgl_akhir = "Sekarang";
                                    $tgl_berakhir = NULL;
                                }
                            
                        ?>
                        <tr style="background: #eaeaea;">
                            <th>
                                PERIODE
                            </th>
                            <th>
                                <?=$tgl_awal?> s/d <?=$tgl_akhir?>
                            </th>
                            <th>
                                <div style="width: 5px"></div>
                            </th>
                            <th>PENEMPATAN</th>
                            <th><?=$k->penempatan;?></th>
                            <th>
                                <div style="width: 5px"></div>
                            </th>
                            <th colspan="2">
                                <button type="button" title="Edit Data" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editKarier<?php echo $k->karir_id ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-pencil"></i> </button>
								<button type="button" title="Nonaktifkan Jabatan" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#disableData<?php echo $k->karir_id ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-ban"></i> </button>
                                <button type="button" title="Hapus" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $k->karir_id ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i> </button>

                                <?php
                                    $data['pegawai'] = $pegawai;
									$data['karier'] = $k;
									$this->load->view('pegawai/modal_karier_edit', $data);
								?>

                                <!-- Nonaktif data pegawai -->
								<div id="disableData<?php echo $k->karir_id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
                                                <button type="button" class="close" onclick="hideOffKarir(<?php echo $k->karir_id ?>)">&times;</button>
												<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
											</div>
											<div class="modal-body">
												<div style="margin-bottom:15px;">
                                                    <p>Yakin ingin menonaktifkan data ini ?</p>
                                                    <i>Data akan tersimpan di dalam riwayat karier.</i>
                                                </div>
                                                <br>
                                                <div>
                                                    <label style="width: 100%;">Tanggal Akhir Jabatan</label>				
                                                    <input type="date" <?php if(!empty($k->tgl_akhir)){echo 'value="'.$tgl_berakhir.'"';}?>  style="width:100%" name="tgl_akhir" class="form-control">
                                                </div>
											</div>
                                            <br>
                                            <br>
											<div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" onclick="hideOffKarir(<?php echo $k->karir_id ?>)">Batal</button>
												<a href="<?php echo base_url().'karier/karier_nonaktif/'.$k->karir_id; ?>" class="btn btn-primary">Nonaktifkan</a>
											</div>
										</div>
									</div>
								</div>

                                <!-- Hapus data pegawai -->
								<div id="hapusData<?php echo $k->karir_id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
                                                <button type="button" class="close" onclick="hideDelKarir(<?php echo $k->karir_id ?>)">&times;</button>
												<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
											</div>
											<div class="modal-body">
												<p>Yakin ingin menghapus data ini ?</p>
                                                <i>Data yang dihapus tidak akan tersimpan dalam riwayat karier.</i>
											</div>
											<div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" onclick="hideDelKarir(<?php echo $k->karir_id ?>)">Batal</button>
												<a href="<?php echo base_url().'karier/karier_hapus/'.$k->karir_id; ?>" class="btn btn-primary">Hapus</a>
											</div>
										</div>
									</div>
								</div>

                            </th>
                        </tr>
                        <tr>
                            <td>
                                <strong>POSISI</strong>
                            </td>
                            <td>
                                <?= $k->posisi_pegawai?>
                            </td>
                            <td><div style="width: 5px"></div></td>
                            <td>
                                <strong>DIVISI</strong>
                            </td>
                            <td>
                                <?php
                                    if (empty($k->divisi_nama)) {
                                        echo "-";
                                    }else {
                                        echo $k->divisi_nama;
                                    }
                                ?>
                            </td>
                            <td><div style="width: 5px"></td>
                            <td>
                                <strong>ATASAN LANGSUNG</strong>
                            </td>
                            <td style="width: 135px">
                                <?php 
                                    if (empty($k->pegawai_atasan_langsung)) {
                                        echo "-";
                                    }else {
                                        echo $k->atasan_langsung;   
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>LEVEL</strong>
                            </td>
                            <td>
                                <?php
                                    if (empty($k->level_id)) {
                                        echo "-";
                                    }else {
                                        echo $k->level_nama;   
                                    }
                                ?>
                            </td>
                            <td><div style="width: 5px"></div></td>
                            <td>
                                <strong>BAGIAN</strong>
                            </td>
                            <td>
                                <?php
                                    if (empty($k->divisi_bagian_nama)) {
                                        echo "-";
                                    }else {
                                        echo $k->divisi_bagian_nama;
                                    }
                                ?>
                            </td>
                            <td><div style="width: 5px"></td>
                            <td rowspan="2">
                                <strong>ATASAN DARI ATASAN LANGSUNG</strong>
                            </td>
                            <td rowspan="2">
                                <?php 
                                    if (empty($k->pegawai_atasan_atasan)) {
                                        echo "-";
                                    }else {
                                        echo $k->atasan_atasan;
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>STATUS</strong>
                            </td>
                            <td>
                                <?= $k->status_nama?>
                            </td>
                            <td><div style="width: 5px"></div></td>
                            <td>
                                <strong>JABATAN</strong>
                            </td>
                            <td>
                                <?= $k->jabatan_nama?>
                            </td>
                            <td><div style="width: 5px"></td>
                        </tr>
                        <tr>
                            <td colspan="8"><hr></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
			</div>	
		    <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 135px; height: 35px;"><i class="fa fa-close"></i> Tutup</button>
                    <button type="button" title="Tambah Karier" class="btn btn-success" onclick="openAddKarir(<?php echo $pegawai->pegawai_id ?>)"><i class="fa fa-briefcase"></i> Tambah Karier</button>
                    <a href="<?php echo base_url('karier/karier_riwayat/'.$pegawai->pegawai_id);?>" type="button" class="btn btn-primary" style="width: 135px; height: 35px;"><i class="fa fa-history"></i> Riwayat Karier</a>
                </div>
            </div>										
		</div>
	</div>
</div>