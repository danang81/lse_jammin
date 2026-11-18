<?php

class Md_list_lse extends CI_Model {

    public function MDL_Select($start_date, $end_date){
        $tblinsw = $this->config->item('tmst_insw');
        $tblTypeVar = $this->config->item('tmst_typevar');
        
        $hasil = array();
        $sSQL = "
                SELECT i.*, t.name as prosesName 
                FROM $tblinsw i
                LEFT JOIN(SELECT id, name FROM $tblTypeVar WHERE table_name = 'KODE_PROSES')t ON t.id = i.kodeProses
                WHERE 1=1
                    AND i.recdate >= '$start_date'
                    AND i.recdate <= '$end_date'
                ORDER BY i.id ASC        
        ";
        // $this->auth->TVD($sSQL);
        // die();
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

    public function MDL_getAutoID2() {
        
        $tbllse = $this->config->item('tmst_insw');
        $tblBranch = $this->config->item('tmst_branch');
        $tahun = date("y");
        $bulan = date("m");

        $branch_id = $this->input->post('branch_id');
        $FILTER_BRANCH = strlen($branch_id) ? "AND a.id = '$branch_id'" : '';

        $sSQL = "
            SELECT a.initial_id,a.last_id,MAX(b.num) AS no_urut,MAX(b.old_year) AS old_year
            FROM $tblBranch a
            LEFT JOIN
            ( 
                SELECT CAST(SUBSTRING(no_lse,14,4) AS UNSIGNED INTEGER) AS num, CAST(SUBSTRING(no_lse,9,2) AS UNSIGNED INTEGER) AS old_year,branch_id
                FROM $tbllse
            ) b ON b.branch_id = a.id AND b.old_year = '$tahun'
            WHERE 1=1
            $FILTER_BRANCH
        ";
        //$this->auth->TVD($sSQL); exit();
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            $data = $ambil->row();

            if ($data->old_year =='') {
                $no_urut = 1;
            }else {
                $no_urut = $data->no_urut + 1;        
            }
        } else {
            $no_urut = $data->last_id;
        }

        $hasil = sprintf("%s-LNSW$tahun$bulan%04d",$data->initial_id, $no_urut);
        return $hasil;
    }

    public function MDL_SelectID($id){
        $tblinsw = $this->config->item('tmst_insw');
        $tmst_barang_insw = $this->config->item('tmst_barang_insw');
        $tmst_kerjasama_insw = $this->config->item('tmst_kerjasama_insw');


        $sSQL = "
                SELECT i.id as id_ls, i.*, k.kodeKategoriBarang, k.namaKategoriBarang, k.nomorNtpn, k.tanggalNtpn, 
                k.npwpPenjual, k.npwpPenambang, k.npwpTrader, k.tonasePembelian, k.tonaseEkspor, k.nama_perusahaan_barang, 
                b.id_insw,b.seriBarang,b.kodeKategoriEksportir,b.namaKategoriEksportir,b.kodeHs,b.uraianBarang,b.hargaSatuan,b.fob,
                b.jumlahTonase,b.number_format,b.asalBarang,b.isAddition,b.no_mining_license
                FROM $tblinsw i
                LEFT JOIN $tmst_barang_insw b ON i.nomorAju = b.nomorAju
                LEFT JOIN $tmst_kerjasama_insw k ON b.id = k.pid_barang
                WHERE 1=1
                AND i.id = '$id'
                ORDER BY i.id ASC        
        ";
        //$this->auth->TVD($sSQL); exit();
        $ambil = $this->db->query($sSQL);

        return $ambil->row();
    }

    public function MDL_Select_Detail($id){
        $tblinsw = $this->config->item('tmst_insw');
        $tmst_barang_insw = $this->config->item('tmst_barang_insw');
        $tmst_kerjasama_insw = $this->config->item('tmst_kerjasama_insw');
        $tblTypeVar = $this->config->item('tmst_typevar');
        $tmst_branch = $this->config->item('tmst_branch');
        $tmst_jenis_ls = $this->config->item('tmst_jenis_ls');

        $sSQL = "
                SELECT i.*, br.branch, ls.nama_ls, b.id AS id_barang, c.nama_penjualan, v.nama_vessel, p.jenis_pengajuan, iu.iup, k.pid_barang
                FROM $tblinsw i
                LEFT JOIN $tmst_barang_insw b ON b.nomorAju = i.nomorAju
                LEFT JOIN $tmst_kerjasama_insw k ON k.pid_barang = b.nomorAju
                LEFT JOIN(SELECT id, name AS nama_penjualan FROM $tblTypeVar WHERE table_name = 'PENJUALAN_BATUBARA')c ON c.id = i.penjualan
                LEFT JOIN(SELECT id, name AS nama_vessel FROM $tblTypeVar WHERE table_name = 'PEMUATAN_VESSEL')v ON v.id = i.lokasiMuatVessel
                LEFT JOIN(SELECT id, name AS jenis_pengajuan FROM $tblTypeVar WHERE table_name = 'JENIS_PENGAJUAN')p ON p.id = i.jnspengajuan
                LEFT JOIN(SELECT id, name AS iup FROM $tblTypeVar WHERE table_name = 'JENIS_IUP')iu ON iu.id = i.eksportir_jenisIup
                LEFT JOIN $tmst_branch br on i.branch_id = br.id
                LEFT JOIN $tmst_jenis_ls ls on i.detail_jenis_lse = ls.id
                WHERE i.id='$id'
        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->row();
    }

    public function MDL_InsertBarang(){
        $tmst_barang_insw = $this->config->item('tmst_barang_insw');
        
        $kategoriEksportir = $this->input->post('kodeKategoriEksportir');
        
        if($kategoriEksportir == 1){
            $nama_kategori = 'Penambang';
        } else{
            $nama_kategori = 'Trader';
        }
    
        $data = array(
            'nomorAju'              => $this->input->post('nomorAju'),
            'seriBarang'            => $this->input->post('seriBarang'),
            'namaKategoriEksportir' => $nama_kategori,
            'kodeKategoriEksportir' => $this->input->post('kodeKategoriEksportir'),
            'kodeHs'                => $this->input->post('kodeHs'),
            'uraianBarang'          => $this->input->post('uraianBarang'),
            'hargaSatuan'           => str_replace(',', '', $this->input->post('hargaSatuan')),
            'fob'                   => str_replace(',', '', $this->input->post('fob')),
            'jumlahTonase'          => str_replace(',', '', $this->input->post('jumlahTonase')),
            'number_format'         => $this->input->post('number_format'),
            'asalBarang'            => $this->input->post('asalBarang'),
            'recdate'               => date("Y-m-d H:i:s"),   
            'isAddition'            => 1,
            'no_mining_license'     => $this->input->post('no_mining_license')
        );
        //$this->auth->TVD($data); exit();
        $res5 = $this->db->insert($tmst_barang_insw, $data);

        return $res5;
    }

