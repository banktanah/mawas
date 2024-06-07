	<footer class="main-footer">
		<div class="pull-right hidden-xs">
		Copyright@<?php echo date('Y') ?>. <strong>Badan Bank Tanah</strong>
		</div>
		Aplikasi Manajemen Pegawai Terpusat <strong>[MAWAS]</strong> 
	</footer>
</div>

<!-- <script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script> -->
<script>
	// $.widget.bridge('uibutton', $.ui.button);
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
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script> -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/ckeditor/ckeditor.js"></script>

<!-- js untuk select2  -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<script>
	$("#namaPegawai").select2();
	$("#namaUser").select2();
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	// var chart = new OrgChart(document.getElementById("tree"), {
	// 		template: "mila",
	// 		enableSearch: false,
	// 		align: OrgChart.align.orientation,
	// 		scaleInitial:OrgChart.match.boundary,
	// 		nodeBinding: {
    //             field_0: "Jabatan",
	// 			field_1: "Nama",
	// 			img_0: "img"
    //         },
			
    //         nodes: [
	// 			<?php
	// 				$jbt = $this->db->query("select * from jabatan")->result();
	// 				foreach ($jbt as $j) {
	// 					if ($j->jabatan_level == 1) {
	// 						//$name = $this->db->query("select * from pegawai where pegawai_jabatan = '$j->jabatan_id'")->row();
	// 						echo '{ id:'.$j->jabatan_id.', Jabatan:"'.$j->jabatan_nama.'", Nama: "'.$j->pegawai_nama.'", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },';
	// 					}elseif ($j->jabatan_level > 1) {
	// 						echo '{ id:'.$j->jabatan_id.', pid:'.$j->jabatan_under.', Jabatan:"'.$j->jabatan_nama.'", Nama: "'.$j->pegawai_nama.'", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },';
	// 					}
	// 				}
	// 			?>
                
    //         ]
    //     });

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

<script>
	function changePicPreview() {
		document.getElementById("inputPic").value = "";
		var output = document.getElementById('profilePic');
		output.src = "";
	}
</script>

<script>
	function changeEmail() {
		var idPegawai = document.getElementById("namaPegawai").value;
		var emailPegawai = document.getElementById('emailPegawai');
		
		$.ajax({
			type: 'POST',
			url:'<?php echo base_url('pegawai/get_email');?>',
			data:'id='+idPegawai,
			success: function(response) { 
				emailPegawai.value = response;
			}				
		});
		return false;
	}
</script>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('profilePic');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
    	URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

<?php
	$pegawais = $this->db->query("SELECT * FROM pegawai")->result();
	$karirs = $this->db->query("SELECT * FROM pegawai_karir")->result();

	foreach ($pegawais as $changepic) {
		echo
		'<script>
			function changePicPreview'.$changepic->pegawai_id.'() {
				document.getElementById("inputPic'.$changepic->pegawai_id.'").value = "";
				var output = document.getElementById("profilePic'.$changepic->pegawai_id.'");
				output.src = "";
			}
		</script>';
	}

	foreach ($pegawais as $loadfile) {
		echo
		'<script>
			var loadFile'.$loadfile->pegawai_id.' = function(event) {
				var output = document.getElementById("profilePic'.$loadfile->pegawai_id.'");
				output.src = URL.createObjectURL(event.target.files[0]);
				output.onload = function() {
					URL.revokeObjectURL(output.src) // free memory
				}
			};
		</script>';
	}

	foreach ($pegawais as $kp) {
		echo 
		"<script>
			$('#karierDivisi".$kp->pegawai_id."').select2();
			$('#karierDivisiBagian".$kp->pegawai_id."').select2();
			$('#atasanLangsung".$kp->pegawai_id."').select2();
			$('#atasanAtasan".$kp->pegawai_id."').select2();
			$('#lokasi".$kp->pegawai_id."').select2();
		</script>";
	}

	foreach ($karirs as $karir) {
		echo 
		"<script>
			$('#karierDivisiE".$karir->karir_id."').select2();
			$('#karierDivisiBagianE".$karir->karir_id."').select2();
			$('#atasanLangsungE".$karir->karir_id."').select2();
			$('#atasanAtasanE".$karir->karir_id."').select2();
			$('#lokasiE".$karir->karir_id."').select2();
		</script>";
	}
?>

