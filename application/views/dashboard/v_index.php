<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
            <div class="col-lg-9">
            	<div class="row">
                	<div class="col-lg-4 col-xs-6">
	                    <div class="small-box bg-purple">
	                        <div class="inner">
	                            <h3><?php ?></h3>

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
	                            <h3><?php  ?></h3>

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
	                            <h3><?php  ?></h3>

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
							
						</div>
					</div>
				</div>
            </div>
		</div>

		

	</section>

</div>