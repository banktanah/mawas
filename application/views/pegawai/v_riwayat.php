<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pegawai
			<small>Riwayat Karier Pegawai</small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header">
						<center><h2 class="box-title">Data Riwayat</h3></center>
					</div>

					<div class="box-body">
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

					<hr>

					<div class="box-body">
						<table class="table table-bordered table-hover" id="table-datatable">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Status</th>
									<th>Posisi</th>
									<th>Level</th>
									<th>Jabatan</th>
									<th>Divisi</th>
									<th>Bagian</th>
									<th>Berlaku</th>
									<th>Berakhir</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($riwayats as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->pegawai_status; ?></td>
										<td>
											<?php
												if (empty($p->pegawai_posisi)) {
													echo "-";
												}else {
													echo $p->pegawai_posisi;
												}
											?>
										</td>
										<td>
											<?php 
												if (empty($p->pegawai_level)) {
													echo "-";
												}else {
													echo $p->pegawai_level;
												}
											?>
										</td>
										<td>
											<?php 
												if (empty($p->pegawai_jabatan)) {
													echo "-";
												}else {
													echo $p->pegawai_jabatan;
												}
											?>
										</td>
										<td>
											<?php 
												if (empty($p->pegawai_divisi)) {
													echo "-";
												}else {
													echo $p->pegawai_divisi;
												}
											?>
										</td>
										<td>
											<?php
												if (empty($p->pegawai_divisi_bagian)) {
													echo "-";
												}else {
													echo $p->pegawai_divisi_bagian;
												}
											?>
										</td>
										<td>
											<?php echo date("d-m-Y", strtotime($p->tgl_awal));?>
										</td>
										<td>
											<?php
												if (empty($p->tgl_akhir)) {
													$tgl_akhir = "-";
												}else {
													$tgl_akhir = date("d-m-Y", strtotime($p->tgl_akhir));
												}

												echo $tgl_akhir;
											?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<strong>
						<a href="<?=base_url('pegawai');?>"><i class="fa fa-angle-double-left"> Kembali</i></a>
					</strong>
				</div>
			</div>
		</div>

	</section>
</div>