    public function MDL_SelectBarangID($id){
        $tmst_barang_insw = $this->config->item('tmst_barang_insw');

        $sSQL = "
                SELECT b.* FROM $tmst_barang_insw b
                WHERE b.id = '$id'
        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->row();
    }

    public function MDL_SelectBarang($id){
        $tmst_barang_insw = $this->config->item('tmst_barang_insw');
        $tmst_insw = $this->config->item('tmst_insw');

        $sSQL = "
                SELECT b.* FROM $tmst_barang_insw b,$tmst_insw a
                WHERE a.id = '$id'
                AND b.nomorAju = a.nomorAju
                AND a.id = b.id_insw
                ORDER BY b.seriBarang ASC
        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->result();
    }

    public function MDL_Edit_Barang($id) {
        $tmst_barang_insw = $this->config->item('tmst_barang_insw');
        
        $kategoriEksportir = $this->input->post('kodeKategoriEksportir');
        
        if($kategoriEksportir == 1){
            $nama_kategori = 'Penambang';
        } else{
            $nama_kategori = 'Trader';
        }

        $data = array(
            'nomorAju' => $this->input->post('nomorAju'),
            'seriBarang' => $this->input->post('seriBarang'),
            'namaKategoriEksportir' => $nama_kategori,
            'kodeKategoriEksportir' => $kategoriEksportir,
            'kodeHs' => $this->input->post('kodeHs'),
            'uraianBarang' => $this->input->post('uraianBarang'),
            'hargaSatuan' => str_replace(',', '', $this->input->post('hargaSatuan')),
            'fob' => str_replace(',', '', $this->input->post('fob')),
            'jumlahTonase' => str_replace(',', '', $this->input->post('jumlahTonase')),
            'number_format' => $this->input->post('number_format'),
            'asalBarang' => $this->input->post('asalBarang'),      
            'moddate' => date("Y-m-d H:i:s"),    
            'no_mining_license'     => $this->input->post('no_mining_license')
        );
        //  $this->auth->TVD($data);
        // die();
        $this->db->where('id', $id);
        $barang = $this->db->update($tmst_barang_insw, $data);

        return $barang;
    }


    public function MDL_SelectCal($nomorPermohonan) {
        $tblInswCal = $this->config->item('ttrs_insw_survres_cal');

        $hasil = array();
        $sSQL = "
                SELECT
                    id, no_lse, cal_arb, cal_adb, tm_arb, t_ash_adb, t_sulfur_adb, klasifikasi_batubara, ket
                FROM
                    $tblInswCal
                WHERE no_lse = '$nomorPermohonan'
                ORDER BY id ASC 
                ";

                // $this->auth->TVD($sSQL);
                // die();

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }

