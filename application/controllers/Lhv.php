<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lhv extends CI_Controller {
    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('md_lhv');
        $this->load->model('Md_lhv_approval');
        $this->load->model('md_template_email');

        $this->tblName = $this->config->item('ttrs_lhv');
        $this->field = 'id';
        $this->field_no_lhv = 'no_lhv';
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

            $data['results'] = $this->md_lhv->MDL_Select($req_startdate, $req_enddate);


            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%lhv/CTRL_View/", site_url());
            $data['page'] = 'lhv/view';
            $data['plugin'] = 'lhv/plugin';
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
                redirect('loading_port');
            } elseif ($this->input->post('btn_submit')) {
                $isDuplicated = $this->md_lhv->MDL_isPermInsert($this->input->post('no_lhv'));
                $id = $data['id'] = $this->md_lhv->MDL_getAutoID();
                if ($isDuplicated) {
                    $this->md_lhv->MDL_Insert();
                    redirect('lhv/CTRL_Edit/' . $this->input->post('no_lhv'));
                } else {
                    $data['no_lhv'] = $this->input->post('no_lhv');
                    $data['page'] = 'error_duplicated';
                    $this->load->view('template_admin', $data);
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
                $this->breadcrumbs->add('Add New', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                /* DATA FORM */
                $data['datenow'] = date("Y-m-d");
                $data['id'] = $this->md_lhv->MDL_getAutoID();
                $data['no_lhv'] = $this->md_lhv->MDL_getAutoID2();
                /* END DATA FORM */




                $AryPort = $this->CTRL_Option_Port();
                $data['port'] = "";
                $data['option_port'] = $AryPort;



                $AryType = $this->CTRL_Option_Type();
                $data['type'] = '';
                $data['option_type'] = $AryType;

                $AryProvince = $this->CTRL_Option_Province();


                $data['provinsi'] = '';
                $data['provinsi_lainnya'] = '';
                $data['option_province'] = $AryProvince;


                $AryNamaPetugas = $this->CTRL_Option_Nama_Petugas();
                $data['nama_petugas'] = "";
                $data['option_nama_petugas'] = $AryNamaPetugas;


                $data['nama_surveyor'] = '';
                $data['option_nama_surveyor'] = array(
                    '' => 'Pilih Nama Surveyor',
                    'PT. Carsurin' => 'PT. Carsurin');

                $Aryjenis_perizinan = $this->CTRL_Option_Jenis_Perizinan();
                $data['jenis_perizinan'] = '';
                $data['jenis_perizinan_lainnya'] = '';
                $data['option_jenis_perizinan'] = $Aryjenis_perizinan;



                $Arytujuan_pengapalan = $this->CTRL_Option_Tujuan_Pengapalan();
                $data['tujuan_pengapalan'] = '';
                $data['option_tujuan_pengapalan'] = $Arytujuan_pengapalan;

                $Arykurs_mata_uang = $this->CTRL_Option_Kurs_Mata_Uang();
                $data['kurs_mata_uang'] = '';
                $data['option_kurs_mata_uang'] = $Arykurs_mata_uang;

                $AryClients = $this->CTRL_Option_Clients();
                $data['nama_perusahaan_supplyer'] = '';
                $data['nama_perusahaan_supplyer_lainnya'] = '';
                $data['option_nama_perusahaan_supplyer'] = $AryClients;


                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Add New", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);

                $data['url_cek_field'] = sprintf("%s%s/costcenter_code", site_url(), "lhv/CTRL_CekField");
                $data['url'] = 'lhv/CTRL_New';
                $data['page'] = 'lhv/form';
                $data['plugin'] = 'lhv/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Edit($no_lhv) {

        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($no_lhv, $this->tblName, $this->field_no_lhv)) {

            $data['no_lhv'] = $no_lhv;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('lhv');
            } elseif ($this->input->post('btn_submit')) {

                $this->md_lhv->MDL_Update($no_lhv);
                redirect('lhv/CTRL_Edit/' . $no_lhv);
            } else if ($this->input->post('btn_upload')) {
                $this->md_lhv->MDL_Upload_Document($no_lhv);
                redirect('lhv/CTRL_Edit/' . $no_lhv . '/#FormC');
            } elseif ($this->input->post('btn_submit2')) {
                $this->md_lhv->MDL_Update($no_lhv);
                redirect('lhv/CTRL_Edit/' . $no_lhv . '/#FormC');
            } elseif ($this->input->post('btn_inatrade')) {
                $this->CTRL_SendXML();
                echo 'Send to Inatrade';
                die();
                redirect('Lhv_approval');
            } elseif ($this->input->post('btn_aggrement')) {
                $this->Md_lhv_approval->MDL_ApproveAggrement($no_lhv);
                $this->Md_lhv_approval->MDL_InsertAggrement($no_lhv);
                redirect('lhv/CTRL_Edit/' . $no_lhv . '/#FormCertificate');
            } elseif ($this->input->post('btn_send_approve')) {
                $res = $this->md_lhv->MDL_Approval_LHV($no_lhv);
                if ($res) {
                    $this->CTRL_SendEmail($no_lhv);
                }
                redirect('lhv');
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
                
                $hasil = $this->md_lhv->MDL_SelectID($no_lhv);
                $data['document_results'] = $this->md_lhv->MDL_SelectDocumentVerification($no_lhv);

                //$this->auth->TVD($hasil);die();
                $data['id'] = $hasil->id;
                $data['no_lhv'] = $hasil->no_lhv;
                $data['tanggal_lhv'] = $hasil->tanggal_lhv;
                $data['nama_surveyor'] = $hasil->nama_surveyor;
                $data['nama_petugas'] = $hasil->nama_petugas;
                $data['no_register'] = $hasil->no_register;
                $data['nama_vessel'] = $hasil->nama_vessel;
                $data['supplyer_name'] = $hasil->supplyer_name;
                $data['pelabuhan_muat'] = $hasil->pelabuhan_muat;
                $data['pelabuhan_bongkar'] = $hasil->pelabuhan_bongkar;
                $data['nama_muat'] = $hasil->nama_muat;
                $data['nama_bongkar'] = $hasil->nama_bongkar;
                $data['nama_shipper'] = $hasil->nama_shipper;
                $data['no_register'] = $hasil->no_register;
                $data['tanggal_pencatatan'] = $hasil->tanggal_pencatatan;
                $data['sumber_komoditas'] = $hasil->sumber_komoditas;
                $data['tanggal_pencatatan'] = $hasil->tanggal_pencatatan;
                $data['sumber_komoditas'] = $hasil->sumber_komoditas;
                $data['nama_perusahaan_supplyer'] = $hasil->nama_perusahaan_supplyer;
                $data['jenis_perizinan'] = $hasil->jenis_perizinan;
                $data['provinsi'] = $hasil->provinsi;
                $data['kabupaten'] = $hasil->kabupaten;
                $data['tonase'] = $hasil->tonase;
                $data['kalori'] = $hasil->kalori;
                $data['kurs_fob'] = $hasil->kurs_fob;
                $data['total_tonase_keterangan'] = $hasil->total_tonase_keterangan;
                $data['supplyer_name_lainnya'] = $hasil->supplyer_name_lainnya;

                $data['nama_perusahaan_supplyer_lainnya'] = $hasil->nama_perusahaan_supplyer_lainnya;
                $data['jenis_perizinan_lainnya'] = $hasil->jenis_perizinan_lainnya;

                $data['no_tgl_sk'] = $hasil->no_tgl_sk;
                $data['no_tgl_sk_lainnya'] = $hasil->no_tgl_sk_lainnya;

                $data['kabupaten_lainnya'] = $hasil->kabupaten_lainnya;
                $data['tonase_lainnya'] = $hasil->tonase_lainnya;

                $data['kalori_lainnya'] = $hasil->kalori_lainnya;
                $data['tujuan_domestik'] = $hasil->tujuan_domestik;

                $data['tujuan_pengapalan'] = $hasil->tujuan_pengapalan;
                $data['pemanfaatan'] = $hasil->pemanfaatan;

                $data['end_user'] = $hasil->end_user;
                $data['total_tonase'] = $hasil->total_tonase;

                $data['kurs_mata_uang'] = $hasil->kurs_mata_uang;
                $data['royalti_usd'] = $hasil->royalti_usd;


                $data['royalti_rp'] = $hasil->royalti_rp;
                $data['nama_pembeli'] = $hasil->nama_pembeli;
                $data['alamat_lengkap'] = $hasil->alamat_lengkap;

                $data['barge_tug_boat'] = $hasil->barge_tug_boat;
                $data['bill_of_landing'] = $hasil->bill_of_landing;

                $data['analisa_kalori'] = $hasil->analisa_kalori;
                $data['analisa_total_moisture'] = $hasil->analisa_total_moisture;

                $data['alamat_perusahaan_supplyer_lainnya'] = $hasil->alamat_perusahaan_supplyer_lainnya;
                $data['alamat_perusahaan_supplyer'] = $hasil->alamat_perusahaan_supplyer;

                $data['analisa_sulfur'] = $hasil->analisa_sulfur;
                $data['analisa_ash'] = $hasil->analisa_ash;
                $data['nama_alamat_bank'] = $hasil->nama_alamat_bank;

                $data['setoran_royalti'] = $hasil->setoran_royalti;
                $data['harga_batubara'] = $hasil->harga_batubara;

                $data['copy_setor_royalti'] = $hasil->copy_setor_royalti;
                $data['copy_sertifikat_cnc'] = $hasil->copy_sertifikat_cnc;
                $data['file_foto'] = $hasil->file_foto;
                
                $author = $this->md_lhv->getAuthorSignatureLhv($no_lhv);
           
            
            $data['nama_atasan'] = $author->authorized_sign_name;
            $data['posisi_atasan'] = $author->position_name;
            $data['date_terbit'] = $author->branch.' tanggal '.date(' d F Y',strtotime($hasil->tanggal_lhv));
            $data['mask_id'] = 'LHV.'.$author->initial_id.'.'. substr($no_lhv, -4).'/CS/'. strtoupper(date('M/',strtotime($hasil->tanggal_lhv))).date('Y',strtotime($hasil->tanggal_lhv));
            //$this->auth->TVD($data['mask_id']);die();

                //7 agustus 2017 10:36
                $data['last_status'] = $hasil->laststatus_lhv;

                //$data['note'] = $hasil->note;
                $data['requester'] = $hasil->userid;

                $AryType = $this->CTRL_Option_Type();
                $data['type'] = '';
                $data['option_type'] = $AryType;

                $AryProvince = $this->CTRL_Option_Province();
                $data['provinsi'] = $hasil->provinsi;
                $data['provinsi_lainnya'] = $hasil->provinsi_lainnya;
                $data['option_province'] = $AryProvince;


                $AryNamaPetugas = $this->CTRL_Option_Nama_Petugas();
                $data['nama_petugas'] = $hasil->nama_petugas;
                $data['option_nama_petugas'] = $AryNamaPetugas;

                $AryClients = $this->CTRL_Option_Clients();
                $data['option_nama_perusahaan_supplyer'] = $AryClients;

                $AryAggrement = $this->CTRL_Option_Client();
                $data['aggrement'] = "";
                $data['option_aggrement'] = $AryAggrement;

                $AryPort = $this->CTRL_Option_Port();
                $data['option_port'] = $AryPort;


                $data['nama_surveyor'] = $hasil->nama_surveyor;
                $data['option_nama_surveyor'] = array(
                    '' => 'Pilih Nama Surveyor',
                    'PT. Carsurin' => 'PT. Carsurin');

                $Aryjenis_perizinan = $this->CTRL_Option_Jenis_Perizinan();
                $data['jenis_perizinan'] = $hasil->jenis_perizinan;
                $data['jenis_perizinan_lainnya'] = $hasil->jenis_perizinan_lainnya;
                $data['option_jenis_perizinan'] = $Aryjenis_perizinan;

                $AryDocument = $this->CTRL_Option_Document($no_lhv);
                $data['option_document'] = $AryDocument;

                $AryVariable = $this->CTRL_Option_Variable();
                $data['option_variable'] = $AryVariable;

                $Arytujuan_pengapalan = $this->CTRL_Option_Tujuan_Pengapalan();
                $data['tujuan_pengapalan'] = $hasil->tujuan_pengapalan;
                $data['option_tujuan_pengapalan'] = $Arytujuan_pengapalan;

                $Arykurs_mata_uang = $this->CTRL_Option_Kurs_Mata_Uang();
                $data['kurs_mata_uang'] = $hasil->kurs_mata_uang;
                $data['option_kurs_mata_uang'] = $Arykurs_mata_uang;

                //TAB 4
                $data['history'] = $this->md_lhv->MDL_SelectHistory($hasil->no_lhv);

                $data['table_bill'] = $this->Md_lhv_approval->MDL_SelectDetailBill($no_lhv);
                $data['table_shipment'] = $this->Md_lhv_approval->MDL_SelectDetailPraShipment($no_lhv);
                $data['count_shipment'] = count($this->Md_lhv_approval->MDL_SelectDetailPraShipment($no_lhv));
                $data['table_royalty'] = $this->Md_lhv_approval->MDL_SelectDetailRoyalty($no_lhv);
                $data['count_royalty'] = count($this->Md_lhv_approval->MDL_SelectDetailRoyalty($no_lhv));
                $data['table_cnc'] = $this->Md_lhv_approval->MDL_SelectDetailCNC($no_lhv);

                $data['detail_shipper'] = $this->Md_lhv_approval->MDL_SelectDetailShipper($no_lhv);
                $data['detail_bukti_setor'] = $this->Md_lhv_approval->MDL_SelectDetailBuktiSetor($no_lhv);
                $data['detail_cnc'] = $this->Md_lhv_approval->MDL_SelectCNC($no_lhv);

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - Update", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'lhv/CTRL_Edit/' . $no_lhv;
                $data['url_del'] = 'lhv/CTRL_Delete/' . $no_lhv;
                $data['page'] = 'lhv/form_edit';
                $data['plugin'] = 'lhv/plugin';
                $this->load->view('template_admin', $data);
            }
        }
    }

    public function CTRL_Delete($no_lhv) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($no_lhv, $this->tblName, $this->field_no_lhv)) {
            $data['id'] = $id;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            $no_lhv = $this->input->post('id');
            $this->md_lhv->MDL_Delete($no_lhv);
            redirect('lhv');
        }
    }

    public function CTRL_Delete_Certif() {
        $id = $this->input->post('id');

        $result = $this->md_sample_scanning->MDL_Delete_Certif($id);
        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => 'Some errors occured.'));
        }
    }

    public function CTRL_Print($no_lhv) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            $hasil = $this->Md_lhv_approval->MDL_SelectID($no_lhv);

            $table_bill = $this->Md_lhv_approval->MDL_SelectDetailBill($no_lhv);
            $table_shipment = $this->Md_lhv_approval->MDL_SelectDetailPraShipment($no_lhv);
            $count_shipment = count($this->Md_lhv_approval->MDL_SelectDetailPraShipment($no_lhv));
            $table_royalty = $this->Md_lhv_approval->MDL_SelectDetailRoyalty($no_lhv);
            $count_royalty = count($this->Md_lhv_approval->MDL_SelectDetailRoyalty($no_lhv));
            $table_cnc = $this->Md_lhv_approval->MDL_SelectDetailCNC($no_lhv);

            $template_id = $this->config->item('template_LHV_Full');

            $template = $this->md_template_email->MDL_SelectID($template_id);
            $content = $template->content;

            
            $author = $this->md_lhv->getAuthorSignatureLhv($no_lhv);
            $content = str_replace('{nama_atasan}', $author->authorized_sign_name, $content);
            $content = str_replace('{posisi_atasan}', $author->position_name, $content);
            $content = str_replace('{date_terbit}', $author->branch.' tanggal '.date(' d F Y',strtotime($hasil->tanggal_lhv)), $content);
            
            $mask_id = 'LHV.'.$author->initial_id.'.'. substr($hasil->no_lhv, -4).'/CS/'. strtoupper(date('M/',strtotime($hasil->tanggal_lhv))).date('Y',strtotime($hasil->tanggal_lhv));
            
            
            $content = str_replace('{no_lhv}', $mask_id, $content);
            $content = str_replace('{jenis_perizinan}', $hasil->jenis_perizinan, $content);
            $content = str_replace('{jenis_perizinan_lainnya}', $hasil->jenis_perizinan_lainnya, $content);
            $content = str_replace('{supplyer_name}', $hasil->supplyer_name, $content);
            $content = str_replace('{supplyer_name_lainnya}', $hasil->supplyer_name_lainnya, $content);
            $content = str_replace('{no_tgl_sk}', $hasil->no_tgl_sk, $content);
            $content = str_replace('{no_tgl_sk_lainnya}', $hasil->no_tgl_sk_lainnya, $content);
            $content = str_replace('{alamat_perusahaan_supplyer}', $hasil->alamat_perusahaan_supplyer, $content);
            $content = str_replace('{alamat_perusahaan_supplyer_lainnya}', $hasil->alamat_perusahaan_supplyer_lainnya, $content);
            $content = str_replace('{sumber_komoditas}', $hasil->sumber_komoditas, $content);
            $content = str_replace('{nama_pembeli}', $hasil->nama_pembeli, $content);
            $content = str_replace('{alamat_lengkap}', $hasil->alamat_lengkap, $content);
            $content = str_replace('{pelabuhan_muat}', $hasil->pelabuhan_muat, $content);
            $content = str_replace('{pelabuhan_bongkar}', $hasil->pelabuhan_bongkar, $content);
            $content = str_replace('{nama_vessel}', $hasil->nama_vessel, $content);
            $content = str_replace('{barge_tug_boat}', $hasil->barge_tug_boat, $content);
            
            
            

            
            foreach ($table_bill as $key => $row) {
                $item_table1 .= '<tr>';
                $item_table1 .= '<td align="center" style="font-size: 10px;">1.</td>';
                $item_table1 .= '<td align="left" style="font-size: 10px;">' . $row->name . '</td>';
                $item_table1 .= '<td align="center" style="font-size: 10px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table1 .= '<td align="center" style="font-size: 10px;">' . $row->name_satuan . '</td>';
                $item_table1 .= '<td align="center" style="font-size: 10px;">' . number_format($row->value,$row->number_format) . '</td>';
                $item_table1 .= '<td align="center" style="font-size: 10px;">' . $row->remark . '</td>';
                $item_table1 .= '</tr>';
            }
            $content = str_replace('{table_bill}', $item_table1, $content);

            $item_table2 .= '<tr>';
            $item_table2 .= '<td rowspan="' . (1 + ($count_shipment * 1)) . '" align="center" valign="top" style="font-size: 10px;">2.</td>';
            $item_table2 .= '<td align="left" style="font-size: 10px;">Analisa Kualitas (Pra Shipment)</td>';
            $item_table2 .= '<td colspan="3" align="center" style="font-size: 10px;"></td>';
            $item_table2 .= '<td align="left" style="font-size: 10px;"></td>';
            $item_table2 .= '</tr>';
            $no = 'a';
            foreach ($table_shipment as $key => $row) {
                $item_table2 .= '<tr>';
                $item_table2 .= '<td align="left" style="font-size: 10px;"> ' .$no++. '. '. $row->name . '</td>';
                $item_table2 .= '<td align="center" style="font-size: 10px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table2 .= '<td align="center" style="font-size: 10px;">' . $row->name_satuan . '</td>';
                $item_table2 .= '<td align="center" style="font-size: 10px;">' . number_format($row->value,$row->number_format) . '</td>';
                $item_table2 .= '<td align="center" style="font-size: 10px;">' . $row->remark . '</td>';
                $item_table2 .= '</tr>';
            }

            $content = str_replace('{table_shipment}', $item_table2, $content);

            $item_table3 .= '<tr>';
            $item_table3 .= '<td rowspan="' . (1 + ($count_royalty * 1)) . '" align="center" valign="top" style="font-size: 10px;">3.</td>';
            $item_table3 .= '<td align="left" style="font-size: 10px;">Royalty</td>';
            $item_table3 .= '<td colspan="3" align="center" style="font-size: 10px;"></td>';
            $item_table3 .= '<td align="left" style="font-size: 10px;"></td>';
            $item_table3 .= '</tr>';
            $no = 'a';
            foreach ($table_royalty as $key => $row) {
                $item_table3 .= '<tr>';
                $item_table3 .= '<td align="left" style="font-size: 10px;"> ' .$no++. '. '.  $row->name . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 10px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 10px;">' . $row->name_satuan . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 10px;">' . number_format($row->value,$row->number_format) . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 10px;">' . $row->remark . '</td>';
                $item_table3 .= '</tr>';
            }

            $content = str_replace('{table_royalty}', $item_table3, $content);

            foreach ($table_cnc as $key => $row) {
                $item_table4 .= '<tr>';
                $item_table4 .= '<td align="center" style="font-size: 10px;">4.</td>';
                $item_table4 .= '<td align="left" style="font-size: 10px;">' . $row->name . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 10px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 10px;">' . $row->name_satuan . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 10px;">' . number_format($row->value,$row->number_format) . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 10px;">' . $row->remark . '</td>';
                $item_table4 .= '</tr>';
            }
            $content = str_replace('{table_cnc}', $item_table4, $content);


            $content = str_replace('{nama_surveyor}', $hasil->nama_surveyor, $content);
            $content = str_replace('{nama_petugas}', $hasil->nama_petugas, $content);
            $content = str_replace('{no_register}', $hasil->no_register, $content);
