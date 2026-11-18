<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lhv_approval extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('Md_lhv_approval');
        $this->load->model('Md_lhv');
        $this->load->model('md_template_email');
        $this->load->model('md_employee');
        $this->tblName = $this->config->item('ttrs_lhv');
        $this->field = 'no_lhv';
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

            $laststatus_lhv = $this->input->post('laststatus_lhv');
            $laststatus_lhv = strlen($laststatus_lhv) ? $laststatus_lhv : '1';
            $data['laststatus_lhv'] = $laststatus_lhv;

            $AryStatment = $this->CTRL_Option_TypeView();
            $data['laststatus'] = $laststatus_lhv;
            $data['option_laststatus'] = $AryStatment;

            $data['results'] = $this->Md_lhv_approval->MDL_SelectApprove($laststatus_lhv);

            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%Lhv_approval/CTRL_View/", site_url());
            $data['page'] = 'Lhv_approval/view';
            $data['plugin'] = 'Lhv_approval/plugin';
            $this->load->view('template_admin', $data);
        }
    }

    public function CTRL_Edit($no_lhv) {
        if (!$this->auth->Auth_isPerm()) {
            $this->load->view('error_akses');
        } elseif (!$this->auth->Auth_isPrivButton('edit')) {
            $data['action'] = 'edit';
            $data['page'] = 'error_sysmenu';
            $this->load->view('template_admin', $data);
        } elseif (!$this->auth->Auth_isRecID($no_lhv, $this->tblName, $this->field)) {
            $data['id'] = $no_lhv;
            $data['page'] = 'error_invalidID';
            $this->load->view('template_admin', $data);
        } else {
            if ($this->input->post('close')) {
                redirect('Lhv_approval');
            } elseif ($this->input->post('btn_send')) {


                $approval_status = $this->input->post('approval_status');
                $this->Md_lhv_approval->MDL_Approve($no_lhv);
                $this->Md_lhv_approval->MDL_Insert($no_lhv);
                
                $this->CTRL_SendEmail($no_lhv);

                redirect('Lhv_approval');
                //}
            } elseif ($this->input->post('btn_void')) {
                $void_notes = $this->input->post('void_notes');
                $this->Md_lhv_approval->MDL_InsertVoid($no_lhv, $void_notes);
                $this->Md_lhv_approval->MDL_Set_Void($no_lhv, $void_notes);
                redirect('Lhv_approval');
            } elseif ($this->input->post('btn_aggrement')) {
                $this->Md_lhv_approval->MDL_ApproveAggrement($no_lhv);
                $this->Md_lhv_approval->MDL_InsertAggrement($no_lhv);
                redirect('lhv_approval/CTRL_Edit/' . $no_lhv . '/#FormE');
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
                $this->breadcrumbs->add('LSE Approval Statment', current_url());
                $breadcrum = $this->breadcrumbs->output();
                $data['breadcrum'] = $breadcrum;
                /* end */

                //TAB 1
                $hasil = $this->Md_lhv_approval->MDL_SelectID($no_lhv);

                $data['id'] = $hasil->id;
                $data['no_lhv'] = $hasil->no_lhv;
                $data['tanggal_lhv'] = $hasil->tanggal_lhv;
                $data['nama_pembeli'] = $hasil->nama_pembeli;
                $data['alamat_lengkap'] = $hasil->alamat_lengkap;
                $data['nama_vessel'] = $hasil->nama_vessel;
                $data['barge_tug_boat'] = $hasil->barge_tug_boat;
                $data['bill_of_landing'] = $hasil->bill_of_landing;
                $data['analisa_kalori'] = $hasil->analisa_kalori;
                $data['analisa_total_moisture'] = $hasil->analisa_total_moisture;
                $data['analisa_sulfur'] = $hasil->analisa_sulfur;
                $data['analisa_ash'] = $hasil->analisa_ash;
                $data['nama_alamat_bank'] = $hasil->nama_alamat_bank;
                $data['setoran_royalti'] = $hasil->setoran_royalti;
                $data['harga_batubara'] = $hasil->harga_batubara;
                $data['nama_surveyor'] = $hasil->nama_surveyor;
                $data['nama_petugas'] = $hasil->nama_petugas;
                $data['no_register'] = $hasil->no_register;
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
                $data['supplyer_name'] = $hasil->supplyer_name;
                $data['jenis_perizinan'] = $hasil->jenis_perizinan;
                $data['provinsi'] = $hasil->provinsi;
                $data['kabupaten'] = $hasil->kabupaten;
                $data['tonase'] = $hasil->tonase;
                $data['kalori'] = $hasil->kalori;
                $data['nama_perusahaan_supplyer_lainnya'] = $hasil->nama_perusahaan_supplyer_lainnya;
                $data['supplyer_name_lainnya'] = $hasil->supplyer_name_lainnya;
                $data['jenis_perizinan_lainnya'] = $hasil->jenis_perizinan_lainnya;
                $data['no_tgl_sk'] = $hasil->no_tgl_sk;
                $data['no_tgl_sk_lainnya'] = $hasil->no_tgl_sk_lainnya;
                $data['alamat_perusahaan_supplyer_lainnya'] = $hasil->alamat_perusahaan_supplyer_lainnya;
                $data['alamat_perusahaan_supplyer'] = $hasil->alamat_perusahaan_supplyer;
                $data['kabupaten_lainnya'] = $hasil->kabupaten_lainnya;
                $data['tonase_lainnya'] = $hasil->tonase_lainnya;
                $data['kalori_lainnya'] = $hasil->kalori_lainnya;
                $data['tujuan_domestik'] = $hasil->tujuan_domestik;
                $data['tujuan_pengapalan'] = $hasil->tujuan_pengapalan;
                $data['pemanfaatan'] = $hasil->pemanfaatan;
                $data['end_user'] = $hasil->end_user;
                $data['total_tonase'] = $hasil->total_tonase;
                $data['total_tonase_keterangan'] = $hasil->total_tonase_keterangan;
                $data['kurs_mata_uang'] = $hasil->kurs_mata_uang;
                $data['royalti_usd'] = $hasil->royalti_usd;
                $data['royalti_rp'] = $hasil->royalti_rp;
                $data['last_status'] = $hasil->laststatus_lhv;
                $data['file_foto'] = $hasil->file_foto;
                $data['kurs_fob'] = $hasil->kurs_fob;
                $data['session_user'] = $this->session->userdata('userid');
                $data['requester'] = $hasil->userid;

                $data['total_tonase_keterangan'] = $hasil->total_tonase_keterangan;

                $AryProvince = $this->CTRL_Option_Province();
                $data['provinsi'] = $hasil->provinsi;
                $data['provinsi_lainnya'] = $hasil->provinsi_lainnya;
                $data['option_province'] = $AryProvince;

                $Aryjenis_perizinan = $this->CTRL_Option_Jenis_Perizinan();
                $data['jenis_perizinan'] = $hasil->jenis_perizinan;
                $data['jenis_perizinan_lainnya'] = $hasil->jenis_perizinan_lainnya;
                $data['option_jenis_perizinan'] = $Aryjenis_perizinan;

                $AryNamaPetugas = $this->CTRL_Option_Nama_Petugas();
                $data['option_nama_petugas'] = $AryNamaPetugas;

                $Arykurs_mata_uang = $this->CTRL_Option_Kurs_Mata_Uang();
                $data['option_kurs_mata_uang'] = $Arykurs_mata_uang;

                $Arytujuan_pengapalan = $this->CTRL_Option_Tujuan_Pengapalan();
                $data['option_tujuan_pengapalan'] = $Arytujuan_pengapalan;

                $AryClients = $this->CTRL_Option_Clients();
                $data['option_nama_perusahaan_supplyer'] = $AryClients;

                $AryPort = $this->CTRL_Option_Port();
                $data['option_port'] = $AryPort;

                $data['hasil_approveby'] = $this->Md_lhv_approval->MDL_ApproveBy($no_lhv);
                $current_approver = $this->Md_lhv_approval->MDL_ApproveBy_Now($no_lhv);
                $data['approver'] = array();
                if ($current_approver != null) {
                    $data['approver'] = $current_approver->approved_by;
                }
                $AryStatment = $this->CTRL_Option_Type();
                $data['statement'] = $hasil->laststatus_lhv;
                $data['option_statement'] = $AryStatment;


                $data['document_results'] = $this->md_lhv->MDL_SelectDocumentVerification($no_lhv);


                //TAB 4
                $data['history'] = $this->Md_lhv_approval->MDL_SelectHistory($no_lhv);

                //CERTIFICATE
                $data['table_bill'] = $this->Md_lhv_approval->MDL_SelectDetailBill($no_lhv);
                $data['table_shipment'] = $this->Md_lhv_approval->MDL_SelectDetailPraShipment($no_lhv);
                $data['count_shipment'] = count($this->Md_lhv_approval->MDL_SelectDetailPraShipment($no_lhv));
                $data['table_royalty'] = $this->Md_lhv_approval->MDL_SelectDetailRoyalty($no_lhv);
                $data['count_royalty'] = count($this->Md_lhv_approval->MDL_SelectDetailRoyalty($no_lhv));
                $data['table_cnc'] = $this->Md_lhv_approval->MDL_SelectDetailCNC($no_lhv);

                $data['detail_shipper'] = $this->Md_lhv_approval->MDL_SelectDetailShipper($no_lhv);
                $data['detail_bukti_setor'] = $this->Md_lhv_approval->MDL_SelectDetailBuktiSetor($no_lhv);
                $data['detail_cnc'] = $this->Md_lhv_approval->MDL_SelectCNC($no_lhv);

                $AryAggrement = $this->CTRL_Option_Client();
                $data['aggrement'] = "";
                $data['option_aggrement'] = $AryAggrement;

                $nm_title = $this->auth->Auth_getNameMenu();
                $data['title_head'] = sprintf("%s - LSE Approval Statment", $nm_title);
                $data['title'] = sprintf("%s", $nm_title);
                $data['url'] = 'Lhv_approval/CTRL_Edit/' . $no_lhv;
                $data['url_del'] = 'Lhv_approval/CTRL_Delete/' . $no_lhv;
                $data['page'] = 'Lhv_approval/form_edit';
                $data['plugin'] = 'Lhv_approval/plugin';
                $this->load->view('template_admin', $data);
            }
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

            $content = str_replace('{no_lhv}', $hasil->no_lhv, $content);
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
                $item_table1 .= '<td align="center" style="font-size: 11px;">1.</td>';
                $item_table1 .= '<td align="left" style="font-size: 11px;">' . $row->name . '</td>';
                $item_table1 .= '<td align="center" style="font-size: 11px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table1 .= '<td align="center" style="font-size: 11px;">' . $row->name_satuan . '</td>';
                $item_table1 .= '<td align="center" style="font-size: 11px;">' . number_format($row->value, $row->number_format, ".", ","). '</td>';
                $item_table1 .= '<td align="center" style="font-size: 11px;">' . $row->remark . '</td>';
                $item_table1 .= '</tr>';
            }
            $content = str_replace('{table_bill}', $item_table1, $content);

            $item_table2 .= '<tr>';
            $item_table2 .= '<td rowspan="' . (1 + ($count_shipment * 1)) . '" align="center" valign="top" style="font-size: 11px;">2.</td>';
            $item_table2 .= '<td align="left" style="font-size: 11px;">Analisa Kualitas (Pra Shipment)</td>';
            $item_table2 .= '<td colspan="3" align="center" style="font-size: 11px;"></td>';
            $item_table2 .= '<td align="left" style="font-size: 11px;"></td>';
            $item_table2 .= '</tr>';
            foreach ($table_shipment as $key => $row) {
                $item_table2 .= '<tr>';
                $item_table2 .= '<td align="left" style="font-size: 11px;">' . $row->name . '</td>';
                $item_table2 .= '<td align="center" style="font-size: 11px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table2 .= '<td align="center" style="font-size: 11px;">' . $row->name_satuan . '</td>';
                $item_table2 .= '<td align="center" style="font-size: 11px;">' . number_format($row->value, $row->number_format). '</td>';
                $item_table2 .= '<td align="center" style="font-size: 11px;">' . $row->remark . '</td>';
                $item_table2 .= '</tr>';
            }

            $content = str_replace('{table_shipment}', $item_table2, $content);

            $item_table3 .= '<tr>';
            $item_table3 .= '<td rowspan="' . (1 + ($count_royalty * 1)) . '" align="center" valign="top" style="font-size: 11px;">3.</td>';
            $item_table3 .= '<td align="left" style="font-size: 11px;">Royalty</td>';
            $item_table3 .= '<td colspan="3" align="center" style="font-size: 11px;"></td>';
            $item_table3 .= '<td align="left" style="font-size: 11px;"></td>';
            $item_table3 .= '</tr>';
            foreach ($table_royalty as $key => $row) {
                $item_table3 .= '<tr>';
                $item_table3 .= '<td align="left" style="font-size: 11px;">' . $row->name . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 11px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 11px;">' . $row->name_satuan . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 11px;">' . number_format($row->value, $row->number_format) . '</td>';
                $item_table3 .= '<td align="center" style="font-size: 11px;">' . $row->remark . '</td>';
                $item_table3 .= '</tr>';
            }

            $content = str_replace('{table_royalty}', $item_table3, $content);

            foreach ($table_cnc as $key => $row) {
                $item_table4 .= '<tr>';
                $item_table4 .= '<td align="center" style="font-size: 11px;">4.</td>';
                $item_table4 .= '<td align="left" style="font-size: 11px;">' . $row->name . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 11px;">' . ($row->file_upload ? "Ada" : "Tidak Ada") . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 11px;">' . $row->name_satuan . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 11px;">' . $row->value . '</td>';
                $item_table4 .= '<td align="center" style="font-size: 11px;">' . $row->remark . '</td>';
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

            $data['plugin'] = 'Lhv_approval/plugin';
            $this->load->view('Lhv_approval/print_request_form', $data);
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

            $content = str_replace('{no_lhv}', $hasil->no_lhv, $content);
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
            $content = str_replace('{total_tonase}', $hasil->total_tonase . ' MT', $content);
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
//            $content = str_replace('{nama_atasan}', $hasil->total_tonase_keterangan, $content);
//            $content = str_replace('{posisi_atasan}', $hasil->royalty, $content);

            $data = array(
                'content' => $content
            );

            $data['plugin'] = 'Lhv_approval/plugin';
            $this->load->view('Lhv_approval/print_request_form', $data);
        }
    }

    public function CTRL_Option_Type() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('REQUEST_STATUS');
        foreach ($AryTypeStatus as $row) {
            if ($row->id != '0' && $row->id != '1' && $row->id != '2' && $row->id != '6' && $row->id != '7' && $row->id != '8') {
                $option[$row->id] = $row->name;
            }
        }
        return $option;
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

    public function CTRL_Option_TypeView() {
        $this->load->model('md_ref_json');
        $Aryapproval_status = $this->md_ref_json->MDL_Select_MasterType('REQUEST_STATUS');
        foreach ($Aryapproval_status as $row) {
            $option[$row->id] = $row->name;
        }
        $option['0'] = 'All';
        return $option;
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

    public function CTRL_Option_Jenis_Perizinan() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('PERIZINAN');
        $option[''] = 'Pilih Jenis Perizinan...';
        foreach ($AryTypeStatus as $row) {
            $option[$row->id] = $row->name;
        }
        return $option;
    }

    public function CTRL_Option_Nama_Petugas() {
        $this->load->model('md_lhv');
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

    public function CTRL_Option_Kurs_Mata_Uang() {
        $this->load->model('md_ref_json');
        $AryTypeStatus = $this->md_ref_json->MDL_Select_MasterType('CURRENCY');
        $option[''] = 'Pilih Kurs Mata Uang...';
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

    public function CTRL_Option_Clients() {
        $this->load->model('md_lhv');
        $AryClients = $this->md_lhv->MDL_SelectClients();
        $option[''] = 'Pilih Perusahaan...';
        if ($AryClients) {
            foreach ($AryClients as $row) {
                $option[$row->client_id] = $row->client_name;
            }
        }
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
    
    
    public function CTRL_SendEmail($reqid) {
        $this->load->model('md_lhv');
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

        $Aryapproval_status = $this->CTRL_Option_Status();
        $aryTemplate = $this->md_lhv->MDL_getTemplateEmail('2'); // Template Pass Approval
        $subject = @$aryTemplate->name . "-" . "Request Surveyor Export";
        $message = @$aryTemplate->content;

        
        # Replace Content Email
        $hasil = $this->Md_lhv_approval->MDL_Select_DetailEmail($reqid);
        
        

        $tmpHasil['${REQUESTAPPROVALNAME}'] = "LSCOAL Approval Request";
        $tmpHasil['${REQUEST_NUMBER}'] = $hasil->request_no;
        $tmpHasil['${APPROVER_EMPNO}'] = $hasil->fixed_approver;
        $tmpHasil['${APPROVER_NAME}'] = $hasil->emp_name;
        $tmpHasil['${REQUEST_STATUS}'] = @$Aryapproval_status[$hasil->status];
        $aryParam = array_keys($tmpHasil);
        $aryValue = array_values($tmpHasil);

        $message = str_replace($aryParam, $aryValue, $message);

        
        
        $aryEmail = $this->Md_lhv_approval->MDL_getEmailTo($reqid);
        
       
        
        while (list($k, $v) = @each($aryEmail)) {
            //$emailto = @join(",",$aryEmail);
            //$aryEmailCC = $this->md_advancerequest->MDL_getEmailCC();
            //$emailcc = @join(",",$aryEmailCC);

            $emailto = $v;
            $this->email->to($emailto);
            // if(count($aryEmailCC) > 0) {
            // $this->email->cc($emailcc);
            // }

            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
        }
    }
    
    public function CTRL_Option_Status() {
        $this->load->model('md_ref_json');
        $Aryapproval_status = $this->md_ref_json->MDL_Select_MasterType('REQUEST_STATUS');
        foreach ($Aryapproval_status as $row) {
            $option[$row->id] = $row->name;
        }
        $option['0'] = 'All';
        return $option;
    }
    
}
