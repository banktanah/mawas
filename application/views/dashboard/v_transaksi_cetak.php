<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style type="text/css">
        p{
            margin: 5px 0 0 0;
        }
        p.footer{
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
            display: block;
        }
        .bold{
            font-weight: bold;
        }

        #footer {
            clear: both;
            position: relative;
            height: 40px;
            margin-top: -40px;
        }
    </style>
</head>
<body style="font-size: 12px">
    <p align="center"> 
        <span style="font-size: 18px"><b>LAPORAN RENCANA DAN REALISASI <br> BADAN BANK TANAH</b></span> <br>
    </p>

    <hr>

    <p>
        <table>
            <?php 
            $idProject="";
            foreach ($project as $p) {
                ?>
                <tr>
                    <th  align="left">Nama</th>
                    <th width="1px">:</th>
                    <td><?php echo $p->project_nama ?></td>
                </tr>
                <tr>
                    <th  align="left">Lokasi</th>
                    <th width="1px">:</th>
                    <td><?php echo $p->project_lokasi ?></td>
                </tr>

                <tr>
                    <th  align="left">Periode</th>
                    <th width="1px">:</th>
                    <td><?php echo $p->project_periode ?></td>
                </tr>

                <?php   
                $idProject = $p->project_id;
            }
            ?>

        </table>
    </p>



    <p>
        <table style="border: 1px solid black;border-collapse: collapse;font-size: 11px" width="100%">
            <tr style="margin: 5px">
                <th rowspan="2" style="border: 1px solid black;">URAIAN PEKERJAAN</th>
                <th rowspan="2" style="border: 1px solid black;">SATUAN</th>
                <th colspan="4" style="border: 1px solid black;">RENCANA BDP</th>
                <th colspan="4" style="border: 1px solid black;">REALISASI BDP</th>                
                <th rowspan="2" style="border: 1px solid black;">SISA</th>
                <th rowspan="2" style="border: 1px solid black;">KETERANGAN</th>
            </tr>
            <tr style="margin: 5px">
                <th style="border: 1px solid black;">Volume</th>
                <th style="border: 1px solid black;">Harga Satuan (Rp.)</th>
                <th style="border: 1px solid black;">Jumlah (Rp.)</th>
                <th style="border: 1px solid black;">Total (Rp.)</th>
                <th style="border: 1px solid black;">Volume</th>
                <th style="border: 1px solid black;">Harga Satuan (Rp.)</th>
                <th style="border: 1px solid black;">Jumlah (Rp.)</th>
                <th style="border: 1px solid black;">Total (Rp.)</th>

            </tr>
                <?php 
                foreach ($data as $d) {
                     // code...
                    $idKat = $d->transaksi_kategori;
                    ?>
                    <tr style="margin:5px">
                        <td colspan="5" style="border: 1px solid black;"><b><?php echo $d->kategori_nama; ?></b></td>
                        <?php
                        $totx = $this->db->query("select sum(transaksi_rencana_jumlah) as total from transaksi where transaksi_project='$idProject' and transaksi_kategori='$idKat'")->row();
                        $toty = $this->db->query("select sum(realisasi_jumlah_harga) as total from realisasi where realisasi_project='$idProject' and realisasi_kategori='$idKat'")->row();

                        ?>

                        <td style="border: 1px solid black;"><b><?php echo "Rp.". number_format($totx->total) ?></b></td>
                        <td colspan="3"></td>   
                        <td style="border: 1px solid black;"><b><?php echo "Rp.". number_format($toty->total) ?></b></td>
                        <td style="border:1px solid black;" colspan="2">
                            <?php 
                            $x = $totx->total;
                            $y = $toty->total;
                            $hasil = abs($x-$y);                                                
                            ?>
                            <b><?php echo number_format($hasil) ?></b>
                        </td>
                        
                    </tr>                    
                    <?php

                    $sub = $this->db->query("select * from transaksi, sub_kategori where transaksi_project='$idProject' and transaksi_kategori='$idKat' and transaksi_sub_kategori=sub_id order by transaksi_kategori")->result();
                    foreach ($sub as $s) {
                        // code...
                        $idSub = $s->sub_id;
                        $id_kategori = $s->transaksi_kategori;
                        $id_transaksi = $s->transaksi_id;

                        ?>
                        <tr>
                            <td style="border:1px solid black;"><center><?php echo $s->nama ?></center></td>
                            <td style="border:1px solid black;"><center><?php echo $s->satuan ?></center></td>
                            <td style="border:1px solid black;"><?php echo "Rp.".number_format($s->transaksi_rencana_volume) ?></td>
                            <td style="border:1px solid black;"><?php echo "Rp.".number_format($s->transaksi_rencana_harga) ?></td>
                            <td style="border:1px solid black;"><?php echo "Rp.".number_format($s->transaksi_rencana_jumlah) ?></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;">
                                <?php
                                $real = $this->db->query("select realisasi_volume from realisasi where realisasi_transaksi='$id_transaksi'")->result();
                                foreach ($real as $r) {
                                                            // code...
                                    ?>                                                          
                                    <?php echo "Rp.".number_format($r->realisasi_volume) ?><br>

                                    <?php
                                }

                                ?>
                            </td>
                            <td style="border:1px solid black;">
                                <?php
                                $real = $this->db->query("select realisasi_harga_satuan from realisasi where realisasi_transaksi='$id_transaksi'")->result();
                                foreach ($real as $r) {
                                                            // code...
                                    ?>                                                          
                                    <?php echo "Rp.".number_format($r->realisasi_harga_satuan) ?><br>

                                    <?php
                                }

                                ?>
                            </td>
                            <td style="border:1px solid black;">
                                <?php
                                $real = $this->db->query("select realisasi_jumlah_harga from realisasi where realisasi_transaksi='$id_transaksi'")->result();
                                foreach ($real as $r) {
                                                            // code...
                                    ?>                                                          
                                    <?php echo "Rp.".number_format($r->realisasi_jumlah_harga) ?><br>

                                    <?php
                                }

                                ?>
                            </td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"></td>
                            <td style="border:1px solid black;"><?php echo $s->transaksi_keterangan ?></td>
                        </tr>
                        <?php
                    }

                }
                ?>            

            <tr>
                <th colspan="5" style="border:1px solid black;"><center>TOTAL</center></th>
                <th style="border:1px solid black;">
                    <?php
                    $cek = $this->db->query("select sum(transaksi_rencana_jumlah) as total_rencana from transaksi where transaksi_project='$idProject'")->row();
                    echo "Rp.".number_format($cek->total_rencana);
                    ?>
                </th>
                <th colspan="3" style="border:1px solid black;"></th>
                <th style="border:1 solid black;" colspan="3">
                    <?php
                    $cek = $this->db->query("select sum(realisasi_jumlah_harga) as total_realisasi from realisasi where realisasi_project='$idProject'")->row();
                    echo "Rp.". number_format($cek->total_realisasi);
                    ?>
                </th>

            </tr> 



        </table>


    </p>



</body>
</html>