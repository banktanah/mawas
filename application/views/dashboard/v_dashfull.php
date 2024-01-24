
	<section class="content-header">
		<h1 style="margin-left: 15px;">
			HR MONITORING
			<small>Dashboard</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">

			<div class="col-md-4 col-sm-6 col-xs-12" hidden>
				<div class="info-box bg-aqua">
					<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Pegawai</span>
						<span class="info-box-number"><?php echo $jumlah_pegawai; ?></span>
						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
							Jumlah Pegawai
						</span>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 col-xs-12" hidden>
				<div class="info-box bg-green">
					<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Laki-laki</span>
						<span class="info-box-number"><?php echo $jumlah_pegawai_l; ?></span>
						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
							Jumlah Pegawai Laki-laki
						</span>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 col-xs-12" hidden>
				<div class="info-box bg-maroon">
					<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Perempuan</span>
						<span class="info-box-number"><?php echo $jumlah_pegawai_p;?></span>
						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
							Jumlah Pegawai Perempuan
						</span>
					</div>
				</div>
			</div>
			

		</div>

		<div class="row">
            <div class="col-lg-9">
            	<div class="row">
                	<div class="col-lg-4 col-xs-6">
	                    <div class="small-box bg-purple">
	                        <div class="inner">
	                            <h3><?php echo $pegawai ?></h3>

	                            <p>Pegawai</p>
	                        </div>
	                        <div class="icon">
	                            <i class="ion ion-person"></i>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-lg-4 col-xs-6">
	                    <div class="small-box bg-orange">
	                        <div class="inner">
	                            <h3><?php echo $jabatan ?></h3>

	                            <p>Posisi</p>
	                        </div>
	                        <div class="icon">
	                            <i class="ion ion-briefcase"></i>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-lg-4 col-xs-6">
	                    <div class="small-box bg-primary">
	                        <div class="inner">
	                            <h3><?php echo $divisi ?></h3>

	                            <p>Divisi</p>
	                        </div>
	                        <div class="icon">
	                            <i class="ion ion-android-list"></i>
	                        </div>
	                    </div>
	                </div>
                </div>
                
                <div class="row">
                	<div class="col-md-4">
	                    <div class="box box-solid">					
	                        <div class="box-body">															
	                            <div class="chart-container" style="height:auto; width:100%">
	                                <center><b>GENDER PEGAWAI</b></center>
	                                <center><canvas id="grafik_gender"></canvas></center>
	                            </div>						
	                        </div>
	                    </div>
	                </div>
					<div class="col-md-4">
	                    <div class="box box-solid">					
	                        <div class="box-body">		
	                            <div class="chart-container" style="height:auto; width:100%">
	                                <center><b>Status Kepegawaian</b></center>
	                                <center><canvas id="grafik_status"></canvas></center>
	                            </div>					
	                        </div>
	                    </div>
	                </div>
	                
	                <div class="col-md-4">
	                    <div class="box box-solid">					
	                        <div class="box-body">		
	                            <div class="chart-container" style="height:auto; width:100%">
	                                <center><b>MASA KERJA</b></center>
	                                <center><canvas id="grafik_mk"></canvas></center>
	                            </div>					
	                        </div>
	                    </div>
	                </div>
                </div>
                <div class="row">
                	<div class="col-md-4">
	                    <div class="box box-solid">					
	                        <div class="box-body">		
	                            <div class="chart-container" style="position: relative; height:auto; width:100%">
	                                <center><b>USIA PEGAWAI</b></center>
	                                <center><canvas id="grafik_usia"></canvas></center>
	                            </div>					
	                        </div>
	                    </div>
                	</div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box box-primary">
					<div class="box-header">
						<center>
						<h3 class="box-title">DIVISI</h3>
						</center>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>NO</th>
										<th>Nama Divisi</th>
										<th>Jumlah Anggota</th>									
									</tr>
								</thead>
								<tbody>
									<?php 
									$no=1;
									foreach ($divisis as $dl) {
										// code...
										?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $dl->divisi_nama ?></td>
											<td>
												<?php  
													$angg = $this->db->query("SELECT * FROM pegawai WHERE pegawai_divisi = '$dl->divisi_id'")->num_rows();
													echo $angg;
												?>
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
		</div>
		
		<div class="row">
            <div class="col-lg-9">
                
            </div>
            <div class="col-lg-3">
                
            </div>		
		</div>

		<div class="row">

			<div class="col-lg-4">
				
				

			</div>
			
			<!-- <div class="col-lg-8">
				<div class="box box-solid">					
					<div class="box-body">		
						<div class="chart-container" style="position: relative; height:auto; width:100%">
							<center><b>DIVISI</b></center>
							<center><canvas id="grafik_bar"></canvas></center>
						</div>					
					</div>
				</div>
			</div> -->
		</div>

		<!-- <div class="row">
			<div class="col-md-6">

				<div class="box box-widget widget-user-2">

					<?php 
					// $id_user = $this->session->userdata('id');
					// $user = $this->db->query("select * from user where user_id='$id_user'")->row();
					?>

					<div class="widget-user-header bg-yellow">
						<div class="widget-user-image">
							<?php 
							// if($user->user_foto==""){
							// 	?>
							// 	<img class="img-circle" src="<?php //echo base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="User Avatar">
							// 	<?php
							// }else{
							// 	?>
							// 	<img class="img-circle" src="<?php //echo base_url() ?>gambar/user/<?php //echo $user->user_foto ?>" alt="User Avatar">
							// 	<?php 
							// }
							?>
							
						</div>

						<h3 class="widget-user-username"><?php //echo $user->user_nama; ?></h3>
						<h5 class="widget-user-desc"><?php //echo $user->user_level; ?></h5>
					</div>
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked">
							<li><a href="#">Nama <span class="pull-right badge bg-blue"><?php //echo $user->user_nama; ?></span></a></li>
							<li><a href="#">Username <span class="pull-right badge bg-aqua"><?php //echo $user->user_username; ?></span></a></li>
							<li><a href="#">Level <span class="pull-right badge bg-green"><?php //echo $user->user_level; ?></span></a></li>
							<li><a href="#">Status <span class="pull-right badge bg-red">Aktif</span></a></li>
						</ul>
					</div>
				</div>

			</div>
			
		</div> -->

	</section>

