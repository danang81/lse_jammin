<?php

class Md_penjualan_provisional extends CI_Model {

    public function MDL_Select($start_date, $end_date){
        $tbl_penjualan_provisional = $this->config->item('ttrs_penjualan_provisional');
        
        $hasil = array();
        $sSQL = "
                SELECT i.*
                FROM $tbl_penjualan_provisional i
                WHERE 1=1
                    AND i.recdate >= '$start_date'
                    AND i.recdate <= '$end_date'
                ORDER BY i.id ASC        
        ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil['data'][] = $data;
            }
            return $hasil;
        } else {
            return $hasil['data'] = array('data' => []);
        }
    }
}
?>