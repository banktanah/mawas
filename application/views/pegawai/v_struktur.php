<style>
    #collapsul {
        --icon-space: 1.3em;
        list-style: none;
        padding: 0;
        margin-bottom: 12px;
        margin-top: 8px;
    }

    #collapsli {
        padding-left: var(--icon-space);
        margin-bottom: 8px;
        margin-top: 8px;
    }

    #collapslibag {
        padding-left: var(--icon-space);
        margin-bottom: 8px;
        margin-top: 8px;
    }

    #collapsli:before {
        content: "\f007"; /* FontAwesome Unicode */
        font-family: FontAwesome;
        display: inline-block;
        margin-left: calc( var(--icon-space) * -1 );
        width: var(--icon-space);
    }

    #collapslibag:before {
        content: "\f0f7"; /* FontAwesome Unicode */
        font-family: FontAwesome;
        display: inline-block;
        margin-left: calc( var(--icon-space) * -1 );
        width: var(--icon-space);
    }
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			STRUKTUR ORGANISASI
			<small>Badan Bank Tanah</small>
		</h1>
	</section>

	<section class="content">
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid">					
					<div class="box-body">															
						<div class="chart-container" style="position: relative; height:auto; width:100%">
							<center><h3>BADAN BANK TANAH</h3></center>
                            <ul id="collapsul">
                                <?php

                                ?>
                                    <li id="collapsli"><span class="Collapsable"><?php if(!empty($kepala_badan)){echo $kepala_badan->pegawai_nama;}else{echo "Kepala Badan";}?> <strong>Kepala Badan Bank Tanah</strong></span>
                                        <ul id="collapsul">
                                            <li id="collapsli"><span class="Collapsable"><strong>---</strong></span>
                                                <ul id="collapsul">
                                                    <?php
                                                    foreach ($divisis as $divisi) {
                                                        if (empty($divisi->deputi_id)) {
                                                            $divisi_id = $divisi->divisi_id;
                                                            $pegawai_divisi = $this->db->select('t1.*, t2.*, t3.*, t4.*, t5.*, t6.*, t7.*, t8.pegawai_nama as atasan_langsung, t9.pegawai_nama as atasan_atasan')
                                                                              ->from('pegawai_karir as t1')
                                                                              ->where('t10.deputi_id', "NULL")
                                                                              ->where('t4.divisi_id', "$divisi_id")
                                                                              ->where('t6.jabatan_nama', 'Kepala Divisi')
                                                                              ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                                                                              ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                                                                              ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                                                                              ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                                                                              ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                                                                              ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                                                                              ->join('pegawai as t8', 't1.pegawai_atasan_langsung = t8.pegawai_id', 'LEFT')
                                                                              ->join('pegawai as t9', 't1.pegawai_atasan_atasan = t9.pegawai_id', 'LEFT')
                                                                              ->join('deputi as t10', 't1.deputi_id = t10.deputi_id', 'LEFT')
                                                                              ->get()
                                                                              ->row();
                                                    ?>
                                                        <li id="collapsli"><span class="Collapsable"><?php if(!empty($pegawai_divisi->pegawai_nama)){echo $pegawai_divisi->pegawai_nama;}else{echo "Kepala Divisi"; } ?> <strong>[<?=$divisi->divisi_nama?>]</strong></span>
                                                            <ul id="collapsul">
                                                                <?php
                                                                foreach ($bagians as $bagian) {
                                                                    if ($bagian->divisi_id == $divisi->divisi_id) {
                                                                ?>
                                                                <li id="collapslibag"><span class="Collapsable"><strong><?=$bagian->divisi_bagian_nama?></strong></span>
                                                                    <ul id="collapsul">
                                                                        <?php
                                                                        foreach ($pegawais as $pegawai) {
                                                                            if ($pegawai->divisi_bagian_id == $bagian->divisi_bagian_id && $pegawai->jabatan_nama == "Kepala Bagian") {
                                                                        ?>
                                                                        <li id="collapsli"><span class="Collapsable"><?=$pegawai->pegawai_nama?> <strong>[<?=$pegawai->jabatan_nama?>]</strong></span></li>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        foreach ($pegawais as $pegawai) {
                                                                            if ($pegawai->divisi_bagian_id == $bagian->divisi_bagian_id && $pegawai->jabatan_nama != "Kepala Bagian") {
                                                                        ?>
                                                                        <li id="collapsli"><span class="Collapsable"><?=$pegawai->pegawai_nama?> <strong>[<?=$pegawai->jabatan_nama?>]</strong></span></li>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        <?php
                                        foreach ($deputis as $deputi) {
                                            $deputi_id = $deputi->deputi_id;
                                            $pegawai_deputi = $this->db->select('t1.*, t2.*, t3.*, t4.*, t5.*, t6.*, t7.*, t8.pegawai_nama as atasan_langsung, t9.pegawai_nama as atasan_atasan')
                                                            ->from('pegawai_karir as t1')
                                                            ->where('t10.deputi_id', "$deputi_id")
                                                            ->where('t6.jabatan_nama', 'Deputi')
                                                            ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                                                            ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                                                            ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                                                            ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                                                            ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                                                            ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                                                            ->join('pegawai as t8', 't1.pegawai_atasan_langsung = t8.pegawai_id', 'LEFT')
                                                            ->join('pegawai as t9', 't1.pegawai_atasan_atasan = t9.pegawai_id', 'LEFT')
                                                            ->join('deputi as t10', 't1.deputi_id = t10.deputi_id', 'LEFT')
                                                            ->get()
                                                            ->row();
                                        ?>
                                            <li id="collapsli"><span class="Collapsable"><?php if(!empty($pegawai_deputi)){echo $pegawai_deputi->pegawai_nama;}else{echo "Deputi";} ?> <strong>[<?=$deputi->deputi_nama;?>]</strong></span>
                                                <ul id="collapsul">
                                                    <?php
                                                        foreach ($divisis as $divisi) {
                                                            if ($divisi->deputi_id == $deputi->deputi_id) {
                                                                $divisi_id = $divisi->divisi_id;
                                                                $pegawai_divisi = $this->db->select('t1.*, t2.*, t3.*, t4.*, t5.*, t6.*, t7.*, t8.pegawai_nama as atasan_langsung, t9.pegawai_nama as atasan_atasan')
                                                                                  ->from('pegawai_karir as t1')
                                                                                  ->where('t10.deputi_id', "$deputi_id")
                                                                                  ->where('t4.divisi_id', "$divisi_id")
                                                                                  ->where('t6.jabatan_nama', 'Kepala Divisi')
                                                                                  ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                                                                                  ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                                                                                  ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                                                                                  ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                                                                                  ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                                                                                  ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                                                                                  ->join('pegawai as t8', 't1.pegawai_atasan_langsung = t8.pegawai_id', 'LEFT')
                                                                                  ->join('pegawai as t9', 't1.pegawai_atasan_atasan = t9.pegawai_id', 'LEFT')
                                                                                  ->join('deputi as t10', 't1.deputi_id = t10.deputi_id', 'LEFT')
                                                                                  ->get()
                                                                                  ->row();
                                                    ?>
                                                        <li id="collapsli"><span class="Collapsable"><?php if(!empty($pegawai_divisi->pegawai_nama)){echo $pegawai_divisi->pegawai_nama;}else{echo "Kepala Divisi"; } ?> <strong>[<?=$divisi->divisi_nama?>]</strong></span>
                                                            <ul id="collapsul">
                                                                <?php
                                                                foreach ($bagians as $bagian) {
                                                                    if ($bagian->divisi_id == $divisi->divisi_id) {
                                                                ?>
                                                                    <li id="collapslibag"><span class="Collapsable"><strong><?=$bagian->divisi_bagian_nama?></strong></span>
                                                                        <ul id="collapsul">
                                                                            <?php
                                                                            foreach ($pegawais as $pegawai) {
                                                                                if ($pegawai->divisi_bagian_id == $bagian->divisi_bagian_id && $pegawai->jabatan_nama == "Kepala Bagian") {
                                                                            ?>
                                                                            <li id="collapsli"><span class="Collapsable"><?=$pegawai->pegawai_nama?> <strong>[<?=$pegawai->jabatan_nama?>]</strong></span></li>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            foreach ($pegawais as $pegawai) {
                                                                                if ($pegawai->divisi_bagian_id == $bagian->divisi_bagian_id && $pegawai->jabatan_nama != "Kepala Bagian") {
                                                                            ?>
                                                                            <li id="collapsli"><span class="Collapsable"><?=$pegawai->pegawai_nama?> <strong>[<?=$pegawai->jabatan_nama?>]</strong></span></li>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        <?php   
                                        }
                                        ?>
                                        </ul>
                                    </li>
                            </ul>


                            
                            <!-- <hr>
                            <ul id="collapsul">
                                <li id="collapsli"><span class="Collapsable">item 1</span>
                                    <ul id="collapsul">
                                        <li id="collapsli"><span class="Collapsable">item 1</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 2</span>
                                            <ul id="collapsul">
                                                <li id="collapsli"><span class="Collapsable">item 1</span></li>
                                                <li id="collapsli"><span class="Collapsable">item 2</span></li>
                                                <li id="collapsli"><span class="Collapsable">item 3</span></li>                                    <li><span class="Collapsable">item 4</span></li>
                                            </ul>
                                        </li>
                                        <li id="collapsli"><span class="Collapsable">item 3</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 4</span>
                                            <ul id="collapsul">
                                                <li id="collapsli"><span class="Collapsable">item 1</span></li>
                                                <li id="collapsli"><span class="Collapsable">item 2</span></li>
                                                <li id="collapsli"><span class="Collapsable">item 3</span></li>
                                                <li id="collapsli"><span class="Collapsable">item 4</span></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li id="collapsli"><span class="Collapsable">item 2</span>
                                    <ul id="collapsul">
                                        <li id="collapsli"><span class="Collapsable">item 1</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 2</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 3</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 4</span></li>
                                    </ul>
                                </li>
                                <li id="collapsli"><span class="Collapsable">item 3</span>
                                    <ul id="collapsul">
                                        <li id="collapsli"><span class="Collapsable">item 1</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 2</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 3</span></li>
                                        <li id="collapsli"><span class="Collapsable">item 4</span></li>
                                    </ul>
                                </li>
                                <li id="collapsli"><span class="Collapsable">item 4</span></li>
                            </ul> -->
						</div>						
					</div>
				</div>
			</div>	
		</div>

	</section>

</div>