<script>
	function changePegawaiActive(selectObject) {
		var active = selectObject.value;  
		location="<?php echo base_url('pegawai?is_active=')?>" + active;
	}
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
	function changeDivisiBagian(idPegawai) {
		var divisiEle = 'karierDivisi'+idPegawai;
		var divisiBagianEle = 'karierDivisiBagian'+idPegawai;
		var idDivisi = document.getElementById(divisiEle).value;

		// alert(idPerolehan);
		// alert(idProvinsi);
		
		$.ajax({
			type: 'POST',
			url:'<?php echo base_url('bagian/get_divisi_bagian');?>',
			data:'id='+idDivisi,
			success: function(response) { 
				$('#karierDivisiBagian'+idPegawai).html(response); 
			}				
		});
		return false;
	}

	function changeDivisiBagianE(idKarir) {
		var divisiEle = 'karierDivisiE'+idKarir;
		var divisiBagianEle = 'karierDivisiBagianE'+idKarir;
		var idDivisi = document.getElementById(divisiEle).value;

		// alert(idPerolehan);
		// alert(idProvinsi);
		
		$.ajax({
			type: 'POST',
			url:'<?php echo base_url('divisi_bagian/get_divisi_bagian');?>',
			data:'id='+idDivisi,
			success: function(response) { 
				$('#karierDivisiBagianE'+idKarir).html(response); 
			}				
		});
		return false;
	}

	function changeJabatan(idPegawai){
		var jabatanEle = 'jabatan'+idPegawai;
		var deputiEle = 'deputi'+idPegawai;
		var deputiInputEle = 'deputiInput'+idPegawai;
		var idJabatan = document.getElementById(jabatanEle).value;

		if (idJabatan == 2) {
			document.getElementById(deputiEle).style.display = 'block';
			document.getElementById(deputiInputEle).required = true;
		}else{
			document.getElementById(deputiEle).style.display = 'none';
			document.getElementById(deputiInputEle).required = false;
		}
		
	}

	function changeJabatanE(idKarir){
		var jabatanEdEle = 'jabatanE'+idKarir;
		var deputiEdEle = 'deputiE'+idKarir;
		var deputiInputEdEle = 'deputiInputE'+idKarir;
		var idJabatan = document.getElementById(jabatanEdEle).value;

		if (idJabatan == 2) {
			document.getElementById(deputiEdEle).style.display = 'block';
			document.getElementById(deputiInputEdEle).required = true;
		}else{
			document.getElementById(deputiEdEle).style.display = 'none';
			document.getElementById(deputiInputEdEle).required = false;
		}
		
	}

	function hideKarirModal(idKarir){
		var modalClose = '#editKarier'+idKarir;
		//var modalOpen = '#editKarier'+idKarir;
		//$("#kepegawaian"+idPegawai).modal('hide');
		$(modalClose).modal('hide');
		// $(modalClose).removeClass("fade").modal("hide");
		// $(modalOpen).addClass("fade").modal("show");
	}

	function hideOffKarir(idKarir){
		var modalClose = '#disableData'+idKarir;
		//var modalOpen = '#editKarier'+idKarir;
		//$("#kepegawaian"+idPegawai).modal('hide');
		$(modalClose).modal('hide');
		// $(modalClose).removeClass("fade").modal("hide");
		// $(modalOpen).addClass("fade").modal("show");
	}

	function hideDelKarir(idKarir){
		var modalClose = '#hapusData'+idKarir;
		//var modalOpen = '#editKarier'+idKarir;
		//$("#kepegawaian"+idPegawai).modal('hide');
		$(modalClose).modal('hide');
		// $(modalClose).removeClass("fade").modal("hide");
		// $(modalOpen).addClass("fade").modal("show");
	}
	
	function openAddKarir(idPegawai){
		var modalClose = '#kepegawaian'+idPegawai;
		var modalOpen = '#addKarier'+idPegawai;
		$(modalClose).modal('hide');
		$(modalOpen).modal('show');
	}

</script>

<script>
	$(function () {
		// CKEDITOR.replace('editor')
	});

	$(document).ready( function () {

		$('#table-datatable').DataTable({
			"scrollX": true
		});

		var table = $('#table-pegawai').DataTable({
			"scrollX": true,
			"sDom": "lrtip"
		});

		$('.datatable-init').css("width", "100%");
		$('.datatable-init').DataTable({
			"scrollX": true
		});

		$('.filter-pegawai').on('click', function(e){
			e.stopPropagation();    
		});

		$('#search-nama').on('keyup', function(){
			table
			.column(1)
			.search(this.value)
			.draw();
		});

		$('#search-nik').on('keyup', function(){
			table
			.column(2)
			.search(this.value)
			.draw();
		});

		$('#search-ttl').on('keyup', function(){
			table
			.column(3)
			.search(this.value)
			.draw();
		});

		$('#search-jk').on('keyup', function(){
			table
			.column(4)
			.search(this.value)
			.draw();
		});

		$('#search-edu').on('keyup', function(){
			table
			.column(5)
			.search(this.value)
			.draw();
		});

		$('#search-ag').on('keyup', function(){
			table
			.column(6)
			.search(this.value)
			.draw();
		});

		$('#search-kw').on('keyup', function(){
			table
			.column(7)
			.search(this.value)
			.draw();
		});

		$('#search-spn').on('keyup', function(){
			table
			.column(8)
			.search(this.value)
			.draw();
		});

		$('#search-adr').on('keyup', function(){
			table
			.column(9)
			.search(this.value)
			.draw();
		});

		$('#search-mail').on('keyup', function(){
			table
			.column(12)
			.search(this.value)
			.draw();
		});
	});
</script>

<script>
	$(".Collapsable").click(function () {
		$(this).parent().children().toggle();
		$(this).toggle();
	});

	$('#pilihDivisi').select2();
</script>

</body>
</html>
