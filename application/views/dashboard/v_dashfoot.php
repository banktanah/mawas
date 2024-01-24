<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Copyright@<?php echo date('Y') ?></b>. All Right Reserved
		</div>
		<strong>Aplikasi HR Monitoring</strong> Badan Bank Tanah
</footer>

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
<script src="<?php echo base_url(); ?>assets/bower_components/orgchart/orgchart.js"></script>

<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/ckeditor/ckeditor.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	var chart = new OrgChart(document.getElementById("tree"), {
			template: "mila",
			enableSearch: false,
			align: OrgChart.align.orientation,
			scaleInitial:OrgChart.match.boundary,
			nodeBinding: {
                field_0: "Jabatan",
				field_1: "Nama",
				img_0: "img"
            },
			
            nodes: [
				<?php
					$jbt = $this->db->query("select * from jabatan")->result();
					foreach ($jbt as $j) {
						if ($j->jabatan_level == 1) {
							//$name = $this->db->query("select * from pegawai where pegawai_jabatan = '$j->jabatan_id'")->row();
							echo '{ id:'.$j->jabatan_id.', Jabatan:"'.$j->jabatan_nama.'", Nama: "'.$j->pegawai_nama.'", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },';
						}elseif ($j->jabatan_level > 1) {
							echo '{ id:'.$j->jabatan_id.', pid:'.$j->jabatan_under.', Jabatan:"'.$j->jabatan_nama.'", Nama: "'.$j->pegawai_nama.'", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },';
						}
					}
				?>
                
            ]
        });

		$(".img").hide();

// 	var chart = new OrgChart(document.getElementById("tree"), {
//     template: "olivia",
//     mouseScrool: OrgChart.action.none,
//     enableSearch: false,
//     nodeBinding: {
//         field_0: "name",
//         field_1: "title",
//         img_0: "img"
//     },
//     nodes: [
//         { id: 1, name: "Amber McKenzie", title: "CEO", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
//         { id: 2, pid: 1, name: "Ava Field", title: "IT Manager", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
//         { id: 3, pid: 1, name: "Rhys Harper", img: "https://cdn.balkan.app/shared/empty-img-none.svg" }
//     ]
// });

// var chart = new OrgChart(document.getElementById("tree"), {
//     template: "olivia",
// 	enableSearch: false,
//     mouseScrool: OrgChart.action.none,
//     nodeMouseClick: OrgChart.action.none,
//     tags: {
//         "node-with-subtrees": {
//             template: "group",
//             subTreeConfig: {
//                 orientation: OrgChart.orientation.right
//             }
//         }
//     }
// });
// chart.load([{ id: 0 }, { id: 1, pid: 0, tags: ["node-with-subtrees"] }, { id: 2, stpid: 1 }, { id: 3, pid: 2 }]);

</script>

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
	var ctx = document.getElementById("grafik_bar").getContext('2d');
	var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [ 
					<?php
						$div_label = $this->db->query("SELECT * FROM divisi")->result();
						
						foreach ($div_label as $dl) {
							echo '"'.$dl->divisi_nama.'",';
						}
					?>
				],
				datasets: [
				{
					label: "JUMLAH PEGAWAI",
					backgroundColor: "green",
					borderColor: "grey",
					borderWidth: 1,
					data: [
							<?php
								$div_data = $this->db->query("SELECT * FROM divisi")->result();	
								
								foreach ($div_data as $dd) {
									$div_peg = $this->db->query("SELECT * FROM pegawai WHERE pegawai_divisi = '$dd->divisi_id'")->num_rows();
									echo $div_peg.",";
								}
							?>
					]
				}
				],

			}, 
	});

</script>


<script type="text/javascript">
	var ctx_stat = document.getElementById("grafik_status").getContext('2d');
	var myChart_stat = new Chart(ctx_stat, {
		type: 'doughnut',
		data: {
			labels:[
			<?php
				$stat_label = $this->db->query("SELECT * FROM status_pegawai")->result();
				foreach ($stat_label as $sl) {
					echo '"'.strtoupper($sl->status_nama).'",';
				}
			?>
			],				
			datasets: [{
				data: [
				<?php

					foreach ($stat_label as $sd) {
						$stat_data = $this->db->query("SELECT * FROM pegawai WHERE pegawai_status = '$sd->status_pegawai_id'")->num_rows();
						echo $stat_data.",";
					}
				
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

	
	var ctx_usia = document.getElementById("grafik_usia").getContext('2d');
	var myChart_usia = new Chart(ctx_usia, {
		type: 'doughnut',
		data: {
			labels:[
			"<= 25 Tahun", "26 s/d 45 Tahun", "> 45 Tahun"
			],				
			datasets: [{
				data: [
				<?php

					$young = 0;
					$mid_age = 0;
					$old = 0;

					$pegawais = $this->db->query("SELECT * FROM pegawai")->result();

					foreach ($pegawais as $pa) {
						$born = new DateTime($pa->pegawai_tgl_lahir);
						$now = new DateTime();
						
						$interval_age = date_diff($born,$now);
						$age = $interval_age->format('%Y');

						if ($age < 26) {
							$young += 1;
						}elseif ($age > 25 && $age < 46) {
							$mid_age += 1;
						}elseif ($age > 45) {
							$old += 1;
						}
					}

					echo $young.",".$mid_age.",".$old;
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

	var ctx_gender = document.getElementById("grafik_gender").getContext('2d');
	var myChart_gender = new Chart(ctx_gender, {
		type: 'doughnut',
		data: {
			labels:[
			"Laki-laki", "Perempuan"
			],				
			datasets: [{
				data: [
				<?php
					$laki = 0;
					$perempuan = 0;
					foreach ($pegawais as $pg) {

						if ($pg->pegawai_gender == "L") {
							$laki += 1;
						}elseif ($pg->pegawai_gender == "P") {
							$perempuan += 1;
						}
					}

					echo $laki.",".$perempuan;
				?>
				

				],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)'
				],
				borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)'
				],
				borderWidth: 1
			}]

		}, 
	});

	var ctx_mk = document.getElementById("grafik_mk").getContext('2d');
	var myChart_mk = new Chart(ctx_mk, {
		type: 'doughnut',
		data: {
			labels:[
			"<= 3 Bulan", "4 s/d 6 Bulan", "> 6 Bulan"
			],				
			datasets: [{
				data: [
				<?php
				
					$junior = 0;
					$mid_level = 0;
					$senior = 0;

					foreach ($pegawais as $pm) {
						$join = new DateTime($pm->pegawai_tgl_gabung);
						
						$Months = $now->diff($join); 
 						$total_months = (($Months->y) * 12) + ($Months->m);

						if ($total_months <= 3) {
							$junior += 1;
						}elseif ($total_months > 3 && $total_months <= 6) {
							$mid_level += 1;
						}elseif ($total_months > 6) {
							$senior += 1;
						}
					}

					echo $junior.",".$mid_level.",".$senior;

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


</script>


<script type="text/javascript">
	$(document).ready(function(){

		$('#pegawai_divisi').change(function(){ 
			var id=$(this).val();
			$.ajax({

				type: 'POST',
				url:'<?php echo base_url('dashboard/get_divisi_bagian');?>',
				data:'id='+id,
				success: function(response) { 
					$('#pegawai_divisi_bagian').html(response); 
				}				
			});
			return false;
		}); 

	});
</script>

<script>
	$(function () {
		CKEDITOR.replace('editor')
	});

	$(document).ready( function () {
		$('#table-datatable').DataTable();
	} );
</script>
</body>
</html>
