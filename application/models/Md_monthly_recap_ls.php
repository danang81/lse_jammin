<?php

class Md_monthly_recap_ls extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select($req_startdate, $req_enddate) {
        
        $hasil = array();
        $sSQL = "SELECT id,no_laporan, tgl_laporan, periode_bulan, periode_tahun,status_report
                FROM ttrs_monthly_recap_ls
                WHERE recdate  >= '$req_startdate' AND recdate  <= '$req_enddate'
                ";
        // $this->auth->TVD($sSQL);die();
        $ambil = $this->db->query($sSQL);
        foreach ($ambil->result() as $data) {
            $hasil[] = $data;
        }

        return $hasil;
    }

    public function MDL_SelectID($id){

        $sSQL = "
                SELECT *
                FROM ttrs_monthly_recap_ls
                WHERE id = '$id'
                ";

        $ambil = $this->db->query($sSQL);
        return $ambil->row();
    }

    public function MDL_SelectLS($id){
       // $tblLS = $this->config->item('ttrs_transaksi_ls');
        // $tblTransaksi = $this->config->item('ttrs_transaksi_ls'); 
        

        $ambil = $this->db->get_where('ttrs_transaksi_ls', array('id_recap_ls' => $id))->result();
        foreach($ambil as $row){
            $hasil[] = $row;
        }
        return $hasil;

    }

    public function MDL_Insert() {
        $tblrecap = $this->config->item('ttrs_monthly_recap_ls'); 
        $filepath_recap = $this->config->item('filepath_recap');
        $tblTransaksi = $this->config->item('ttrs_transaksi_ls'); 
        
        $userid = $this->session->userdata('userid');
        $recdate = date("Y-m-d H:i:s");
        
        $konfigurasi = array(
            'upload_path' => $filepath_recap,
            'allowed_types' => 'pdf',
            'max_size' => 300000,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE,
        );
        $this->load->library('upload', $konfigurasi);

        if (strlen($_FILES['attachment']['name'])) {
            if ($this->upload->do_upload('attachment')) {
                $attachment = $this->upload->data();
                $attachment = $attachment['file_name'];
            } else {
                $error = array('error' => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert($error);window.close();</script>";
                die();
            }
        }

        $data = $this->input->post();

        unset($data['btn_submit']);
        unset($data['id']);

        $data = array(
            'nib'           => $this->input->post('nib'),
            'tax_file'      => $this->input->post('tax_file'),
            'name'          => $this->input->post('name'),
            'no_laporan'    => $this->input->post('no_laporan'),
            'tgl_laporan'   => $this->input->post('tgl_laporan'),
            'periode_bulan' => $this->input->post('periode_bulan'),
            'periode_tahun' => $this->input->post('periode_tahun'),
            'userid'        => $userid,
            'recdate'       => $recdate,
            'status_report' => '0'  // by default status report = 0
        );

        if ($attachment) {
            $data['attachment'] = $attachment;
        }
       
        $this->db->insert($tblrecap, $data);
        $idRecap = $this->db->insert_id();

        $recap = $this->input->post('rekap');
        foreach ($recap as $key => $value) { 
            $data2 = array(
                'id_recap_ls'   => $idRecap,
                'jenis_ls'      => $value['jenis_lse'], 
                'id_ls'         => $value['id_jenis_lse'], 
                'total_terbit'  => $value['total_terbit'],
                'total_cabut'   => $value['total_cabut'],
                'total_rubah'   => $value['total_rubah']
            );
            
            $this->db->insert($tblTransaksi, $data2);
        }

        return  $idRecap;

    }

    public function MDL_getCompany() {
        $tblcompany = $this->config->item('tmst_company');

        $sSQL = "
        SELECT nib, tax_file, name
        FROM $tblcompany
        WHERE id = 'CMPY00001'
        ";

        $ambil = $this->db->query($sSQL);
        foreach ($ambil->result() as $data) {
            $hasil[] = $data;
        }
        return $hasil;
        
    }

    public function MDL_Count($periode_bulan, $periode_tahun){    
        
        $hasil = array();
        $sSQL = "
                SELECT a.id,a.commodity, b.jenis_lse, IFNULL(b.jumData, 0) as total_terbit, 
                        IFNULL(c.jumData, 0) as total_rubah,IFNULL(d.jumData, 0) as total_cabut
                FROM tmst_jenis_ls a
                    LEFT JOIN (
                         SELECT jenis_lse,detail_jenis_lse,laststatus_lse, count(*) as jumData
                         FROM ttrs_lse
                         WHERE laststatus_lse IN ('8')
                            AND MONTH(recdate) = $periode_bulan
                            AND YEAR(recdate) = $periode_tahun
                        GROUP BY jenis_lse,detail_jenis_lse,laststatus_lse 
                    ) b ON b.jenis_lse = a.commodity  

                    LEFT JOIN (
                         SELECT jenis_lse,detail_jenis_lse,laststatus_lse, count(*) as jumData
                         FROM ttrs_lse
                         WHERE laststatus_lse IN ('9')
                         AND MONTH(recdate) = $periode_bulan
                         AND YEAR(recdate) = $periode_tahun
                        GROUP BY jenis_lse,detail_jenis_lse,laststatus_lse 
                    ) c ON c.jenis_lse = a.commodity 

                    LEFT JOIN (
                         SELECT jenis_lse,detail_jenis_lse,laststatus_lse, count(*) as jumData
                         FROM ttrs_lse
                         WHERE laststatus_lse IN ('10')
                         AND MONTH(recdate) = $periode_bulan
                         AND YEAR(recdate) = $periode_tahun
                        GROUP BY jenis_lse,detail_jenis_lse,laststatus_lse 
                    ) d ON d.jenis_lse = a.commodity 

                WHERE 1=1
                AND a.active ='1'
                AND a.id = b.detail_jenis_lse
                ";
        //$this->auth->TVD($sSQL); exit();

        $ambil = $this->db->query($sSQL);
       
        if($ambil->num_rows() > 0){
            foreach($ambil->result() as $data){       
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_Update_StatusRekapLS($id) {

        $data = array(
                'status_report' => '1'
            );

        $this->db->where('id', $id);
        $this->db->update('ttrs_monthly_recap_ls', $data);
    }
}

?>
