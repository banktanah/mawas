<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Akses
			<small>Hak Akses Aplikasi</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Akses Aplikasi <?= $nama_apps; ?></h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addKategori"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
							<a href="<?php echo base_url('apps') ?>" type="button" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> &nbsp Kembali</a>
						</div>

						<?php
							$this->load->view('template/v_alert');
						?>

						<div id="addKategori" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<center><h4 class="modal-title"> Tambah Akses <?= $nama_apps; ?></h4></center>
									</div>
									<div class="modal-body">

										<form action="<?php echo base_url('akses/akses_act') ?>" method="post" enctype="multipart/form-data">											

                                            <div class="form-group" style="width:100%">
                                                <label style="width: 100%;"> Nama User</label>	
                                                <input type="hidden" name="apps_id" value="<?= $apps_id; ?>">
                                                <select id="namaUser" class="form-control" name="user_id" required style="width: 100%;">
                                                    <option value="">--Pilih Akun User--</option>
                                                    <?php 
                                                        $peg = $this->db->query("select * from user")->result();
                                                        foreach ($peg as $pg) {
                                                    ?>
                                                    <option value="<?= $pg->user_id ?>"><?= $pg->user_nama.' | '.$pg->user_username ?></option>
                                                    <?php
                                                        }
                                                    ?>													
                                                </select>
                                            </div>
											<div class="form-group" style="width:100%">
                                                <label style="width: 100%;"> Role User</label>	
                                                <select class="form-control" name="role_nama" required style="width: 100%;">
                                                    <option value="">--Pilih Role User--</option>
                                                    <?php 
                                                        $role = $this->db->query("select * from user_role")->result();
                                                        foreach ($role as $r) {
                                                    ?>
                                                    <option value="<?= $r->role_nama ?>"><?= $r->role_nama ?></option>
                                                    <?php
                                                        }
                                                    ?>													
                                                </select>
                                            </div>
										
											<br>
											<input type="submit" value="Simpan" class="btn btn-primary">
										</form>
									</div>											
								</div>
							</div>
						</div>		
					</div>

					<div class="box-body">
						<table class="table table-bordered" id="table-datatable">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>User</th>
									<th>Role</th>
									<th width="5%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($akses as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td>
                                            <?php 
                                                $user = $this->db->query("SELECT * FROM user WHERE user_id = '$p->user_id'")->row();
                                                echo $user->user_nama.' - '.$user->user_username;
                                            ?>
                                        </td>
										<td>
                                            <?php 
                                                echo $p->akses_role; 
                                            ?>
                                        </td>
										<td>
<!-- 											
											<button title="Edit Data" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData<?php //echo $p->apps_id ?>"><i class="fa fa-pencil"></i> </button> -->
											<button title="Hapus" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->akses_id ?>"><i class="fa fa-trash"></i> </button>	


											<!-- edit data user -->
											<!-- <div id="editData<?php //echo $p->apps_id ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<center><h4 class="modal-title"> Edit Data Aplikasi</h4></center>
														</div>
														<div class="modal-body">

															<form action="<?php //echo base_url('dashboard/apps_update') ?>" method="post" enctype="multipart/form-data">
																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Nama Aplikasi</label>	
																	<input type="hidden" name="id" value="<?php //echo $p->apps_id ?>">	
																	<input type="text" name="nama_apps" value="<?php //echo $p->apps_nama ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Url Aplikasi</label>	
																	<input type="text" name="url_apps" value="<?php //echo $p->apps_url ?>" required class="form-control" style="width:100%">
																</div>

																<div class="form-group" style="width:100%">
																	<label style="width: 100%;"> Deskripsi</label>		
																	<textarea style="width:100%" name="desc_apps" rows="4" class="form-control"><?php //echo $p->apps_desc; ?></textarea>
																</div>
																
																<br>
																<br>
																<input type="submit" value="Simpan" class="btn btn-primary">
															</form>
														</div>											
													</div>
												</div>
											</div>	 -->


											<!-- Hapus data user -->
											<div id="hapusData<?php echo $p->akses_id ?>" class="modal fade" role="dialog">
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
															<a href="<?php echo base_url().'akses/akses_hapus?akses_id='.$p->akses_id.'&apps_id='.$p->apps_id; ?>" class="btn btn-primary">Hapus</a>
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