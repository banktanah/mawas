<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Akses Group
			<small>Hak Akses Group</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User Group</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addKategori"><i class="fa fa-plus"></i>  &nbsp Tambah</button>
							<a href="<?php echo base_url('apps') ?>" type="button" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> &nbsp Kembali</a>
						</div>

						<?php
							$this->load->view('template/v_alert');
						?>
					</div>

					<div class="box-body">
						<table class="table table-bordered" id="table-datatable">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Group Name</th>
									<th>Description</th>
									<th width="5%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no = 1;
									foreach($groups as $p){								
								?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $p->name ?></td>
											<td><?php echo $p->description; ?></td>
											<td>
												<!-- <button title="Edit Data" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData<?php //echo $p->apps_id ?>"><i class="fa fa-pencil"></i> </button> -->
												<button title="Hapus" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $p->user_group_id ?>"><i class="fa fa-trash"></i>Hapus</button>	
												<button title="Akses" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_akses" onclick="addAccessData('<?php echo $p->user_group_id ?>')"><i class="fa fa-people"></i>Akses</button>
												
												<!-- Hapus data user -->
												<div id="hapusData<?php echo $p->user_group_id ?>" class="modal fade" role="dialog">
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
																<a href="<?php echo base_url().'akses/akses_hapus?akses_id='.$p->user_group_id.'&apps_id='.$p->user_group_id; ?>" class="btn btn-primary">Hapus</a>
															</div>
														</div>
													</div>
												</div>
											</td>
										</tr>
								<?php 
									} 
								?>
							</tbody>
						</table>
						

					</div>
				</div>

			</div>
		</div>

		<!-- Modals -->
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
		
		<script>
			function addAccessData(usergroup_id){
				let group_matrix_str = '<?php echo json_encode($groups)?>';
				let group_matrix = group_matrix_str? JSON.parse(group_matrix_str): [];

				let group = group_matrix.find(a => a.user_group_id == usergroup_id);
				// console.log(group);
				let datas = group? group.access: [];
				// console.log(datas);

				$('#modal_akses').find('#modal-title-group').html(group.name);
				$('#modal_akses').find('[name="group_id"]').html(group.user_group_id);

				let no = 1;
				let content = '';
				datas.forEach(a => {
					content += `
						<tr>
							<td>${no++}</td>
							<td>${a.apps_nama}</td>
							<td>${a.role}</td>
							<td>
								<form action="<?php echo base_url('akses/group_delete') ?>" method="post">
									<input type="hidden" name="apps_id" value="${a.apps_id}" />
									<input type="hidden" name="role" value="${a.role}" />
									<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Hapus</button>	
								</form>
							</td>
						</tr>
					`;
				});

				$(`#tbody_access`).html(content);
			}

			function toggleCustomRole(){
				$('#role-form').toggle('slow');
				$('#custom-role-form').toggle('slow');
			}

			function deleteRole(apps_id, role){

			}
		</script>
		<div id="modal_akses" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title"> Tambah Akses <span id="modal-title-group"></span></h4></center>
					</div>
					<div class="modal-body">
						
						<table class="table table-bordered" id="table-datatable">
							<thead>
								<tr>
									<th>No</th>
									<th>Aplikasi</th>
									<th>Role</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tbody_access">
							</tbody>
						</table>

						<form action="<?php echo base_url('akses/group_add') ?>" method="post" enctype="multipart/form-data">											

							<div class="form-group" style="width:100%">
								<label style="width: 100%;"> Aplikasi</label>	
								<input type="hidden" name="user_group_id" value="">
								<select class="form-control" name="apps_id" required style="width: 100%;">
									<option value="">--Pilih Aplikasi--</option>
									<?php 
										foreach($apps as $app) {
									?>
											<option value="<?= $app->apps_id ?>"><?= $app->apps_nama ?></option>
									<?php
										}
									?>													
								</select>
							</div>
							<div id="role-form" class="form-group" style="width:100%">
								<label style="width: 100%;"> Role</label>	
								<select class="form-control" name="role" style="width: 100%;">
									<option value="">--Pilih Role--</option>
									<?php 
										foreach($roles as $r) {
									?>
											<option value="<?= $r->role ?>"><?= $r->role ?></option>
									<?php
										}
									?>													
								</select>
							</div>
							<div class="form-group" style="width:100%">
								<label style="width: 100%;"> Custom Role <input type="checkbox" onchange="toggleCustomRole()"/></label>
							</div>
							<div id="custom-role-form" class="form-group" style="width:100%; display:none;">
								<label style="width: 100%;"> Custom Role Name</label>
								<input type="text" name="role_custom" class="form-control" />
							</div>
						
							<br>
							<input type="submit" value="Simpan" class="btn btn-primary">
						</form>
					</div>											
				</div>
			</div>
		</div>
	</section>

</div>