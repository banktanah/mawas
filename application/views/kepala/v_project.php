<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Project
			<small>Data Project</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Data Project</h3>													
					</div>

					<div class="box-body">
						<table class="table table-bordered" id="table-datatable">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Project</th>
									<th>Lokasi</th>
									<th>Periode</th>									
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($project as $p){ 									
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->project_nama; ?></td>
										<td><?php echo $p->project_lokasi; ?></td>
										<td><?php echo $p->project_periode; ?></td>										
										<td>
											
											
											

											<a href="<?php echo base_url().'kepala/project_detail/'.$p->project_id; ?>" class="btn btn-sm btn-primary">DETAIL</a>											
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