//            $content = str_replace('{nama_atasan}', $hasil->total_tonase_keterangan, $content);
//            $content = str_replace('{posisi_atasan}', $hasil->royalty, $content);
            
            $data = array(
                'content' => $content
            );

            $data['plugin'] = 'lhv/plugin';
            $this->load->view('lhv/print_request_form', $data);
        }
    }

    public function CTRL_Print_Simple($no_lhv) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            $hasil = $this->Md_lhv_approval->MDL_SelectID($no_lhv);
            $bukti_setor = $this->Md_lhv_approval->MDL_SelectDetailBuktiSetor($no_lhv);
            $cnc = $this->Md_lhv_approval->MDL_SelectCNC($no_lhv);
            $shipper = $this->Md_lhv_approval->MDL_SelectDetailShipper($no_lhv);

            $template_id = $this->config->item('template_LHV_Simple');

            $template = $this->md_template_email->MDL_SelectID($template_id);
            $content = $template->content;
            
            $author = $this->md_lhv->getAuthorSignatureLhv($no_lhv);
            $content = str_replace('{nama_atasan}', $author->authorized_sign_name, $content);
            $content = str_replace('{posisi_atasan}', $author->position_name, $content);
            $content = str_replace('{date_terbit}', $author->branch.' tanggal '.date(' d F Y',strtotime($hasil->tanggal_lhv)), $content);
            
            $mask_id = 'LHV.'.$author->initial_id.'.'. substr($hasil->no_lhv, -4).'/CS/'. strtoupper(date('M/',strtotime($hasil->tanggal_lhv))).date('Y',strtotime($hasil->tanggal_lhv));
            
            $content = str_replace('{no_lhv}', $mask_id, $content);
            $content = str_replace('{jenis_perizinan}', $hasil->jenis_perizinan, $content);
            $content = str_replace('{jenis_perizinan_lainnya}', $hasil->jenis_perizinan_lainnya, $content);
            $content = str_replace('{supplyer_name}', $hasil->supplyer_name, $content);
            $content = str_replace('{supplyer_name_lainnya}', $hasil->supplyer_name_lainnya, $content);
            $content = str_replace('{no_tgl_sk}', $hasil->no_tgl_sk, $content);
            $content = str_replace('{no_tgl_sk_lainnya}', $hasil->no_tgl_sk_lainnya, $content);
            $content = str_replace('{alamat_perusahaan_supplyer}', $hasil->alamat_perusahaan_supplyer, $content);
            $content = str_replace('{alamat_perusahaan_supplyer_lainnya}', $hasil->alamat_perusahaan_supplyer_lainnya, $content);
            $content = str_replace('{sumber_komoditas}', $hasil->sumber_komoditas, $content);
            $content = str_replace('{pelabuhan_muat}', $hasil->pelabuhan_muat, $content);
            $content = str_replace('{pelabuhan_bongkar}', $hasil->pelabuhan_bongkar, $content);
            $content = str_replace('{nama_vessel}', $hasil->nama_vessel, $content);
            $content = str_replace('{barge_tug_boat}', $hasil->barge_tug_boat, $content);
            $content = str_replace('{total_tonase}', number_format($hasil->total_tonase,3) . ' MT', $content);
            $content = str_replace('{total_tonase_keterangan}', $hasil->total_tonase_keterangan, $content);
            $content = str_replace('{royalty}', $hasil->royalti_usd . ' USD / Rp.' . $hasil->royalti_rp, $content);

            $content = str_replace('{bukti_setor}', $detail_bukti_setor ? ($bukti_setor->file_upload ? "Ada" : "Tidak Ada") : " Tidak Ada ", $content);
            $content = str_replace('{remark_bukti_setor}', $bukti_setor ? ($bukti_setor->remark ? $bukti_setor->remark : "Tidak Terlampir") : " Tidak Terlampir ", $content);
            $content = str_replace('{bukti_cnc}', $cnc ? ($cnc->file_upload ? "Ada" : "Tidak Ada") : " Tidak Ada ", $content);
            $content = str_replace('{remark_bukti_cnc}', $cnc ? ($cnc->remark ? $shipper->remark : "Tidak Terlampir") : " Tidak Terlampir ", $content);
            $content = str_replace('{bukti_shipper}', $shipper ? ($shipper->file_upload ? "Ada" : "Tidak Ada") : " Tidak Ada ", $content);
            $content = str_replace('{remark_bukti_shipper}', $shipper ? ($shipper->remark ? $shipper->remark : "Tidak Terlampir") : " Tidak Terlampir ", $content);

            $content = str_replace('{nama_surveyor}', $hasil->nama_surveyor, $content);
            $content = str_replace('{nama_petugas}', $hasil->nama_petugas, $content);
            $content = str_replace('{no_register}', $hasil->no_register, $content);
            
            

            $data = array(
                'content' => $content
            );

            $data['plugin'] = 'lhv/plugin';
            $this->load->view('lhv/print_request_form', $data);
        }
    }

    public function CTRL_Option_Province() {
        $this->load->model('md_province');
        $AryProvince = $this->md_province->MDL_Select();
        $option[''] = 'Pilih Provinsi...';
        foreach ($AryProvince as $row) {
            $option[$row->province_code] = $row->province_name;
        }
        return $option;
    }

    public function CTRL_Option_Province2($country) {
        $this->load->model('md_province');
        $AryProvince = $this->md_province->MDL_Select2($country);
        $option[''] = 'Choose Region...';
        foreach ($AryProvince as $row) {
            $option[$row->province_code] = $row->province_name;
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

    public function CTRL_Option_Type() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('COMPANY_TYPE');
        $option[''] = 'Choose Entity Type...';
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }

    public function cek_country_region() {
        $country_code = $this->input->post('country_code');
        $AryData = $this->md_importer->select_region_by_countryID($country_code);

        echo json_encode(array('result' => $AryData));
    }

    public function get_province($country_code) {
        $AryData = $this->md_importer->select_region($country_code);

        $option = array();
        foreach ($AryData as $row) {
            $option[$row->country_code] = $row->province_name;
        }
        //var_dump($option);die();
        echo json_encode(array('result' => $AryData));
        return $option;
    }

    public function CTRL_Option_Port() {
        $this->load->model('md_loading_port');
        $AryPort = $this->md_loading_port->MDL_Select();
        $option[''] = 'Pilih Pelabuhan...';
        foreach ($AryPort as $row) {
            $option[$row->loading_port_code] = $row->loading_port_name;
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

    public function getAllDatas($req_startdate, $req_enddate) {
        $req_startdate = strlen($req_startdate) ? $req_startdate : date("Y-m-01");
        $req_enddate = strlen($req_enddate) ? $req_enddate : date("Y-m-t");


        $results = $this->md_lhv->MDL_Select($req_startdate, $req_enddate);

        echo json_encode($results);
    }

    // 1 agustus 2017 11:16
    public function CTRL_Option_Importer() {
        $AryImporter = $this->md_lhv->MDL_SelectImporter();
        $option[''] = 'Choose a Importer...';
        if ($AryImporter) {
            foreach ($AryImporter as $row) {
                $option[$row->importer_id] = $row->importer_name;
            }
        }
        return $option;
    }

    public function CTRL_Option_Nama_Petugas() {
        $AryNamaPetugas = $this->md_lhv->MDL_SelectPetugas();

        //$this->auth->TVD($AryNamaPetugas);die();
        $option[''] = 'Pilih Nama Petugas...';
        if ($AryNamaPetugas) {
            foreach ($AryNamaPetugas as $row) {
                $name = $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name;
                $option[$name] = $name;
            }
        }
        return $option;
    }

    public function CTRL_Option_Jenis_Perizinan() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('PERIZINAN');
        $option[''] = 'Pilih Jenis Perizinan...';
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }

    public function CTRL_Option_Tujuan_Pengapalan() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('TUJUAN_PENGAPALAN');
        $option[''] = 'Pilih Tujuan Pengapalan...';
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
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

    // 1 agustus 2017 11:16
    public function getNomorRegister() {
        $nama_petugas = $this->input->post('name');

        $sql = "
                select no_register from( 
                select CONCAT(first_name,' ',middle_name,' ',last_name )as nama_petugas ,no_register from tmst_employee where no_register!='') a

                where a.nama_petugas like'%$nama_petugas%' ";

        $result = $this->db->query($sql)->row()->no_register;



        echo json_encode($result);
    }

    // 4 agustus 2017 08:54
    public function CTRL_Option_Transport() {
        $AryTransport = $this->md_lhv->MDL_SelectTransport();
        $option[''] = 'Choose a Transport...';
        if ($AryTransport) {
            foreach ($AryTransport as $row) {
                $option[$row->name] = $row->name;
            }
        }
        return $option;
    }

    public function CTRL_SendEmail($reqid) {

        $config = Array(
            'protocol' => $this->config->item('protocol'),
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $this->config->item('smtp_user'), // change it to yours
            'smtp_pass' => $this->config->item('smtp_pass'), // change it to yours
            'mailtype' => $this->config->item('mailtype'),
            'charset' => $this->config->item('charset'),
            'wordwrap' => $this->config->item('wordwrap')
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->config->item('smtp_user'), 'Laporan Surveyor - Export (Coal)');

        $aryTemplate = $this->md_lhv->MDL_getTemplateEmail('3'); // Template Approval
        $subject = @$aryTemplate->name . "-" . "Request Surveyor Report";
        $message = @$aryTemplate->content;

        # Replace Content Email
        $hasil = $this->md_lhv->MDL_SelectID($reqid);
        $tmpHasil['${REQUESTAPPROVALNAME}'] = "LHV Approval Request";
        $tmpHasil['${REQUEST_NUMBER}'] = $hasil->no_lhv;
        $tmpHasil['${REQUESTER_EMPNO}'] = $hasil->userid;
        $tmpHasil['${REQUESTER_NAME}'] = $hasil->requester_name;

        
        $aryParam = array_keys($tmpHasil);
        $aryValue = array_values($tmpHasil);

        $message = str_replace($aryParam, $aryValue, $message);
        $aryEmail = $this->md_lhv->MDL_getEmailTo($reqid);
        
        while (list($k, $v) = @each($aryEmail)) {
            $emailto = $v;
            $this->email->to($emailto);

            $this->email->subject($subject);
            $this->email->message($message);

            $this->email->send();
        }
    }

    // 4 agustus 2017 08:54
    public function CTRL_Option_Cargo() {
        $AryCargo = $this->md_lhv->MDL_SelectCargo();
        $option[''] = 'Choose a Cargo...';
        if ($AryCargo) {
            foreach ($AryCargo as $row) {
                $option[$row->name] = $row->name;
            }
        }
        return $option;
    }

    public function CTRL_Option_Document($no_lhv) {
        $AryDocument = $this->md_lhv->MDL_SelectDocument($no_lhv);
        $option[''] = 'Pilih Tipe File Terlampir..';
        if ($AryDocument) {
            foreach ($AryDocument as $row) {
                $option[$row->id] = $row->name;
            }
            return $option;
        }
    }

    public function CTRL_Option_Variable() {
        $AryDocument = $this->md_lhv->MDL_SelectVariable();
        $option[''] = 'Kosongkan bila tidak ada..';
        if ($AryDocument) {
            foreach ($AryDocument as $row) {
                $option[$row->id] = $row->name;
            }
            return $option;
        }
    }

    public function CTRL_Option_Client() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('REQUEST_STATUS');
        foreach ($AryTypeStatus as $row) {
            if ($row->id >= '6' && $row->id != '9' && $row->id != '8') {
                $option[$row->id] = $row->name;
            }
        }
        return $option;
    }

    public function CTRL_SendXML() {
        $data = $this->CTRL_ProvideData();

        $str = "<?xml version='1.0' encoding='iso-8859-1'?><lse_batubara_document></lse_batubara_document>";
        $xml = simplexml_load_string($str);

        $header = $xml->addChild('header');
        // $header->addChild('npwp', $data['exporter_npwp']);
        $header->addChild('npwp', '12345');
        $header->addChild('namapersh', $data['client_name']);
        $header->addChild('alamat', $data['exporter_address']);
        $header->addChild('telp', $data['phone']);
        $header->addChild('fax', $data['fax']);
        $header->addChild('email', '');
        $header->addChild('idprop', '');
        $header->addChild('nmprop', '');
        $header->addChild('idkab', '');
        $header->addChild('nmkab', '');
        //$header->addChild('jenisls', 'LS0012');
        $header->addChild('nols', $data['no_lhv']);
        //$header->addChild('nols', 'LS00001');
        $header->addChild('tglls', $data['date_issued']);
        $header->addChild('tglakhirls', $data['date_expired']);
        $header->addChild('urbarang', '');
        $header->addChild('noet', $data['no_reg_exporter']);
        $header->addChild('tglet', $data['date_reg_exporter']);
        $header->addChild('tglakhiret', '2017-08-08'); // Hardcode
        $header->addChild('nospe', ''); // Hardcode
        $header->addChild('tglakhirspe', '2017-08-08'); // Hardcode
        $header->addChild('nopveb', '12345'); // Hardcode
        $header->addChild('tglpveb', '2017-08-08'); // Hardcode
        $header->addChild('tempatperiksa', $data['survey_location']);
        $header->addChild('tglperiksa', $data['survey_location_date']);
        $header->addChild('portperiksa', $data['loading_port_id']);
        $header->addChild('nopacklist', $data['no_packing_list']);
        $header->addChild('tglpacklist', $data['date_packing_list']);
        $header->addChild('noinvoice', $data['no_invoice_packing_list']);
        $header->addChild('tglinvoice', $data['date_invoice_packing_list']);
        $header->addChild('fobusd', $data['total_fas']);
        $header->addChild('kurs', 'USD');
        $header->addChild('namaimp', $data['importer_name']);
        $header->addChild('alamatimp', $data['importer_address']);
        $header->addChild('negaraimp', $data['country']);
        $header->addChild('portmuat', $data['loading_port_code']);
        $header->addChild('tglmuat', $data['tglmuat']); //////////////////////
        $header->addChild('negaratujuan', $data['negaratujuan']); ///////////////
        $header->addChild('porttujuan', $data['port_destination']); ///////////
        $header->addChild('namavessel', $data['vessel_name']);
        $header->addChild('tglmuatvessel', $data['stdate_load_vessel']);
        $header->addChild('noiupop', $data['no_mining_license']);
        $header->addChild('tgliupop', $data['date_mining_license']);
        $header->addChild('noiupopkpp', $data['no_smelter_license']);
        $header->addChild('tgliupopkpp', $data['date_smelter_license']);
        $header->addChild('noiupopkolah', $data['no_transsell_license']);
        $header->addChild('tgliupopkolah', $data['date_transsell_license']);
        $header->addChild('nobayarroyalti', $data['no_royalty_payment']);
        $header->addChild('tglbayarroyalti', $data['date_royalty_payment']);
        $header->addChild('idlc', $data['no_lc']); //////////////////////////////lc_type
        $header->addChild('nolc', $data['no_lc']);
        $header->addChild('tgllc', $data['date_lc']);
        $header->addChild('modetransport', $data['mode_transport']);
        $header->addChild('cargotype', $data['cargo_type']);
        $header->addChild('nopetikemas', $data['container_numseal']); //////////////////////////////////////////////////////
        $header->addChild('nosegel', $data['container_numseal']);
        $header->addChild('catatanperiksa', $data['note']);
        $header->addChild('kesimpulan', $data['note']);

        if ($data['komoditas']) {
            $komoditas = $xml->addChild('komoditas');
            foreach ($data['komoditas'] as $key => $kom) {
                $item = $komoditas->addChild('loop');

                $item->addChild('seri', $kom->lse_id);
                $item->addChild('hs', $kom->hs);
                $item->addChild('uraian', $kom->description);
                $item->addChild('volume', $kom->quantity);
                $item->addChild('satuan', 'TNE'); ////////////////////////////
                $item->addChild('fob', $kom->fas);
                $item->addChild('kurs', 'USD'); ///////////////////////////////
                $item->addChild('noiup', $kom->no_mining_license);
                $item->addChild('tgliup', ''); //////////////////////////////////
            }
        }

        if ($data['detil_batubara']) {
            $detil_batubara = $xml->addChild('detil_batubara');
            foreach ($data['detil_batubara'] as $key => $det_bat) {

                $item = $detil_batubara->addChild('loop');


                $item->addChild('seri', $det_bat->id_cal);
                $item->addChild('cal_arb', $det_bat->cal_arb);
                $item->addChild('cal_adb', $det_bat->cal_adb);
                $item->addChild('tm_arb', $det_bat->tm_arb);
                $item->addChild('tash_adb', $det_bat->t_ash_adb);
                $item->addChild('tsulf_adb', $det_bat->t_sulfur_adb);
                $item->addChild('klasifikasibb', 1234); ////////////////////////di petunjuk harus terisi angka
                // $item->addChild('klasifikasibb', $det_bat->klasifikasi_batubara);
                $item->addChild('keterangan', $det_bat->ket);
            }
        }

        if ($data['detil_asal']) {
            $detil_asal = $xml->addChild('detil_asal');
            foreach ($data['detil_asal'] as $key => $det_asal) {

                $item = $detil_asal->addChild('loop');

                $item->addChild('seri', $det_asal->id_roy);
                $item->addChild('npwp', $det_asal->npwp);
                $item->addChild('nmpersh', $det_asal->client_name);
                $item->addChild('idprop', $det_asal->province_code);
                $item->addChild('nmprop', $det_asal->province_name);
                $item->addChild('royalti', $det_asal->royalty_dp);
                $item->addChild('kurs', 'USD');
            }
        }

        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = true;
        $doc->loadXML($xml->asXML(), LIBXML_NOBLANKS);
        $doc->save('xml/' . $data['no_lhv'] . '.xml');

        $file = 'xml/' . $data['no_lhv'] . '.xml';
        $xml = simplexml_load_file($file);
        //$this->auth->TVD($xml); exit();
        $xml = $xml->asXML();


        /* Koneksi Web Services with NuSoap Client */
        $this->load->library("Nusoap_lib");
        $data = array(
            "wscarsurin", // Username
            "54FRB4WK", // Password
            $xml
        );

        $soapclient = new nusoap_client('http://inatrade.kemendag.go.id/ws/lse_bb.php');
        $result = $soapclient->call("sendDocument", $data);
        $this->auth->TVD($result);
        exit();

        if ($result['respond']->status == "R00") {
            //Update Status refunmer pada LSE 
            $this->md_lhv->MDL_UpdateRefnumberSuccess($data['no_lhv'], $result['respond']->refnumber);
            print("
				<script language=\"javascript\">
					alert('Data has been sent to INATRADE');
					window.location.href = document.referrer;
				</script>");
        } else {
            print("
				<script language=\"javascript\">
					alert('Integration failed, please check any required information and try again.');
					window.location.href = document.referrer;
				</script>");
        }
    }

    private function CTRL_ProvideData() {

        $no_lhv = $this->uri->segment(3);
        $this->load->model('md_ref_json');
        $breadcrum = $this->breadcrumbs->output();
        $data['breadcrum'] = $breadcrum;


        $hasil = $this->md_lhv->MDL_SelectID($no_lhv);

        $data['exporter_npwp'] = $hasil->exporter_npwp;
        $data['client_name'] = $hasil->client_name;
        $data['exporter_address'] = $hasil->exporter_address;
        $data['phone'] = $hasil->phone;
        $data['fax'] = $hasil->fax;
        $data['no_lhv'] = $hasil->no_lhv;
        $data['date_issued'] = $hasil->date_issued;
        $data['date_expired'] = $hasil->date_expired;
        $data['no_reg_exporter'] = $hasil->no_reg_exporter;
        $data['date_reg_exporter'] = $hasil->date_reg_exporter;
        $data['survey_location'] = $hasil->survey_location;
        $data['survey_location_date'] = $hasil->survey_location_date;
        $data['loading_port_id'] = $hasil->loading_port_id;

        $data['no_packing_list'] = $hasil->no_packing_list;
        $data['date_packing_list'] = $hasil->date_packing_list;
        $data['no_invoice_packing_list'] = $hasil->no_invoice_packing_list;
        $data['date_invoice_packing_list'] = $hasil->date_invoice_packing_list;
        $data['total_fas'] = $hasil->total_fas;
        $data['importer_name'] = $hasil->importer_name;
        $data['importer_address'] = $hasil->importer_address;

        $data['country'] = $hasil->country;
        $data['loading_port_code'] = $hasil->loading_port_code;

        $data['tglmuat'] = $hasil->date_lc;
        $data['negaratujuan'] = $hasil->country_id;
        $data['port_destination'] = $hasil->port_destination;

        $data['vessel_name'] = $hasil->vessel_name;
        $data['stdate_load_vessel'] = $hasil->stdate_load_vessel;
        $data['no_mining_license'] = $hasil->no_mining_license;
        $data['date_mining_license'] = $hasil->date_mining_license;
        $data['no_smelter_license'] = $hasil->no_smelter_license;
        $data['date_smelter_license'] = $hasil->date_smelter_license;

        $data['no_transsell_license'] = $hasil->no_transsell_license;
        $data['date_transsell_license'] = $hasil->date_transsell_license;
        $data['no_royalty_payment'] = $hasil->no_royalty_payment;
        $data['date_royalty_payment'] = $hasil->date_royalty_payment;

        $data['lc_type'] = $hasil->lc_type;
        $data['no_lc'] = $hasil->no_lc;
        $data['date_lc'] = $hasil->date_lc;
        $data['mode_transport'] = $hasil->mode_transport;
        $data['cargo_type'] = $hasil->cargo_type;


        $data['container_numseal'] = $hasil->container_numseal;
        $data['note'] = $hasil->note;


        $data['komoditas'] = $this->md_lhv->MDL_SelectSR1($no_lhv);
        $data['detil_asal'] = $this->md_lhv->MDL_SelectSR2($no_lhv);
        $data['detil_batubara'] = $this->md_lhv->MDL_SelectSR3($no_lhv);



        $this->auth->TVD($data);
        die();

        return $data;
    }

    public function CTRL_Option_Clients() {
        $AryClients = $this->md_lhv->MDL_SelectClients();
        $option[''] = 'Pilih Perusahaan...';
        if ($AryClients) {
            foreach ($AryClients as $row) {
                $option[$row->client_id] = $row->client_name;
            }
        }
        return $option;
    }

    public function getClientAddress() {

        $id_client = $this->input->post('id_client');
        // $exporter = $this->db->get_where('tmst_client', array('client_id' => $id_client))->row();
        $client = $this->db->query("select address from tmst_client  where client_id='$id_client'")->row();
        $result = array(
            'address' => $client->address,
        );

        echo json_encode($result);
    }

    public function CTRL_Delete_Document($no_lhv, $id) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('delete')) {
            $data['action'] = 'delete';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } else {
            $this->md_lhv->MDL_Delete_Document($id);
            redirect('lhv/CTRL_Edit/' . $no_lhv . '/#FormC');
        }
    }

}
