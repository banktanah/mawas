<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $this->session->userdata('hrm_level'); ?> | Aplikasi Monitoring HR</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="<?= base_url().'gambar/favicon.png'; ?>" type="image/gif">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<?php 
		$id_user = $this->session->userdata('id');
		$user = $this->db->query("select * from user where user_id='$id_user'")->row();
		?>

		<header class="main-header">			
			<a href="#" class="logo">
				<img src="<?php echo base_url()."gambar/logo_admin.png" ?>" style="width: 200px; height: auto;">				
			</a>
			
			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php
									if (empty($user->foto_path)) {
								?>
								<img src="<?= base_url().'gambar/default_foto.png'; ?>" class="user-image" alt="User Image">
								<?php
									}else{
								?>
								<img src="<?= $user->foto_path; ?>" class="user-image" alt="User Image">
								<?php
									}
								?>
								<span class="hidden-xs">HAK AKSES : <b><?= $this->session->userdata('hrm_level'); ?></b></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<?php
										if (empty($user->foto_path)) {
									?>
									<img src="<?= base_url().'gambar/default_foto.png'; ?>" class="user-image" alt="User Image">
									<?php
										}else{
									?>
									<img src="<?= $user->foto_path; ?>" class="user-image" alt="User Image">
									<?php
										}
									?>			
									
									<p>
										<?php echo $this->session->userdata('nama') ?>
										<small>Hak akses : <?= $this->session->userdata('hrm_level'); ?></small>
									</p>
								</li>
								
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url().'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url().'dashboard/keluar' ?>" class="btn btn-default btn-flat">Keluar</a>
									</div>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<?php
							if (empty($user->foto_path)) {
						?>
						<img src="<?= base_url().'gambar/default_foto.png'; ?>" style="height: 45px; width: 45px;" class="img-circle" alt="User Image">
						<?php
							}else{
						?>
						<img src="<?= $user->foto_path; ?>" style="height: 45px; width: 45px;" class="img-circle" alt="User Image">
						<?php
							}
						?>
						
					</div>
					<div class="pull-left info">
						<span>
							<p>
								<?php echo $user->user_nama; ?>
							</p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</span>
					</div>
				</div>
				
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>

					<?php 
						if($this->session->userdata('hrm_level') == "Admin"){
					?>
					<li>
						<a href="<?php echo base_url().'dashboard' ?>">
							<i class="fa fa-dashboard"></i>
							<span>DASHBOARD</span>
						</a>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-cog"></i> <span>DATA MASTER</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<!-- <li><a href="<?php //echo base_url().'dashboard/kategori' ?>">&nbsp; &nbsp; KATEGORI</a></li>
							<li><a href="<?php //echo base_url().'dashboard/sub' ?>">&nbsp; &nbsp; SUB KATEGORI</a></li> -->
							<li><a href="<?php echo base_url().'dashboard/divisi' ?>">&nbsp; &nbsp; DIVISI</a></li>
							<li><a href="<?php echo base_url().'dashboard/divisi_bagian' ?>">&nbsp; &nbsp; DIVISI BAGIAN</a></li>
							<li><a href="<?php echo base_url().'dashboard/status_pegawai' ?>">&nbsp; &nbsp; STATUS KEPEGAWAIAN</a></li>
							<li><a href="<?php echo base_url().'dashboard/pendidikan' ?>">&nbsp; &nbsp; PENDIDIKAN</a></li>
							<!-- <li><a href="<?php //echo base_url().'dashboard/apps' ?>">&nbsp; &nbsp; APLIKASI</a></li> -->
							<li><a href="<?php echo base_url().'dashboard/jabatan_general' ?>">&nbsp; &nbsp; JABATAN</a></li>
							<li><a href="<?php echo base_url().'dashboard/role' ?>">&nbsp; &nbsp; ROLE</a></li>
						</ul>
					</li> 

					<!-- <li class="treeview">
						<a href="#">
							<i class="fa fa-briefcase"></i> <span>MASTER DATA</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url().'dashboard/entitas' ?>">&nbsp; &nbsp;<i class="fa fa-briefcase"></i> DATA ENTITAS</a></li>
							<li><a href="<?php echo base_url().'dashboard/video' ?>">&nbsp; &nbsp;<i class="fa fa-play"></i> DATA VIDEO TES</a></li>
							<li><a href="<?php echo base_url().'dashboard/pertanyaan' ?>">&nbsp; &nbsp;<i class="fa fa-pencil"></i> DATA PERTANYAAN TES</a></li>
						</ul>
					</li> -->

					<li>
						<a href="<?php echo base_url().'dashboard/user' ?>">
							<i class="fa fa-envelope"></i>
							<span>AKUN PEGAWAI</span>
						</a>
					</li>

					<!-- <li>
						<a href="<?php echo base_url().'dashboard/pembayaran' ?>">
							<i class="fa fa-money"></i>
							<span>TAGIHAN</span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url().'dashboard/pengajuan' ?>">
							<i class="fa fa-id-card"></i>
							<span>PENGAJUAN PAS</span>
						</a>
					</li>	 -->
					<li>
						<a href="<?php echo base_url().'dashboard/pegawai' ?>">
							<i class="fa fa-drivers-license"></i>
							<span>DATA PEGAWAI</span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url().'dashboard/apps' ?>">
							<i class="fa fa-exclamation-triangle"></i>
							<span>AKSES APLIKASI</span>
						</a>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears"></i> <span>ORGANISASI</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<!-- <li><a href="<?php //echo base_url().'dashboard/kategori' ?>">&nbsp; &nbsp; KATEGORI</a></li>
							<li><a href="<?php //echo base_url().'dashboard/sub' ?>">&nbsp; &nbsp; SUB KATEGORI</a></li> -->
							<li><a href="<?php echo base_url().'dashboard/jabatan' ?>">&nbsp; &nbsp; JABATAN</a></li>
							<li><a href="<?php echo base_url().'dashboard/struktur' ?>">&nbsp; &nbsp; STRUKTUR</a></li>
						</ul>
					</li>
					
					<?php
						}
					?>

					<?php 
						if($this->session->userdata('hrm_level') == "Pegawai"){
					?>

					<li>
						<a href="<?php echo base_url().'dashboard/profil' ?>">
							<i class="fa fa-user"></i>
							<span>PROFIL</span>
						</a>
					</li>

					<?php
						}
					?>

					<li>
						<a href="<?php echo base_url().'dashboard/ganti_password' ?>">
							<i class="fa fa-lock"></i>
							<span>GANTI PASSWORD</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/keluar' ?>">
							<i class="fa fa-share"></i>
							<span>KELUAR</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>