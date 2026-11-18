<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class List_lse extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('md_lse');
        $this->load->model('md_list_lse');
        $this->load->model('md_template_email');
        $this->load->model('md_branch');
        $this->load->model('md_ref_json');

        $this->tblName = $this->config->item('tmst_insw');
        $this->tblNamehs = $this->config->item('ttrs_insw_survres_hs');
        $this->tblNameroy = $this->config->item('ttrs_insw_survres_royalty');
        $this->tblNamecal = $this->config->item('ttrs_insw_survres_cal');
        $this->tblNamekerjasama = $this->config->item('tmst_kerjasama_insw');
        $this->field = 'id';
        $this->field_no_lse = 'no_lse';
        $this->field_pid = 'pid_barang';
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

            $data['results'] = $this->md_list_lse->MDL_Select($req_startdate, $req_enddate);

            
            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%list_lse/CTRL_View/", site_url());
            $data['page'] = 'list_lse/view';
            $data['plugin'] = 'list_lse/plugin';
            $this->load->view('template_admin', $data);
        }
    }

    public function getAllDatas($req_startdate, $req_enddate) {
        $req_startdate = strlen($req_startdate) ? $req_startdate : date("Y-m-01");
        $req_enddate = strlen($req_enddate) ? $req_enddate : date("Y-m-t");

        $results = $this->md_list_lse->MDL_Select($req_startdate, $req_enddate);
        
        echo json_encode($results);
    }
    
    public function CTRL_View_Detail($id) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id, $this->tblName, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('btn_submit')) {
                $res = $this->md_list_lse->MDL_UpdateIssuingOffice($id);
                
                if($res){
                    $this->session->set_flashdata('msgsubmit', array('title' => 'Success!', 'message' => 'Data Has Been Updated', 'class' => 'alert alert-success'));
                }
                redirect('list_lse/CTRL_View_Detail/'.$id);
            }  elseif ($this->input->post('btn_submit2')) {
                $res2 = $this->md_list_lse->MDL_UpdateSurvey($id);
                if($res2){
                    $this->session->set_flashdata('msgsave', array('title' => 'Success!', 'message' => 'Data Has Been Saved', 'class' => 'alert alert-success'));
                }
                redirect('list_lse/CTRL_View_Detail/' . $id . '/#FormC');
            } elseif ($this->input->post('btn_inatrade')) {  
                //$result = $this->CTRL_SendXML2_1(); 
                $jnspengajuan = 1;
                $result = $this->send_doc_simbara($jnspengajuan); 

                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }

            } elseif ($this->input->post('btn_rubah_ls')) {  
                $jnspengajuan = 2;
                $result = $this->send_doc_simbara($jnspengajuan); 
                
                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }
            } elseif ($this->input->post('btn_submit_coa')) {

                $prev_file  = $this->input->post('prev_file');
                $no_lse     = $this->input->post('no_lse');
                $cek_coa    = $this->md_list_lse->MDL_SelectNew_SR3($no_lse);
                if ($cek_coa){
                    $res2 = $this->md_list_lse->MDL_UPDATECOA($no_lse);
                } else {
                    $res2 = $this->md_list_lse->MDL_INSERTCOA();
                }

                if($res2){
                    $this->session->set_flashdata('msgsave_coa', array('title' => 'Success!', 'message' => 'Data Has Been Saved', 'class' => 'alert alert-success'));
                }
                redirect('list_lse/CTRL_View_Detail/' . $id . '/#FormCOA');

            } elseif ($this->input->post('btn_send_coa')) {
                $jnspengajuan = 1;
                $result = $this->send_coa($jnspengajuan);

                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }
            } elseif ($this->input->post('btn_ubah_coa')) {
                $jnspengajuan = 2;
                $result = $this->send_coa($jnspengajuan); 
                
                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }
             } elseif ($this->input->post('btn_batal_coa')) {
                $jnspengajuan = 9;
                $result = $this->send_coa($jnspengajuan); 
                
                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }
             } elseif ($this->input->post('btn_send_cow')) {
                $jnspengajuan = 1;
                $result = $this->send_cow($jnspengajuan);

                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }
            } elseif ($this->input->post('btn_ubah_cow')) {
                $jnspengajuan = 2;
                $result = $this->send_cow($jnspengajuan); 

                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }
            } elseif ($this->input->post('btn_batal_cow')) {
                $jnspengajuan = 9;
                $result = $this->send_cow($jnspengajuan); 
                
                if ($result->kode == '200'){
                    $message = $result->data->keterangan;
                    print "
                        <script type=\"text/javascript\">
                            alert('".$message."');  
                            window.location.href = document.referrer;
                        </script>
                    ";
                }
                else {
                    $this->auth->TVD($result); exit();
                }
             } elseif ($this->input->post('btn_submit_cow')) {

                $no_lse = $this->input->post('no_lse');
                $cek_cow = $this->md_list_lse->MDL_SelectNew_COW($no_lse);
                
                if ($cek_cow){
                    $res_cow = $this->md_list_lse->MDL_UPDATECOW($no_lse);
                } else {
                    $res_cow = $this->md_list_lse->MDL_INSERTCOW();
                }

                if($res_cow){
                    $this->session->set_flashdata('msgsave', array('title' => 'Success!', 'message' => 'Data Has Been Saved', 'class' => 'alert alert-success'));
                }
                redirect('list_lse/CTRL_View_Detail/' . $id . '/#FormCOW');  
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
                $this->breadcrumbs->add('Update', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $data['disabled'] = "";
                
                $hasil = $this->md_list_lse->MDL_Select_Detail($id);
                 if ($hasil->no_lse == ''){
                    $data['no_lse'] = $this->md_list_lse->MDL_getAutoID2();
                } else {
                    $data['no_lse'] = $hasil->no_lse;
                }
                
                $data['sign'] = $this->md_list_lse->MDL_GetBranchSign($hasil->branch_id);
                // $this->auth->TVD($data['sign']);
                // die();

                $AryBranch = $this->CTRL_Option_Branch();
                $data['branch'] = strlen($this->input->post('branch_id')) ? $this->input->post('branch_id') : $hasil->branch_id;
                $data['branch_name'] = $hasil->branch;
                $data['option_branch'] = $AryBranch;

                $AryCommodity = $this->CTRL_Option_Commodity();
                $data['commodity'] = '';
                $data['option_commodity'] = $AryCommodity;


                $AryDetailLSE = $this->CTRL_Option_Detail_Commodity('COAL');
                $data['option_detail_jenis_lse'] = $AryDetailLSE;

                $data['file_lse']   = $hasil->file_lse;
                $data['id'] = $hasil->id;
                $data['nomorAju'] = $hasil->nomorAju;
                $data['tanggalAju'] = $hasil->tanggalAju;
                $data['nomorPermohonan'] = $hasil->nomorPermohonan;
                $data['tglPermohonan'] = $hasil->tglPermohonan;
                $data['seriperubahan'] = $hasil->seriperubahan;
                $data['jnspengajuan'] = $hasil->jenis_pengajuan;
                $data['perihal'] = $hasil->perihal;
                $data['tglVerifikasi'] = $hasil->tglVerifikasi;
                $data['waktuVerifikasi'] = $hasil->waktuVerifikasi;
                $data['kodeLokasi'] = $hasil->kodeLokasi;
                $data['namaLokasi'] = $hasil->namaLokasi;
                $data['eksportir_nomorIdentitas'] = $hasil->eksportir_nomorIdentitas;
                $data['eksportir_nib'] = $hasil->eksportir_nib;
                $data['eksportir_nitku'] = $hasil->eksportir_nitku;
                $data['eksportir_namaPerusahaan'] = $hasil->eksportir_namaPerusahaan;
                $data['eksportir_alamatPerusahaan'] = $hasil->eksportir_alamatPerusahaan;
                $data['eksportir_teleponPerusahaan'] = $hasil->eksportir_teleponPerusahaan;
                $data['eksportir_faxPerusahaan'] = $hasil->eksportir_faxPerusahaan;
                $data['eksportir_emailPerusahaan'] = $hasil->eksportir_emailPerusahaan;
                $data['eksportir_jenisIup'] = $hasil->iup;
                $data['eksportir_nomorIup'] = $hasil->eksportir_nomorIup;
                $data['eksportir_nomorEt'] = $hasil->eksportir_nomorEt;
                $data['eksportir_namaCp'] = $hasil->eksportir_namaCp;
                $data['eksportir_jabatanCp'] = $hasil->eksportir_jabatanCp;
                $data['eksportir_teleponCp'] = $hasil->eksportir_teleponCp;
                $data['eksportir_emailCp'] = $hasil->eksportir_emailCp;
                $data['imp_namaPerusahaan'] = $hasil->imp_namaPerusahaan;
                $data['imp_negaraPerusahaan'] = $hasil->imp_negaraPerusahaan;
                $data['imp_alamatPerusahaan'] = $hasil->imp_alamatPerusahaan;
                $data['imp_teleponPerusahaan'] = $hasil->imp_teleponPerusahaan;
                $data['imp_faxPerusahaan'] = $hasil->imp_faxPerusahaan;
                $data['imp_emailPerusahaan'] = $hasil->imp_emailPerusahaan;
                $data['seriDokumen'] = $hasil->seriDokumen;
                $data['kodeDokumen'] = $hasil->kodeDokumen;
                $data['namaDokumen'] = $hasil->namaDokumen;
                $data['nomorDokumen'] = $hasil->nomorDokumen;
                $data['tanggalDokumen'] = $hasil->tanggalDokumen;
                $data['urlDokumen'] = $hasil->urlDokumen;
                $data['kodeCaraPengirim'] = $hasil->kodeCaraPengirim;
                $data['namaCaraPengirim'] = $hasil->namaCaraPengirim;
                $data['namaAlatPengirim'] = $hasil->namaAlatPengirim;
                $data['ukuranTongkang'] = $hasil->ukuranTongkang;
                $data['tanggalPemuatanAwal'] = ($hasil->tanggalPemuatanAwal == '0000-00-00' || $hasil->tanggalPemuatanAwal == '' ) ? ' ' : date("Y-m-d", strtotime($hasil->tanggalPemuatanAwal));
                $data['tanggalPemuatanAkhir'] = ($hasil->tanggalPemuatanAkhir == '0000-00-00' || $hasil->tanggalPemuatanAkhir == '' ) ? ' ' : date("Y-m-d", strtotime($hasil->tanggalPemuatanAkhir));
                $data['pelabuhan_kodeKegiatan'] = $hasil->pelabuhan_kodeKegiatan;
                $data['pelabuhan_uraianKegiatan'] = $hasil->pelabuhan_uraianKegiatan;
                $data['pelabuhan_kodePelabuhan'] = $hasil->pelabuhan_kodePelabuhan;
                $data['pelabuhan_namaPelabuhan'] = $hasil->pelabuhan_namaPelabuhan;
                $data['pelabuhan_namaNegara'] = $hasil->pelabuhan_namaNegara;
                $data['penjualan'] = $hasil->nama_penjualan;
                $data['lokasiMuatVessel'] = $hasil->nama_vessel;
                $data['perusahaanAsuransiKapal_nmPerusahaan'] = $hasil->perusahaanAsuransiKapal_nmPerusahaan;
                $data['perusahaanAsuransiKapal_noPolisSertifikat'] = $hasil->perusahaanAsuransiKapal_noPolisSertifikat;
                $data['perusahaanAsuransiKapal_noSertifikat'] = $hasil->perusahaanAsuransiKapal_noSertifikat;
                $data['perusahaanAsuransiCargo_nmPerusahaan'] = $hasil->perusahaanAsuransiCargo_nmPerusahaan;
                $data['perusahaanAsuransiCargo_noPolisSertifikat'] = $hasil->perusahaanAsuransiCargo_noPolisSertifikat;
                $data['perusahaanAsuransiCargo_noSertifikat'] = $hasil->perusahaanAsuransiCargo_noSertifikat;
                $data['kodeProses'] = $hasil->kodeProses;
                $data['api_key'] = $hasil->api_key;
                $data['recdate'] = $hasil->recdate;
                $data['date_issued'] = ($hasil->date_issued == '0000-00-00' || $hasil->date_issued == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_issued));
                $data['date_expired'] = ($hasil->date_expired == '0000-00-00' || $hasil->date_expired == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_expired));
                $data['no_wo'] = $hasil->no_wo;
                $data['date_wo'] = ($hasil->date_wo == '0000-00-00' || $hasil->date_wo == '')? ' ' : date("Y-m-d", strtotime($hasil->date_wo));
                $data['survey_location'] = $hasil->survey_location;
                $data['survey_location_date'] = ($hasil->survey_location_date == '0000-00-00' || $hasil->survey_location_date == '') ? ' ' : date("Y-m-d", strtotime($hasil->survey_location_date));
                $data['date_reg_exporter'] =  ($hasil->date_reg_exporter == '0000-00-00' || $hasil->date_reg_exporter == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_reg_exporter));
                $data['eksportir_tanggal_Iup'] =  ($hasil->eksportir_tanggal_Iup == '0000-00-00' || $hasil->eksportir_tanggal_Iup == '') ? ' ' : date("Y-m-d", strtotime($hasil->eksportir_tanggal_Iup));
                $data['no_invoice_packing_list'] = $hasil->no_invoice_packing_list;
                $data['date_invoice_packing_list'] =  ($hasil->date_invoice_packing_list == '0000-00-00' || $hasil->date_invoice_packing_list == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_invoice_packing_list));
                $data['no_packing_list'] = $hasil->no_packing_list;
                $data['date_packing_list'] = ($hasil->date_packing_list == '0000-00-00' || $hasil->date_packing_list == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_packing_list));
                $data['no_mining_license'] = $hasil->no_mining_license;
                $data['date_mining_license'] = ($hasil->date_mining_license == '0000-00-00' || $hasil->date_mining_license == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_mining_license));

                $data['no_transsell_license'] = $hasil->no_transsell_license;
                $data['date_transsell_license'] = ($hasil->date_transsell_license == '0000-00-00' || $hasil->date_transsell_license == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_transsell_license));
                $data['no_smelter_license'] = $hasil->no_smelter_license;
                $data['date_smelter_license'] = ($hasil->date_smelter_license == '0000-00-00' || $hasil->date_smelter_license == '') ? ' ' : date("Y-m-d", strtotime($hasil->date_smelter_license));
                $data['stdate_load_vessel'] =  ($hasil->stdate_load_vessel == '0000-00-00' || $hasil->stdate_load_vessel == '') ? ' ' : date("d M Y", strtotime($hasil->stdate_load_vessel));
                $data['enddate_load_vessel'] =  ($hasil->enddate_load_vessel == '0000-00-00' || $hasil->enddate_load_vessel == '') ? ' ' : date("d M Y", strtotime($hasil->enddate_load_vessel));
                $data['transit_port'] = $hasil->transit_port;
                $data['transit_country'] = $hasil->transit_country;

                $AryCountry = $this->CTRL_Option_Country();
                $data['country'] = $hasil->country_id;
                $data['option_country'] = $AryCountry;

                $data['jenis_lse'] = $hasil->jenis_lse;
                $data['detail_jenis_lse'] = $hasil->nama_ls;
                $data['mode_transport'] = $hasil->mode_transport;
                $data['cargo_type'] = $hasil->cargo_type;
                $data['container_numseal'] = $hasil->container_numseal;
                $data['note'] = $hasil->note;
                $data['pelabuhan_namaNegara'] = $hasil->pelabuhan_namaNegara;


                $data['pid_barang'] = $hasil->pid_barang;


                // Tab 2
                $data['results2'] = $this->md_list_lse->MDL_SelectSR1($data['nomorPermohonan']);
                // $this->auth->TVD($data['results2']);
                // die();
                $data['results3'] = $this->md_list_lse->MDL_SelectSR2($data['nomorPermohonan']);
                // $this->auth->TVD($data['results3']);
                // die();
                $data['results4'] = $this->md_list_lse->MDL_SelectSR3($data['no_lse']);
                // $this->auth->TVD($data['results4']);
                // die();
                // Tab 3
                $data['barang'] = $this->md_list_lse->MDL_SelectBarang($data['id']); 
                //$this->auth->TVD($data['barang']);
                //die();

                $result_coa = $this->md_list_lse->MDL_SelectNew_SR3($data['no_lse']);
                
                if ($result_coa) {
                    $data['coa_no']                 = $result_coa->coa_no;
                    $data['tgl_coa']                = $result_coa->tgl_coa;
                    $data['tgl_periksa_sample']     = $result_coa->tgl_periksa_sample;
                    $data['file_coa']               = $result_coa->file_coa;
                    $data['t_ash_adb']              = $result_coa->t_ash_adb;
                    $data['t_ash_arb']              = $result_coa->t_ash_arb;
                    $data['tm_arb']                 = $result_coa->tm_arb;
                    $data['t_sulfur_adb']           = $result_coa->t_sulfur_adb;
                    $data['tsulf_arb']              = $result_coa->tsulf_arb;
                    $data['inh_adb']                = $result_coa->inh_adb;
                    $data['vol_matter_adb']         = $result_coa->vol_matter_adb;
                    $data['fix_carb_arb']           = $result_coa->fix_carb_arb;
                    $data['size_0']                 = $result_coa->size_0;
                    $data['size_50']                = $result_coa->size_50;
                    $data['hgi']                    = $result_coa->hgi;
                    $data['cal_arb']                = $result_coa->cal_arb;
                    $data['cal_adb']                = $result_coa->cal_adb;
                    $data['cal_adb']                = $result_coa->cal_adb;
                    $data['nett_cv']                = $result_coa->nett_cv;
                    $data['klasifikasi_batubara']   = $result_coa->klasifikasi_batubara;
                    $data['ket']                    = $result_coa->ket;
                    $data['send_inatrade_coa']      = $result_coa->send_inatrade;

                } else {
                    $data['coa_no']                 = '';
                    $data['tgl_coa']                = '';
                    $data['tgl_periksa_sample']     = '';
                    $data['file_coa']               = '';
                    $data['t_ash_adb']              = '';
                    $data['t_ash_arb']              = '';
                    $data['tm_arb']                 = '';
                    $data['t_sulfur_adb']           = '';
                    $data['tsulf_arb']              = '';
                    $data['inh_adb']                = '';
                    $data['vol_matter_adb']         = '';
                    $data['fix_carb_arb']           = '';
                    $data['size_0']                 = '';
                    $data['size_50']                = '';
                    $data['hgi']                    = '';
                    $data['cal_arb']                = '';
                    $data['cal_adb']                = '';
                    $data['cal_adb']                = '';
                    $data['nett_cv']                = '';
                    $data['klasifikasi_batubara']   = '';
                    $data['ket']                    = '';
                }

                // FORM COW
                $result_cow = $this->md_list_lse->MDL_SelectNew_COW($data['no_lse']);
                
                if ($result_cow) {
                    $data['nomor_cow']   = $result_cow->no_cow;
                    $data['tgl_cow']     = $result_cow->tgl_cow;
                    $data['tgl_periksa'] = $result_cow->tgl_periksa;
                    $data['ur_barang']   = ($result_cow->uraian_barang == '') ? $data['barang'][0]->uraianBarang  : $result_cow->uraian_barang;
                    $data['spesifikasi'] = ($result_cow->spec_barang =='') ? '-' : $result_cow->spec_barang;
                    $data['jml_barang']  = ($result_cow->jumlah_barang == '') ? $data['barang'][0]->jumlahTonase : $result_cow->jumlah_barang;
                    $data['file_cow']    = $result_cow->file_cow;

                    $AryUOM = $this->CTRL_Option_UOM();
                    $data['uom_cow'] = $result_cow->satuan;
                    $data['option_uom_cow'] = $AryUOM;

                    $data['send_inatrade_cow'] = $result_cow->send_inatrade;
                } else {
                    $data['nomor_cow']   = '';
                    $data['tgl_cow']     = '';
                    $data['tgl_periksa'] = '';
                    $data['ur_barang']   = '';
                    $data['spesifikasi'] = '';
                    $data['jml_barang']  = '';
                    $data['file_cow']    = '';

                    $AryUOM = $this->CTRL_Option_UOM();
                    $data['uom_cow'] = '';
                    $data['option_uom_cow'] = $AryUOM;
                }

                $data['kerjasama_insw'] = $this->md_list_lse->MDL_SelectKerjasamaBarang($data['nomorAju'],$data['id']);
                // $this->auth->TVD($data['kerjasama_insw']);
                // die();

                // Tab 4
                $data['port'] = $this->md_list_lse->MDL_SelectPort($data['id']);

                $data['loading_port'] = $this->md_list_lse->MDL_SelectPortLoad($data['nomorAju'],$data['id']);
                // $this->auth->TVD($data['loading_port']);
                // die();

                $data['loading_destin'] = $this->md_list_lse->MDL_SelectPortDest($data['nomorAju'],$data['id']);
                // $this->auth->TVD($data['loading_port']);
                // die();

                // Tab 5
                $data['doc'] = $this->md_list_lse->MDL_SelectDoc($data['nomorAju']);

                //TAB 6
                $data['history'] = $this->md_list_lse->MDL_SelectHistory($data['nomorAju']);
                // $this->auth->TVD($data['history']);

                $data['table3'] = $this->md_list_lse->MDL_SelectCal($data['no_lse']);
                // $this->auth->TVD($data['table3']);
                // die();

                $SumAmount = $this->md_list_lse->MDL_GetSum($data['nomorAju']);
                if ($SumAmount) {
                    $data['SumAmount'] = $SumAmount->SumFob;
                } else {
                    $data['SumAmount'] = "0";
                }

                $AryTransport = $this->CTRL_Option_Transport();
                $data['option_transport'] = $AryTransport;

                //Tambahan wasil 04072024
                $data['satuan_packing_list']    = $hasil->satuan_packing_list;
                $data['tanggalBerangkat']       = $hasil->tanggalBerangkat;
                $data['container_code']         = $hasil->container_code;
                $data['file_et']                = $hasil->file_et;
                $data['file_spe']               = $hasil->file_spe;
                $data['spe_no']                 = $hasil->spe_no;
                $data['spe_date']               = $hasil->spe_date;
                $data['urlFileEt']              = $hasil->urlFileEt;
                $data['urlFileSpe']             = $hasil->urlFileSpe;
                
                $AryContainerCode   = $this->CTRL_Option_Container_Code();
                $data['option_container_code']  = $AryContainerCode;
                
                $AryPackingList = $this->CTRL_Option_PackingList();
                $data['option_packing_list']  = $AryPackingList;

                $AryCity = $this->CTRL_Option_City();
                $data['exportir_city']         = $hasil->eksportir_kota;
                $data['option_exportir_city']  = $AryCity;

                $AryProvinsi = $this->CTRL_Option_Provinsi();
                $data['exportir_provinsi']         = $hasil->eksportir_provinsi;
                $data['option_exportir_provinsi']  = $AryProvinsi;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Update", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_View_Detail/' . $id;
                $data['url_view'] = sprintf("%slist_lse/CTRL_View/", site_url());
                $data['url_upload'] = sprintf("%s%s/%s/%s",site_url(),"list_lse/CTRL_UploadLS",$id, true);
                $data['page'] = 'list_lse/view_detail';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_admin', $data);

            }
        }
    }

    public function CTRL_UploadLS($id){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id, $this->tblName, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else if($this->input->post('btn_upload_lse')){
            $this->md_list_lse->MDL_Upload_LSE($id);
            print("
                    <script language=\"javascript\">
                       window.opener.location.reload();
                       self.close();
                    </script>
                ");
        } else{
            $hasil = $this->md_list_lse->MDL_Select_Detail($id);
            $data['id']         = $id;
            $data['file_lse']   = $hasil->file_lse;
            
            $data['page'] = 'list_lse/form_upload_final_ls';
            $data['plugin'] = 'list_lse/plugin';
            $this->load->view('template_popupwindow', $data);
        }
    }

    public function generateQRCode($id, $no_lse){
        
        $ls_encode = bin2hex($id);
        $id_unik = md5($no_lse);
        $id_encode = $ls_encode .'%'. $id_unik;
                          
        $content = base_url()."list_lse/CTRL_View_LSE/$id_encode";  
        
        $logopath = 'file_upload/qr/jammin_circle.png';
        $this->load->helper('plugin_helper');
        phpqrcode();
        // QRcode::png($content);s
        
        $filepath = 'file_upload/qr/'.$no_lse.'.png';
        
        // we need to be sure ours script does not output anything!!!
        // otherwise it will break up PNG binary! 
        ob_start("callback");

        // text for the qr code
        // $codeText = 'Projectname'.$divider.$param;

        // end of processing here
        $debugLog = ob_get_contents();
        ob_end_clean();

        // create a QR code and save it in the filepath
        QRcode::png($content, $filepath, QR_ECLEVEL_H, 6, 3, true );
        
        // Start DRAWING LOGO IN QRCODE

        $QR = imagecreatefrompng($filepath);

        // START TO DRAW THE IMAGE ON THE QR CODE
        $logo = imagecreatefromstring(file_get_contents($logopath));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);

        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width/3;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;

        imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

        // Save QR code again, but with logo on it
        imagepng($QR,$filepath);

        // outputs image directly into browser, as PNG stream
        readfile($filepath);
    }
    
    public function CTRL_View_LSE($id_encode){
        $id_ls = strtok($id_encode, '%');
        $id_ls = hex2bin($id_ls);

        $hasil = $this->db->get_where('tmst_insw', array('id'=>$id_ls))->row();
        $hasil_barang = $this->md_list_lse->MDL_SelectBarang($hasil->id);
//        $esign_doc = $this->md_list_lse->MDL_SelectUploadedLS($hasil->nomorAju);
//        $base64doc = $esign_doc->esigned_file;
                                        
        $data['id'] = $hasil->id;
        $data['no_lse'] = $hasil->no_lse;
        $data['nomorAju']       = $hasil->nomorAju;
        $data['tanggalAju']     = date('d M Y', strtotime($hasil->tanggalAju));
        $data['issuing_office'] = $hasil->branch;
        $data['date_issued']    = date('d M Y', strtotime($hasil->date_issued));
        $data['date_expired']   = date('d M Y', strtotime($hasil->date_expired));
        $data['exporter_name']  = $hasil->eksportir_namaPerusahaan;
        $data['exporter_npwp']  = $hasil->eksportir_nomorIdentitas;
        $data['eksportir_nib']  = $hasil->eksportir_nib;
        $data['importer_name']  = $hasil->imp_namaPerusahaan;
        
        $data['hasil_barang']   = $hasil_barang;
        
        if($hasil->stdate_load_vessel == $hasil->enddate_load_vessel){
            $loading_date = date('d M Y', strtotime($hasil->stdate_load_vessel));
        } else{
            $loading_date = date('d M Y', strtotime($hasil->stdate_load_vessel)) . ' s/d ' . date('d M Y', strtotime($hasil->enddate_load_vessel));
        }
        
        $data['loading_date']   = $loading_date;
        $data['id_encode']      = $id_encode;
        $data['file_lse']       = $hasil->file_lse;
        
        $this->load->view('list_lse/view_lse_document', $data);
        
    }
    public function CTRL_Edit_Port($id){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                print("
                       <script language=\"javascript\">
                       self.close();
                       </script>
                       ");
            } elseif ($this->input->post('btn_submit')) {
                $res = $this->md_list_lse->MDL_Update_Port($id);
                if($res){
                    $this->session->set_flashdata('msgupdateport', array('title' => 'Success!', 'message' => 'Data Has Been Updated', 'class' => 'alert alert-success'));
                    print("
                    <script language=\"javascript\">
                       window.opener.location.reload();
                       self.close();
                    </script>
                    ");
                }
            }else {
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
                $this->breadcrumbs->add('Update', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;

                $port = $this->db->get_where('tmst_insw_port', array('id'=>$id))->row();
                $data['id'] = $id;
                $data['uraianKegiatan'] = $port->uraianKegiatan;
                $data['kodePelabuhan']  = $port->kodePelabuhan;
                $data['namaPelabuhan']  = $port->namaPelabuhan;
                $data['namaNegara']     = $port->namaNegara;
                
                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_Edit_Port/' . $id;
                $data['page'] = 'list_lse/form_edit_port';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_New_Barang($id){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('add')) {
            $data['action'] = 'add';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                print("
                       <script language=\"javascript\">
                       self.close();
                       </script>
                       ");
                //redirect('lse/CTRL_Edit/' . $id . '/#FormC');
            } elseif ($this->input->post('btn_submit')) {
                $res5 = $this->md_list_lse->MDL_InsertBarang();
                if($res5){
                    $this->session->set_flashdata('msgsubmitbarang', array('title' => 'Success!', 'message' => 'Data Has Been Submit', 'class' => 'alert alert-success'));
                    print("
                    <script language=\"javascript\">
                       window.opener.location.reload();
                       self.close();
                    </script>
                    ");
                }
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
                $this->breadcrumbs->add('Add INSW Barang', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */
               
                $hasil = $this->md_list_lse->MDL_SelectID($id);
                $data['nomorAju'] = $hasil->nomorAju;
                // $this->auth->TVD($data['nomorAju']);
                // die();
                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add New", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_New_Barang/' . $id;
                $data['page'] = 'list_lse/form_insw_barang';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_Edit_Barang($id){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        }  else {
            if ($this->input->post('close')) {
                //redirect('lse/CTRL_Edit/' . $hasil->no_lse . '/#FormC');
                print("
                           <script language=\"javascript\">
                           self.close();
                           </script>
                           ");
            } elseif ($this->input->post('btn_submit')) {
                $barang = $this->md_list_lse->MDL_Edit_Barang($id);
                if($barang){
                        $this->session->set_flashdata('msgeditbarang', array('title' => 'Success!', 'message' => 'Data Has Been Updated', 'class' => 'alert alert-success'));
                        print("
                        <script language=\"javascript\">
                           window.opener.location.reload();
                           self.close();
                        </script>
                        ");
                    }
                //redirect('lse/CTRL_Edit/' . $hasil->no_lse . '/#FormC');
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
                $this->breadcrumbs->add('Edit SR 3', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $hasil = $this->md_list_lse->MDL_SelectBarangID($id);
                $data['id'] = $hasil->id;
                $data['nomorAju'] = $hasil->nomorAju;
                $data['seriBarang'] = $hasil->seriBarang;
                $data['namaKategoriEksportir'] = $hasil->namaKategoriEksportir;
                $data['kodeKategoriEksportir'] = $hasil->kodeKategoriEksportir;
                $data['kodeHs'] = $hasil->kodeHs;
                $data['uraianBarang'] = $hasil->uraianBarang;
                $data['hargaSatuan'] = $hasil->hargaSatuan;
                $data['fob'] = $hasil->fob;
                $data['jumlahTonase'] = $hasil->jumlahTonase;
                $data['asalBarang'] = $hasil->asalBarang;
                $data['no_mining_license'] = $hasil->no_mining_license;
                $data['number_format'] = $hasil->number_format;
                //var_dump($data['number_format']); exit();
                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Edit", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_Edit_Barang/' . $id;
                // $data['url_del'] = 'list_lse/CTRL_Delete_Barang/' . $id;
                $data['page'] = 'list_lse/form_edit_barang';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }
    
    public function CTRL_Delete_Barang($id, $id_ls){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id, $this->tblNamebarang, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            $res = $this->md_list_lse->MDL_Delete_Barang($id);
            if($res){
                $this->session->set_flashdata('msgdeletebarang', array('title' => 'Success!', 'message' => 'Successfully Deleted!', 'class' => 'alert alert-success'));
            }
            redirect('list_lse/CTRL_View_Detail/'.$id_ls.'#FormEdit');
        }
    }

    public function CTRL_Print($id, $save='') {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            $hasil = $this->md_list_lse->MDL_Select_Detail($id);
            //$this->auth->TVD($hasil); exit();
            if ($hasil->date_packing_list == "0000-00-00") {
                $date_packing_list = '-';
            } else {
                $date_packing_list = date("d M Y", strtotime($hasil->date_packing_list));
            }

            $nomorPermohonan = $hasil->nomorPermohonan;
            $nomorAju = $hasil->nomorAju;
            $no_lse = $hasil->no_lse;
            
            $barang = $this->md_list_lse->MDL_SelectBarang($id);
            $kerjasama_insw = $this->md_list_lse->MDL_SelectKerjasamaBarang($nomorAju,$id);
            $table3 = $this->md_list_lse->MDL_SelectCal($no_lse);
            $loading_port = $this->md_list_lse->MDL_SelectPortLoad($nomorAju,$id);
            $loading_destin = $this->md_list_lse->MDL_SelectPortDest($nomorAju,$id);


            // $table2 = $this->md_lse->MDL_SelectDetailRoyalty($no_lse);

            $template_id = $this->config->item('template_LSE');

            $template = $this->md_template_email->MDL_SelectID($template_id);
            $content = $template->content;
            
            $FOB_FAS ="FOB";

            $content = str_replace('{BRANCH_ISSUING}', $hasil->branch, $content);
            $content = str_replace('{LS_NO}', $hasil->no_lse, $content);
            $content = str_replace('{LS_DATE}', $hasil->date_issued == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_issued)), $content);
            $content = str_replace('{EXPIRES_DATE}', $hasil->date_expired == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_expired)), $content);
            $content = str_replace('{PPBE_NO}', $hasil->no_wo, $content); 
            $content = str_replace('{PPBE_DATE}', $hasil->date_wo == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_wo)), $content);
            $content = str_replace('{SURVEY_LOCATION}', $hasil->survey_location, $content);
            $content = str_replace('{VERIFIED_DATE}', date("d M Y", strtotime($hasil->survey_location_date)), $content);
            $content = str_replace('{PACKING_NO}', $hasil->no_packing_list, $content);
            $content = str_replace('{PACKING_DATE}', $date_packing_list, $content);
            $content = str_replace('{INVOICE_NO}', $hasil->no_invoice_packing_list, $content);
            $content = str_replace('{INVOICE_DATE}', $hasil->date_invoice_packing_list == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_invoice_packing_list)), $content);
            $content = str_replace('{VALUTA}', "USD", $content);
            $content = str_replace('{IUP_NO}', $hasil->no_mining_license, $content);
            $content = str_replace('{IUP_DATE}', $hasil->date_mining_license == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_mining_license)), $content);
            $content = str_replace('{ET_NO}', $hasil->eksportir_nomorEt, $content);
            $content = str_replace('{ET_DATE}', $hasil->date_reg_exporter == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_reg_exporter)), $content);
            $content = str_replace('{NPWP_NO}', $hasil->eksportir_nomorIdentitas, $content);
            $content = str_replace('{EXPORTER_NAME}', $hasil->eksportir_namaPerusahaan, $content);
            $content = str_replace('{EXPORTER_ADDRESS}', $hasil->eksportir_alamatPerusahaan, $content);
            $content = str_replace('{IMPORTER_NAME}', $hasil->imp_namaPerusahaan, $content);
            $content = str_replace('{IMPORTER_ADDRESS}', $hasil->imp_alamatPerusahaan, $content);
            $content = str_replace('{TRANSPORT_LICENSE}', $hasil->no_transsell_license, $content);
            $content = str_replace('{DATE_TRANSPORT_LICENSE}', $hasil->date_transsell_license == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_transsell_license)), $content);
            $content = str_replace('{SMELTING_LICENSE}', $hasil->no_smelter_license, $content);
            $content = str_replace('{DATE_SMELTING_LICENSE}', $hasil->date_smelter_license == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_smelter_license)), $content);
            $content = str_replace('{PORT_DATE}', $hasil->stdate_load_vessel == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->stdate_load_vessel)), $content);
            $content = str_replace('{VESSEL_NAME}', $hasil->namaAlatPengirim, $content);
            $content = str_replace('{SHIPPING_DATE}', $hasil->stdate_load_vessel == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->stdate_load_vessel)), $content);
            $content = str_replace('{SHIPPING_DATE_END}', $hasil->enddate_load_vessel == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->enddate_load_vessel)), $content);
            $content = str_replace('{MODE_TRANSPORT}', $hasil->mode_transport, $content);
            $content = str_replace('{CARGO_TYPE}', $hasil->cargo_type, $content);
            $content = str_replace('{SURVEY_NOTES}', $hasil->note, $content);
            $content = str_replace('{PETI_KEMAS}', $hasil->container_numseal, $content);
            $content = str_replace('{JENIS_KAPAL}', $hasil->namaCaraPengirim, $content);
           
            $content = str_replace('{KAPASITAS_KAPAL}', number_format($hasil->ukuranTongkang, 2, ".", ","), $content);
            $content = str_replace('{BENDERA}', $hasil->pelabuhan_namaNegara, $content);
            $content = str_replace('{INSURANCE}', $hasil->perusahaanAsuransiKapal_nmPerusahaan, $content);
            
            $sign = $this->md_lse->MDL_GetBranchSign($hasil->branch_id);
            $content = str_replace('{SIGNATURE}', "<strong>" . $sign->head_of_branch_name . "<br/>" . $sign->position_name . "</strong>", $content);

            $item_table1 = '<table border="1" cellpadding="1" width="100%">';
            $item_table1 .= '<tr>';
            $item_table1 .= '<th align="center" width="5%"><font face="Arial"><b>NO</b></font></th>';
            $item_table1 .= '<th align="center" width="10%"><font face="Arial"><b>HS</b></font></th>';
            $item_table1 .= '<th align="center" width="30%"><font face="Arial"><b><u>URAIAN BARANG </u><br><em>DESCRIPTION</em></b></font></th>';
            $item_table1 .= '<th align="center" width="12%"><font face="Arial"><b><u>JUMLAH (TNE)</u><br><em>QUANTITY(TNE)</em></font></b></th>';
            $item_table1 .= '<th align="center" width="12%"><font face="Arial"><b>(USD) PRICE</font></b></th>';
            $item_table1 .= '<th align="center" width="31%"><font face="Arial"><b><u>NO.IUP/PKP2B/IPR ASAL BARANG </u><br><em>MINING LICENSE OF GOODS ORIGINS</em></font></b></th>';
            $item_table1 .= '</tr>';

            $SumQty = 0;
            $SumFOB = 0;
            foreach ($barang as $key => $row) {
                $no = $key + 1;
                
                $nm = strpos($row->jumlahTonase,'.');
                $quantity_format = strlen(substr($row->jumlahTonase, $nm+1));  
                
                $item_table1 .= '<tr>';
                $item_table1 .= '<td>' . $no . '</td>';
                $item_table1 .= '<td>' . $row->kodeHs . '</td>';
                $item_table1 .= '<td align="left">' . $row->uraianBarang . '</td>';
                $item_table1 .= '<td align="right">' . number_format($row->jumlahTonase, $quantity_format, ".", ",") . ' MT</td>';
                $item_table1 .= '<td align="right">' . number_format($row->fob, 2, ".", ",") . '</td>';
                $item_table1 .= '<td>' . $row->no_mining_license . '</td>';
                $item_table1 .= '</tr>';

                $SumQty = $SumQty + $row->jumlahTonase;
                $SumFOB = $SumFOB + $row->fob;
                
                $FOB_FAS = $row->fob;
            }

            $item_table1 .= '<tr>';
            $item_table1 .= '<td align="center" colspan="3"><b>TOTAL</b></td>';
            $item_table1 .= '<td align="right">'.number_format($SumQty, $quantity_format, ".", ",").' MT</td>';
            $item_table1 .= '<td align="right">'.number_format($SumFOB, 2, ".", ",").'</td>';
            $item_table1 .= '<td colspan="2"></td>';
            $item_table1 .= '</tr>';
            $item_table1 .= "</table>";


            $content = str_replace('{AMOUNT}', number_format($SumFOB, 2, ".", ","), $content);
            $content = str_replace('{CONTENT1}', $item_table1, $content);

            $item_table2 = '<table border="1" cellpadding="1" width="100%">';
            $item_table2 .= '<tr>';
            $item_table2 .= '<th align="center" width="5%"><font face="Arial"><b>NO</b></font></th>';
            $item_table2 .= '<th align="center" width="30%"><font face="Arial"><b>NAMA PERUSAHAAN ASAL BARANG</b></font></th>';
            $item_table2 .= '<th align="center" width="15%"><font face="Arial"><b><u>NPWP</u><br><em>NPWP</em></b></font></th>';
            $item_table2 .= '<th align="center" width="15%"><font face="Arial"><b><u>PROPINSI ASAL BARANG</u><br><em>PROVINCE</em></font></b></th>';
            $item_table2 .= '<th align="center" colspan="2" width="35%"><font face="Arial"><b><u>ROYALTI DIMUKA (USD DAN IDR)</u><br><em>ROYALTI DP (USD DAN IDR)</em></font></b></th>';
            $item_table2 .= '</tr>';

            $SumRoyalty = 0;
            $SumRoyalty_usd = 0;
            $valuta = "";
            
            $royalti_payment_no = array();
            $royalti_payment_date = array();
            foreach ($kerjasama_insw as $key2 => $row2) {
                if($row2->kodeKategoriBarang == 1){
                    $npwp = $row2->npwpPenjual;
                } elseif($row2->kodeKategoriBarang == 2){
                    $npwp = $row2->npwpPenambang;
                } else{
                    $npwp = $row2->npwpTrader;
                }
                
                $royalti_dp_idr = 0;
                $royalti_dp_usd = 0;
                if ($row2->valuta == 'IDR'){
                    $royalti_dp_idr = $row2->royalty_dp;
                } elseif ($row2->valuta == 'USD'){
                    $royalti_dp_usd = $row2->royalty_dp;
                }
                $no2 = $key2 + 1;
                $item_table2 .= '<tr>';
                $item_table2 .= '<td>' . $no2 . '</td>';
                $item_table2 .= '<td align="left">' . $row2->nama_perusahaan_barang . '</td>';
                $item_table2 .= '<td>' . $npwp . '</td>';
                $item_table2 .= '<td>' . $row2->asalBarang . '</td>';
                $item_table2 .= '<td align="right">IDR ' . number_format($royalti_dp_idr, 2, ".", ",") . '</td>';
                $item_table2 .= '<td align="right">$ ' . number_format($royalti_dp_usd, 2, ".", ",") . '</td>';
                $item_table2 .= '</tr>';

                $SumRoyalty     = $SumRoyalty + $royalti_dp_idr;
                $SumRoyalty_usd = $SumRoyalty_usd + $royalti_dp_usd;
                $valuta = $row2->valuta;

                $royalti_payment_no[$key2]= str_replace(',','', $row2->nomorNtpn);
                $no_pembayaran_royalti = implode(", ", $royalti_payment_no);

                $royalti_payment_date[$key2]=str_replace(',','',date("d M Y", strtotime($row2->tanggalNtpn)));
                $date_pembayaran_royalti = implode(", ", $royalti_payment_date);
            }
            
            $content = str_replace('{ROYALTY_NO}', $no_pembayaran_royalti, $content);
            $content = str_replace('{ROYALTY_DATE}', ($date_pembayaran_royalti == '0000-00-00' || $date_pembayaran_royalti == '30 Nov -0001')  ? '-' : $date_pembayaran_royalti, $content);

            $item_table2 .= '<tr>';
            $item_table2 .= '<td align="center" colspan="4"><strong>TOTAL</strong></td>';
            $item_table2 .= '<td align="right"><font face="Arial"><b>IDR ' . number_format($SumRoyalty, 2, ".", ",") . ' </font></b></td>';
             $item_table2 .= '<td align="right"><font face="Arial"><b>$ ' . number_format($SumRoyalty_usd, 2, ".", ",") . ' </font></b></td>';
            $item_table2 .= '</tr>';
            $item_table2 .= "</table>";

            $content = str_replace('{CONTENT2}', $item_table2, $content);

            $item_table3 = '<table border="1" cellpadding="1" width="100%">';
            $item_table3 .= '<tr>';
            $item_table3 .= '<th align="center" width="5%"><font face="Arial"><b>NO</b></font></th>';
            $item_table3 .= '<th align="center"><font face="Arial"><b>Cal.(KKal/Kg-arb)</b></font></th>';
            $item_table3 .= '<th align="center"><font face="Arial"><b>Cal.(KKal/Kg-adb)</b></font></th>';
            $item_table3 .= '<th align="center"><font face="Arial"><b>TM(%-arb)</font></b></th>';
            $item_table3 .= '<th align="center"><font face="Arial"><b>T.Ash(%-adb)</font></b></th>';
            $item_table3 .= '<th align="center"><font face="Arial"><b>T.Sulfur(%-adb)</b></font></th>';
            $item_table3 .= '<th align="center"><font face="Arial"><b>Klarifikasi <br/> Batubara(adb)</font></b></th>';
            $item_table3 .= '<th align="center" width="20%"><font face="Arial"><b>Keterangan</font></b></th>';
            $item_table3 .= '</tr>';

            foreach ($table3 as $key3 => $row3) {
                $no3 = $key3 + 1;
                //$this->auth->TVD($row3->klasifikasi_batubara); exit();
                $item_table3 .= '<tr>';
                $item_table3 .= '<td>' . $no3 . '</td>';
                $item_table3 .= '<td align="right">' . number_format($row3->cal_arb, 0, ".", ",") . '</td>';
                $item_table3 .= '<td align="right">' . number_format($row3->cal_adb, 0, ".", ",") . '</td>';
                $item_table3 .= '<td align="right">' . number_format($row3->tm_arb, 2, ".", ",") . '</td>';
                $item_table3 .= '<td align="right">' . number_format($row3->t_ash_adb, 2, ".", ",") . '</td>';
                $item_table3 .= '<td align="right">' . number_format($row3->t_sulfur_adb, 2, ".", ",") . '</td>';
                $item_table3 .= '<td align="right">' . $row3->klasifikasi_batubara . '</td>';
                $item_table3 .= '<td align="left">' . $row3->ket . '</td>';
                $item_table3 .= '</tr>';
            }
            $item_table3 .= "</table>";
            
            $content = str_replace('{CONTENT3}', $item_table3, $content);

            foreach ($loading_port as $key4 => $row4) {
                $content = str_replace('{PORT_LOADING}', $row4->namaPelabuhan, $content);
                
            }

            foreach ($loading_destin as $key5 => $row5) {
                $content = str_replace('{PORT_DESTINATION}', $row5->namaPelabuhan . ',' . $row5->namaNegara, $content);
            }
            
            $content = str_replace('FOB', $FOB_FAS, $content);
            $content = str_replace('FAS', $FOB_FAS, $content);

            
            $data = array(
                'content'   => $content,
                'save'      => ($save) ? $save : '',
                'nomorAju'  => $nomorAju,
                'id'        => $id,
                'no_lse'    => $hasil->no_lse
            );
            //exit();
            $data['plugin'] = 'list_lse/plugin';
            $this->load->view('list_lse/print_request_form', $data);
        }
    }

    private function CTRL_ProvideData() {

        $no_lse = $this->uri->segment(3);
        $this->load->model('md_ref_json');
        $breadcrum = $this->breadcrumbs->output();
        $data['breadcrum'] = $breadcrum;  
        
        $hasil = $this->md_list_lse->MDL_SelectID($no_lse);
        
        $data['nomorAju']   = $hasil->nomorAju;
        $data['nomorPermohonan']   = $hasil->nomorPermohonan;
        $data['id'] = $hasil->id_ls;
        $data['id_request'] = '';
        $data['jenis_lse'] = $hasil->jenis_lse;
        $data['respon_code'] = '';
        $data['detail_jenis_lse'] = $hasil->detail_jenis_lse;
        $data['exporter_npwp'] = $hasil->eksportir_npwp16;
        $data['client_name'] = $hasil->eksportir_namaPerusahaan;
        $data['exporter_address'] = $this->cleanString($hasil->eksportir_alamatPerusahaan);
        $data['phone'] = $hasil->eksportir_teleponPerusahaan;
        $data['fax'] = $hasil->eksportir_faxPerusahaan;
        $data['email'] = $hasil->eksportir_emailPerusahaan;
        $data['no_lse'] = $hasil->no_lse;
        $data['date_issued'] = $hasil->date_issued;
        $data['date_expired'] = $hasil->date_expired;
        $data['no_reg_exporter'] = $hasil->eksportir_nomorEt;
        $data['date_reg_exporter'] = $hasil->date_reg_exporter;
        $data['survey_location'] = $hasil->survey_location;
        $data['survey_location_date'] = $hasil->survey_location_date;
        // list insw
        $data['nib']                        = $hasil->eksportir_nib;
        $data['nitku']                      = $hasil->eksportir_nitku;
        $data['eksportir_jenisIup']         = $hasil->eksportir_jenisIup;
        $data['jnspengajuan']               = $hasil->jnspengajuan;
        $data['imp_namaPerusahaan']         = $hasil->imp_namaPerusahaan;
        $data['imp_alamatPerusahaan']       = $hasil->imp_alamatPerusahaan;
        $data['imp_negaraPerusahaan']       = $hasil->imp_negaraPerusahaan;
        $data['namaAlatPengirim']           = $hasil->namaAlatPengirim;
        $data['tglmuat']                    = $hasil->tanggalPemuatanAwal;
        $data['exportir_city']              = $hasil->eksportir_kota;
        $data['exportir_provinsi']          = $hasil->eksportir_provinsi;
        $data['tanggalBerangkat']           = $hasil->tanggalBerangkat;
        $data['eksportir_nomorIup']         = $hasil->eksportir_nomorIup;
        $data['eksportir_tanggal_Iup']      = $hasil->eksportir_tanggal_Iup;
        $data['container_code']             = $hasil->container_code;
        $data['jenis_doc_et']               = $hasil->jenis_doc_et;
        $data['urlFileEt']                  = $hasil->urlFileEt;
        $data['satuan_packing_list']        = $hasil->satuan_packing_list;

        //cek insw_port
        
        $port_load  = $this->md_list_lse->MDL_SelectPortLoad($hasil->nomorAju,$data['id']);
        $port_dest  = $this->md_list_lse->MDL_SelectPortDest($hasil->nomorAju,$data['id']);
       
        $data['loading_port_id']    = $port_load[0]->kodePelabuhan;
        $data['negaratujuan']       = substr($port_dest[0]->kodePelabuhan,0,2);
        $data['port_destination']   = $port_dest[0]->kodePelabuhan;
        
        //belum tersedia        
        $data['tglakhiret']  = '';
        $data['total_fas'] = '';
        $data['no_royalty_payment'] = ''; //$hasil->no_royalty_payment
        $data['date_royalty_payment'] = ''; //$hasil->date_royalty_payment
                
        $data['tglmuat'] = '0000-00-00'; // sebelumnya $hasil->date_lc
        
        $data['loading_date'] = '0000-00-00'; //$hasil->loading_date; //tanggalPemuatanAwal ?
        
        $data['lc_type'] = '';
        $data['date_lc'] = '0000-00-00';
        $data['no_lc'] = '';
        //$data['tglakhirspe'] = $hasil->loading_port_id;
        //$data['nospe']       = $hasil->loading_port_id; //SPE itu untuk mineral
        //$data['tglakhirspe'] = $hasil->loading_port_id; //SPE itu untuk mineral
        $data['nopveb']      = $hasil->no_wo;
        $data['tglpveb']     = $hasil->date_wo;
        // End
        $data['no_packing_list'] = $hasil->no_packing_list;
        $data['date_packing_list'] = $hasil->date_packing_list;
        $data['no_invoice_packing_list'] = $hasil->no_invoice_packing_list;
        $data['date_invoice_packing_list'] = $hasil->date_invoice_packing_list;
        $data['importer_name'] = $hasil->imp_namaPerusahaan;
        $data['importer_address'] = $hasil->imp_alamatPerusahaan;
        $data['country'] = $hasil->imp_negaraPerusahaan;

        $data['stdate_load_vessel'] = $hasil->stdate_load_vessel;
        $data['no_mining_license'] = $hasil->no_mining_license;
        $data['date_mining_license'] = $hasil->date_mining_license;
        $data['no_smelter_license'] = $hasil->no_smelter_license;
        $data['date_smelter_license'] = $hasil->date_smelter_license;

        $data['no_transsell_license'] = $hasil->no_transsell_license;
        $data['date_transsell_license'] = $hasil->date_transsell_license;
        
        $data['mode_transport'] = $hasil->mode_transport;
        $data['cargo_type'] = $hasil->cargo_type;
        $data['bendera'] = $hasil->pelabuhan_namaNegara;
        $data['nama_perusahaan_asuransi'] = $hasil->perusahaanAsuransiKapal_nmPerusahaan;

        $data['container_numseal'] = $hasil->container_numseal;
        $data['note'] = $hasil->note;
        
        $data['jenis_kapal'] = $hasil->namaCaraPengirim;
        $data['vessel_name'] = $hasil->namaAlatPengirim;
        $data['kapasitas_kapal'] = $hasil->ukuranTongkang;        

        $data['komoditas'] = $this->md_list_lse->MDL_SelectBarang($data['id']);
        $total_fas = 0;
        foreach ($data['komoditas'] as $kom){
            $total_fas += $kom->fob;
        }
        
        $data['total_amount'] = round($total_fas,2); // $hasil->total_fas
        
        $data['detil_batubara'] = $this->md_list_lse->MDL_SelectSR3($data['no_lse']);
        $data['detil_asal'] = $this->md_list_lse->MDL_SelectKerjasamaBarang($data['nomorAju'],$data['id']);
        $total_tonase1 = 0;
        foreach ($data['detil_asal'] as $kom_kerjasama){
            $total_tonase1 += $kom_kerjasama->tonaseEkspor;
        }

        $data['total_tonase'] = number_format((float)$total_tonase1, 3, '.', '');

        return $data;
    }
    
    function cleanString($string) {
       $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
       return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
    }
    
    public function send_coa($jnspengajuan){
    
        $data = $this->CTRL_ProvideData();
        $id_insw         = $data['id'];
        $jenis_lse       = $data['detail_jenis_lse'];
        $noAju           = $data['nomorAju'];
        $nomorPermohonan = $data['nomorPermohonan'];
        
        $url  = "https://ws.kemendag.go.id/surveyor/sendCOA"; // Production

        $result_coa = $this->md_list_lse->MDL_SelectNew_SR3($data['no_lse']);
        $result_cow = $this->md_list_lse->MDL_SelectNew_COW($data['no_lse']);

        $url_print_coa = 'http://13.250.153.103/lse/file_upload/coa/'.$result_coa->file_coa;

        //json_encode
        $data_json = array(    
                        "header" => array(
                            'jns_penerbitan'    => $jnspengajuan, // 1 = baru , 2 = perubahan, 9 = pembatalan
                            'nib'               => $data['nib'],
                            'npwp'              => $data['exporter_npwp'],
                            'nama_perusahaan'   => $data['client_name'],
                            'no_ls'             => $data['no_lse'],
                            'tgl_ls'            => $data['date_issued'],
                            'kode_ls'           => '0101161', //$data['detail_jenis_lse'],
                            'nomor_coa'         => $result_coa->coa_no,
                            'tgl_coa'           => $result_coa->tgl_coa,
                            'tgl_periksa'       => $result_coa->tgl_periksa_sample,
                            'url_coa'           => $url_print_coa,
                        ),

                        //"komoditas" => $komoditas,
                        "komoditas"  => array(
                            'ur_barang'         => $result_cow->uraian_barang, 
                            'spesifikasi'       => $result_cow->spec_barang, 
                            'jml_barang'        => $result_cow->jumlah_barang, 
                            'satuan'            => $result_cow->satuan,
                        ),

                        "coa" => array(
                            "spec" => array(
                                'ash_arb'       => $result_coa->t_ash_arb,
                                'ash_adb'       => $result_coa->t_ash_adb,
                                'tm_arb'        => $result_coa->tm_arb,
                                'inh_adb'       => $result_coa->inh_adb,
                                'tsulf_arb'     => $result_coa->tsulf_arb,
                                'tsulf_adb'     => $result_coa->t_sulfur_adb,
                                'vol_matter'    => $result_coa->vol_matter_adb,
                                'fix_carb'      => $result_coa->fix_carb_arb,
                                'size_0'        => $result_coa->size_0,
                                'size_50'       => $result_coa->size_50,
                                'hgi'           => $result_coa->hgi,
                            ),
                            "param" => array(
                                'gcv_arb'       => $result_coa->cal_arb,   
                                'gcv_adb'       => $result_coa->cal_adb, 
                                'ncv_arb'       => $result_coa->nett_cv, 
                            )  
                        ),
                        'username' => "jammin" 
                );
        
       //$this->auth->TVD($data_json);  exit();
       //$this->auth->TVD(str_replace("\/","/",json_encode($data_json)));  exit();
    
        // Send request to Server
        $ch = curl_init($url);
        
        //pass encoded JSON string to the POST fields 
        curl_setopt($ch, CURLOPT_POSTFIELDS, str_replace("\/","/",json_encode($data_json)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'x-Gateway-APIKey:ab6eba5d-79db-4938-b007-8ee45179daaf',
            'Content-Type:application/json',
        ));

        $result = curl_exec($ch);
        
        /* close cURL resource */   
        curl_close($ch);

        $final_result = json_decode($result);
        
        if ($final_result->kode == '200'){
            $this->md_list_lse->MDL_Update_StatusCOA($data['no_lse'],$jnspengajuan);
        }

        //$this->md_list_lse->MDL_InsertLog_JSON($data['no_lse'],'sendCOA',$jnspengajuan,$final_result);
        
        return $final_result;
    }

    public function send_cow($jnspengajuan){
    
        $data = $this->CTRL_ProvideData();
        $id_insw         = $data['id'];
        $jenis_lse       = $data['detail_jenis_lse'];
        $noAju           = $data['nomorAju'];
        $nomorPermohonan = $data['nomorPermohonan'];
        
        $url  = "https://ws.kemendag.go.id/surveyor/sendCOW"; // Staging

        $result_cow = $this->md_list_lse->MDL_SelectNew_COW($data['no_lse']);
        $url_print_cow = 'http://13.250.153.103/lse/file_upload/cow/'.$result_cow->file_cow;

        //json_encode
        $data_json = array(    
                        "header" => array(
                            'jns_penerbitan'    => $jnspengajuan, // 1 = baru , 2 = perubahan, 8 = pembatalan
                            'nib'               => $data['nib'],
                            'npwp'              => $data['exporter_npwp'],
                            'nama_perusahaan'   => $data['client_name'],
                            'no_ls'             => $data['no_lse'],
                            'tgl_ls'            => $data['date_issued'],
                            'kode_ls'           => '0101161', 
                            'nomor_cow'         => $result_cow->no_cow,
                            'tgl_cow'           => $result_cow->tgl_cow,
                            'tgl_periksa'       => $result_cow->tgl_periksa,
                            'url_cow'           => $url_print_cow,
                        ),

                        "komoditas"  => array(
                            'ur_barang'         => $result_cow->uraian_barang, 
                            'spesifikasi'       => $result_cow->spec_barang, 
                            'jml_barang'        => $result_cow->jumlah_barang, 
                            'satuan'            => $result_cow->satuan,
                        ),
                        'username' => "jammin" 
                );
        
        //$this->auth->TVD($data_json);  exit();
        //$this->auth->TVD(str_replace("\/","/",json_encode($data_json)));  exit();
    
        // Send request to Server
        $ch = curl_init($url);
        
        //pass encoded JSON string to the POST fields 
        curl_setopt($ch, CURLOPT_POSTFIELDS, str_replace("\/","/",json_encode($data_json)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'x-Gateway-APIKey:ab6eba5d-79db-4938-b007-8ee45179daaf',
            'Content-Type:application/json',
        ));

        $result = curl_exec($ch);
        $this->auth->TVD($result); exit();
        /* close cURL resource */   
        curl_close($ch);

        $final_result = json_decode($result);

        //if ($final_result->kode == '200'){
            $this->md_list_lse->MDL_Update_StatusCOW($data['no_lse'],$jnspengajuan);
        //}
        
        return $final_result;
    }
    
    // send_doc_lse via JSON for COAL
    // version 3.0
    public function send_doc_simbara($jnspengajuan){
    
        $data = $this->CTRL_ProvideData();

        $id_insw         = $data['id'];
        $id_lse          = $data['no_lse'];
        $jenis_lse       = $data['detail_jenis_lse'];
        $noAju           = $data['nomorAju'];
        $nomorPermohonan = $data['nomorPermohonan'];

        
        //$url  = "https://services.kemendag.go.id/surveyor/1.0/send_doc_simbara";
        $url  = "https://ws.kemendag.go.id/surveyor/send_doc_simbara";

        $url_print_certificate = base_url().'list_lse/CTRL_Print/'.$data['id'];
        
        if($data['tglmuat'] !='0000-00-00' ){ // loading_date
            $data['tglmuat'] = $data['tglmuat'];
        } else {
            $data['tglmuat'] = '0000-00-00';
        }
        

        $referensi_doc = array();
        //foreach ($data['list_document'] as $doc) {
            $referensi_doc[] = array(
                "jns_dok"      => $data['jenis_doc_et'],
                "no_dokumen"   => $data['no_reg_exporter'],
                "tgl_dokumen"  => $data['date_reg_exporter'],
                "neg_penerbit" => "ID",
                "url_dok"      => $data['urlFileEt']
            );
        //}

        
        $komoditas = array();
        $idseriAsal = 0;
        foreach ($data['komoditas'] as $kom) {
            $idseriAsal = $idseriAsal + 1;

            //start royalti..
            $data['detil_asal2'] = $this->md_list_lse->MDL_SelectKerjasamaBarang2($data['nomorAju'],$data['id'],$idseriAsal);
            $royalti_detail = array();
            foreach ($data['detil_asal2'] as $kom_kerjasama) {
                if($kom_kerjasama->kodeKategoriBarang == 1){
                    $npwp = $kom_kerjasama->npwpPenjual;
                } elseif($kom_kerjasama->kodeKategoriBarang == 2){
                    $npwp = $kom_kerjasama->npwpPenambang;
                } else{
                    $npwp = $kom_kerjasama->npwpTrader;
                }

                $royalti_detail[] = array(
                        'no_ntpn'   => $kom_kerjasama->nomorNtpn, 
                        'tgl_ntpn'  => $kom_kerjasama->tanggalNtpn, 
                        'nib'       => $data['nib'],  
                        'npwp'      => $npwp, 
                        'nitku'     => "-",
                        'nama'      => $kom_kerjasama->nama_perusahaan_barang,
                        'jns_iup'   => "1", 
                        'volume'    => $kom_kerjasama->tonaseEkspor,
                        'satuan'    => "TNE", 
                        'kd_prop'   => "32", 
                        'royalti'   => $kom_kerjasama->royalty_dp,
                        'currency'  => $kom_kerjasama->valuta
                );
            }
            //end royalti..

            $komoditas[] = array(
                'seri'              => $idseriAsal,
                //'seri_izin'       => $idseriAsal,
                'pos_tarif'         => $kom->kodeHs, 
                'ur_barang'         => $kom->uraianBarang, 
                'spesifikasi'       => "-", 
                'neg_asal'          => "ID", 
                'jml_barang'        => $kom->jumlahTonase, 
                'satuan'            => "TNE", 
                'berat_bersih'      => $kom->jumlahTonase,
                'harga_barang'      => $kom->fob, 
                'currency'          => "USD", 
                'harga_barang_idr'  => "", 
                'harga_barang_usd'  => $kom->fob, 
                'no_iup'            => $data['eksportir_nomorIup'],  
                'tgl_iup'           => $data['eksportir_tanggal_Iup'],  
                'royalti'           => $royalti_detail
            );
        }

        // BatuBara Simbara
        if ($data['detil_batubara']) {
            $detil_batubara = array();
            $idposTarif = 0;
            foreach ($data['detil_batubara'] as $key => $det_bat) {
                $idposTarif = $idposTarif + 1;
                $detil_batubara[] = array(
                    'seri'            => $idposTarif,
                    'cal_arb'         => $det_bat->cal_arb,
                    'cal_adb'         => $det_bat->cal_adb, 
                    'tm_arb'          => $det_bat->tm_arb, 
                    'tash_adb'        => $det_bat->t_ash_adb, 
                    'tsulf_adb'       => $det_bat->t_sulfur_adb, 
                    'klasifikasi_bb'  => $det_bat->klasifikasi_batubara, 
                    'keterangan'      => $det_bat->ket
                );
            }
        }

        //json_encode
        $data_json = array(    
                        "header" => array(
                            'jns_penerbitan'    => $jnspengajuan, // 1 = baru , 2 = perubahan, 9 = pembatalan
                            'no_permohonan'     => $data['nomorAju'], 
                            'kode_ls'           => '0101161', //$data['detail_jenis_lse'],
                            'no_ls'             => $data['no_lse'],
                            'tgl_ls'            => $data['date_issued'],
                            'tgl_expired'       => $data['date_expired'],
                            'keterangan'        => substr($data['note'],0,999),
                            'url_ls'            => $url_print_certificate
                        ),
                        "eksportir" => array(
                            'npwp'     => $data['exporter_npwp'],
                            'nib'      => $data['nib'],
                            'nitku'    => $data['nitku'],
                            'jns_iup'  => $data['eksportir_jenisIup'],
                            'nama'     => $data['client_name'],
                            'alamat'   => substr($data['exporter_address'],0,100),
                            'kd_kota'  => $data['exportir_city'],
                            'kd_prov'  => $data['exportir_provinsi'],
                            'kodepos'  => ''
                        ),
                        "importir" => array(
                            'nama'        => $data['imp_namaPerusahaan'],
                            'alamat'      => substr(str_replace(" – ","",$data['imp_alamatPerusahaan']),0,100),
                            'kd_kota'     => '-',
                            'kd_negara'   => $data['imp_negaraPerusahaan']
                        ),
                        "transportation" => array(
                            'cara_angkut'       => 1,   // Via Laut
                            'plb_muat'          => $data['loading_port_id'], 
                            'plb_transit'       => '', 
                            'plb_tujuan'        => $data['port_destination'], 
                            'neg_tujuan'        => $data['imp_negaraPerusahaan'],    // New Field
                            'neg_transit'       => "", 
                            'transport_name'    => $data['namaAlatPengirim'], 
                            'transport_number'  => "", 
                            'transport_country' => $data['imp_negaraPerusahaan'],
                            'tgl_muat'          => $data['tglmuat'],
                            'tgl_berangkat'     => $data['tanggalBerangkat']
                        ),

                        "referensi" => $referensi_doc,

                        "barang" => array(
                            'jml_barang_netto'  => $data['total_tonase'], 
                            'jml_barang_bruto'  => $data['total_tonase'], 
                            'incoterm'          => "FOB", // FOB
                            'nilai_invoice'     => $data['total_amount'],
                            'currency'          => "USD",
                            'nilai_invoice_idr' => 0.000, 
                            'nilai_invoice_usd' => $data['total_amount'],
                            'tgl_periksa'       => $data['survey_location_date'],
                            'lokasi_periksa'    => $data['loading_port_id'],
                        ),

                        "komoditas" => $komoditas,
                        "batubara"  => $detil_batubara,  // Buka jika send doc ls simbara

                        "package" => [array(
                            'seri'          => 1,
                            'package_info'  => "BATU BARA", 
                            'jml_package'   => 1,  
                            'unit'          => $data['satuan_packing_list']
                        )],
                        "kontainer" => [array(
                            'seri'          => 1, 
                            'jns_kontainer' => $data['container_code'],
                            'no_kontainer'  => substr($data['container_numseal'],0,10)
                        )],
                        'username' => "jammin" 
                );

        //$this->auth->TVD($data_json); exit();
        //$this->auth->TVD(str_replace("\/","/",json_encode($data_json)));  exit();
        // Send request to Server
        $ch = curl_init($url);
        
        //pass encoded JSON string to the POST fields 
        curl_setopt($ch, CURLOPT_POSTFIELDS, str_replace("\/","/",json_encode($data_json)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //'x-Gateway-APIKey:ab6eba5d-79db-4938-b007-8ee45179daaf',
            'x-api-key:ab6eba5d-79db-4938-b007-8ee45179daaf',
            'Content-Type:application/json',
        ));

        $result = curl_exec($ch);

        /* close cURL resource */   
        curl_close($ch);

        //echo ($result); 
        $final_result = json_decode($result);
        
        if ($final_result->kode == '200'){
            $this->md_list_lse->MDL_Update_Inatrade_V2($id_lse);
        }
        
        return $final_result;
    }

    // Fuction untuk Mengirim data respon status Surveyor ke INSW
    public function sendResponseSurveyor(){
        $url = "https://api.insw.go.id/api/integration/pabean/ekspor/send-response-surveyor";

        $nomorAju        = $this->input->post('nomorAju');
        $kodeProses      = $this->input->post('kodeProses');
        $waktuProses     = $this->input->post('waktuProses');
        $nomorPermohonan = $this->input->post('nomorPermohonan');
        
        $data = json_encode(array(
                    'data'  => [ 
                        array(
                            'noAju'             => $nomorAju,
                            'nomorPermohonan'   => $nomorPermohonan,
                            'kodeProses'        => $kodeProses,
                            'waktuProses'       => $waktuProses,
                            'keterangan'        => "",
                            'urlLampiran'       => "",
                            'payloadLs'         =>  new ArrayObject()
                        )
                    ]
                ));
        
        // Send request to Server
        $ch = curl_init($url);

        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
        /* set the content type json */

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Insw-key:pZ66hobzPpXBn2bMHVPTz0wG1pxuWQdo',
            'Content-Type:application/json',
        ));

        $result = curl_exec($ch);
        /* close cURL resource */

        curl_close($ch);

        $final_result = json_decode($result);
        return $final_result;
    }
    
    //Send Doc LS version 2.0
    public function CTRL_SendXML2_1(){
           
        $data = $this->CTRL_ProvideData();
        
        $id_insw         = $data['id'];
        $id_lse          = $data['no_lse'];
        $jenis_lse       = $data['detail_jenis_lse'];
        $noAju           = $data['nomorAju'];
        $nomorPermohonan = $data['nomorPermohonan'];

        $this->CTRL_Print($data['id'], true); // Save document LS
                
        $str = "<SurveyorSendDocLs xmlns='http://tempuri.org/'></SurveyorSendDocLs>";
        $xml = simplexml_load_string($str);
        
        // Username dan Password WebServices
        $string0 = $xml->addChild('string0','jammin_ekspor_2020');
        $string1 = $xml->addChild('string1','AzlJfwa');
        // End

        $string2 = $xml->addChild('string2');
        $LSE_Document = $string2->addChild('LSE_Document');
        $header = $LSE_Document->addChild('header');
                              
        $header->addChild('npwp', $data['exporter_npwp']); // $data['exporter_npwp']
        $header->addChild('refnumber',$data['nomorAju']);// No AJU
        $header->addChild('jenisLS',$data['detail_jenis_lse'] );
        $header->addChild('status','001');
        $header->addChild('namaPerusahaan', $data['client_name']);
        $header->addChild('alamatPerusahaan', substr($data['exporter_address'],0,100));
        $header->addChild('telepon', $data['phone']);
        $header->addChild('fax', $data['fax']);
        $header->addChild('emailPerusahaan',$data['email']);
        $header->addChild('idkab','101' );  // hardcode
        $header->addChild('idprop','15' );  // hardcode
        $header->addChild('no_ls',$data['no_lse'] );
        $header->addChild('tgl_ls',$data['date_issued']);
        $header->addChild('tgl_ls_expired',$data['date_expired']); 
        $header->addChild('no_izin', '');    // No Persetujuan Eksport (PE)
        $header->addChild('tgl_izin', '');
        $header->addChild('tgl_izin_expired', '');     
        $header->addChild('noizinterdaftar', $data['no_reg_exporter']);//Nomor Eksportir Terdaftar (ET)
        $header->addChild('tglizinterdaftar', $data['date_reg_exporter']);
        $header->addChild('tglizinterdaftar_expired', ''); 
        
        if($data['no_lc']){
            $header->addChild('no_lc',$data['no_lc']);    
        }
        if($data['date_lc'] !='0000-00-00' ){
            $header->addChild('tgl_lc',$data['date_lc']);
        }
        
        $header->addChild('modetransport',$data['mode_transport'] );
        $header->addChild('cargotype',$data['cargo_type'] );///////////////////////mandatory
        $header->addChild('bendera',$data['bendera'] );///////////////////////mandatory
        $header->addChild('jeniskapal',substr($data['jenis_kapal'],0,10) );///////////////////////mandatory
        $header->addChild('kapkapal', $data['kapasitas_kapal'] );///////////////////////mandatory
        if($data['nama_perusahaan_asuransi']){
            $header->addChild('asuransi', substr($data['nama_perusahaan_asuransi'],0,29));///////////////////////mandatory    
        }
        
        $header->addChild('catatanperiksa',substr($data['note'],0,100));///////////////////////mandatory

        $header->addChild('tempatperiksa',substr($data['survey_location'],0,100) );
        if($data['survey_location_date'] !='0000-00-00' ){
            $header->addChild('tglperiksa',$data['survey_location_date'] );
        }
        $header->addChild('portperiksa',$data['loading_port_id'] );
        $header->addChild('nopacklist',$data['no_packing_list'] );
        if($data['date_packing_list'] !='0000-00-00'){
            $header->addChild('tglpacklist',$data['date_packing_list'] );   
         }
         
        $header->addChild('noinvoice',$data['no_invoice_packing_list'] );
        if($data['date_invoice_packing_list'] !='0000-00-00' ){
           $header->addChild('tglinvoice',$data['date_invoice_packing_list'] );   
        }
         
        $header->addChild('namaclient',$data['importer_name'] );
        $header->addChild('alamatclient',substr($data['importer_address'],0,100));
        if($data['country']){
            $header->addChild('negaraclient',$data['country'] );
        }
        if($data['tglmuat'] !='0000-00-00' ){ // date_lc atau loading_date?
            $header->addChild('tglmuat',$data['tglmuat'] );
        }
        $header->addChild('namavessel',$data['vessel_name'] );
        if($data['stdate_load_vessel'] !='0000-00-00' ){
            $header->addChild('tglmuatvessel',$data['stdate_load_vessel'] );
        }
        if($data['no_mining_license']){
            $header->addChild('noiupop',$data['no_mining_license'] );   
        }
        if($data['date_mining_license'] != '0000-00-00'){
            $header->addChild('tgliupop',$data['date_mining_license'] );   
        }
         
        if($data['no_smelter_license']){
            $header->addChild('noiupopkpp',$data['no_smelter_license'] );   
        }
        if($data['date_smelter_license'] != '0000-00-00'){
            $header->addChild('tgliupopkpp',$data['date_smelter_license'] );   
        }
        if($data['no_transsell_license']){
            $header->addChild('noiupopkolah',$data['no_transsell_license'] );   
         }
         if($data['date_transsell_license'] != '0000-00-00'){
            $header->addChild('tgliupopkolah',$data['date_transsell_license'] );   
         }
         if($data['container_numseal']){
            $header->addChild('nopetikemas',substr($data['container_numseal'],0,100));   
         }
         if($data['container_numseal']){
            $header->addChild('nosegel',substr($data['container_numseal'],0,100) );   
         }
        
        $filepath = base_url('file_upload/insw_lse_document');
        $file_name = $filepath . '/' . $data['nomorAju'] . '.pdf';

        $header->addChild('url_ls',$file_name);
        $header->addChild('kesimpulan',substr($data['note'],0,100));
         
         // DETAIL
        $idposTarif = 0;
        $idposTarif_barang = 0;
        $detail = $LSE_Document->addChild('detailBarang');
        foreach($data['komoditas'] as $key => $kom){
            $item = $detail->addChild('loop');
            $idposTarif = $idposTarif + 1;
            $idposTarif_barang = $idposTarif_barang + 1;
            
            $item->addChild('idposTarif', $idposTarif);
            $item->addChild('posTarif',$kom->kodeHs);
            $item->addChild('jmlVolume',$kom->jumlahTonase);
            $item->addChild('satuan', 'TNE'); // TNE
            $item->addChild('uraian_barang', $kom->uraianBarang);
            $item->addChild('kdNegaraAsal', 'ID');
            $item->addChild('kdNegaraMuat', 'ID');
            $item->addChild('kdNegaraTujuan', $data['negaratujuan']);
            
            $item->addChild('kdPortAsal', $data['loading_port_id']);
            $item->addChild('kdPortBongkar', $data['port_destination']);
            $item->addChild('kdPortMuat', $data['loading_port_id']);
                        
            $item->addChild('value_currency', $data['total_amount']);
            $item->addChild('currency', 'USD'); 
            $item->addChild('value_fob', $kom->fob);
        }
        
        if ($data['detil_batubara']) {
            $detil_batubara = $LSE_Document->addChild('detilBatubara');
            $idposTarif = 0;
            foreach ($data['detil_batubara'] as $key => $det_bat) {
                $item = $detil_batubara->addChild('loop');

                if ($idposTarif_barang == '1'){
                    $idposTarif =  1;
                    $idseriAsal =  1;
                } else{
                    $idposTarif = $idposTarif + 1;
                }

                $item->addChild('idposTarif', $idposTarif);
                $item->addChild('cal_arb', $det_bat->cal_arb);
                $item->addChild('cal_adb', $det_bat->cal_adb);
                $item->addChild('tm_arb', $det_bat->tm_arb);
                $item->addChild('tash_adb', $det_bat->t_ash_adb);
                $item->addChild('tsulf_adb', $det_bat->t_sulfur_adb);
                $item->addChild('klasifikasibb', $det_bat->klasifikasi_batubara);
                $item->addChild('keterangan', $det_bat->ket);
            }
        }
        
        if ($data['detil_asal']) {
            $detil_asal = $LSE_Document->addChild('detilAsal');
            $idposTarif = 0;
            $idseriAsal = 0;
            //$client_id  = "";

            foreach ($data['detil_asal'] as $key => $det_asal) {
                
                if($det_asal->npwpPenjual <> '' && $det_asal->kodeKategoriBarang =='1'){
                    $npwp = $det_asal->npwpPenjual;
                } elseif($det_asal->npwpPenambang <> '' && $det_asal->kodeKategoriBarang =='2'){
                    $npwp = $det_asal->npwpPenambang;
                } elseif($det_asal->npwpTrader <> '' && $det_asal->kodeKategoriBarang =='3'){
                    $npwp = $det_asal->npwpTrader;
                } else {
                    $npwp = '';
                }

                // idposTarif & idseriAsal belum selesai
                $idposTarif = $det_asal->seriBarang;
                $idseriAsal = $det_asal->seriBarang;

                $item = $detil_asal->addChild('loop');

                $item->addChild('idseriAsal', $idseriAsal);
                $item->addChild('idposTarif', $idposTarif);

                //NEW PIA
                $item->addChild('nobayarroyalti', $det_asal->nomorNtpn);
                $item->addChild('tglbayarroyalti', $det_asal->tanggalNtpn);
                //END PIA
                
                $item->addChild('npwp', $npwp); // bisa npwpPenjual, npwpPenambang atau npwpTrader
                $item->addChild('nmpersh', $det_asal->nama_perusahaan_barang);
                $item->addChild('idprop', ''); // $det_asal->province_code
                $item->addChild('nmprop', $det_asal->asalBarang); // $det_asal->province_name

                //NEW PIA
                $item->addChild('jmlVolume', $det_asal->tonaseEkspor); // bisa tonasePembelian atau tonaseEkspor
                $item->addChild('satuan', 'TNE'); // TNE
                //END PIA

                $item->addChild('royalti', $det_asal->royalty_dp);
                $item->addChild('kurs', $det_asal->valuta);
                
//                $client_id = $det_asal->client_id;
            }
        }

        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = true;
        $doc->loadXML($xml->asXML(), LIBXML_NOBLANKS);
        $doc->save('xml/send_doc_ls_'.$data['no_lse'].'.xml');

        $file = 'xml/send_doc_ls_'.$data['no_lse'].'.xml';
                  
        $xml = simplexml_load_file($file);
        $xml = $xml->asXML();
        $xml =  str_replace(array("<SurveyorSendDocLs>", "</SurveyorSendDocLs>",'<?xml version="1.0"?>'),"",$xml);

        $data = '<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
              <soap:Body>   
                  '.$xml.'
                </SurveyorSendDocLs>
              </soap:Body>
            </soap:Envelope>';
        
        //$this->auth->TVD($data); exit();
        $url = 'https://gwi.kemendag.go.id/ws/ls_exim?wsdl';
        /* Init cURL resource */
        $ch = curl_init($url);
        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
        /* set the content type json */

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'SOAPAction:SurveyorSendDocLs',
            'Content-Type:application/xml',
        ));

        $result = curl_exec($ch);
       
        /* close cURL resource */

        curl_close($ch);

        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);
        $MyObject = simplexml_load_string($clean_xml);
        
        $respond = $MyObject->Body->SurveyorSendDocLsResponse;
        /*$refnumber ='';
        foreach ($respond->data->detailBarang->loop as $key => $value) {
            $refnumber = $value->refnumber;
        }
        $my_reffnumber = (array)$refnumber;*/

        $my_array = (array)$respond;
        $msg = $my_array['msg'];
        $kode = $my_array['kode'];

        if($kode =='200'){
            $alert = $msg;
            $this->md_list_lse->MDL_Update_Inatrade_V2($id_lse);
            // Update Status LS TERBIT
            $url = "https://api.insw.go.id/api/integration/pabean/ekspor/send-response-surveyor";

            $data = json_encode(array(
                        'data'  => [ 
                            array(
                                'noAju'             => $noAju,
                                'nomorPermohonan'   => $nomorPermohonan,
                                'kodeProses'        => '050',
                                'waktuProses'       => date("Y-m-d H:i:s"),
                                'keterangan'        => '',
                                'urlLampiran'       => '',
                                'payloadLs'         => new ArrayObject()
                            )
                        ]
                    ));
            //$this->auth->TVD($data); exit();
            // Send request to Server
            $ch = curl_init($url);

            /* pass encoded JSON string to the POST fields */
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
            /* set the content type json */

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Insw-key:pZ66hobzPpXBn2bMHVPTz0wG1pxuWQdo',
                'Content-Type:application/json',
            ));

            $result = curl_exec($ch);
            /* close cURL resource */

            curl_close($ch);

            $final_result = json_decode($result);
            if ($final_result->data->kode == 'A01'){
                $data = array(
                    'id_insw'           => $id_insw,
                    'nomorAju'          => $noAju,
                    'nomorPermohonan'   => $nomorPermohonan,
                    'kodeProses'        => '050',
                    'waktuProses'       => date("Y-m-d H:i:s"),
                );
                //$this->auth->TVD($data); exit();       
                $this->db->insert('tmst_respond_insw', $data);
                
                //update table tmst_insw
                $data_proses = array('kodeProses'=> '050');
                $this->db->where('no_lse', $id_lse);
                $res = $this->db->update('tmst_insw', $data_proses); 
            }
            // END Update Status LS Terbit
        } else{
            $alert = $msg;
        }
    
        // Insert Log untuk status TRUE
        $this->md_lse->MDL_InsertLog($id_lse,'','','',date("Y-m-d H:i:s"),$my_array['msg'],'SendDoc_LS',$jenis_lse,$my_array['kode']);

        return $alert;
         
    }

    public function CTRL_PrintMineral($id, $nomorPermohonan) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            $hasil = $this->md_list_lse->MDL_Select_Detail($id);

            if ($hasil->date_packing_list == "0000-00-00") {
                $date_packing_list = '-';
            } else {
                $date_packing_list = date("d M Y", strtotime($hasil->date_packing_list));
            }

            $nomorPermohonan = $hasil->nomorPermohonan;
            $nomorAju = $hasil->nomorAju;

            
            $barang = $this->md_list_lse->MDL_SelectBarang($nomorAju);
            $kerjasama_insw = $this->md_list_lse->MDL_SelectKerjasamaBarang($nomorAju);
            // $table3 = $this->md_list_lse->MDL_SelectCal($nomorPermohonan);
            $loading_port = $this->md_list_lse->MDL_SelectPortLoad($nomorAju);
            $loading_destin = $this->md_list_lse->MDL_SelectPortDest($nomorAju);



            // $table2 = $this->md_lse->MDL_SelectDetailRoyalty($no_lse);

            $template_id = $this->config->item('template_LSE_Mineral');

            $template = $this->md_template_email->MDL_SelectID($template_id);
            $content = $template->content;
            
            $FOB_FAS ="FOB";

            $content = str_replace('{BRANCH_ISSUING}', $hasil->branch, $content);
            $content = str_replace('{LS_NO}', $hasil->nomorPermohonan, $content);
            $content = str_replace('{LS_DATE}', $hasil->date_issued == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_issued)), $content);
            $content = str_replace('{EXPIRES_DATE}', $hasil->date_expired == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_expired)), $content);
            $content = str_replace('{PPBE_NO}', $hasil->no_wo, $content);
            $content = str_replace('{PPBE_DATE}', $hasil->date_wo == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_wo)), $content);
            $content = str_replace('{SURVEY_LOCATION}', $hasil->survey_location, $content);
            $content = str_replace('{VERIFIED_DATE}', date("d M Y", strtotime($hasil->survey_location_date)), $content);
            $content = str_replace('{PACKING_NO}', $hasil->no_packing_list, $content);
            $content = str_replace('{PACKING_DATE}', $date_packing_list, $content);
            $content = str_replace('{INVOICE_NO}', $hasil->no_invoice_packing_list, $content);
            $content = str_replace('{INVOICE_DATE}', $hasil->date_invoice_packing_list == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_invoice_packing_list)), $content);
            $content = str_replace('{VALUTA}', "USD", $content);
            $content = str_replace('{IUP_NO}', $hasil->no_mining_license, $content);
            $content = str_replace('{IUP_DATE}', $hasil->date_mining_license == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_mining_license)), $content);
            $content = str_replace('{ET_NO}', $hasil->eksportir_nomorEt, $content);
            $content = str_replace('{ET_DATE}', $hasil->date_reg_exporter == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_reg_exporter)), $content);
            $content = str_replace('{NPWP_NO}', $hasil->eksportir_nomorIdentitas, $content);
            $content = str_replace('{EXPORTER_NAME}', $hasil->eksportir_namaPerusahaan, $content);
            $content = str_replace('{EXPORTER_ADDRESS}', $hasil->eksportir_alamatPerusahaan, $content);
            $content = str_replace('{IMPORTER_NAME}', $hasil->imp_namaPerusahaan, $content);
            $content = str_replace('{IMPORTER_ADDRESS}', $hasil->imp_alamatPerusahaan, $content);
            $content = str_replace('{TRANSPORT_LICENSE}', $hasil->no_transsell_license, $content);
            $content = str_replace('{DATE_TRANSPORT_LICENSE}', $hasil->date_transsell_license == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_transsell_license)), $content);
            $content = str_replace('{SMELTING_LICENSE}', $hasil->no_smelter_license, $content);
            $content = str_replace('{DATE_SMELTING_LICENSE}', $hasil->date_smelter_license == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->date_smelter_license)), $content);
            $content = str_replace('{PORT_DATE}', $hasil->tanggalPemuatanAwal == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->tanggalPemuatanAwal)), $content);
            $content = str_replace('{VESSEL_NAME}', $hasil->namaAlatPengirim, $content);
            $content = str_replace('{SHIPPING_DATE}', $hasil->stdate_load_vessel == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->stdate_load_vessel)), $content);
            $content = str_replace('{SHIPPING_DATE_END}', $hasil->enddate_load_vessel == '0000-00-00' ? '-' : date("d M Y", strtotime($hasil->enddate_load_vessel)), $content);
            $content = str_replace('{MODE_TRANSPORT}', $hasil->mode_transport, $content);
            $content = str_replace('{CARGO_TYPE}', $hasil->cargo_type, $content);
            $content = str_replace('{SURVEY_NOTES}', $hasil->note, $content);
            $content = str_replace('{PETI_KEMAS}', $hasil->container_numseal, $content);
            $content = str_replace('{JENIS_KAPAL}', $hasil->namaCaraPengirim, $content);
           
            $content = str_replace('{KAPASITAS_KAPAL}', number_format($hasil->ukuranTongkang, 2, ".", ","), $content);
            $content = str_replace('{BENDERA}', $hasil->pelabuhan_namaNegara, $content);
            $content = str_replace('{INSURANCE}', $hasil->perusahaanAsuransiKapal_nmPerusahaan, $content);
            
            $sign = $this->md_lse->MDL_GetBranchSign($hasil->branch_id);
            $content = str_replace('{SIGNATURE}', "<strong>" . $sign->head_of_branch_name . "<br/>" . $sign->position_name . "</strong>", $content);

            $item_table1 = '<table border="1" cellpadding="1" width="100%">';
            $item_table1 .= '<tr>';
            $item_table1 .= '<th align="center" width="5%"><font face="Arial"><b>NO</b></font></th>';
            $item_table1 .= '<th align="center" width="10%"><font face="Arial"><b>HS</b></font></th>';
            $item_table1 .= '<th align="center" width="30%"><font face="Arial"><b><u>URAIAN BARANG </u><br><em>DESCRIPTION</em></b></font></th>';
            $item_table1 .= '<th align="center" width="12%"><font face="Arial"><b><u>JUMLAH (TNE)</u><br><em>QUANTITY(TNE)</em></font></b></th>';
            $item_table1 .= '<th align="center" width="12%"><font face="Arial"><b>FAS(USD) PRICE</font></b></th>';
            $item_table1 .= '<th align="center" width="31%"><font face="Arial"><b><u>NO.IUP/PKP2B/IPR ASAL BARANG </u><br><em>MINING LICENSE OF GOODS ORIGINS</em></font></b></th>';
            $item_table1 .= '</tr>';

            $SumQty = 0;
            $SumFOB = 0;
            foreach ($barang as $key => $row) {
                $no = $key + 1;
                
                $nm = strpos($row->jumlahTonase,'.');
                $quantity_format = strlen(substr($row->jumlahTonase, $nm+1));
                
                $item_table1 .= '<tr>';
                $item_table1 .= '<td>' . $no . '</td>';
                $item_table1 .= '<td>' . $row->kodeHs . '</td>';
                $item_table1 .= '<td align="left">' . $row->uraianBarang . '</td>';
                $item_table1 .= '<td align="right">' . number_format($row->jumlahTonase, $quantity_format, ".", ",") . ' MT</td>';
                $item_table1 .= '<td align="right">' . number_format($row->fob, 2, ".", ",") . '</td>';
                $item_table1 .= '<td>' . $hasil->no_mining_license . '</td>';
                $item_table1 .= '</tr>';

                $SumQty = $SumQty + $row->jumlahTonase;
                $SumFOB = $SumFOB + $row->fob;
                
                $FOB_FAS = $row->fob_fas;
            }
            /*$item_table1 .= '<tr>';
            $item_table1 .= '<td align="center" colspan="3"><b>TOTAL</b></td>';
            $item_table1 .= '<td align="right"><font face="Arial"><b>' . number_format($SumQty, 3, ".", ",") . ' MT</b></font></td>';
            $item_table1 .= '<td align="right"><font face="Arial"><b>' . number_format($SumFAS, 2, ".", ",") . '</font></b></td>';
            $item_table1 .= '<td colspan="2"></td>';
            $item_table1 .= '</tr>';*/
            $item_table1 .= '<tr>';
            $item_table1 .= '<td align="center" colspan="3"></td>';
            $item_table1 .= '<td align="right"></td>';
            $item_table1 .= '<td align="right"></td>';
            $item_table1 .= '<td colspan="2"></td>';
            $item_table1 .= '</tr>';
            $item_table1 .= "</table>";


            $content = str_replace('{AMOUNT}', number_format($SumFOB, 2, ".", ","), $content);
            $content = str_replace('{CONTENT1}', $item_table1, $content);

            $item_table2 = '<table border="1" cellpadding="1" width="100%">';
            $item_table2 .= '<tr>';
            $item_table2 .= '<th align="center" width="5%"><font face="Arial"><b>NO</b></font></th>';
            $item_table2 .= '<th align="center" width="35%"><font face="Arial"><b>NAMA PERUSAHAAN ASAL BARANG</b></font></th>';
            $item_table2 .= '<th align="center"><font face="Arial"><b><u>NPWP</u><br><em>NPWP</em></b></font></th>';
            $item_table2 .= '<th align="center"><font face="Arial"><b><u>PROPINSI ASAL BARANG</u><br><em>PROVINCE</em></font></b></th>';
            $item_table2 .= '<th align="center"><font face="Arial"><b><u>ROYALTI DIMUKA</u><br><em>ROYALTI DP</em></font></b></th>';
            $item_table2 .= '</tr>';

            $SumRoyalty = 0;
            $valuta = "";
            $royalti_payment_no = array();
            $royalti_payment_date = array();
            foreach ($kerjasama_insw as $key2 => $row2) {
                $no2 = $key2 + 1;
                $item_table2 .= '<tr>';
                $item_table2 .= '<td>' . $no2 . '</td>';
                $item_table2 .= '<td align="left">' . $row2->namaKategoriEksportir . '</td>';
                $item_table2 .= '<td>' . $row2->npwpPenjual . '</td>';
                $item_table2 .= '<td>' . $row2->asalBarang . '</td>';
                $item_table2 .= '<td align="right">' . number_format($row2->royalty_dp, 2, ".", ",") . ' ' . $row2->valuta . '</td>';
                $item_table2 .= '</tr>';

                $SumRoyalty = $SumRoyalty + $row2->royalty_dp;
                $valuta = $row2->valuta;

               // if($row2->sample =='NO'){
                    $royalti_payment_no[$key2]= str_replace(',','', $row2->nomorNtpn);
                    $no_pembayaran_royalti = implode(", ", $royalti_payment_no);

                    $royalti_payment_date[$key2]=str_replace(',','',date("d M Y", strtotime($row2->tanggalNtpn)));
                    $date_pembayaran_royalti = implode(", ", $royalti_payment_date);
               // } else {
               /*     $no_pembayaran_royalti ='-';
                    $date_pembayaran_royalti ='-';
                }*/
            }
            
            $content = str_replace('{ROYALTY_NO}', $no_pembayaran_royalti, $content);
            $content = str_replace('{ROYALTY_DATE}', ($date_pembayaran_royalti == '0000-00-00' || $date_pembayaran_royalti == '30 Nov -0001')  ? '-' : $date_pembayaran_royalti, $content);

            $item_table2 .= '<tr>';
            $item_table2 .= '<td align="center" colspan="4"><strong>TOTAL</strong></td>';
            $item_table2 .= '<td align="right"><font face="Arial"><b>' . number_format($SumRoyalty, 2, ".", ",") . ' ' . $valuta . '</font></b></td>';
            $item_table2 .= '</tr>';
            $item_table2 .= "</table>";

            $content = str_replace('{CONTENT2}', $item_table2, $content);

            $item_table3 = '<table border="1" cellpadding="1" width="100%">';
            $item_table3 .= '<tr>';
            foreach ($table3_header as $key3 => $row3) {
                $item_table3 .= '<th align="center" width="5%"><font face="Arial"><b>NO</b></font></th>';
                $item_table3 .= '<th align="center"><font face="Arial"><b>' . $row3->variable_0 . '(%)</b></font></th>';
                $item_table3 .= '<th align="center"><font face="Arial"><b>' . $row3->variable_1 . '(%)</b></font></th>';
                $item_table3 .= '<th align="center"><font face="Arial"><b>' . $row3->variable_2 . '(%)</b></font></th>';
                $item_table3 .= '<th align="center"><font face="Arial"><b>' . $row3->variable_3 . '(%)</b></font></th>';
                $item_table3 .= '<th align="center"><font face="Arial"><b>' . $row3->variable_4 . '(%)</b></font></th>';
                $item_table3 .= '<th align="center"><font face="Arial"><b>Size</b></font></th>';
                $item_table3 .= '<th align="center" width="20%"><font face="Arial"><b>Keterangan</b></font></th>';
            }
            $item_table3 .= '</tr>';

            foreach ($table3 as $key3 => $row3) {
                $no3 = $key3 + 1;
                $item_table3 .= '<tr>';
                $item_table3 .= '<td>' . $no3 . '</td>';
                $item_table3 .= '<td align="right">' . $row3->value_0 . '</td>';
                $item_table3 .= '<td align="right">' . $row3->value_1 . '</td>';
                $item_table3 .= '<td align="right">' . $row3->value_2 . '</td>';
                $item_table3 .= '<td align="right">' . $row3->value_3 . '</td>';
                $item_table3 .= '<td align="right">' . $row3->value_4 . '</td>';
                $item_table3 .= '<td align="left">' . $row3->size . '</td>';
                $item_table3 .= '<td align="left">' . $row3->keterangan . '</td>';
                $item_table3 .= '</tr>';
            }
            $item_table3 .= "</table>";

            $content = str_replace('{CONTENT3}', $item_table3, $content);

            $content = str_replace('FOB', $FOB_FAS, $content);
            $content = str_replace('FAS', $FOB_FAS, $content);
            
            $data = array(
                'content' => $content
            );
            $data['plugin'] = 'list_lse/plugin';
            $this->load->view('list_lse/print_request_form', $data);
        }
    }

    

    public function CTRL_New_SR1($id, $no_lse) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('add')) {
            $data['action'] = 'add';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id, $this->tblName, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                print("
                     <script language=\"javascript\">
                     self.close();
                     </script>
                     ");
                //redirect('lse/CTRL_Edit/' . $id . '/#FormC');
            } elseif ($this->input->post('btn_submit')) {
                $this->md_list_lse->MDL_New_SR1($id, $no_lse);
                print("
                     <script language=\"javascript\">
                     window.opener.location.reload();
                     self.close();
                     </script>
                     ");
                //redirect('lse/CTRL_Edit/' . $id . '/#FormC');
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
                $this->breadcrumbs->add('Add SR 1', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $data['results2a'] = $this->md_list_lse->MDL_SelectTSR1($no_lse);

                $hasil = $this->md_lse->MDL_SelectID($id);
                $data['no_lse'] = $hasil->no_lse;
                $data['no_mining_license'] = $hasil->no_mining_license;
                $data['id'] = $hasil->id;

                $AryFobFas = $this->CTRL_Option_FobFas();
                $data['fobfas'] = "";
                $data['option_fobfas'] = $AryFobFas;

                // 1 agustus 2017 10:17
                $AryExporter = $this->CTRL_Option_Exporter();
                $data['exporter'] = "";
                $data['option_exporter'] = $AryExporter;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_New_SR1/' . $id . '/' . $no_lse;
                $data['page'] = 'list_lse/form_sr1';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_New_SR2($id, $no_lse) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('add')) {
            $data['action'] = 'add';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id, $this->tblName, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                print("
                       <script language=\"javascript\">
                       self.close();
                       </script>
                       ");
                //redirect('lse/CTRL_Edit/' . $id . '/#FormC');
            } elseif ($this->input->post('btn_submit')) {
                $this->md_list_lse->MDL_New_SR2($no_lse);
                print("
                       <script language=\"javascript\">
                           window.opener.location.reload();
                           self.close();
                       </script>
                       ");
            }  else {
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
                $this->breadcrumbs->add('Add SR 2', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $hasil = $this->md_list_lse->MDL_SelectID($id);
                // $this->auth->TVD($hasil);
                // die();
                $data['no_lse'] = $hasil->no_lse;
                $data['id'] = $hasil->id;
                $data['jenis_lse'] = $hasil->jenis_lse;
                $data['eksportir_alamatPerusahaan'] = $hasil->eksportir_alamatPerusahaan;

                // 1 agustus 2017 10:17
                $AryExporter = $this->CTRL_Option_Exporter();
                $data['exporter'] = "";
                $data['option_exporter'] = $AryExporter;
                
                $AryProvince = $this->CTRL_Option_Province();
                $data['province'] = '';
                $data['option_province'] = $AryProvince;

                $AryTypeOriginGoods = $this->CTRL_Option_TypeOriginGoods();
                $data['type_origin_goods'] = "";
                $data['option_type_origin_goods'] = $AryTypeOriginGoods;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_New_SR2/' . $id . '/' . $no_lse;
                $data['page'] = 'list_lse/form_sr2';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_New_SR3($id) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('add')) {
            $data['action'] = 'add';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id, $this->tblName, $this->field)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                print("
                       <script language=\"javascript\">
                       self.close();
                       </script>
                       ");
                //redirect('lse/CTRL_Edit/' . $id . '/#FormC');
            } elseif ($this->input->post('btn_submit')) {
                $res3 = $this->md_list_lse->MDL_New_SR3();
                if($res3){
                    $this->session->set_flashdata('msgsubmitsr3', array('title' => 'Success!', 'message' => 'Data Has Been Submit', 'class' => 'alert alert-success'));
                    print("
                    <script language=\"javascript\">
                       window.opener.location.reload();
                       self.close();
                    </script>
                    ");
                }
                //redirect('lse/CTRL_Edit/' . $id . '/#FormC');
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
                $this->breadcrumbs->add('Add SR 3', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $hasil = $this->md_list_lse->MDL_SelectID($id);
                $data['no_lse'] = $hasil->no_lse;
                $data['id'] = $hasil->id;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_New_SR3/' . $id;
                $data['page'] = 'list_lse/form_sr3';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_Edit_SR1($id_hs, $no_lse){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        }  elseif (!$this->auth->Auth_isRecID($id_hs, $this->tblNamehs, $this->field)) {
            $data['id'] = $id_hs;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('list_lse');
            } elseif ($this->input->post('btn_submit')) {
                $this->md_list_lse->MDL_Edit_SR1($id_hs, $no_lse);

                print("
                     <script language=\"javascript\">
                     window.opener.location.reload();
                     self.close();
                     </script>
                     ");
                //redirect('lse/CTRL_Edit/' . $hasil->no_lse . '/#FormC');
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
                $this->breadcrumbs->add('Edit SR 1', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $data['results2a'] = $this->md_list_lse->MDL_SelectTSR1($id_hs);

                $hasil = $this->md_list_lse->MDL_SelectID_SR1($id_hs);
                // $this->auth->TVD($hasil);
                // die();
                $data['hs'] = $hasil->hs;
                $data['description'] = $hasil->description;
                $data['quantity'] = $hasil->quantity;
                $data['fas'] = $hasil->fas;
                $data['no_mining_license'] = $hasil->no_mining_license;
                $data['no_lse'] = $hasil->no_lse;
                $data['exporter'] = $hasil->client_id;
                $data['fob_fas'] = $hasil->fob_fas;


                $AryFobFas = $this->CTRL_Option_FobFas();
                $data['fobfas'] = $hasil->fob_fas;
                $data['option_fobfas'] = $AryFobFas;

                // 1 agustus 2017 10:17
                $AryExporter = $this->CTRL_Option_Exporter();
                $data['option_exporter'] = $AryExporter;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Edit", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_Edit_SR1/' . $id_hs . '/' . $no_lse;
                $data['url_del'] = 'list_lse/CTRL_Delete_SR1/' . $id_hs . '/' . $no_lse;
                $data['page'] = 'list_lse/form_edit_sr1';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_Delete_SR1($id_hs, $no_lse) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id_hs, $this->tblNamehs, $this->field)) {
            $data['no_lse'] = $no_lse;
            $data['id_hs'] = $id_hs;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            $id = $this->input->post('id');
            $this->md_list_lse->MDL_Delete_SR1($id_hs);
            print("
                           <script language=\"javascript\">
                           window.opener.location.reload();
                           self.close();
                           </script>
                           ");
            //redirect('lse/CTRL_Edit/' . $no_lse . '/#FormC');
        }
    }

    public function CTRL_Edit_SR2($id_roy, $no_lse){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        }  elseif (!$this->auth->Auth_isRecID($id_roy, $this->tblNameroy, $this->field)) {
            $data['id'] = $id_roy;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('list_lse');
            } elseif ($this->input->post('btn_submit')) {
                $this->md_list_lse->MDL_Edit_SR2($id_roy, $no_lse);

                print("
                     <script language=\"javascript\">
                     window.opener.location.reload();
                     self.close();
                     </script>
                     ");
                //redirect('lse/CTRL_Edit/' . $hasil->no_lse . '/#FormC');
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
                $this->breadcrumbs->add('Edit SR 1', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $data['results2a'] = $this->md_list_lse->MDL_SelectTSR2($no_lse);

                $hasil = $this->md_list_lse->MDL_SelectID_SR2($id_roy);
                // $this->auth->TVD($hasil);
                // die();
                $data['no_lse'] = $hasil->no_lse;
                $data['royalty_dp'] = $hasil->royalty_dp;
                $data['valuta'] = $hasil->valuta;
                $data['no_royalty_payment'] = $hasil->no_royalty_payment;
                $data['date_royalty_payment'] = $hasil->date_royalty_payment;
                $data['provinsi_asal_barang'] = $hasil->provinsi_asal_barang;
                $data['exporter_npwp'] = $hasil->exporter_npwp;
                $data['quantity'] = $hasil->quantity;
                
                $AryProvince = $this->CTRL_Option_Province();
                $data['province'] = '';
                $data['option_province'] = $AryProvince;

                $AryExporter = $this->CTRL_Option_Exporter();
                $data['exporter'] = $hasil->client_id;
                $data['option_exporter'] = $AryExporter;
                $data['client_name'] = $hasil->client_name;
                $data['exporter_address'] = $hasil->exporter_address;
                $data['province'] = $hasil->province;
                // 1 agustus 2017 10:17

                $AryTypeOriginGoods = $this->CTRL_Option_TypeOriginGoods();
                $data['type_origin_goods'] = $hasil->sample;
                $data['option_type_origin_goods'] = $AryTypeOriginGoods;
                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Edit", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_Edit_SR2/' . $id_roy . '/' . $no_lse;
                $data['url_del'] = 'list_lse/CTRL_Delete_SR2/' . $id_roy . '/' . $no_lse;
                $data['page'] = 'list_lse/form_edit_sr2';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_Delete_SR2($id_roy,$no_lse) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            $id = $this->input->post('id');
            $this->md_list_lse->MDL_Delete_SR2($id_roy);
            print("
                   <script language=\"javascript\">
                       window.opener.location.reload();
                       self.close();
                   </script>
                   ");
            //redirect('lse/CTRL_Edit/' . $id_lse . '/#FormC');
        }
    }

    public function CTRL_Edit_SR3($id_cal){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id_cal, $this->tblNamecal, $this->field)) {
            $data['id'] = $id_cal;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            $hasil = $this->md_list_lse->MDL_SelectID_SR3($id_cal);
            $data['id_cal'] = $hasil->id_cal;
            $data['no_lse'] = $hasil->no_lse;
            // $this->auth->TVD($data['no_lse']); die();
            if ($this->input->post('close')) {
                //redirect('lse/CTRL_Edit/' . $hasil->no_lse . '/#FormC');
                print("
                           <script language=\"javascript\">
                           self.close();
                           </script>
                           ");
            } elseif ($this->input->post('btn_submit')) {
                $res4 = $this->md_list_lse->MDL_Edit_SR3($id_cal, $no_lse);
                if($res4){
                    //     $this->auth->TVD($res3);
                    // die();
                        $this->session->set_flashdata('msgeditsr3', array('title' => 'Success!', 'message' => 'Data Has Been Updated', 'class' => 'alert alert-success'));
                        print("
                        <script language=\"javascript\">
                           window.opener.location.reload();
                           self.close();
                        </script>
                        ");
                    }
                //redirect('lse/CTRL_Edit/' . $hasil->no_lse . '/#FormC');
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
                $this->breadcrumbs->add('Edit SR 3', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $hasil = $this->md_list_lse->MDL_SelectID_SR3($id_cal);
                $data['no_lse'] = $hasil->no_lse;
                $data['cal_arb'] = $hasil->cal_arb;
                $data['cal_adb'] = $hasil->cal_adb;
                $data['tm_arb'] = $hasil->tm_arb;
                $data['nett_cv'] = $hasil->nett_cv;
                $data['t_ash_adb'] = $hasil->t_ash_adb;
                $data['t_sulfur_adb'] = $hasil->t_sulfur_adb;
                $data['klasifikasi_batubara'] = $hasil->klasifikasi_batubara;
                $data['ket'] = $hasil->ket;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Edit", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'list_lse/CTRL_Edit_SR3/' . $id_cal;
                $data['url_del'] = 'list_lse/CTRL_Delete_SR3/' . $id_cal;
                $data['page'] = 'list_lse/form_edit_sr3';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }

    public function CTRL_Delete_SR3($id_cal) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($id_cal, $this->tblNamecal, $this->field)) {
            $data['id_lse'] = $id_lse;
            $data['id'] = $id_cal;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            $id = $this->input->post('id');
            $this->md_list_lse->MDL_Delete_SR3($id_cal);
            print("
                   <script language=\"javascript\">
                   window.opener.location.reload();
                   self.close();
                   </script>
                   ");
        }
    }
    
    public function CTRL_View($id){
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } 
        else {
            if ($this->input->post('close')) {
                print("
                       <script language=\"javascript\">
                       self.close();
                       </script>
                       ");
            } elseif ($this->input->post('btn_submit')) {
                $res6 = $this->md_list_lse->MDL_New_Kerjasama();
                if($res6){

                        $this->session->set_flashdata('msgkerjasama', array('title' => 'Success!', 'message' => 'Data Has Been Updated', 'class' => 'alert alert-success'));
                        print("
                        <script language=\"javascript\">
                           window.opener.location.reload();
                           self.close();
                        </script>
                        ");
                    }
                // redirect('list_lse/CTRL_View/'.$id);
        }else {
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
            $this->breadcrumbs->add('Update', current_url());
            $breadcrum = $this->breadcrumbs->output();
            $data['breadcrum'] = $breadcrum;
    
            $barang = $this->db->get_where('tmst_barang_insw', array('id'=>$id))->row();
            $data['isAddition'] = $barang->isAddition;
        
            $data['kerjasama'] = $this->md_list_lse->MDL_SelectKerjasama($id);
            $data['currency'] = $this->md_list_lse->MDL_SelectValuta();
            $data['option_kategori'] = array('1'=>'Milik Sendiri', '2'=>'Beli dari Penambang Lain', '3'=>'Beli dari Trader');
            // $this->auth->TVD($data['currency']); 
            // die();


            $Arykurs_mata_uang = $this->CTRL_Option_Kurs_Mata_Uang();
            $data['option_kurs_mata_uang'] = $Arykurs_mata_uang;
            
            $nm_title = $this->auth->Auth_getNameMenu();
           // $data['title_head'] = sprintf("%s - %s", $nm_title);
            $data['title'] = sprintf("%s", $nm_title);
            $data['url'] = 'list_lse/CTRL_View/' . $id;
            $data['page'] = 'list_lse/view_insw_kerjasama';
            $data['plugin'] = 'list_lse/plugin';
            $this->load->view('template_popupwindow', $data);
            }
        }
    }


     //    Tambahan wasil 04072024
    public function CTRL_Option_Container_Code(){
        $AryContainer = $this->db->get('tmst_container')->result();
        $option[''] = 'Choose a Container Code...';
        if ($AryContainer) {
            foreach ($AryContainer as $row) {
                $option[$row->kode] = $row->kode . ' - '. $row->keterangan;
            }
        }
        return $option;
    }
    
    public function CTRL_Option_PackingList(){
        $AryPackingList = $this->db->get('tmst_packing_list')->result();
        $option[''] = 'Pilih Satuan Packing List...';
        if ($AryPackingList) {
            foreach ($AryPackingList as $row) {
                $option[$row->code] = $row->code . ' - '. $row->description;
            }
        }
        return $option;
    }

    public function CTRL_Option_City(){
        $AryCity = $this->db->get('tmst_kota')->result();
        $option[''] = 'Pilih Kota...';
        if ($AryCity) {
            foreach ($AryCity as $row) {
                $option[$row->kode] = $row->kode . ' - '. $row->nama_dengan_jenis_kota;
            }
        }
        return $option;
    }

    public function CTRL_Option_Provinsi(){
        $AryProvinsi = $this->db->get('tmst_provinsi')->result();
        $option[''] = 'Pilih Provinsi...';
        if ($AryProvinsi) {
            foreach ($AryProvinsi as $row) {
                $option[$row->kode] = $row->kode . ' - '. $row->nama_provinsi;
            }
        }
        return $option;
    }

    public function CTRL_Option_UOM() {
        $this->load->model('md_ref_json');
        $Ary_Satuan = $this->md_ref_json->MDL_Select_MasterType('UOM_COAL');
        foreach ($Ary_Satuan as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }
    
    public function CTRL_Option_Branch() {
        $this->load->model('md_branch');
        $AryBranch = $this->md_branch->MDL_Select();
        $option[''] = 'Choose Office...';
        foreach ($AryBranch as $row) {
            $option[$row->id] = $row->branch . '&nbsp&nbsp|&nbsp&nbsp' . $row->address;
        }
        return $option;
    }

    public function CTRL_Option_Commodity() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('LSE_COMMODITY');
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }
    
    public function CTRL_Option_Detail_Commodity($commodity){
        
        $AryTypeStatus = $this->db->get_where('tmst_jenis_ls', array('commodity'=>$commodity, 'active'=>1))->result();
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->nama_ls;
        }
        return $option;
    }

    public function CTRL_Option_FobFas() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('FOBFAS');
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }

    public function CTRL_Option_Exporter() {
        $AryExporter = $this->md_lse->MDL_SelectExporter();
        $option[''] = 'Choose a Exporter...';
        if ($AryExporter) {
            foreach ($AryExporter as $row) {
                $option[$row->client_id] = $row->npwp . ' | ' . $row->client_name;
            }
        }
        return $option;
    }

    public function CTRL_Option_Province() {
        $this->load->model('md_province');
        $AryProvince = $this->md_province->MDL_Select();
        $option[''] = 'Choose Region...';
        foreach ($AryProvince as $row) {
            $option[$row->province_code] = $row->province_name;
        }
        return $option;
    }

    public function CTRL_Option_TypeOriginGoods() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('TypeOriginGoods');
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }

    public function CTRL_Option_Transport() {
        $AryTransport = $this->md_lse->MDL_SelectTransport();
        $option[''] = 'Choose a Transport...';
        if ($AryTransport) {
            foreach ($AryTransport as $row) {
                $option[$row->name] = $row->name;
            }
        }
        return $option;
    }

    public function CTRL_Option_Kurs_Mata_Uang() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('CURRENCY');
        $option[''] = 'Pilih Kurs Mata Uang...';
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }
    
    public function CTRL_Option_Status() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('KODE_PROSES');
        $option[''] = 'Pilih Status...';
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->id.' - '.$row->name;
        }
        return $option;
    }
    
    public function CTRL_Option_Country() {
        $this->load->model('md_country');
        $AryCountry = $this->md_country->MDL_Select();
        $option[''] = 'Choose Country...';
        foreach ($AryCountry as $row) {
            $option[$row->country_code] = $row->country_name;
        }
        return $option;
    }
    
    public function get_valuta(){
        $AryValuta = $this->md_list_lse->MDL_SelectValuta();
        
        echo json_encode(array('result' => $AryValuta));
    }

    public function CTRL_NewStatus($id='') {
        if(!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif(!$this->auth->Auth_isPrivButton('add')) {
            $data['action'] = 'add';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                print("
                     <script language=\"javascript\">
                     self.close();
                     </script>
                     ");
            } elseif ($this->input->post('btn_submit')) {
                //Send Respond Surveyor to INSW
                $res_insw = $this->sendResponseSurveyor();
                if ($res_insw->data->kode == 'A01'){
                    $res = $this->md_list_lse->MDL_InsertStatus($id);
                    if($res){
                        $this->session->set_flashdata('msgsuccess', array('title' => 'Success!', 'message' => 'Last Status is Succesfully Updated', 'class' => 'alert alert-success'));
                    
                        print("
                         <script language=\"javascript\">
                            window.opener.location.reload();
                            self.close();
                         </script>
                         ");
                    }
                }
                else {
                    $this->auth->TVD($res_insw); exit();
                }
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
                $this->breadcrumbs->add('Add New', base_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                $data['id'] = $id;

                $hasil = $this->md_list_lse->MDL_SelectID($data['id']);
                $data['nomorAju']           = $hasil->nomorAju;
                $data['nomorPermohonan']    = $hasil->nomorPermohonan;

                $AryUpdateStatus              = $this->CTRL_Option_Status();
                $data['kodeProses']           = '';
                $data['option_update_status'] = $AryUpdateStatus;

                $nm_title           = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add New",$nm_title);
                $data['title']      = sprintf("%s",$nm_title);

                $data['url']    = 'list_lse/CTRL_NewStatus/'.$id;
                $data['page']   = 'list_lse/form_status';
                $data['plugin'] = 'list_lse/plugin';
                $this->load->view('template_popupwindow', $data);
            }
        }
    }
}