        return $hasil;
    }

    public function MDL_SelectPort($id){
        $tmst_insw_port = $this->config->item('tmst_insw_port');

        $sSQL = "
                SELECT id, uraianKegiatan, kodePelabuhan, namaPelabuhan, namaNegara 
                FROM $tmst_insw_port
                WHERE id_insw = '$id'

        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->result();
    }

    public function MDL_Update_Port($id) {
        $tmst_insw_port = $this->config->item('tmst_insw_port');
        
        $kodePelabuhan  = $this->input->post('kodePelabuhan');
        $namaPelabuhan  = $this->input->post('namaPelabuhan');
        
        $data = array(
            'kodePelabuhan' => $kodePelabuhan,
            'namaPelabuhan' => $namaPelabuhan
        );
                
        $this->db->where('id', $id);
        $res = $this->db->update($tmst_insw_port, $data); 
        
        return $res;
    }

    public function MDL_GetSum($noAju) {
        $tblbarang = $this->config->item('tmst_barang_insw');

        $hasil = array();
        $sSQL = "
                SELECT
                    SUM(fob) AS SumFob
                FROM
                    $tblbarang
                WHERE nomorAju = '$noAju'
                GROUP BY nomorAju
                ";

                // $this->auth->TVD($sSQL);
                // die();

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
        }
        return $hasil;
    }

    public function MDL_GetBranchSign($branch_id) {

        $sSQL = "
                SELECT
                    a.id,a.authorized_sign,
                    b.head_of_branch_name, b.position_id,
                    c.position_name
                FROM
                    tmst_branch a
                    LEFT JOIN(SELECT emp_id, CONCAT(first_name,' ',middle_name,' ',last_name)AS head_of_branch_name, position_id FROM tmst_employee)b ON b.emp_id = a.authorized_sign
                    LEFT JOIN(SELECT position_id, position_name FROM tmst_position)c ON c.position_id = b.position_id
                WHERE a.id = '$branch_id'
                ";

        $ambil = $this->db->query($sSQL);

        return $ambil->row();
    }

    public function MDL_SelectKerjasama($id){
        $tmst_kerjasama_insw = $this->config->item('tmst_kerjasama_insw');

        $sSQL = "
                SELECT *
                FROM $tmst_kerjasama_insw
                WHERE pid_barang = '$id'
        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->result();
    }

    public function MDL_SelectKerjasamaBarang($nomorAju,$id){
        $tmst_kerjasama_insw = $this->config->item('tmst_kerjasama_insw');
        $tmst_barang_insw = $this->config->item('tmst_barang_insw');

        $sSQL = "
                SELECT k.*, b.asalBarang, b.nomorAju, b.namaKategoriEksportir,b.seriBarang
                FROM $tmst_kerjasama_insw k
                LEFT JOIN $tmst_barang_insw b ON b.id = k.pid_barang AND b.id_insw ='$id'
                WHERE nomorAju = '$nomorAju'
                ORDER BY k.id,b.seriBarang,k.isAddition ASC
        ";
        //$this->auth->TVD($sSQL);
        //die();
        $ambil = $this->db->query($sSQL);

        return $ambil->result();
    }

    public function MDL_SelectDoc($noAju){
        $tmst_insw_doc = $this->config->item('tmst_insw_doc');

        $sSQL = "
                SELECT seriDokumen, kodeDokumen, namaDokumen, urlDokumen 
                FROM $tmst_insw_doc
                WHERE nomorAju = '$noAju'
        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->result();
    }

    public function MDL_SelectPortLoad($noAju,$id){
        $tmst_insw_port = $this->config->item('tmst_insw_port');

        $sSQL = "
                SELECT id, uraianKegiatan, kodePelabuhan, namaPelabuhan, namaNegara FROM $tmst_insw_port
                WHERE nomorAju = '$noAju'
                AND id_insw ='$id'
                AND kodeKegiatan = 2

        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->result();
    }

    public function MDL_SelectPortDest($noAju,$id){
        $tmst_insw_port = $this->config->item('tmst_insw_port');

        $sSQL = "
                SELECT id, uraianKegiatan, kodePelabuhan, namaPelabuhan, namaNegara FROM $tmst_insw_port
                WHERE nomorAju = '$noAju'
                AND id_insw ='$id'
                AND kodeKegiatan = 5

        ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);

        return $ambil->result();
    }

    public function MDL_UpdateIssuingOffice($id){
        $tblinsw = $this->config->item('tmst_insw');
        $filepath_client_document = $this->config->item('filepath_client_document');

        $data = array(
            'no_lse'            => $this->input->post('no_lse'),
            'date_issued'       => $this->input->post('date_issued'),
            'date_expired'      => $this->input->post('date_expired'),
            'jenis_lse'         => $this->input->post('jenis_lse'),
            'detail_jenis_lse'  => $this->input->post('detail_jenis_lse'),
            'branch_id'         => $this->input->post('branch_id'),
            'no_wo'             => $this->input->post('no_wo'),
            'date_wo'           => $this->input->post('date_wo'),
            'survey_location'   => $this->input->post('survey_location'),
            'survey_location_date'      => $this->input->post('survey_location_date'),
            'date_reg_exporter'         => $this->input->post('date_reg_exporter'),
            'no_invoice_packing_list'   => $this->input->post('no_invoice_packing_list'),
            'date_invoice_packing_list' => $this->input->post('date_invoice_packing_list'),
            'no_packing_list'           => $this->input->post('no_packing_list'),
            'date_packing_list'         => $this->input->post('date_packing_list'),
            'no_mining_license'         => $this->input->post('no_mining_license'),
            'date_mining_license'       => $this->input->post('date_mining_license'),
            'no_transsell_license'      => $this->input->post('no_transsell_license'),
            'date_transsell_license'    => $this->input->post('date_transsell_license'),
            'no_smelter_license'        => $this->input->post('no_smelter_license'),
            'date_smelter_license'      => $this->input->post('date_smelter_license'),
            'stdate_load_vessel'        => $this->input->post('stdate_load_vessel'),
            'enddate_load_vessel'       => $this->input->post('enddate_load_vessel'),
            'transit_port'              => $this->input->post('transit_port'),
            'transit_country'           => $this->input->post('transit_country'),
            'pelabuhan_namaNegara'      => $this->input->post('pelabuhan_namaNegara'),
            'perusahaanAsuransiKapal_nmPerusahaan' => $this->input->post('perusahaanAsuransiKapal_nmPerusahaan'),
            'perusahaanAsuransiKapal_noPolisSertifikat' => $this->input->post('perusahaanAsuransiKapal_noPolisSertifikat'),
            'country_id'                => $this->input->post('country'),
            'eksportir_alamatPerusahaan'=> $this->input->post('eksportir_alamatPerusahaan'),
            'eksportir_namaPerusahaan'  => $this->input->post('eksportir_namaPerusahaan'),
            'namaAlatPengirim'          => $this->input->post('namaAlatPengirim'),
            'tanggalPemuatanAwal'       => $this->input->post('date_issued_awal'),
            'tanggalPemuatanAkhir'      => $this->input->post('date_issued_akhir'),
            'imp_namaPerusahaan'        => $this->input->post('imp_namaPerusahaan'),
            'imp_alamatPerusahaan'      => $this->input->post('imp_alamatPerusahaan'),
            'ukuranTongkang'            => $this->input->post('ukuranTongkang'),
            'eksportir_nib'             => $this->input->post('eksportir_nib'),
            'eksportir_nitku'           => $this->input->post('eksportir_nitku'),
            'eksportir_kota'            => $this->input->post('exportir_city'),
            'eksportir_provinsi'        => $this->input->post('exportir_provinsi'),
            'tanggalBerangkat'          => $this->input->post('tanggalBerangkat'),
            'satuan_packing_list'       => $this->input->post('satuan_packing_list'),
            'eksportir_tanggal_Iup'     => $this->input->post('eksportir_tanggal_Iup'),
            'transhipment'              => $this->input->post('transhipment'),

        );
        // $this->auth->TVD($data);
        // die();

        $konfigurasi = array(
            'upload_path' => $filepath_client_document,
            'allowed_types' => 'pdf|jpg|jpeg|png',
            'max_size' => 7200,
            'remove_spaces' => FALSE,
            'encrypt_name' => TRUE,
        );
        $this->load->library('upload', $konfigurasi);
        
        $file_et = $_FILES['file_et']['name'];
        $file_et_name = "";
        
        if(strlen($file_et)){
            if ($this->upload->do_upload('file_et')) {
                $file_et_name = $this->upload->data();
                $file_et_name = $file_et_name['file_name'];
                $url_file_et  = base_url() . 'file_upload/client_document/' . $file_et_name;
                
                $file_et_prev  = $this->input->post('file_et_prev');
                unlink( $filepath_client_document.'/'.$file_et_prev );
                
                $data['jenis_doc_et'] = $this->input->post('jenis_doc_et');
                $data['file_et']      = $file_et_name;
                $data['urlFileEt']    = $url_file_et;
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.history.back();</script>";
                die();
            }
        }
            
        
        $file_spe = $_FILES['file_spe']['name'];
        $file_spe_name = "";

        if(strlen($file_spe)){

            if ($this->upload->do_upload('file_spe')) {
                $file_spe_name  = $this->upload->data();
                $file_spe_name  = $file_spe_name['file_name'];
                $url_file_spe   = base_url() . 'file_upload/client_document/' . $file_spe_name;
                
                $file_spe_prev  = $this->input->post('file_spe_prev');
                unlink( $filepath_client_document.'/'.$file_spe_prev );
                
                $data['jenis_doc_spe'] = $this->input->post('jenis_doc_spe');
                $data['file_spe']      = $file_spe_name;
                $data['urlFileSpe']    = $url_file_spe;
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.history.back();</script>";
                die();
            }
        }

        $this->db->where('id', $id);
        $res = $this->db->update($tblinsw, $data);

        return $res;
    }

    public function MDL_SelectDetailCal($no_lse) {
        $tblLseCal = $this->config->item('ttrs_insw_survres_cal');

        $hasil = array();
        $sSQL = "
                SELECT
                    cal_arb, cal_adb, tm_arb, t_ash_adb, t_sulfur_adb, klasifikasi_batubara, ket
                FROM
                    $tblLseCal
                WHERE no_lse = '$no_lse'
                ORDER BY id ASC 
                ";

                // $this->auth->TVD($sSQL);
                // die();

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectHistory($noAju) {
        $tmst_respond_insw = $this->config->item('tmst_respond_insw');
        $tblTypeVar = $this->config->item('tmst_typevar');


        $sSQL = "
                SELECT  h.kodeProses, h.waktuProses, h.keterangan, h.urlLampiran, h.payloadLs, v.nama_proses FROM $tmst_respond_insw h                
                LEFT JOIN(SELECT id, name AS nama_proses FROM $tblTypeVar WHERE table_name = 'KODE_PROSES')v ON v.id = h.kodeProses
                WHERE 1=1
                AND h.nomorAju='$noAju'
                ";
                // $this->auth->TVD($sSQL);
                // die();

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function  MDL_UpdateSurvey($id){
        $data = array(
            'mode_transport' =>  $this->input->post('mode_transport'),
            'cargo_type' => $this->input->post('cargo_type'),
            'container_numseal' => $this->input->post('container_numseal'),
            'note' => $this->input->post('note'),
            'container_code'    => $this->input->post('container_code')
        );
        // $this->auth->TVD($data);
        // die();

        $this->db->where('id', $id);
        $res2 = $this->db->update('tmst_insw', $data);

        return $res2;
    }

    public function MDL_SelectTSR1($no_lse) {
        // $this->auth->TVD($no_lse);
        // die();
        $tblHS = $this->config->item('ttrs_lse_survres_hs');
        $hasil = array();
        $sSQL = "
                SELECT
                    sum(b.quantity) as total_quantity,
                    sum(b.fas) as total_fas
                FROM
                    $tblHS b
                WHERE b.id_lse='$no_lse'
                ORDER BY b.id ASC
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_New_SR1($id, $no_lse) {
        //  $this->auth->TVD($no_lse);
        // die();
        $tblsr1 = $this->config->item('ttrs_insw_survres_hs');
        $data = array(
            'id_insw' => $id,
            'hs' => str_replace('.', '', $this->input->post('hs')),//$this->input->post('hs'),
            'description' => $this->input->post('description'),
            'quantity' => str_replace(',', '', $this->input->post('quantity')),
            'fas' => str_replace(',', '', $this->input->post('fas')),
            'no_mining_license' => $this->input->post('no_mining_license'),
            'no_lse'  => $no_lse,
            'fob_fas' => $this->input->post('fobfas'),
            'client_id' => $this->input->post('client_id'),
            'userid'  => $this->session->userdata('userid'),
            'recdate' => date("Y-m-d H:i:s"),
        );
            // $this->auth->TVD($data);
            // die();

            $this->db->insert('ttrs_insw_survres_hs', $data);
    }

    public function MDL_SelectID_SR1($id){
        $tblinsw = $this->config->item('tmst_insw');
        $tblhs = $this->config->item('ttrs_insw_survres_hs');
        $sSQL = "
                SELECT
                    id as id_hs,id_insw, hs, description, quantity, fas, 
                    no_mining_license, no_lse, client_id, fob_fas
                FROM
                $tblhs a
                WHERE id = '$id' 
                ORDER BY id ASC 
                ";
            //     $this->auth->TVD($sSQL);
            // die();
        $ambil = $this->db->query($sSQL);
        return $ambil->row();
    }

    public function MDL_SelectSR1($no_lse) {
        $tblinsw = $this->config->item('tmst_insw');
        $tblinswHS = $this->config->item('ttrs_insw_survres_hs');
        $hasil = array();
        $sSQL = "
                SELECT s.id as id_hs, s.id_insw, s.hs, s.description, s.quantity, s.fas, s.no_mining_license, 
                s.no_lse, s.client_id, s.fob_fas, i.id as insw_id, i.eksportir_nomorIup
                FROM $tblinswHS s
                LEFT JOIN $tblinsw i ON s.no_lse = i.nomorPermohonan
                AND s.no_lse = '$no_lse'
                ORDER BY id_hs ASC

        ";
       
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_Edit_SR1($id_hs, $no_lse) {
        
        $tblsr1 = $this->config->item('ttrs_insw_survres_hs');
        $data3 = array(
            'no_lse' => $this->input->post('no_lse'),
            'hs' => str_replace('.', '', $this->input->post('hs')),//$this->input->post('hs'),
            'description' => $this->input->post('description'),
            'quantity' => str_replace(',', '', $this->input->post('quantity')),
            'fas' => str_replace(',', '', $this->input->post('fas')),
            'no_mining_license' => $this->input->post('no_mining_license'),
            'no_lse' => $no_lse,
            'client_id' => $this->input->post('client_id'),
            'fob_fas' => $this->input->post('fobfas'),
            'moduser' => $this->session->userdata('userid'),
            'moddate' => date("Y-m-d H:i:s")
        );
        // $this->auth->TVD($data3);
        // die();
        $this->db->where('id', $id_hs);
        $this->db->update('ttrs_insw_survres_hs', $data3);
    }

    public function MDL_SelectSR2($id) {
        $tblProvince = $this->config->item('tmst_province');
        $tblClient = $this->config->item('tmst_client');
        $tblinsw = $this->config->item('tmst_insw');
        $tblRoyalty = $this->config->item('ttrs_insw_survres_royalty');

        $hasil = array();
        $sSQL = "
                SELECT
                    a.id as id_province, a.province_code, a.province_name,
                    b.client_id, b.client_name, b.npwp, b.province,
                    c.id as id_insw, c.nomorPermohonan,
                    d.id as id_roy, d.royalty_dp, d.no_lse, d.client_id, d.valuta,
                    d.no_royalty_payment,d.date_royalty_payment,d.quantity
                FROM
                    $tblClient b,
                    $tblinsw c,
                    $tblRoyalty d
                        
                LEFT JOIN $tblProvince a on d.provinsi_asal_barang = a.province_code
                WHERE d.no_lse='$id' 
                    AND d.no_lse = c.nomorPermohonan
                    AND d.client_id = b.client_id
                ORDER BY id_roy, d.client_id ASC
                ";

        // $this->auth->TVD($sSQL); exit();
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_New_SR2($no_lse) {
        $tblsr2 = $this->config->item('ttrs_insw_survres_royalty');
        $data = array(
            'valuta' => $this->input->post('valuta'),
            'royalty_dp' => str_replace(',', '', $this->input->post('royalty_dp')),
            'client_id' => $this->input->post('client_id'),
            'provinsi_asal_barang' => $this->input->post('provinsi_asal_barang'),
            'no_lse' => $no_lse,
            'no_royalty_payment' => $this->input->post('no_royalty_payment'),
            'date_royalty_payment' => $this->input->post('date_royalty_payment'),
            // 'sample' => $this->input->post('type_origin_goods'),
            'quantity' => str_replace(',', '', $this->input->post('quantity')),
            'userid' => $this->session->userdata('userid'),
            'recdate' => date("Y-m-d H:i:s"),
        );
        // $this->auth->TVD($data); 
        // die();
        $this->db->insert('ttrs_insw_survres_royalty', $data);
    }

    public function MDL_New_Kerjasama() {
        $tblkerja = $this->config->item('tmst_kerjasama_insw');
        $tblBarang = $this->config->item('tmst_barang_insw');
        
        $kerjasama = $this->input->post('kerjasama'); 
        $total_tonage = 0;

        foreach ($kerjasama as $key => $val){
            if($val['kodeKategoriBarang'] == '1'){
                $nama_kategori  = "Milik Sendiri";
            } elseif($val['kodeKategoriBarang'] == '2'){
                $nama_kategori  = "Beli dari Penambang Lain";
            } else{
                $nama_kategori  = "Beli dari Trader";
            }
            
            if($val['id_kerjasama'] == ''){
                $data2 = array(
                    'pid_barang'            => $this->uri->segment(3),
                    'kodeKategoriBarang'    => $val['nama_kategori'],
                    'namaKategoriBarang'    => $nama_kategori,
                    'nama_perusahaan_barang'    => $val['nama_perusahaan_barang'],
                    'valuta'        => $val['valuta'],
                    'royalty_dp'    => str_replace(',', '', $val['royalty_dp']),
                    'nomorNtpn'     => 'SELISIHLEBIHMUAT',
                    'tanggalNtpn'   => $val['tanggal_ntpn'],
                    'npwpPenjual'   => $val['npwp_penjual'],
                    'npwpPenambang' => $val['npwp_penambang'],
                    'npwpTrader'    => $val['npwp_trader'],
                    'tonasePembelian'   => $val['tonase_pembelian'],
                    'tonaseEkspor'      => str_replace(',', '', $val['tonase_ekspor']),
                    'number_format' => $val['number_format'],
                    'recdate'       => date('Y-m-d H:i:s'),
                    'isAddition'    => '1'
                );                                            
                $res6 = $this->db->insert($tblkerja, $data2);                
            } else{
                
                if($val['isAddition']){
                    $data2 = array(
                        'kodeKategoriBarang' => $val['nama_kategori'],
                        'namaKategoriBarang' => $nama_kategori,
                        'nama_perusahaan_barang'    => $val['nama_perusahaan_barang'],
                        'valuta'        => $val['valuta'],
                        'royalty_dp'    => str_replace(',', '', $val['royalty_dp']),
                        'nomorNtpn'     => 'SELISIHLEBIHMUAT',
                        'tanggalNtpn'   => $val['tanggal_ntpn'],
                        'npwpPenjual'   => $val['npwp_penjual'],
                        'npwpPenambang' => $val['npwp_penambang'],
                        'npwpTrader'    => $val['npwp_trader'],
                        'tonasePembelian' => $val['tonase_pembelian'],
                        'tonaseEkspor'      => str_replace(',', '', $val['tonase_ekspor']),
                        'number_format' => $val['number_format'],
                        'recdate'       => date('Y-m-d H:i:s')
                    );
                } else{
                    $data2 = array(
                        'pid_barang'                => $this->uri->segment(3),
                        'nama_perusahaan_barang'    => $val['nama_perusahaan_barang'],
                        'npwpPenjual'               => $val['npwp_penjual'],
                        'npwpPenambang'             => $val['npwp_penambang'],
                        'npwpTrader'                => $val['npwp_trader'],
                        'tonaseEkspor'              => str_replace(',', '', $val['tonase_ekspor']),
                        'number_format'             => $val['number_format'],
                        'valuta'                    => $val['valuta'],
                        'royalty_dp'                => str_replace(',', '', $val['royalty_dp'])
                    );
                }
                                
                $this->db->where('id', $val['id_kerjasama']);
                $res6 = $this->db->update($tblkerja, $data2);
                
            }
            $total_tonage = $total_tonage + $val['tonase_ekspor'];
        }
        
        // Update Total Tonage pada Bara
        $data_barang = array(
                        'jumlahTonase'  => $total_tonage
                        );

        $this->db->where('id', $this->uri->segment(3));
        $this->db->update($tblBarang, $data_barang);
        // End Update Barang

        return $res6;
    }


    public function MDL_SelectTSR2($id) {
        $tblRoyalty = $this->config->item('ttrs_insw_survres_royalty');
        $hasil = array();
        $sSQL = "
                SELECT
                    sum(d.royalty_dp) as total_royalty_dp
                FROM
                    $tblRoyalty d
                WHERE d.no_lse='$id'
                ORDER BY d.id ASC
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectValuta() {
        $this->db->select('a.id');
        $this->db->select('a.name');
    
        $this->db->from('tmst_typevar a');
        $this->db->where('a.table_name','CURRENCY');

        return $this->db->get()->result();
    }


    public function MDL_SelectID_SR2($id) {
        $tblinsw = $this->config->item('tmst_insw');
        $tblroy = $this->config->item('ttrs_insw_survres_royalty');
        $tblClient = $this->config->item('tmst_client');
        $sSQL = "
                SELECT
                a.id as id_roy, a.royalty_dp, a.no_lse,a.valuta,a.provinsi_asal_barang,a.sample,
                a.no_royalty_payment,a.date_royalty_payment,
                b.id as id_insw, c.client_id, c.country, c.client_name, 
                c.npwp as exporter_npwp, c.address as exporter_address,c.province,a.quantity
                FROM $tblroy a
                LEFT JOIN(SELECT id , nomorPermohonan FROM $tblinsw)b ON b.nomorPermohonan = a.no_lse
                LEFT JOIN(SELECT * FROM tmst_client)c ON c.client_id = a.client_id
                WHERE a.id='2' 
                ORDER BY a.id ASC 
                ";
        // $this->auth->TVD($sSQL);
        // die();
        $ambil = $this->db->query($sSQL);
        return $ambil->row();
    }

    public function MDL_Edit_SR2($id_roy, $no_lse) {
        $tblsr2 = $this->config->item('ttrs_insw_survres_royalty');
        $data = array(
            'valuta' => $this->input->post('valuta'),
            'royalty_dp' => str_replace(',', '', $this->input->post('royalty_dp')),
            'client_id' => $this->input->post('client_id'),
            'provinsi_asal_barang' => $this->input->post('provinsi_asal_barang'),
            'no_lse' => $no_lse,
            'no_royalty_payment' => $this->input->post('no_royalty_payment'),
            'date_royalty_payment' => $this->input->post('date_royalty_payment'),
            'quantity' => str_replace(',', '', $this->input->post('quantity')),
            'moduser' => $this->session->userdata('userid'),
            'moddate' => date("Y-m-d H:i:s")
        );
        // $this->auth->TVD($data);
        // die();
        $this->db->where('id', $id_roy);
        $this->db->update($tblsr2, $data);
    }


    public function MDL_SelectSR3($id) {
        $tblinsw = $this->config->item('tmst_insw');
        $tblRoyalty = $this->config->item('ttrs_insw_survres_cal');
        $hasil = array();
        $sSQL = "
                SELECT
                a.id as id_lse, a.nomorPermohonan,
                b.id as id_cal, b.cal_arb, b.cal_adb, b.tm_arb, b.t_ash_adb, b.t_sulfur_adb, b.klasifikasi_batubara, b.ket, b.no_lse
                FROM
                $tblinsw a,
                $tblRoyalty b
                WHERE b.no_lse='$id' 
                AND b.no_lse = a.no_lse
                ORDER BY b.id ASC
    
                ";

        // $this->auth->TVD($sSQL); exit();

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectNew_SR3($id) {
        $tblinsw = $this->config->item('tmst_insw');
        $tblRoyalty = $this->config->item('ttrs_insw_survres_cal');
        
        $hasil = "";
        $sSQL = "
                SELECT b.id,b.coa_no, b.tgl_coa, b.tgl_periksa_sample,b.t_ash_arb,b.t_ash_adb,b.inh_adb,b.tsulf_arb,
                    b.vol_matter_adb,b.fix_carb_arb,b.size_0,b.size_50,b.hgi,b.nett_cv,b.file_coa,
                    a.id as id_lse, a.nomorPermohonan,b.id as id_cal,b.cal_arb, b.cal_adb, b.tm_arb, b.t_ash_adb, 
                    b.t_sulfur_adb, b.klasifikasi_batubara, b.ket, b.no_lse
                FROM $tblinsw a, $tblRoyalty b
                WHERE b.no_lse='$id' 
                AND b.no_lse = a.no_lse
                ORDER BY b.id ASC
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectNew_COW($id) {
        $tblinsw        = $this->config->item('tmst_insw');
        $tblinsw_cow    = $this->config->item('ttrs_insw_cow');
        
        $hasil = "";
        $sSQL = "
                SELECT a.id as id_lse, b.*
                FROM $tblinsw a, $tblinsw_cow b
                WHERE b.no_lse='$id' 
                AND b.no_lse = a.no_lse
                ORDER BY b.id ASC
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
        }
        return $hasil;
    }
    
    public function MDL_New_SR3() {
        // $tblsr3 = $this->config->item('ttrs_insw_survres_cal');
        // $cal_arb = str_replace(',', '', $this->input->post('cal_arb'));
        $data = array(
            'cal_arb' => str_replace(',', '', $this->input->post('cal_arb')),
            'cal_adb' => str_replace(',', '', $this->input->post('cal_adb')),
            'tm_arb' => str_replace(',', '', $this->input->post('tm_arb')),
            't_ash_adb' => str_replace(',', '', $this->input->post('t_ash_adb')),
            't_sulfur_adb' => str_replace(',', '', $this->input->post('t_sulfur_adb')),
            'nett_cv' => str_replace(',', '', $this->input->post('nett_cv')),
            'klasifikasi_batubara' => $this->input->post('klasifikasi_batubara'),
            'ket' => $this->input->post('ket'),
            'no_lse' => $this->input->post('no_lse'),
            'userid' => $this->session->userdata('userid'),
            'recdate' => date("Y-m-d H:i:s"),
        );

        //$this->auth->TVD($data); exit();

        $res3 = $this->db->insert('ttrs_insw_survres_cal', $data);
        
        
        return $res3;
    }

    public function MDL_INSERTCOA() {

        $data = array(
            'cal_arb'               => str_replace(',', '', $this->input->post('cal_arb')),
            'cal_adb'               => str_replace(',', '', $this->input->post('cal_adb')),
            'tm_arb'                => str_replace(',', '', $this->input->post('tm_arb')),
            't_ash_adb'             => str_replace(',', '', $this->input->post('t_ash_adb')),
            't_ash_arb'             => str_replace(',', '', $this->input->post('t_ash_arb')),
            't_sulfur_adb'          => str_replace(',', '', $this->input->post('t_sulfur_adb')),
            'tsulf_arb'             => str_replace(',', '', $this->input->post('tsulf_arb')),
            'vol_matter_adb'        => str_replace(',', '', $this->input->post('vol_matter_adb')),
            'fix_carb_arb'          => str_replace(',', '', $this->input->post('fix_carb_arb')),
            'size_0'                => str_replace(',', '', $this->input->post('size_0')),
            'size_50'               => str_replace(',', '', $this->input->post('size_50')),
            'hgi'                   => str_replace(',', '', $this->input->post('hgi')),
            'nett_cv'               => str_replace(',', '', $this->input->post('nett_cv')),
            'inh_adb'               => str_replace(',', '', $this->input->post('inh_adb')),
            'klasifikasi_batubara'  => $this->input->post('klasifikasi_batubara'),
            'ket'                   => $this->input->post('ket'),
            'no_lse'                => $this->input->post('no_lse'),
            'coa_no'                => $this->input->post('nomor_coa'),
            'tgl_coa'               => $this->input->post('tgl_coa'),
            'tgl_periksa_sample'    => $this->input->post('tgl_periksa_sample'),
            //'file_coa'              => $this->input->post('file_coa'),
            'userid'                => $this->session->userdata('userid'),
            'recdate'               => date("Y-m-d H:i:s"),
        );

        $res3 = $this->db->insert('ttrs_insw_survres_cal', $data);
        $id = $this->db->insert_id();

        $filepath_coa = $this->config->item('filepath_coa');

        $konfigurasi = array(
            'upload_path' => $filepath_coa,
            'allowed_types' => 'pdf',
            'max_size' => 50000,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE,
        );

        $this->load->library('upload', $konfigurasi);

        if (strlen($_FILES['file_coa']['name'])) {
            $name_coa = $_FILES['file_coa']['name'];

            if ($this->upload->do_upload('file_coa')) {
              
                $prev_file = $this->input->post('prev_file');
                if($prev_file){
                    unlink('./file_upload/file_coa/' . $prev_file);
                }
                $file_coa = $this->upload->data();
                $file_coa = $file_coa['file_name'];
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.close();</script>";
                die();
                //return array(false, $this->upload->display_errors());die();
            }
        }
        
        if ($file_coa) {           
            $data = array(
                'file_coa' => $file_coa
            );
            
            $this->db->where('id', $id);
            $this->db->update('ttrs_insw_survres_cal', $data);
        }

        return $res3;
    }

    public function MDL_UPDATECOA($no_lse) {

        $data = array(
            'cal_arb'               => str_replace(',', '', $this->input->post('cal_arb')),
            'cal_adb'               => str_replace(',', '', $this->input->post('cal_adb')),
            'tm_arb'                => str_replace(',', '', $this->input->post('tm_arb')),
            't_ash_adb'             => str_replace(',', '', $this->input->post('t_ash_adb')),
            't_ash_arb'             => str_replace(',', '', $this->input->post('t_ash_arb')),
            't_sulfur_adb'          => str_replace(',', '', $this->input->post('t_sulfur_adb')),
            'tsulf_arb'             => str_replace(',', '', $this->input->post('tsulf_arb')),
            'vol_matter_adb'        => str_replace(',', '', $this->input->post('vol_matter_adb')),
            'fix_carb_arb'          => str_replace(',', '', $this->input->post('fix_carb_arb')),
            'size_0'                => str_replace(',', '', $this->input->post('size_0')),
            'size_50'               => str_replace(',', '', $this->input->post('size_50')),
            'hgi'                   => str_replace(',', '', $this->input->post('hgi')),
            'nett_cv'               => str_replace(',', '', $this->input->post('nett_cv')),
            'inh_adb'               => str_replace(',', '', $this->input->post('inh_adb')),
            'klasifikasi_batubara'  => $this->input->post('klasifikasi_batubara'),
            'ket'                   => $this->input->post('ket'),
            'no_lse'                => $this->input->post('no_lse'),
            'coa_no'                => $this->input->post('nomor_coa'),
            'tgl_coa'               => $this->input->post('tgl_coa'),
            'tgl_periksa_sample'    => $this->input->post('tgl_periksa_sample'),
            'moduser'               => $this->session->userdata('userid'),
            'moddate'               => date("Y-m-d H:i:s"),
        );

        $this->db->where('no_lse', $no_lse);
        $this->db->update('ttrs_insw_survres_cal', $data);

        $filepath_coa = $this->config->item('filepath_coa');

        $konfigurasi = array(
            'upload_path' => $filepath_coa,
            'allowed_types' => 'pdf',
            'max_size' => 50000,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE,
        );

        $this->load->library('upload', $konfigurasi);

        if (strlen($_FILES['file_coa']['name'])) {
            $name_coa = $_FILES['file_coa']['name'];

            if ($this->upload->do_upload('file_coa')) {
              
                $prev_file = $this->input->post('prev_file');
                if($prev_file){
                    unlink('./file_upload/file_coa/' . $prev_file);
                }
                $file_coa = $this->upload->data();
                $file_coa = $file_coa['file_name'];
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.close();</script>";
                die();
                //return array(false, $this->upload->display_errors());die();
            }
        }
        
        if ($file_coa) {           
            $data = array(
                'file_coa' => $file_coa
            );
            
            $this->db->where('no_lse', $no_lse);
            $this->db->update('ttrs_insw_survres_cal', $data);
        }
    }

    public function MDL_UPDATE_JENIS_AJU_COA($no_lse,$jnspengajuan) {

        $data = array(
                'jenis_pengajuan' => $jnspengajuan
            );
            
        $this->db->where('no_lse', $no_lse);
        $this->db->update('ttrs_insw_survres_cal', $data);

    }

    public function MDL_InsertLog_JSON($no_lse,$service_name,$jnspengajuan,$return_value) {
        
        $data = array(
            'no_lse'            => $no_lse,
            'service_name'      => $service_name,
            'jenis_pengajuan'   => $jnspengajuan,
            'return_value'      => $return_value,
            'userid'            => $this->session->userdata('userid'),
            'recdate'           => date("Y-m-d H:i:s")
        );

        $this->db->insert('ttrs_loghistory', $data);
        
    }

    public function MDL_INSERTCOW() {

        $data_cow = array(
            'no_cow'             => str_replace(',', '', $this->input->post('nomor_cow')),
            'tgl_cow'            => str_replace(',', '', $this->input->post('tgl_cow')),
            'tgl_periksa'        => str_replace(',', '', $this->input->post('tgl_periksa')),
            'uraian_barang'      => str_replace(',', '', $this->input->post('ur_barang')),
            'spec_barang'        => str_replace(',', '', $this->input->post('spesifikasi')),
            'jumlah_barang'      => str_replace(',', '', $this->input->post('jml_barang')),
            //'number_format'      => $this->input->post('number_format'),
            'satuan'             => str_replace(',', '', $this->input->post('uom_cow')),
            'no_lse'             => $this->input->post('no_lse'),
            'userid'             => $this->session->userdata('userid'),
            'recdate'            => date("Y-m-d H:i:s"),
        );

        $res4 = $this->db->insert('ttrs_insw_cow', $data_cow);
        $id = $this->db->insert_id();

        $filepath_cow = $this->config->item('filepath_cow');

        $konfigurasi = array(
            'upload_path' => $filepath_cow,
            'allowed_types' => 'pdf',
            'max_size' => 50000,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE,
        );

        $this->load->library('upload', $konfigurasi);

        if (strlen($_FILES['file_cow']['name'])) {
            $name_cow = $_FILES['file_cow']['name'];

            if ($this->upload->do_upload('file_cow')) {
              
                $prev_file = $this->input->post('prev_file');
                if($prev_file){
                    unlink('./file_upload/file_cow/' . $prev_file);
                }
                $file_cow = $this->upload->data();
                $file_cow = $file_cow['file_name'];
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.close();</script>";
                die();
                //return array(false, $this->upload->display_errors());die();
            }
        }
        
        if ($file_cow) {           
            $data = array(
                'file_cow' => $file_cow
            );
            
            $this->db->where('id', $id);
            $this->db->update('ttrs_insw_cow', $data);
        }

        return $res4;
    }

    public function MDL_UPDATECOW($no_lse) {

        $data = array(
            'no_cow'             => str_replace(',', '', $this->input->post('nomor_cow')),
            'tgl_cow'            => str_replace(',', '', $this->input->post('tgl_cow')),
            'tgl_periksa'        => str_replace(',', '', $this->input->post('tgl_periksa')),
            'uraian_barang'      => str_replace(',', '', $this->input->post('ur_barang')),
            'spec_barang'        => str_replace(',', '', $this->input->post('spesifikasi')),
            'jumlah_barang'      => str_replace(',', '', $this->input->post('jml_barang')),
            'number_format'      => str_replace(',', '', $this->input->post('number_format')),
            'satuan'             => str_replace(',', '', $this->input->post('uom_cow')),
            'no_lse'             => $this->input->post('no_lse'),
            'moduser'            => $this->session->userdata('userid'),
            'moddate'            => date("Y-m-d H:i:s"),
        );

        $this->db->where('no_lse', $no_lse);
        $this->db->update('ttrs_insw_cow', $data);

        $filepath_cow = $this->config->item('filepath_cow');

        $konfigurasi = array(
            'upload_path' => $filepath_cow,
            'allowed_types' => 'pdf',
            'max_size' => 50000,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE,
        );

        $this->load->library('upload', $konfigurasi);

        if (strlen($_FILES['file_cow']['name'])) {
            $name_cow = $_FILES['file_cow']['name'];

            if ($this->upload->do_upload('file_cow')) {
              
                $prev_file = $this->input->post('prev_file');
                if($prev_file){
                    unlink('./file_upload/file_cow/' . $prev_file);
                }
                $file_cow = $this->upload->data();
                $file_cow = $file_cow['file_name'];

                if ($file_cow) {           
         
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.close();</script>";
                die();
                //return array(false, $this->upload->display_errors());die();
            }

           $data = array(
                'file_cow' => $file_cow
                );
                
                $this->db->where('no_lse', $no_lse);
                $this->db->update('ttrs_insw_cow', $data);
            }
        }
    }

    public function MDL_SelectID_SR3($id) {
        $tblinsw = $this->config->item('tmst_insw');
        $tblcal = $this->config->item('ttrs_insw_survres_cal');
        $sSQL = "
                SELECT
                a.id as id_cal, a.cal_arb, a.cal_adb, a.tm_arb, a.t_ash_adb,a.nett_cv, a.t_sulfur_adb, a.klasifikasi_batubara, a.ket, a.no_lse, 
                b.id as id_lse
                FROM $tblcal a
                LEFT JOIN(SELECT * FROM $tblinsw)b ON b.nomorPermohonan = a.no_lse
                WHERE a.id='$id' 
                ORDER BY a.id ASC 
                ";
        // $this->auth->TVD($sSQL); esxit();
        
        $ambil = $this->db->query($sSQL);
        return $ambil->row();
    }

    public function MDL_Edit_SR3($id_roy, $no_lse) {
        $tblsr3 = $this->config->item('ttrs_insw_survres_cal');
        $data = array(
            'cal_arb' => str_replace(',', '', $this->input->post('cal_arb')),
            'cal_adb' => str_replace(',', '', $this->input->post('cal_adb')),
            'tm_arb' => str_replace(',', '', $this->input->post('tm_arb')),
            't_ash_adb' => str_replace(',', '', $this->input->post('t_ash_adb')),
            't_sulfur_adb' => str_replace(',', '', $this->input->post('t_sulfur_adb')),
            'nett_cv' => str_replace(',', '', $this->input->post('nett_cv')),
            'klasifikasi_batubara' => $this->input->post('klasifikasi_batubara'),
            'ket' => $this->input->post('ket'),
            'no_lse' => $this->input->post('no_lse'),
            'moduser' => $this->session->userdata('userid'),
            'moddate' => date("Y-m-d H:i:s")
        );
        //  $this->auth->TVD($data);
        // die();
        $this->db->where('id', $id_roy);
        $res4 = $this->db->update($tblsr3, $data);

        return $res4;
    }

    public function MDL_Delete_SR1($id_hs) {
        $tblhs = $this->config->item('ttrs_insw_survres_hs');
        $this->db->delete($tblhs, array('id' => $id_hs));
    }

    public function MDL_Delete_SR2($id_roy) {
        $tblroy = $this->config->item('ttrs_insw_survres_royalty');
        $this->db->delete($tblroy, array('id' => $id_roy));
    }

    public function MDL_Delete_SR3($id_cal) {
        $tblcal = $this->config->item('ttrs_insw_survres_cal');
        $this->db->delete($tblcal, array('id' => $id_cal));
    }
    
    public function MDL_InsertStatus($id){
        $tbl_respond    = $this->config->item('tmst_respond_insw');
        $tbl_insw       = $this->config->item('tmst_insw');
        
        $nomorAju       = $this->input->post('nomorAju');
        $kodeProses     = $this->input->post('kodeProses');
        $waktuProses    = $this->input->post('waktuProses');
        $nomorPermohonan    = $this->input->post('nomorPermohonan');
        $keterangan    = $this->input->post('keterangan');

        
        $data = array(
	        'id_insw'   => $id,
            'nomorAju'  => $nomorAju,
            'nomorPermohonan'   => $nomorPermohonan,
            'kodeProses'    => $kodeProses,
            'waktuProses'   => $waktuProses,
            'keterangan'   => $keterangan
        );
                
        $this->db->insert($tbl_respond, $data);
        
        //update table tmst_insw
        $data_proses = array('kodeProses'=>$kodeProses);
        $this->db->where('id', $id);
        $res = $this->db->update($tbl_insw, $data_proses);        
        
        return $res;
    }
    
    public function MDL_Update_Inatrade_V2($no_lse) {
        $tblinsw = $this->config->item('tmst_insw');

        $data = array(
                'kodeProses'    => '050'
            );
        $this->db->where('no_lse', $no_lse);
        $this->db->update($tblinsw, $data);
    }

    public function MDL_Delete_Kerjasama_Barang($id){
        $tbl_kerjasama = $this->config->item('tmst_kerjasama_insw');
        
        $this->db->delete($tbl_kerjasama, array('id'=>$id));
    }
    
    public function MDL_Delete_Barang($id){
        $tbl_barang = $this->config->item('tmst_barang_insw');
        $tbl_kerjasama = $this->config->item('tmst_kerjasama_insw');
        
        $res = $this->db->delete($tbl_barang, array('id'=>$id));
        $res = $this->db->delete($tbl_kerjasama, array('pid_barang'=>$id));   
        
        return $res;
    }

}