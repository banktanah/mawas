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
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add_group"><i class="fa fa-plus"></i> &nbsp Tambah</button>
							<a href="<?php echo base_url('apps') ?>" type="button" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> &nbsp Kembali</a>
						</div>

						<?php
							$this->load->view('template/v_alert');
						?>
					</div>

					<div class="box-body">
						<table class="table table-bordered datatable-init">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th width="40%">Group Name</th>
									<!-- <th>Description</th> -->
									<th>OPSI</th>
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
											<!-- <td><?php //echo $p->description; ?></td> -->
											<td>
												<button title="Akses" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_akses" onclick="modalAccess('<?php echo $p->user_group_id ?>')" style="min-width: 70px; margin-bottom: 5px;">
													<i class="fa fa-people"></i>&nbsp;Akses
												</button>
												<button title="User" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_user" onclick="modalUser('<?php echo $p->user_group_id ?>')" style="min-width: 70px; margin-bottom: 5px;">
													<i class="fa fa-people"></i>&nbsp;User
												</button>
												<button title="Hapus" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete_group" onclick="modalDeleteGroup('<?php echo $p->user_group_id ?>')" style="min-width: 70px; margin-bottom: 5px;">
													<i class="fa fa-trash"></i>&nbsp;Hapus
												</button>
												<!-- <button title="Hapus" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData_<?php echo $p->user_group_id ?>" style="min-width: 70px; margin-bottom: 5px;">
													<i class="fa fa-trash"></i>&nbsp;Hapus
												</button> -->
												
												<!-- <div id="hapusData_<?php echo $p->user_group_id ?>" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
																<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
															</div>
															<div class="modal-body">
																<p>Yakin ingin hapus user-group <?php echo "\"$p->name\"" ?> ?</p>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
																<a href="<?php echo base_url().'akses/user_group_delete?user_group_id='.$p->user_group_id ?>" class="btn btn-primary">Hapus</a>
															</div>
														</div>
													</div>
												</div> -->
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
		<div id="modal_add_group" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title"> Tambah Group</h4></center>
					</div>
					<div class="modal-body">

						<form action="<?php echo base_url('akses/user_group_add') ?>" method="post" enctype="multipart/form-data">											

							<div class="form-group" style="width:100%">
								<label style="width: 100%;"> Nama Group</label>	
								<input type="text" name="group_name" value="" style="width: 100%;">
							</div>
						
							<br>
							<input type="submit" value="Tambah Group" class="btn btn-primary">
						</form>
					</div>											
				</div>
			</div>
		</div>

		<div id="modal_delete_group" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h5 class="modal-title">modal-title</h5>
					</div>
					<div class="modal-body">
						<p>modal-body</p>
					</div>
					<div class="modal-footer">
						<table>
							<tr>
								<td style="padding-right: 2vw">
									<form action="<?php echo base_url('akses/user_group_delete') ?>" method="get" enctype="multipart/form-data">											
										<input type="hidden" name="user_group_id" value="">
										<input type="submit" value="Hapus" class="btn btn-danger">
									</form>
								</td>
								<td>
									<button	button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
								</td>
							</tr>
						</table>
						
						<!-- <a href="<?php echo base_url().'akses/user_group_delete?user_group_id='.$p->user_group_id ?>" class="btn btn-primary">Hapus</a> -->
					</div>
				</div>
			</div>
		</div>

		<div id="modal_akses" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title"> List Akses Aplikasi untuk Group <span id="modal-title-group"></span></h4></center>
					</div>
					<div class="modal-body">
						
						<table class="table table-bordered datatable-init">
							<thead>
								<tr>
									<th>No</th>
									<th>Aplikasi</th>
									<th>Role</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="table-body">
							</tbody>
						</table>

						<form action="<?php echo base_url('akses/group_add') ?>" method="post" enctype="multipart/form-data">											
							<div class="form-group" style="width:100%">
								<label style="width: 100%;"> Aplikasi</label>	
								<input type="hidden" name="user_group_id" value=""/>
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
								<label style="width: 100%;"> Custom Role <input type="checkbox" name="is_custom_role" onchange="toggleCustomRole()"/></label>
							</div>
							<div id="custom-role-form" class="form-group" style="width:100%; display:none;">
								<label style="width: 100%;"> Custom Role Name</label>
								<input type="text" name="role_custom" class="form-control" />
							</div>
						
							<br>
							<input type="submit" value="Tambah Akses" class="btn btn-primary">
						</form>
					</div>											
				</div>
			</div>
		</div>

		<div id="modal_user" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title"> List User didalam Group <span id="modal-title-group"></span></h4></center>
					</div>
					<div class="modal-body">
						
						<table class="table table-bordered datatable-init">
							<thead>
								<tr>
									<th>No</th>
									<th>NIP</th>
									<th>Nama</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tbody_access">
							</tbody>
						</table>

						<form action="<?php echo base_url('akses/group_add_user') ?>" method="post" enctype="multipart/form-data">											
							<div class="form-group" style="width:100%">
								<label style="width: 100%;"> User List</label>	
								<input type="hidden" name="user_group_id" value=""/>
								<select class="form-control" name="user_id" required style="width: 100%;">
									<option value="">--Pilih User--</option>
									<?php 
										foreach($users as $u) {
									?>
											<option value="<?= $u->user_id ?>"><?= "$u->user_nama ($u->nip)" ?></option>
									<?php
										}
									?>													
								</select>
							</div>
						
							<br>
							<input type="submit" value="Tambah User" class="btn btn-primary">
						</form>
					</div>											
				</div>
			</div>
		</div>
		
		<script>
			function modalDeleteGroup(usergroup_id){
				let group_matrix_str = '<?php echo json_encode($groups)?>';
				let group_matrix = group_matrix_str? JSON.parse(group_matrix_str): [];

				let group = group_matrix.find(a => a.user_group_id == usergroup_id);
				console.log(group);

				$('#modal_delete_group').find('.modal-title').html(`Hapus Group`);
				$('#modal_delete_group').find('.modal-body').children().first().html(`Hapus Group ${group.name}`);
				
				$('#modal_delete_group').find('[name="user_group_id"]').val(group.user_group_id);
			}

			function modalAccess(usergroup_id){
				let group_matrix_str = '<?php echo json_encode($groups)?>';
				let group_matrix = group_matrix_str? JSON.parse(group_matrix_str): [];

				let group = group_matrix.find(a => a.user_group_id == usergroup_id);
				// console.log(group);
				let datas = group? group.access: [];
				// console.log(datas);

				$('#modal_akses').find('#modal-title-group').html(group.name);
				$('#modal_akses').find('[name="user_group_id"]').val(group.user_group_id);

				let no = 1;
				let content = '';
				datas.forEach(a => {
					let confirmDeleteMsg = `Yakin hapus role ${a.role}, pada aplikasi ${a.apps_nama} ?`;

					content += `
						<tr>
							<td>${no++}</td>
							<td>${a.apps_nama}</td>
							<td>${a.role}</td>
							<td>
								<form action="<?php echo base_url('akses/group_delete') ?>" method="post" onsubmit="return confirm('${confirmDeleteMsg}');">
									<input type="hidden" name="apps_id" value="${a.apps_id}" />
									<input type="hidden" name="role" value="${a.role}" />
									<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>	
								</form>
							</td>
						</tr>
					`;
				});

				$(`.table-body`).html(content);
			}

			function modalUser(usergroup_id){
				let users_str = '<?php echo json_encode($users)?>';
				let users = users_str? JSON.parse(users_str): [];

				let matrix_user_group_str = '<?php echo json_encode($matrix_user_group)?>';
				let matrix_user_group = matrix_user_group_str? JSON.parse(matrix_user_group_str): [];

				user_ids_in_group = matrix_user_group.filter(a => a.user_group_id == usergroup_id).map(a => parseInt(a.user_id));
				// console.log(user_ids_in_group);
				users_not_in_group = users.filter(a => !user_ids_in_group.includes(parseInt(a.user_id))).map(a => ({user_id: a.user_id, user_nama: a.user_nama.toUpperCase(), nip: a.nip}));
				users_not_in_group = users_not_in_group.sort((a, b) => {
					if(a.user_nama < b.user_nama){
						return -1;
					}

					if(a.user_nama > b.user_nama){
						return 1;
					}

					return 0;
				});
				// console.log(users_not_in_group);
				let userDropdowncontent = `<option value="">--Pilih Akun User--</option>`;
				users_not_in_group.forEach(a => {
					userDropdowncontent += `<option value="${a.user_id}">${a.user_nama}${a.nip? ` (${a.nip})`: ''}</option>`;
				});
				$('#modal_user').find('[name="user_id"]').html(userDropdowncontent);

				users_in_group = users.filter(a => user_ids_in_group.includes(parseInt(a.user_id))).map(a => ({user_id: a.user_id, user_nama: a.user_nama.toUpperCase(), nip: a.nip}));
				users_in_group = users_in_group.sort((a, b) => {
					if(a.user_nama < b.user_nama){
						return -1;
					}

					if(a.user_nama > b.user_nama){
						return 1;
					}

					return 0;
				});

				let group_matrix_str = '<?php echo json_encode($groups)?>';
				let group_matrix = group_matrix_str? JSON.parse(group_matrix_str): [];

				let group = group_matrix.find(a => a.user_group_id == usergroup_id);
				// console.log(group);
				let datas = group? group.access: [];
				// console.log(datas);

				$('#modal_user').find('#modal-title-group').html(group.name);
				$('#modal_user').find('[name="user_group_id"]').val(group.user_group_id);

				let no = 1;
				let content = '';
				users_in_group.forEach(a => {
					let confirmDeleteMsg = `Yakin remove user ${a.user_nama}, dari group ${group.name} ?`;

					content += `
						<tr>
							<td>${no++}</td>
							<td>${a.user_nama}</td>
							<td>${a.nip}</td>
							<td>
								<form action="<?php echo base_url('akses/group_delete_user') ?>" method="post" onsubmit="return confirm('${confirmDeleteMsg}');">
									<input type="hidden" name="user_group_id" value="${group.user_group_id}" />
									<input type="hidden" name="user_id" value="${a.user_id}" />
									<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>	
								</form>
							</td>
						</tr>
					`;
				});

				$('#modal_user').find(`#tbody_access`).html(content);
			}

			function toggleCustomRole(){
				$('#role-form').toggle('slow');
				$('#custom-role-form').toggle('slow');
			}
		</script>

		<?php //$this->load->view('template/v_modal_confirm'); ?>
	</section>

</div>