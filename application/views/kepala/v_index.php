<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-aqua">
					<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
					<div class="info-box-content">
						<?php 
						$datax = $this->db->query("select sum(transaksi_rencana_jumlah) as rencana_jumlah from transaksi")->row();
						?>
						<span class="info-box-text">RENCANA</span>
						<span class="info-box-number"><?php echo "Rp.".number_format($datax->rencana_jumlah) ?></span>
						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
							Total Rencana BDP
						</span>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-green">
					<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
					<div class="info-box-content">
						<?php 
						$datay = $this->db->query("select sum(realisasi_jumlah_harga) as realisasi_jumlah from realisasi")->row();
						?>
						<span class="info-box-text">REALISASI</span>
						<span class="info-box-number"><?php echo "Rp.".number_format($datay->realisasi_jumlah) ?></span>
						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
							Total Realisasi BDP
						</span>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-orange">
					<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
					<div class="info-box-content">
						<?php 
						$x = $datax->rencana_jumlah;
						$y = $datay->realisasi_jumlah;
						$hasil = abs($x-$y);
						?>
						<span class="info-box-text">SISA</span>
						<span class="info-box-number"><?php echo "Rp.".number_format($hasil) ?></span>
						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
							Total Sisa Anggaran
						</span>
					</div>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-lg-6 col-xs-6">
				<div class="small-box bg-purple">
					<div class="inner">
						<h3><?php echo $jumlah_project ?></h3>

						<p>Jumlah Project</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-list"></i>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6 col-xs-6">
				<div class="small-box bg-maroon">
					<div class="inner">
						<h3><?php echo $jumlah_user ?></h3>

						<p>Jumlah user</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
				</div>
			</div>
			
		</div>


		
		<div class="row">
			<div class="col-md-6">

				<div class="box box-widget widget-user-2">

					<?php 
					$id_user = $this->session->userdata('id');
					$user = $this->db->query("select * from user where user_id='$id_user'")->row();
					?>

					<div class="widget-user-header bg-yellow">
						<div class="widget-user-image">
							<?php 
							if($user->user_foto==""){
								?>
								<img class="img-circle" src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="User Avatar">
								<?php
							}else{
								?>
								<img class="img-circle" src="<?php echo base_url() ?>gambar/user/<?php echo $user->user_foto ?>" alt="User Avatar">
								<?php 
							}
							?>
							
						</div>

						<h3 class="widget-user-username"><?php echo $user->user_nama; ?></h3>
						<h5 class="widget-user-desc"><?php echo $user->user_level; ?></h5>
					</div>
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked">
							<li><a href="#">Nama <span class="pull-right badge bg-blue"><?php echo $user->user_nama; ?></span></a></li>
							<li><a href="#">Username <span class="pull-right badge bg-aqua"><?php echo $user->user_username; ?></span></a></li>
							<li><a href="#">Level <span class="pull-right badge bg-green"><?php echo $user->user_level; ?></span></a></li>
							<li><a href="#">Status <span class="pull-right badge bg-red">Aktif</span></a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Project Terbaru</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>NO</th>
										<th>PROJECT</th>
										<th>LOKASI</th>
										<th>PERIODE</th>									
									</tr>
								</thead>
								<tbody>
									<?php 
									$no=1;
									foreach ($project as $p) {
										// code...
										?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $p->project_nama ?></td>
											<td><?php echo $p->project_lokasi ?></td>
											<td><?php echo $p->project_periode ?></td>
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
			<div class="col-md-6">
				<div class="box box-solid">					
					<div class="box-body">															
						<div class="chart-container" style="position: relative; height:auto; width:100%">
							<center><b>HARGA SATUAN</b></center>
							<canvas id="grafik_index"></canvas>
						</div>						
					</div>
				</div>
			</div>	

			<div class="col-md-6">
				<div class="box box-solid">					
					<div class="box-body">															
						<div class="chart-container" style="position: relative; height:auto; width:100%">
							<center><b>JUMLAH HARGA</b></center>
							<canvas id="grafik_"></canvas>
						</div>						
					</div>
				</div>
			</div>	
		</div>

	</section>

</div>