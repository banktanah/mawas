	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Copyright@<?php echo date('Y') ?></b>. All Right Reserved
		</div>
		<strong>Aplikasi HR Monitoring</strong> Badan Bank Tanah
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
