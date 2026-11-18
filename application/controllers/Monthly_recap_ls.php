<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Monthly_recap_ls extends CI_Controller {
 
    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('Md_monthly_recap_ls');
        
        $this->tblNamehs = $this->config->item('ttrs_monthly_recap_ls');
        $this->field = 'id';
    }

    public function index() {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('list')) {
            $data['action'] = 'list';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            /* Bread crum */
            $this->load->model('md_ref_json');
            $params = $this->router->fetch_class();
            $hasil = $this->md_ref_json->MDL_SelectMenu($params);
            $parentt = $hasil->parentt;
            $nm_menu = $hasil->custom_title;
            $path_icon = $hasil->path_icon;
            $this->breadcrumbs->add($parentt, '#', $path_icon);
            $this->breadcrumbs->add($nm_menu, current_url());
            $breadcrum = $this->breadcrumbs->output();
            $data['breadcrum'] = $breadcrum;
            /* end */

            $req_startdate = $this->input->post('req_startdate');
            $req_startdate = strlen($req_startdate) ? $req_startdate : date("Y-m-01");
            $req_enddate = $this->input->post('req_enddate');
            $req_enddate = strlen($req_enddate) ? $req_enddate : date("Y-m-t");

            $data['req_startdate'] = $req_startdate;
            $data['req_enddate'] = $req_enddate;

            $data['results'] = $this->Md_monthly_recap_ls->MDL_Select($req_startdate, $req_enddate);

            
            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%MonthlyRecapLs/CTRL_View/", site_url());
            $data['page'] = 'MonthlyRecapLs/view';
            $data['plugin'] = 'MonthlyRecapLs/plugin';
            $this->load->view('template_admin', $data);
        }
    }

    public function CTRL_New() {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('add')) {
            $data['action'] = 'add';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('Monthly_recap_ls');
            } elseif ($this->input->post('btn_submit')) {
                $recap = $this->input->post('rekap');
                $idRecap = $this->Md_monthly_recap_ls->MDL_Insert();
                redirect('Monthly_recap_ls/CTRL_Edit/'.$idRecap);
            } else {
                /* Bread crum */
                $this->load->model('md_ref_json');
                $params = $this->router->fetch_class();
                $hasil = $this->md_ref_json->MDL_SelectMenu($params);
                $parentt = $hasil->parentt;
                $nm_menu = $hasil->custom_title;
                $url_menu = $hasil->url_menu;
                $path_icon = $hasil->path_icon;
                $this->breadcrumbs->add($parentt, '#', $path_icon);
                $this->breadcrumbs->add($nm_menu, base_url() . $url_menu);
                $this->breadcrumbs->add('Add New', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $dataCompany = $this->Md_monthly_recap_ls->MDL_getCompany();
                /* DATA FORM */
                foreach($dataCompany  as $row){
                    $row->id = $row->nib;
                    $row->id = $row->tax_file;
                    $row->id = $row->name;
                }
                
                $data['nib'] = $row->nib;
                $data['npwp'] = $row->tax_file;
                $data['name'] = $row->name;
                /* END DATA FORM */

                /* DATA OPTION FORM */
                $Arybulan=array('01'=>"Januari",'02'=>"Februari",'03'=>"Maret",'04'=>"April",'05'=>"Mei",'06'=>"Juni",'07'=>"Juli",'08'=>"Agustus",'09'=>"September",'10'=>"Oktober",'11'=>"November",'12'=>"Desember");    

                $data['option_bulan'] = $Arybulan;

                $Arytahun = $this->CTRL_Option_Year();
                $data['option_tahun'] = $Arytahun;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add New", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);

                
                $data['url'] = 'Monthly_recap_ls/CTRL_New';
                $data['page'] = 'MonthlyRecapLs/form';
                $data['plugin'] = 'MonthlyRecapLs/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Edit($id=''){
        if(!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif(!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        }  else {
            if ($this->input->post('close')) {
                redirect('Monthly_recap_ls');
            } elseif ($this->input->post('btn_sendtoinatrade')) {
                $id = $this->input->post('id');
                
                $result = $this->CTRL_SendRecapLS($id); 
                print "
                    <script type=\"text/javascript\">
                        alert('".$result."');  
                        window.location.href = document.referrer;
                    </script>
                ";
                redirect('Monthly_recap_ls');
            } else {
                /* Bread crum */
                $this->load->model('md_ref_json');
                $params = $this->router->fetch_class();
                $hasil = $this->md_ref_json->MDL_SelectMenu($params);
                $parentt = $hasil->parentt;
                $nm_menu = $hasil->custom_title;
                $url_menu = $hasil->url_menu;
                $path_icon = $hasil->path_icon;
                $this->breadcrumbs->add($parentt, '#', $path_icon);
                $this->breadcrumbs->add($nm_menu, base_url().$url_menu);
                $this->breadcrumbs->add('Update', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $hasil = $this->Md_monthly_recap_ls->MDL_SelectID($id);
                
                $data['id']             = $hasil->id;
                $data['nib']            = $hasil->nib;
                $data['tax_file']       = $hasil->tax_file;
                $data['name']           = $hasil->name;
                $data['no_laporan']     = $hasil->no_laporan;
                $data['tgl_laporan']    = $hasil->tgl_laporan;
                $data['periode_bulan']  = $hasil->periode_bulan;
                $data['periode_tahun']  = $hasil->periode_tahun;
                $data['no_laporan']     = $hasil->no_laporan;
                $data['attachment']     = $hasil->attachment;
                $data['status_report']  = $hasil->status_report;
               
                $data['results'] = $this->Md_monthly_recap_ls->MDL_SelectLS($id);
            
                $Arybulan=array('01'=>"Januari",'02'=>"Februari",'03'=>"Maret",'04'=>"April",'05'=>"Mei",'06'=>"Juni",'07'=>"Juli",'08'=>"Agustus",'09'=>"September",'10'=>"Oktober",'11'=>"November",'12'=>"Desember");    
                $data['option_bulan'] = $Arybulan;              

                $Arytahun = $this->CTRL_Option_Year();
                $data['option_tahun'] = $Arytahun;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Update",$nm_title);
                $data['title'] = sprintf("%s",$nm_title);
                $data['url'] = 'Monthly_recap_ls/CTRL_Edit/'. $id;
                $data['page'] = 'MonthlyRecapLs/form_edit';
                $data['plugin'] = 'MonthlyRecapLs/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Option_Bulan() {

        $selected_month = date('m'); //current month

        $bulan=array('01'=>"Januari",'02'=>"Februari",'03'=>"Maret",'04'=>"April",'05'=>"Mei",'06'=>"Juni",'07'=>"Juli",'08'=>"Agustus",'09'=>"September",'10'=>"Oktober",'11'=>"November",'12'=>"Desember");    

        for($c=0; $c<12; $c+=1){
            echo"$bulan[$c]";
        }
        return $bulan;
        
    }

    public function CTRL_Option_Year() {
        $current_year = date('Y');
        $latest_year = date('Y-m-d',strtotime($current_year . "- 3 years"));

        foreach (range(date('Y'), $latest_year) as $data ) {
           $value[$data] = $data;
        }

        return $value;
    }
    
    public function countData(){

        $periode_bulan = $_POST['periode_bulan'];
        $periode_tahun = $_POST['periode_tahun'];

        $dataPeriode = $this->Md_monthly_recap_ls->MDL_Count($periode_bulan,$periode_tahun);

        echo json_encode(array('result' => $dataPeriode));
    }

    public function getAllDatas($req_startdate, $req_enddate) {
        $req_startdate = strlen($req_startdate) ? $req_startdate : date("Y-m-01");
        $req_enddate = strlen($req_enddate) ? $req_enddate : date("Y-m-t");

        $results = $this->Md_monthly_recap_ls->MDL_Select($req_startdate, $req_enddate);
        
        echo json_encode($results);
    }

    public function CTRL_SendRecapLS($id){
        
         $url = "https://services.kemendag.go.id/surveyor/1.0/rekap_bulanan";          // URL PRODUCTION
        // $url = "https://services.kemendag.go.id/surveyor/v1.0.dev/rekap_bulanan";        // URL STAGING

        $sql = $this->db->query("
              SELECT a.*
              FROM ttrs_monthly_recap_ls a
              WHERE id = '$id'
            ")->row();

        $url_upload = base_url()."file_upload/monthly_recap_ls/".$sql->attachment;
       
        $detail_ls = $this->Md_monthly_recap_ls->MDL_SelectLS($id); 
        $detail_laporan = array();
        foreach ($detail_ls as $row_detail) {
            $detail_laporan[] = array(
                "jenis_ls"          => $row_detail->id_ls,
                "total_terbit"      => $row_detail->total_terbit,
                "total_rubah"       => $row_detail->total_rubah,
                "total_beku"        => "0",
                "total_bekuaktif"   => "0",
                "total_panjang"     => "0",
                "total_cabut"       => $row_detail->total_cabut,
                "total_batal"       => "0",
            );
        }
       
        $data = array(
                        "nib"            => $sql->nib,
                        "npwp"           => $sql->tax_file,
                        "nama_surveyor"  => $sql->name,
                        "no_laporan"     => $sql->no_laporan,
                        "tgl_laporan"    => $sql->tgl_laporan,
                        "periode"        => array([
                                               "bulan"          => $sql->periode_bulan,
                                               "tahun"          => $sql->periode_tahun,
                                               "detail_laporan" => $detail_laporan,
                                               "fl_multi_bulan" => "N",
                                            ]),
                        "referensi"     =>  array([
                                              "url_laporan" => $url_upload,
                                            ]),
                        "username"      => "jammin"
                );

        $data_json = json_encode($data,JSON_UNESCAPED_SLASHES);
        
        // Send request to Server
        $ch = curl_init($url);
        
        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
        /* set the content type json */

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'x-Gateway-APIKey:ab6eba5d-79db-4938-b007-8ee45179daaf',
            'Content-Type:application/json',
        ));

        $result = curl_exec($ch);
        
        /* close cURL resource */   
        
        curl_close($ch);
        //echo $result;

        $final_result = json_decode($result);
        
        $my_array = (array)$final_result;

        $kode = $my_array['kode'];
        $message = $my_array['keterangan'];

        if($kode =='200'){
            $alert = $kode.' - '.$message.' Rekap Bulanan LS terkirim ke INATRADE';
            $this->Md_monthly_recap_ls->MDL_Update_StatusRekapLS($id);
        }else{
            $message_error = $my_array['data'][0];
            $error = $message_error->keterangan;
            $alert = 'Gagal terkirim - '.$error;
        }
        
        return $alert;
    }
}