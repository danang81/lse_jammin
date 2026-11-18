<?php

class Md_report_lse extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('md_employee');
    }

    public function MDL_Select($start_date = '', $end_date = '') {
        $userid = $this->session->userdata('userid');
        $SQL =" select d.loading_port_name,c.importer_name,b.npwp,b.address,b.client_name,a.* from ttrs_lse a 

join tmst_client b
on a.client_id = b.client_id 
join tmst_importer c
on c.importer_id = a.importer_id
join tmst_loading_port d
on a.loading_port_id = d.loading_port_code 

WHERE a.recdate >= '$start_date'
                    AND a.recdate <= '$end_date'";
        $result = $this->db->query($SQL)->result();
        //$this->auth->TVD($result);die();
        
        return $result;
    }

   
    public function MDL_SelectReport($start_date = '', $end_date = '') {
       $userid = $this->session->userdata('userid');
        $SQL =" select d.loading_port_name,c.importer_name,b.npwp,b.address,b.client_name,a.* from ttrs_lse a 


join tmst_client b
on a.client_id = b.client_id 
join tmst_importer c
on c.importer_id = a.importer_id
join tmst_loading_port d
on a.loading_port_id = d.loading_port_code




WHERE a.recdate >= '$start_date'
                    AND a.recdate <= '$end_date'";
        
//         $SQL =" 
//
//select  d.loading_port_name,c.importer_name,b.npwp,b.address,b.client_name,a.*,
//e.klasifikasi_batubara,e.tm_arb,e.t_ash_adb,e.t_sulfur_adb,e.cal_adb,e.cal_arb,
//f.hs,f.description,
//g.*
// 
//from ttrs_lse a 
//
//
//join tmst_client b
//on a.client_id = b.client_id 
//join tmst_importer c
//on c.importer_id = a.importer_id
//join tmst_loading_port d
//on a.loading_port_id = d.loading_port_code
//
//
//
//left join (
//
//			select * from ttrs_lse_survres_cal  ) e
//on a.no_lse = e.id_lse
//left join (
//
//			select * from ttrs_lse_survres_hs  ) f
//
//on a.no_lse = f.id_lse
//
//left join (
//
//			select b.client_name as nama_buyer,x.* from ttrs_lse_survres_royalty x
//join tmst_client b
//on x.client_id = b.client_id 
//
// ) g
//
//on a.no_lse = g.id_lse
//
//
//
//WHERE a.recdate >= '$start_date'
//                    AND a.recdate <= '$end_date'";
        
        
        $result = $this->db->query($SQL)->result();
        //$this->auth->TVD($result);die();
        
        return $result;
    }
    
    
     public function MDL_SelectCal($no_lse) {
	
	$ttrs_lse_survres_cal = $this->config->item('ttrs_lse_survres_cal');
	
	$sSQL = "
               select * from $ttrs_lse_survres_cal where id_lse='$no_lse'
                ";

	$hasil = $this->db->query($sSQL)->result();
	
	return $hasil;
    }
    
    
         public function MDL_SelectHS($no_lse) {
	
	$ttrs_lse_survres_hs = $this->config->item('ttrs_lse_survres_hs');
	
	$sSQL = "
               select * from $ttrs_lse_survres_hs where id_lse='$no_lse'
                ";

	$hasil = $this->db->query($sSQL)->result();
	
	return $hasil;
    }
    
    
       public function MDL_Selectroyalty($no_lse) {
	
	$ttrs_lse_survres_royalty = $this->config->item('ttrs_lse_survres_royalty');
        $tblProvince = $this->config->item('tmst_province');
	
	$sSQL = "
               select p.province_name, b.client_name as nama_buyer,a.* from $ttrs_lse_survres_royalty a
                
               join tmst_client b
                on a.client_id = b.client_id 
                
                left join $tblProvince p
                on b.province = p.province_code

                where id_lse='$no_lse'
                ";

         //var_dump($sSQL);die();
	$hasil = $this->db->query($sSQL)->result();
	
	return $hasil;
    }
    
    public function MDL_SelectProduct($no_lse) {
	
	$ttrs_lse_survres_cal = $this->config->item('ttrs_lse_survres_cal');
	
	$sSQL = "
                SELECT variable_0, value_0 FROM ttrs_lse_mineral_variable lv

left join ttrs_lse_mineral_product mp on lv.id=mp.id_variable where no_lse='$no_lse'
                ";

	$hasil = $this->db->query($sSQL)->result();
	
	return $hasil;
    }
   

}

?>
