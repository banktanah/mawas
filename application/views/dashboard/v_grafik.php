<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
	</section>

	<section class="content">		

		<div class="row">




			<?php 
			foreach ($project as $p) {
				?>


				<div class="col-md-6">
					<div class="box box-solid">
						<div class="box-header with-border">
							<h3 class="box-title"><?php echo $p->project_nama; ?></h3>
						</div>
						<div class="box-body">															
							<div class="chart-container" style="position: relative; height:auto; width:100%">
								<canvas id="grafik_<?php echo $p->project_id ?>"></canvas>
							</div>
							<center><a href="<?php echo base_url().'dashboard/project_detail/'.$p->project_id; ?>" class="btn btn-sm btn-primary">DETAIL</a></center>

						</div>
					</div>
				</div>



				<?php
			}

			?>

		</div>		

		

	</section>

</div>