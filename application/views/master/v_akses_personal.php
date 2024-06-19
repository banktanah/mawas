<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Akses Personal
			<small>Tambah hak akses/Overwrite hak akses dari Group</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User List</h3>
						<?php
							$this->load->view('template/v_alert');
						?>
					</div>

					<div class="box-body">
						<table class="table table-bordered datatable-init">
							<thead>
								<tr>
									<th>NO</th>
									<th width="20%">User / NIP</th>
									<th>Akses</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no = 1;
									foreach($users as $u){
								?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $u->user_nama.(!empty($u->nip)? " / $u->nip": '') ?></td>
											<td>
												<?php 
													// foreach($u->app_list as $row){
													// 	echo "<div>$row</div>";
													// }
													$app_list = implode('; ', $u->app_list);
													$app_list = strlen($app_list) > 30? substr($app_list, 0, 30).'...': $app_list;
													echo $app_list;
												?>
											</td>
											<td>
												<button title="Akses" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_akses" onclick="modalAccess('<?php echo $u->user_id ?>')" style="min-width: 70px; margin-bottom: 5px;">
													<i class="fa fa-people"></i>&nbsp;Akses
												</button>
												<button title="Hapus" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData<?php echo $u->nip ?>" style="min-width: 70px; margin-bottom: 5px;">
													<i class="fa fa-trash"></i>&nbsp;Hapus
												</button>	
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
		
		<script>
			var users = '<?php echo count($users)>0? json_encode($users): ''?>';
			if(users.length > 0){
				users = JSON.parse(users);
			}
			// console.log(users);
			var user_apps = [];
			var access_array = [];

			function modalAccess(user_id){
				let user = users.find(a => a.user_id == user_id);

				// console.log(group);
				user_apps = user.apps.length>0? user.apps: [];
				user_apps = user_apps.sort((a, b) => {
					if ( a.apps_nama < b.apps_nama ){
						return -1;
					}
					if ( a.apps_nama > b.apps_nama ){
						return 1;
					}
					return 0;
				});
				// console.log(user_apps);

				$('#modal_akses').find('#modal-title-personal').html(user.user_nama);
				access_array = user_apps.filter(a => a.grant_type != null);
				$('#modal_akses').find('[name="user_id"]').val(user_id);

				modalAccess_generateAccessTable()
			}

			function toggleCustomRole(){
				$('#role-form').toggle('slow');
				$('#custom-role-form').toggle('slow');
			}

			function modalAccess_generateAccessTable(toggled_apps_id = null, toggled_role = null){
				if(toggled_apps_id !== null){
					let toggledGrant = access_array.find(a => a.apps_id==toggled_apps_id && a.role==toggled_role).grant_type;
					toggledGrant = toggledGrant=='+'? '-': '+';
					access_array.find(a => a.apps_id==toggled_apps_id && a.role==toggled_role).grant_type = toggledGrant;
				}
				// console.log(access_array);

				let no = 1;
				let content = '';
				user_apps.forEach(a => {
					// let toggleSign = a.grant_type;
					// if(toggled_apps_id !== null){
					// 	let acc = access_array.find(b => b.apps_id==a.apps_id);
					// 	// console.log(acc);
					// 	toggleSign = acc.grant_type;
					// }

					let grantSign = a.grant_type;
					let acc = access_array.find(b => b.apps_id==a.apps_id && b.role==a.role);
					if(acc){
						grantSign = acc.grant_type;
					}

					content += `
						<tr>
							<td>${no++}</td>
							<td>${a.apps_nama}</td>
							<td>${a.role}</td>
							<td>${a.grant_type? a.grant_type: '[Group]'}</td>
							<td>
								${
									a.grant_type? 
										`
											<div>
												<button type="button" onclick="modalAccess_btnChangeGrant(${a.apps_id}, '${a.role}')" class="btn btn-info btn-sm" style="min-width: 105px; margin-bottom: 5px;"><i class="fa ${grantSign=='-'? 'fa-plus': 'fa-minus'}"></i>&nbsp Change Grant</button>
											</div>
											<div>
												<button type="button" onclick="modalAccess_btnDelGrant(${a.apps_id}, '${a.role}')" class="btn btn-danger btn-sm" style="min-width: 105px; margin-bottom: 5px;"><i class="fa fa-trash"></i>&nbsp Hapus</button>
											</div>
											<!--
											<form action="<?php echo base_url('akses/group_delete') ?>" method="post">
												<input type="hidden" name="apps_id" value="${a.apps_id}" />
												<input type="hidden" name="role" value="${a.role}" />
												<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp Hapus</button>	
											</form>
											-->
										`
									: '[Group]'
								}
							</td>
						</tr>
					`;
				});

				$('#modal_akses').find(`#tbody_access`).html(content);
			}

			function modalAccess_btnChangeGrant(apps_id, role){
				let formData = $('#modal_akses').find('form').serializeArray();
				// console.log(formData);

				modalAccess_generateAccessTable(apps_id, role);
			}

			function modalAccess_btnAddGrant(){
				// console.log(user_apps);

				let apps_id = $('#modal_akses').find('#modal_akses_section_add').find('[name="apps_id"]').val();
				let apps_nama = $('#modal_akses').find('#modal_akses_section_add').find('[name="apps_id"] option:selected').text();
				let is_role_custom = $('#modal_akses').find('#modal_akses_section_add').find('[name="is_role_custom"]').is(":checked");
				let role = $('#modal_akses').find('#modal_akses_section_add').find(`[name="${is_role_custom? 'role_custom': 'role'}"]`).val();

				let acc = access_array.find(a => a.apps_id==apps_id && a.role==role);
				if(acc){
					alert(`Access to "${apps_nama}" (Role: "${role}") is already exists !`);
					return;
				}

				let roleObj = {
					apps_id: apps_id,
					apps_nama: apps_nama,
					grant_type: '+',
					role: role
				};

				user_apps.push(roleObj);
				access_array.push(roleObj);
				user_apps = user_apps.sort((a, b) => {
					if ( a.apps_nama < b.apps_nama ){
						return -1;
					}
					if ( a.apps_nama > b.apps_nama ){
						return 1;
					}
					return 0;
				});

				modalAccess_generateAccessTable();
			}

			function modalAccess_btnDelGrant(apps_id, role){
				// console.log(user_apps);

				user_apps = user_apps.filter(a => !(a.apps_id==apps_id && a.role==role));
				access_array = access_array.filter(a => !(a.apps_id==apps_id && a.role==role));

				user_apps = user_apps.sort((a, b) => {
					if ( a.apps_nama < b.apps_nama ){
						return -1;
					}
					if ( a.apps_nama > b.apps_nama ){
						return 1;
					}
					return 0;
				});

				modalAccess_generateAccessTable();
			}

			function modalAccess_btnSave(){
				// $('#modal_akses').find('form').submit(function(e){
				// 	$('#modal_akses').find('[name="access_array"]').val(JSON.stringify(access_array));

				// 	console.log($('#modal_akses').find('[name="access_array"]').val());

				// 	return false;
				// });

				$('#modal_akses').find('form').on('submit', function(e){
					// validation code here
					// if(!valid) {
					// 	e.preventDefault();
					// }
					
					// console.log(access_array);
					$('#modal_akses').find('[name="access_array"]').val(JSON.stringify(access_array));
					// console.log($('#modal_akses').find('[name="access_array"]').val());

					// e.preventDefault();
					// e.stopPropagation();
				});
			}
		</script>

		<div id="modal_akses" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title"> Akses untuk User <span id="modal-title-personal"></span></h4></center>
					</div>
					<div class="modal-body">
						
						<table class="table table-bordered datatable-init">
							<thead>
								<tr>
									<th>No</th>
									<th>Aplikasi</th>
									<th>Role</th>
									<th>Grant-Type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tbody_access">
							</tbody>
						</table>

						<form action="<?php echo base_url('akses/personal_access_save') ?>" method="post" enctype="multipart/form-data">											
							<input type="hidden" name="user_id" value="">
							<input type="hidden" name="access_array" value="[]">
							<div id="modal_akses_section_add" style="background-color: lightgrey; border: 1px solid black; border-radius: 5px; padding: 10px;">
								<div class="form-group" style="width:100%;">
									<label style="width: 100%;"> Aplikasi</label>
									<select class="form-control" name="apps_id" style="width: 100%;">
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
									<label style="width: 100%;"> Custom Role <input type="checkbox" name="is_role_custom" onchange="toggleCustomRole()"/></label>
								</div>
								<div id="custom-role-form" class="form-group" style="width:100%; display:none;">
									<label style="width: 100%;"> Custom Role Name</label>
									<input type="text" name="role_custom" class="form-control" />
								</div>
								
								<input type="button" onclick="modalAccess_btnAddGrant()" value="Tambah" class="btn btn-primary">
							</div>
						
							<br>
							<input type="submit" onclick="modalAccess_btnSave()" value="Simpan" class="btn btn-primary">
						</form>
					</div>											
				</div>
			</div>
		</div>
	</section>

</div>