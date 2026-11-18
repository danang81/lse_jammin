<?php

class Md_lhv extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select($start_date, $end_date) {
        $ttrs_lhv = $this->config->item('ttrs_lhv');
        $user = $this->session->userdata('userid');
        
        $tblBranch = $this->config->item('tmst_branch');

        $tbltypevar = $this->config->item('tmst_typevar');
        
        $isAdmin = $this->config->item('isAdmin');
        $branch_id = $this->session->userdata('branch_id');
        $BRANCH_QUERY = ($this->session->userdata('email') == $isAdmin)? "": "AND a.branch_id='$branch_id'";
		

        $hasil = array();
        $sSQL = "
               SELECT a.*, d.branch,
                      t.nm_type as status_lhv
                      
               FROM $ttrs_lhv a
                    LEFT JOIN(SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'REQUEST_STATUS') t ON t.id = a.laststatus_lhv
                   
                   
                    LEFT JOIN(SELECT * FROM $tblBranch)d ON d.id = a.branch_id 
                        
where 1=1 
$BRANCH_QUERY
                ";
//echo $sSQL;die(); b.nama_muat LEFT JOIN(SELECT loading_port_code, loading_port_name AS nama_muat FROM tmst_loading_port)b ON b.loading_port_code = a.pelabuhan_muat

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

    public function MDL_getTemplateEmail($id) {
        $tblemail_template = $this->config->item('tmst_template_email');

        return $this->db->get_where($tblemail_template, array('id' => $id, 'status' => 1))->row();
    }

