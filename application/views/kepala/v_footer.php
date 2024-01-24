		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Copyright@<?php echo date('Y') ?></b>. All Right Reserved
			</div>
			<strong>Aplikasi Monitoring Keuangan</strong> Badan Bank Tanah
		</footer>
	</div>

	<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>

	<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
	<script src="<?php echo base_url() ?>assets/bower_components/ckeditor/ckeditor.js"></script>
	<script>
		$(function () {
			CKEDITOR.replace('editor')
		});

		$(document).ready( function () {
			$('#table-datatable').DataTable();
		} );
	</script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script type="text/javascript">
	<?php
	$x="";
	$y="";
	$data = $this->db->query("SELECT * from project")->result();
	foreach ($data as $d) {
		$id = $d->project_id;
		?>



		var ctx = document.getElementById("grafik_<?php  echo $d->project_id?>").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels:[
				<?php 
				$idKat = "";				
				$dat = $this->db->query("SELECT * FROM transaksi where transaksi_project='$id' group by transaksi_kategori")->result();
				foreach ($dat as $dd) {
					
					echo $dd->transaksi_kategori.",";
					$idKat = $dd->transaksi_kategori;
				}
				?>
				],
				//labels: ["10-20", "21-30", "31-60"],
				datasets: [
				{
					label: "RENCANA",
					backgroundColor: "pink",
					borderColor: "red",
					borderWidth: 1,
					data: [
					<?php								
					$dax = $this->db->query("SELECT * FROM transaksi where transaksi_project='$id' group by transaksi_kategori")->result();
					foreach($dax as $dx){
						$id_kat= $dx->transaksi_kategori;
						$rencana = $this->db->query("SELECT sum(transaksi_rencana_jumlah) as total from transaksi where transaksi_project='$id' and transaksi_kategori='$id_kat'")->result();
						foreach ($rencana as $r) {	
							$x = $r->total;						
							echo $r->total.",";
						}
					}					
					?>
					]
				},
				{
					label: "REALISASI",
					backgroundColor: "lightblue",
					borderColor: "blue",
					borderWidth: 1,
					data: [
					<?php									
					$dax = $this->db->query("SELECT * FROM realisasi where realisasi_project='$id' group by realisasi_kategori")->result();
					foreach($dax as $dx){
						$id_kat= $dx->realisasi_kategori;
						$realisasi = $this->db->query("SELECT sum(realisasi_jumlah_harga) as total from realisasi where realisasi_project='$id' and realisasi_kategori='$id_kat'")->result();
						foreach ($realisasi as $rel) {	
							$y = $rel->total;						
							echo $rel->total.",";
						}
					}					
					?>
					]

					//data: [245000]
				},
				{
					label: "SISA",
					backgroundColor: "lightgreen",
					borderColor: "green",
					borderWidth: 1,
					data: [
					<?php 
					$dax = $this->db->query("SELECT * FROM transaksi where transaksi_project='$id' group by transaksi_kategori")->result();
					foreach($dax as $dx){
						$id_kat= $dx->transaksi_kategori;
						$rencana = $this->db->query("SELECT sum(transaksi_rencana_jumlah) as total from transaksi where transaksi_project='$id' and transaksi_kategori='$id_kat'")->row();						
						$realisasi= $this->db->query("SELECT sum(realisasi_jumlah_harga) as total from realisasi where realisasi_project='$id' and realisasi_kategori='$id_kat'")->row();

						$x = $rencana->total;
						$y = $realisasi->total;
						$hasil = abs($x-$y);
						echo $hasil.",";
						
					}

					?>
					]
				},
				],

			}, 
		});

		// code...

		<?php
	}
	?>
	



</script>
	<script type="text/javascript">
		var ctx = document.getElementById("grafik_index").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels:[
				"RENCANA", "REALISASI", "SISA"
				],				
				datasets: [{
					label: 'HARGA SATUAN RP',
					data: [
					<?php
					$rencana = $this->db->query("select sum(transaksi_rencana_harga) as rencana_satuan from transaksi")->row();
					$realisasi = $this->db->query("select sum(realisasi_harga_satuan) as realisasi_harga from realisasi")->row();
					$x = $rencana->rencana_satuan;
					$y = $realisasi->realisasi_harga;
					$hasil = abs($x-$y);

					echo $rencana->rencana_satuan.",".$realisasi->realisasi_harga.",".$hasil;
					?>


					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)'
					],
					borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)'
					],
					borderWidth: 1
				}]




			}, 
		});


		var ctx = document.getElementById("grafik_").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels:[
				"RENCANA", "REALISASI", "SISA"
				],				
				datasets: [{
					label: 'JUMLAH HARGA RP',
					data: [
					<?php
					$rencanax = $this->db->query("select sum(transaksi_rencana_jumlah) as rencana_jumlah from transaksi")->row();
					$realisasiy = $this->db->query("select sum(realisasi_jumlah_harga) as realisasi_jumlah from realisasi")->row();
					$xx = $rencanax->rencana_jumlah;
					$yy = $realisasiy->realisasi_jumlah;
					$hasilxy = abs($xx-$yy);

					echo $rencanax->rencana_jumlah.",".$realisasiy->realisasi_jumlah.",".$hasilxy;
					?>


					],
					backgroundColor: [				
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]




			}, 
		});


	</script>


</body>
</html>
