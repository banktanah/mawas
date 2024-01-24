<?php
    function get_karier($id_pegawai)
    {
        $data = $this->db->select('*')
						  ->from('pegawai_karir as t1')
                          ->where('t1.pegawai_id', $id_pegawai)
						  ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                          ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                          ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                          ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                          ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                          ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                          ->order_by("tgl_awal", "DESC")
						  ->get()
						  ->result();

        return $data;
    }
?>