    public function MDL_getEmailTo($reqid) {
        $tblrequestapproval_detail = $this->config->item('tmst_requestapproval_detail');
        $tblemployee = $this->config->item('tmst_employee');
        $userid = $this->session->userdata('userid');

        $hasil = array();

        $sSQL = "
            SELECT u.emp_id, u.email
            FROM $tblemployee u, $tblrequestapproval_detail e
            WHERE u.emp_id IN (trim(TRAILING',' FROM e.approved_by))
                AND e.requester = '$userid'
                AND e.request_no ='2'
                AND u.email != ''
        ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data->email;
            }
        }

        return $hasil;
    }

    // Fungsi Tambah Data
    public function MDL_Insert() {
        $ttrs_lhv = $this->config->item('ttrs_lhv');
        $filepath_lhv = $this->config->item('filepath_lhv');
        $file_foto = "";

        $konfigurasi = array(
            'upload_path' => $filepath_lhv,
            'allowed_types' => 'jpg|jpeg|png|',
            'max_size' => 2000,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE,
        );
        $this->load->library('upload', $konfigurasi);

        if (strlen($_FILES['file_foto']['name'])) {
            if ($this->upload->do_upload('file_foto')) {
                $file_foto = $this->upload->data();
                $file_foto = $file_foto['file_name'];
            } else {
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.close();</script>";
                die();
                //return array(false, $this->upload->display_errors());die();
            }
        }

        $data = $this->input->post();

        unset($data['btn_submit']);
        unset($data['id']);


        if ($file_foto) {

            $data['file_foto'] = $file_foto;
        }
        
        $data['branch_id'] = $this->session->userdata('branch_id');
        $data['userid'] = $this->session->userdata('userid');
        
        $this->db->insert($ttrs_lhv, $data);
    }

    public function MDL_SelectID($no_lhv) {
        $ttrs_lhv = $this->config->item('ttrs_lhv');


        $sSQL = "
                SELECT
                    a.*,
                    b.supplyer_name,
                    c.supplyer_name_lainnya,
                    d.nama_muat,
                    e.nama_bongkar,
                    f.requester_name
                FROM
                    $ttrs_lhv a
                    LEFT JOIN(SELECT client_id, CONCAT(type,'. ',client_name) AS supplyer_name FROM tmst_client)b ON b.client_id = a.nama_perusahaan_supplyer
                    LEFT JOIN(SELECT client_id, CONCAT(type,'. ',client_name) AS supplyer_name_lainnya FROM tmst_client)c ON c.client_id = a.nama_perusahaan_supplyer_lainnya
                    LEFT JOIN(SELECT loading_port_code, loading_port_name AS nama_muat FROM tmst_loading_port)d ON d.loading_port_code = a.pelabuhan_muat
                    LEFT JOIN(SELECT loading_port_code, loading_port_name AS nama_bongkar FROM tmst_loading_port)e ON e.loading_port_code = a.pelabuhan_bongkar
                    LEFT JOIN(SELECT CONCAT(first_name,' ',middle_name,' ',last_name)AS requester_name , emp_id FROM tmst_employee)f ON f.emp_id = a.userid
                WHERE a.no_lhv='$no_lhv'
                ";
        $hasil = $this->db->query($sSQL)->row();

        // $this->auth->tvd($hasil);die();
        return $hasil;
    }

    public function MDL_SelectDocumentVerification($no_lhv) {
        $hasil = array();

        $sSQL = "
                SELECT
                    a.*,
                    b.file_type_name,
                    c.tonase_name
                FROM
                    ttrs_lhv_document_verification a
                    LEFT JOIN(SELECT id,name AS file_type_name FROM tmst_typevar)b ON b.id = a.file_type_id
                    LEFT JOIN(SELECT id,name AS tonase_name FROM tmst_typevar)c ON c.id = a.tonase_id
                WHERE a.no_lhv='$no_lhv'
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }

        return $hasil;
    }

    // Fungsi Ubah Data
    public function MDL_Update($no_lhv) {

        $ttrs_lhv = $this->config->item('ttrs_lhv');
        $filepath_lhv = $this->config->item('filepath_lhv');
        $separator = $this->config->item('separator');

        $file_foto = "";
        $data = $this->input->post();

        $konfigurasi = array(
            'upload_path' => $filepath_lhv,
            'allowed_types' => 'jpg|jpeg|png|',
            'max_size' => 2000,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE,
        );

        $this->load->library('upload', $konfigurasi);


        if (strlen($_FILES['file_foto']['name'])) {

            //===== START Delete File yang lama
            $file_name = $this->input->post('prev_attachment');
            $file = $filepath_lhv . $separator . $file_name;
            //$this->auth->TVD($file);die();
            if (file_exists($file)) {
                unlink($file);
            }
            //===== END


            $res = $this->upload->do_upload('file_foto');
            if ($res) {
                $attachment = $this->upload->data();
                $file_foto = $attachment['file_name'];
            } else {

                echo $this->upload->display_errors();
                die();
            }

            unset($data['prev_attachment']);
            $data['file_foto'] = $file_foto;
        }




        unset($data['prev_attachment']);
        unset($data['btn_submit']);
        unset($data['id']);
$data['branch_id'] = $this->session->userdata('branch_id');


        $data['lastdate_lhv'] = date("Y-m-d H:i:s");
        $data['userid'] = $this->session->userdata('userid');
        $data['moduser'] = $this->session->userdata('userid');
        $data['moddate'] = date("Y-m-d H:i:s");

//$this->auth->TVD($data);
//        die();



        $this->db->where('no_lhv', $no_lhv);
        $this->db->update($ttrs_lhv, $data);
    }

    public function MDL_isPermInsert($id) {
        $tblName = $this->config->item('ttrs_lhv');
        $res = $this->db->get_where($tblName, array('no_lhv' => $id))->num_rows();

        if ($res) {
            return 0;
        } else {
            return 1;
        }
    }

    public function MDL_Delete($id) {
        $ttrs_lhv = $this->config->item('ttrs_lhv');
        $ttrs_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $this->db->delete($ttrs_lhv, array('no_lhv' => $id));
        $this->db->delete($ttrs_lhv_document_verification, array('no_lhv' => $id));
    }

    public function MDL_Delete_Certif($id) {
        $res = array();

        $res[] = $this->db->delete('ttrs_lhv_document_verification', array('id' => $id));

        return $res;
    }

    public function MDL_Delete_SR1($id_hs) {
        $tblhs = $this->config->item('ttrs_lhv_survres_hs');
        $this->db->delete($tblhs, array('id' => $id_hs));
    }

    public function MDL_Delete_SR2($id_roy) {
        $tblroy = $this->config->item('ttrs_lhv_survres_royalty');
        $this->db->delete($tblroy, array('id' => $id_roy));
    }

    public function MDL_Delete_SR3($id_cal) {
        $tblcal = $this->config->item('ttrs_lhv_survres_cal');
        $this->db->delete($tblcal, array('id' => $id_cal));
    }

    public function MDL_getAutoID() {
        $ttrs_lhv = $this->config->item('ttrs_lhv');

        $sSQL = "
			SELECT MAX(a.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(no_lhv,3,5) AS UNSIGNED INTEGER) AS num
				FROM $ttrs_lhv
			) a
			WHERE 1=1
		";

        $ambil = $this->db->query($sSQL);
//        $this->auth->TVD($sSQL);
//        die();
        if ($ambil->num_rows() > 0) {
            $data = $ambil->row();
            $no_urut = $data->no_urut + 1;
        } else {
            $no_urut = 1;
        }

        $hasil = sprintf($no_urut);

        return $hasil;
    }

    public function MDL_getAutoID2() {

        $ttrs_lhv = $this->config->item('ttrs_lhv');

        $sSQL = "
			SELECT MAX(a.num) AS no_urut
			FROM (
				SELECT CAST(SUBSTRING(no_lhv,3,5) AS UNSIGNED INTEGER) AS num
				FROM $ttrs_lhv
			) a
			WHERE 1=1
		";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            $data = $ambil->row();
            $no_urut = $data->no_urut + 1;
        } else {
            $no_urut = 1;
        }

        $hasil = sprintf("LH%05d", $no_urut);

        return $hasil;
    }

    public function select_region_by_countryID($country_code) {
        $tbl_province = $this->config->item('tmst_country');

        $query = $this->db->query("SELECT 
              a.country_code,
              a.country_name
            FROM
              $tbl_province a 
            WHERE  a.country_code = '$country_code'
            ORDER BY a.country_name asc");

        // echo $this->db->last_query();die();
        return $query->result();
    }

    public function select_region($country_code) {
        $tbl_province = $this->config->item('tmst_province');
        $query = $this->db->query(" SELECT 
            a.country_code,
            a.province_name,
            a.province_code

            FROM $tbl_province a

            WHERE a.country_code = '$country_code' 
            ORDER BY a.province_name asc");
        return $query->result();
    }

    // 1 agustus 2017 10:17
    public function MDL_SelectClients() {
        $tmst_client = $this->config->item('tmst_client');
        $user_id = $this->session->userdata('userid');
        $hasil = array();
        $sSQL = "
                SELECT a.*
		FROM $tmst_client a
		WHERE 1=1 
		";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    // 1 agustus 2017 11:16
    public function MDL_SelectPetugas() {
        $tmst_employee = $this->config->item('tmst_employee');
        $user_id = $this->session->userdata('userid');
        $hasil = array();
        $sSQL = "
                SELECT a.*
		FROM $tmst_employee a
		WHERE no_register !='' 
		";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    // 4 agustus 2017 08:54
    public function MDL_SelectTransport() {
        $tbl_transport = $this->config->item('tmst_typevar');
        $hasil = array();
        $sSQL = "
                SELECT a.id, a.name, a.table_name
		FROM $tbl_transport a
		WHERE table_name='TRANSPORT' 
		";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    // 4 agustus 2017 08:54
    public function MDL_SelectCargo() {
        $tbl_cargo = $this->config->item('tmst_typevar');
        $hasil = array();
        $sSQL = "
    SELECT a.id, a.name, a.table_name
    FROM $tbl_cargo a
    WHERE table_name='CARGO_TYPE'
    ";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function MDL_SelectDocument($no_lhv) {
        $hasil = array();

        $sSQL = "
			SELECT a.*
			FROM tmst_typevar a
			WHERE 
			    a.table_name = 'LHV_CERTIFICATE'
			    AND a.id NOT IN
				(SELECT file_type_id 
				 FROM ttrs_lhv_document_verification
				 WHERE no_lhv = '$no_lhv')
			ORDER BY a.tid
		";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }

        return $hasil;
    }

    public function MDL_SelectVariable() {
        $tmst_typevar = $this->config->item('tmst_typevar');
        $hasil = array();
        $sSQL = "
                SELECT a.id, a.name, a.table_name
		FROM $tmst_typevar a
		WHERE table_name='LHV_VARIABLE' order by tid
		";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function MDL_Upload_Document($no_lhv) {
        $table_lhv_document = $this->config->item('ttrs_lhv_document_verification');
        $filepath_lhv_document = $this->config->item('filepath_lhv_document');

        $file_type_id = $this->input->post('file_type_id');
        $tonase_id = $this->input->post('tonase_id');
        $value = $this->input->post('value');
        $remark = $this->input->post('remark');

        $userid = $this->session->userdata('userid');
        $recdate = date("Y-m-d H:i:s");

        $userfile = '';
        $konfigurasi = array(
            'upload_path' => $filepath_lhv_document,
            'allowed_types' => 'pdf',
            'max_size' => 2000,
            'remove_spaces' => FALSE,
            'encrypt_name' => TRUE,
        );

        $this->load->library('upload');
        $this->upload->initialize($konfigurasi);
        if (strlen($_FILES['userfile']['name'])) {
            if ($this->upload->do_upload('userfile')) {
                $userfile = $this->upload->data();
                $userfile = $userfile['file_name'];
            } else {
                echo $this->upload->display_errors();
                array(false => $this->upload->display_errors());
                echo "<script type='text/javascript'>alert('Attached File Denied, Please choose another type of attachment..');window.history.back();</script>";
                die();
            }
        }

        $data = array(
            'no_lhv' => $no_lhv,
            'file_type_id' => $file_type_id,
            'tonase_id' => $tonase_id,
            'value' => $value,
            'number_format' => $this->input->post('number_format'),
            'remark' => $remark,
            'userid' => $userid,
            'recdate' => $recdate,
        );

        if ($userfile != '') {
            $data['file_upload'] = $userfile;
        }

        $this->db->insert($table_lhv_document, $data);
    }

    function MDL_Approval_LHV($no_lhv) {
        $ttrs_lhv = $this->config->item('ttrs_lhv');
        $tbl_approvedby = $this->config->item('ttrs_approvedby');
        $moduser = $this->session->userdata('userid');
        $moddate = date("Y-m-d H:i:s");

        $results_approver = $this->md_lhv->MDL_Approver();

        $data = array(
            'laststatus_lhv' => 1,
            'lastdate_lhv' => $moddate,
            'moduser' => $moduser,
            'moddate' => $moddate
        );
        $this->db->where('no_lhv', $no_lhv);
        $this->db->update($ttrs_lhv, $data);

        if (count($results_approver) > 0) {

            $cek_request = $this->MDL_SelectApprover($no_lhv);
            if (count($cek_request) > 0) {
                $this->db->delete($tbl_approvedby, array('request_no' => $no_lhv));
                //$this->db->insert($tbl_approvedby, $data);
            }

            foreach ($results_approver as $row) {
                $data = array(
                    'requestapproval_id' => 2,
                    'request_no' => $no_lhv,
                    'status' => 1,
                    'recdate' => date("Y-m-d H:i:s"),
                    'last_status' => 1,
                    'request_for' => $row->requester,
                    'approved_by' => $row->approved_by
                );

                $this->db->insert($tbl_approvedby, $data);
            }
            $result = TRUE;
            return $result;
        } else {
            $result = FALSE;
            return $result;
        }
    }

    public function MDL_Approver() {
        $tblrequestapproval_detail = $this->config->item('tmst_requestapproval_detail');
        $tbl_user = $this->config->item('tmst_users');
        $userid = $this->session->userdata('userid');
        $hasil = array();
        $sSQL = "       
            SELECT requester,approved_by
            FROM $tblrequestapproval_detail
            WHERE requester ='$userid'
            AND request_no ='2'
            ORDER BY id asc
        ";
        $ambil = $this->db->query($sSQL)->result();

        return $ambil;
    }

    public function MDL_SelectApprover($id) {
        $this->db->from('ttrs_approvedby a');
        $this->db->join('tmst_employee e', 'a.fixed_approver = e.emp_id', 'left');
        $this->db->join('tmst_position p', 'e.position_id = p.position_id', 'left');
        $this->db->where('a.request_no', $id);
        $result = $this->db->get();
        $result = $result->result();
        return $result;
    }

    public function MDL_ApproveAggrement($no_lhv) {
        $tbl_ttrs_lhv = $this->config->item('ttrs_lhv');
        $user = $this->session->userdata('userid');

        $data = array(
            'laststatus_lse' => $this->input->post('client_aggrement'),
            'moddate' => date("Y-m-d H:i:s"),
            'moduser' => $user
        );

        $this->db->where(array(
            'no_lhv' => $no_lhv,
        ));
        $this->db->update($tbl_ttrs_lhv, $data);
    }

    public function MDL_InsertAggrement($no_lhv) {

        $data = array(
            'no_lhv' => $no_lhv,
            'approval_status' => $this->input->post('client_aggrement'),
            'approval_date' => date("Y-m-d H:i:s"),
            'userid' => $this->session->userdata('userid'),
            'recdate' => date("Y-m-d H:i:s")
        );

        $this->db->insert('ttrs_lhv_history_approval', $data);
    }

    public function MDL_SelectDetailHS($id_lse) {
        $tblLseHS = $this->config->item('ttrs_lhv_survres_hs');

        $hasil = array();
        $sSQL = "
                SELECT
                    hs, description, quantity, fas, no_mining_license
                FROM
                    $tblLseHS
                WHERE id_lse = '$id_lse'
                ORDER BY id ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectHistory($no_lhv) {

        $hasil = array();
        $sSQL = "
                SELECT
                    a.*,
		    b.emp_name,
		    c.status_name
                FROM ttrs_lhv_history_approval a
		    LEFT JOIN(SELECT emp_id, CONCAT(first_name,' ',middle_name,' ',last_name) AS emp_name FROM tmst_employee)b ON b.emp_id=a.userid
			LEFT JOIN(SELECT id, name AS status_name FROM tmst_typevar)c ON c.id=a.approval_status
                WHERE no_lhv = '$no_lhv'
                ORDER BY a.approval_date ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_GetSum($id_lse) {
        $tblLseHS = $this->config->item('ttrs_lhv_survres_hs');

        $hasil = array();
        $sSQL = "
                SELECT
                    SUM(fas) AS SumFas
                FROM
                    $tblLseHS
                WHERE id_lse = '$id_lse'
                GROUP BY id_lse
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectDetailRoyalty($id_lse) {
        $tblLseRoyalty = $this->config->item('ttrs_lhv_survres_royalty');

        $hasil = array();
        $sSQL = "
                SELECT
                    a.royalty_dp,
		    b.company_name, b.npwp,
		    c.province_name
                FROM
                    $tblLseRoyalty a
			LEFT JOIN(SELECT client_id, CONCAT(type,'. ',client_name)AS company_name, npwp, province FROM tmst_client)b ON b.client_id = a.client_id
			    LEFT JOIN(SELECT province_code,province_name FROM tmst_province)c ON c.province_code = b.province
                WHERE a.id_lse = '$id_lse'
                ORDER BY a.id ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectDetailCal($id_lse) {
        $tblLseCal = $this->config->item('ttrs_lhv_survres_cal');

        $hasil = array();
        $sSQL = "
                SELECT
                    cal_arb, cal_adb, tm_arb, t_ash_adb, t_sulfur_adb, klasifikasi_batubara, ket
                FROM
                    $tblLseCal
                WHERE id_lse = '$id_lse'
                ORDER BY id ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_UpdateRefnumberSuccess($no_lhv, $refnumber) {

        $tbllse = $this->config->item('ttrs_lhv');

        $data = array(
            'refnumber' => $refnumber,
            'moduser' => $this->session->userdata('userid'),
            'moddate' => date("Y-m-d H:i:s")
        );


        $this->db->where('no_lhv', $no_lhv);
        $this->db->update($tbllse, $data);
    }

    public function UpdateDataClient($client_id, $data) {

        $tmst_client_document = $this->config->item('tmst_client_document');

        $this->db->where('client_id', $client_id);
        $this->db->update($tmst_client_document, $data);
    }

    public function MDL_Delete_Document($id) {
        $ttrs_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');


        $this->db->delete($ttrs_lhv_document_verification, array('id' => $id));
    }
    
    public function getAuthorSignatureLhv($no_lhv){
        
         $ttrs_lhv = $this->config->item('ttrs_lhv');
         $tmst_employee = $this->config->item('tmst_employee');
         $tmst_branch = $this->config->item('tmst_branch');
         $tmst_position = $this->config->item('tmst_position');
        
        $sql = " select l.userid , e.branch_id ,b.authorized_sign2,

CONCAT(au.first_name ,' ',au.middle_name,' ' ,au.last_name) as authorized_sign_name,
p.position_name,b.branch,b.initial_id

from $ttrs_lhv l

left join $tmst_employee e on l.userid = e.emp_id

left join $tmst_branch b on e.branch_id = b.id

left join $tmst_employee au on b.authorized_sign2 = au.emp_id

left join $tmst_position p on au.position_id = p.position_id

where l.no_lhv = '$no_lhv' ";
        
        $result = $this->db->query($sql)->row();
        
       
       return  $result;
        
    }

}

?>
