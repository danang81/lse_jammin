<?php

class Md_lhv_approval extends CI_Model {

    // Fungsi Ambil Data
    public function MDL_Select($laststatus_lse) {
        $tblLse = $this->config->item('ttrs_lse');
        $tblImporter = $this->config->item('tmst_importer');
        $tblClient = $this->config->item('tmst_client');
        $tblBranch = $this->config->item('tmst_branch');
        $tblLoadingPort = $this->config->item('tmst_loading_port');
        $tblCountry = $this->config->item('tmst_country');
        $tbltypevar = $this->config->item('tmst_typevar');
        $user = $this->session->userdata('userid');

        $hasil = array();
        $sSQL = "
                SELECT
                    a.id, a.no_lse, a.date_issued, a.date_expired, a.date_expired, a.port_destination, a.laststatus_lse, 
		    a.lastdate_lse, a.laststatus_inatrade, a.lastdate_inatrade, a.mode_transport, a.cargo_type, a.container_numseal, a.note,
                    b.importer_id, b.country as country_importer, b.npwp, b.importer_name, b.address as importer_address,
                    c.client_id, c.country, c.client_name, c.npwp as exporter_npwp, c.address as exporter_address,
                    d.id as id_branch, d.branch,
                    e.id as id_lpc, e.loading_port_code, e.loading_port_name,
                    f.id as id_country, f.country_code, f.country_name,
                    g.id as id_typevar, g.name as name_typevar,
                    t.nm_type as status_lse,
                    t2.nm_type2 as status_inatrade
                FROM
                    $tblImporter b,
                    $tblClient c,
                    $tblBranch d,
                    $tblLoadingPort e,
                    $tblCountry f,
                    $tbltypevar g,
                    $tblLse a
                    LEFT JOIN (SELECT id, name as nm_type FROM $tbltypevar WHERE table_name = 'REQUEST_STATUS') t ON t.id = a.laststatus_lse
                    LEFT JOIN (SELECT id as id2, name as nm_type2 FROM $tbltypevar WHERE table_name = 'REQUEST_STATUS') t2 ON t2.id2 = a.laststatus_inatrade
		    LEFT JOIN (SELECT request_no,approved_by FROM ttrs_approvedby)h ON h.request_no = a.id
                WHERE 1=1 
                    AND a.importer_id           = b.importer_id
                    AND a.client_id             = c.client_id
                    AND a.branch_id             = d.id
                    AND a.loading_port_id       = e.loading_port_code
                    AND a.country_id            = f.country_code
                    AND a.laststatus_lse        = g.id
                    AND a.laststatus_lse = '$laststatus_lse'
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

    public function MDL_SelectApprove($current_status = FALSE) {
        $userid = $this->session->userdata('userid');
        $this->db->select('ir.*,b.branch, CONCAT(e.first_name," ",e.middle_name," ",e.last_name) AS client_name , c.name AS status_lhv ');
        $this->db->from('ttrs_lhv ir');

        $this->db->join('tmst_employee e', 'ir.userid = e.emp_id');
        $this->db->join('tmst_branch b', 'e.branch_id = b.id');
        $this->db->join('ttrs_approvedby a', 'ir.no_lhv = a.request_no');
        $this->db->join('tmst_typevar c', 'ir.laststatus_lhv = c.id');
        $this->db->like('a.approved_by', $userid);
        if ($current_status) {
            $this->db->where('ir.laststatus_lhv', $current_status);
        }
        $this->db->group_by('a.request_no');
        return $this->db->get()->result();
    }

    // Fungsi Tambah Data
    public function MDL_Insert($no_lhv) {
        $data = array(
            'no_lhv' => $no_lhv,
            'approval_status' => $this->input->post('approval_status'),
            'approval_date' => date("Y-m-d H:i:s"),
            'remark' => $this->input->post('remark'),
            'userid' => $this->session->userdata('userid'),
            'recdate' => date("Y-m-d H:i:s")
        );
        $this->db->insert('ttrs_lhv_history_approval', $data);
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

    public function MDL_InsertVoid($no_lhv, $void_notes) {
        $data = array(
            'no_lhv' => $no_lhv,
            'approval_status' => '9',
            'approval_date' => date("Y-m-d H:i:s"),
            'remark' => $void_notes,
            'userid' => $this->session->userdata('userid'),
            'recdate' => date("Y-m-d H:i:s"),
            'moduser' => $this->session->userdata('userid'),
            'moddate' => date("Y-m-d H:i:s")
        );
        $this->db->insert('ttrs_lhv_history_approval', $data);
    }

    public function MDL_SelectID($no_lhv) {
        $ttrs_lhv = $this->config->item('ttrs_lhv');


        $sSQL = "
                SELECT
                    a.*,
                    b.supplyer_name,
                    c.supplyer_name_lainnya,
                    d.nama_muat,
                    e.nama_bongkar
                FROM
                    $ttrs_lhv a
                    LEFT JOIN(SELECT client_id, CONCAT(type,'. ',client_name) AS supplyer_name FROM tmst_client)b ON b.client_id = a.nama_perusahaan_supplyer
                    LEFT JOIN(SELECT client_id, CONCAT(type,'. ',client_name) AS supplyer_name_lainnya FROM tmst_client)c ON c.client_id = a.nama_perusahaan_supplyer_lainnya
                    LEFT JOIN(SELECT loading_port_code, loading_port_name AS nama_muat FROM tmst_loading_port)d ON d.loading_port_code = a.pelabuhan_muat
                    LEFT JOIN(SELECT loading_port_code, loading_port_name AS nama_bongkar FROM tmst_loading_port)e ON e.loading_port_code = a.pelabuhan_bongkar
                WHERE a.no_lhv='$no_lhv'
                ";
        $hasil = $this->db->query($sSQL)->row();

        // $this->auth->tvd($hasil);die();
        return $hasil;
    }

    public function MDL_SelectDetailBill($no_lhv) {
        $tbl_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $hasil = array();
        $sSQL = "
                SELECT
                   a.*,
                   b.name,b.tid,
                   c.name_satuan
                FROM
                   $tbl_lhv_document_verification a
                       LEFT JOIN(SELECT id,name,tid FROM tmst_typevar)b ON b.id = a.file_type_id
                       LEFT JOIN(SELECT id,name AS name_satuan FROM tmst_typevar)c ON c.id = a.tonase_id
                WHERE a.no_lhv = '$no_lhv' AND a.file_type_id = 'file_bill'
                ORDER BY b.tid ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectDetailPraShipment($no_lhv) {
        $tbl_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $hasil = array();
        $sSQL = "
                SELECT
                   a.*,
                   b.name,b.tid,
                   c.name_satuan
                FROM
                   $tbl_lhv_document_verification a
                       LEFT JOIN(SELECT id,name,tid FROM tmst_typevar)b ON b.id = a.file_type_id
                       LEFT JOIN(SELECT id,name AS name_satuan FROM tmst_typevar)c ON c.id = a.tonase_id
                WHERE a.no_lhv = '$no_lhv' AND (a.file_type_id = 'file_kalori' OR a.file_type_id = 'file_moisture' OR a.file_type_id = 'file_sulfur' OR a.file_type_id = 'file_ash')
                ORDER BY b.tid ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectDetailRoyalty($no_lhv) {
        $tbl_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $hasil = array();
        $sSQL = "
                SELECT
                   a.*,
                   b.name,b.tid,
                   c.name_satuan
                FROM
                   $tbl_lhv_document_verification a
                       LEFT JOIN(SELECT id,name,tid FROM tmst_typevar)b ON b.id = a.file_type_id
                       LEFT JOIN(SELECT id,name AS name_satuan FROM tmst_typevar)c ON c.id = a.tonase_id
                WHERE a.no_lhv = '$no_lhv' AND (a.file_type_id = 'file_detail_bank' OR a.file_type_id = 'file_royalty_val' OR a.file_type_id = 'file_coal_price' OR a.file_type_id = 'file_royalty_cop')
                ORDER BY b.tid ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectDetailCNC($no_lhv) {
        $tbl_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $hasil = array();
        $sSQL = "
                SELECT
                   a.*,
                   b.name,b.tid,
                   c.name_satuan
                FROM
                   $tbl_lhv_document_verification a
                       LEFT JOIN(SELECT id,name,tid FROM tmst_typevar)b ON b.id = a.file_type_id
                       LEFT JOIN(SELECT id,name AS name_satuan FROM tmst_typevar)c ON c.id = a.tonase_id
                WHERE a.no_lhv = '$no_lhv' AND a.file_type_id = 'file_cnc_copy'
                ORDER BY b.tid ASC 
                ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_SelectDetailShipper($no_lhv) {
        $tbl_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $sSQL = "
                SELECT
                   a.*,
                   b.name,b.tid
                FROM
                   $tbl_lhv_document_verification a
                       LEFT JOIN(SELECT id,name,tid FROM tmst_typevar)b ON b.id = a.file_type_id
                WHERE a.no_lhv = '$no_lhv' AND a.file_type_id = 'file_shipper'
                ORDER BY b.tid ASC 
                ";

        $ambil = $this->db->query($sSQL)->row();

        return $ambil;
    }

    public function MDL_SelectDetailBuktiSetor($no_lhv) {
        $tbl_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $sSQL = "
                SELECT
                   a.*,
                   b.name,b.tid
                FROM
                   $tbl_lhv_document_verification a
                       LEFT JOIN(SELECT id,name,tid FROM tmst_typevar)b ON b.id = a.file_type_id
                WHERE a.no_lhv = '$no_lhv' AND a.file_type_id = 'file_royalty_cop'
                ORDER BY b.tid ASC 
                ";

        $ambil = $this->db->query($sSQL)->row();

        return $ambil;
    }

    public function MDL_SelectCNC($no_lhv) {
        $tbl_lhv_document_verification = $this->config->item('ttrs_lhv_document_verification');

        $sSQL = "
                SELECT
                   a.*,
                   b.name,b.tid
                FROM
                   $tbl_lhv_document_verification a
                       LEFT JOIN(SELECT id,name,tid FROM tmst_typevar)b ON b.id = a.file_type_id
                WHERE a.no_lhv = '$no_lhv' AND a.file_type_id = 'file_cnc_copy'
                ORDER BY b.tid ASC 
                ";

        $ambil = $this->db->query($sSQL)->row();

        return $ambil;
    }

    // Fungsi Ubah Data
    public function MDL_Update($request_no) {
        $tbl_approvedby = $this->config->item('ttrs_approvedby');

        $user = $this->session->userdata('userid');

        $data = array(
            'status' => $this->input->post('approval_statement'),
            'last_status' => $this->input->post('last_status'),
            'respon_date' => date("Y-m-d H:i:s"),
            'fixed_approver' => $user,
            'remark' => $this->input->post('remark')
        );

        $this->db->where(array(
            'request_no' => $request_no,
            'approved_by' => $user
        ));
        $this->db->update($tbl_approvedby, $data);
    }

    public function MDL_SelectApproval($request_no, $request_for) {
        $tbl_approvedby = $this->config->item('ttrs_approvedby');
        $user = $this->session->userdata('userid');

        $hasil = array();
        $sSQL = "
                SELECT a.respon_date, a.remark,
		       b.status_name,
		       c.emp_name
		FROM $tbl_approvedby a
		    LEFT JOIN(SELECT id, name AS status_name FROM tmst_typevar)b ON b.id = a.status
			    LEFT JOIN(SELECT emp_id, CONCAT(first_name,' ',middle_name,' ',last_name)AS emp_name FROM tmst_employee)c ON c.emp_id = a.approved_by
		WHERE a.request_no = '$request_no' AND
		      a.request_for = '$request_for' AND
		      a.approved_by != '$user'
		";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function MDL_SelectApprovalBy($request_no, $request_for) {
        $tbl_approvedby = $this->config->item('ttrs_approvedby');
        $user = $this->session->userdata('userid');

        $hasil = array();
        $sSQL = "
                SELECT a.respon_date, a.remark,a.status,
		       b.status_name,
		       c.emp_name
		FROM $tbl_approvedby a
		    LEFT JOIN(SELECT id, name AS status_name FROM tmst_typevar)b ON b.id = a.status
			    LEFT JOIN(SELECT emp_id, CONCAT(first_name,' ',middle_name,' ',last_name)AS emp_name FROM tmst_employee)c ON c.emp_id = a.approved_by
		WHERE a.request_no = '$request_no' AND
		      a.request_for = '$request_for' AND
		      a.approved_by = '$user'
		";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
            return $hasil;
        }
    }

    public function MDL_ApproveBy($no_lhv) {
        $tblapprovedby = $this->config->item('ttrs_approvedby');
        $tblemployee = $this->config->item('tmst_employee');
        $tbltypevar = $this->config->item('tmst_typevar');

        $hasil = array();

        $sSQL = "       
            SELECT a.id id, CONCAT(b.first_name,' ',b.middle_name,' ',b.last_name) as approval_name, a.approved_by, a.respon_date, master_type.name as status_name, a.status, a.approved_by, a.remark
            FROM $tblapprovedby a
            LEFT JOIN ( SELECT id, name FROM $tbltypevar WHERE table_name = 'REQUEST_STATUS' ) master_type ON master_type.id = a.status
            LEFT JOIN $tblemployee b ON a.fixed_approver = b.emp_id
            WHERE a.request_no = '$no_lhv'
            ORDER BY a.id desc
        ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $approve = explode(',', $data->approved_by);
                $approver_name = array();
                for ($i = 0; $i < count($approve); $i++) {
                    if ($approve[$i]) {
                        $approver_name[$i] = $this->md_employee->MDL_SelectByID($approve[$i])->emp_name;
                    }
                }
                $data->approver_name = $approver_name;
                $hasil[] = $data;
            }
        }
        return $hasil;
    }

    public function MDL_ApproveBy_Now($no_lhv) {
        $tblapprovedby = $this->config->item('ttrs_approvedby');
        $tblemployee = $this->config->item('tmst_employee');
        $tbltypevar = $this->config->item('tmst_typevar');

        $userid = $this->session->userdata('userid');

        $hasil = array();

        $sSQL = "       
            SELECT CONCAT(b.first_name,' ',b.middle_name,' ',b.last_name) as approval_name, 
		   a.approved_by, a.respon_date, 
		   master_type.name as status_name,a.status , a.approved_by
            FROM $tblemployee b, $tblapprovedby a
		LEFT JOIN ( SELECT id, name FROM $tbltypevar WHERE table_name = 'REQUEST_STATUS' ) master_type ON master_type.id = a.status
            WHERE a.request_no = '$no_lhv'
		AND (SUBSTR(a.approved_by,1,8) = b.emp_id OR SUBSTR(a.approved_by,10,8) = b.emp_id)
		AND (SUBSTR(a.approved_by,1,8) = '$userid' OR SUBSTR(a.approved_by,10,8) = '$userid')
		AND fixed_approver = ''
            ORDER BY a.id asc
        ";
        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
        }
        return $hasil;
    }

    public function MDL_Approve($no_lhv) {
        $tbl_approvedby = $this->config->item('ttrs_approvedby');
        $tbl_ttrs_lhv = $this->config->item('ttrs_lhv');

        $requester = array();
        $approval_status = $this->input->post('approval_status');
        $approved_by = $this->input->post('approved_by');
        $userid = $this->session->userdata('userid');
        $recdate = date("Y-m-d H:i:s");
        $moduser = $this->session->userdata('userid');
        $moddate = date("Y-m-d H:i:s");

        $ceklast_status = $this->Md_lhv_approval->MDL_LastStatus($no_lhv);
        if ($ceklast_status->total_lststatus == 1 && $approval_status == 3) {
            $lst_status = 3;
        } elseif ($ceklast_status->total_lststatus == 2 && $approval_status == 3) {
            $lst_status = 2;
        } elseif ($ceklast_status->total_lststatus == 3 && $approval_status == 3) {
            $lst_status = 2;
        } else {
            $lst_status = $approval_status;
        }

        $data = array(
            'laststatus_lhv' => $lst_status,
        );
     //   $this->db->where('no_lhv', $no_lhv);
      //  $this->db->from('ttrs_lhv');
       // $temp_requester = $this->db->get()->result()->requester;
       // $requester = reset($temp_requester);
       // $this->db->where('emp_id', $requester);
      //  $this->db->from('tmst_employee');
      //  $temp_branch = $this->db->get()->result()->branch_id;
       // $branch = reset($temp_branch);

        $this->db->where('no_lhv', $no_lhv);
        $this->db->update($tbl_ttrs_lhv, $data);

        // insert Approved By

        if ($lst_status == 3) { //if last status in transaction Approved, last status in Approved By "Approved"
            $data = array(
                'status' => $approval_status,
                'last_status' => $lst_status,
                'respon_date' => $recdate,
                'fixed_approver' => $this->session->userdata('userid'),
                'remark' => $this->input->post('remark')
            );

            $this->db->where('id', $this->input->post('id_approval'));
            $this->db->update($tbl_approvedby, $data);
        } else {
            $data = array(
                'status' => $approval_status,
                'last_status' => $lst_status,
                'respon_date' => $recdate,
                'fixed_approver' => $this->session->userdata('userid'),
                'remark' => $this->input->post('remark')
            );

            $this->db->where('id', $this->input->post('id_approval'));
            $this->db->update($tbl_approvedby, $data);
        }
    }

    public function MDL_ApproveAggrement($no_lhv) {
        $tbl_ttrs_lhv = $this->config->item('ttrs_lhv');
        $user = $this->session->userdata('userid');

        $data = array(
            'laststatus_lhv' => $this->input->post('client_aggrement'),
            'moddate' => date("Y-m-d H:i:s"),
            'moduser' => $user
        );

        $this->db->where(array(
            'no_lhv' => $no_lhv,
        ));
        $this->db->update($tbl_ttrs_lhv, $data);
    }

    public function MDL_LastStatus($no_lhv) {
        $tblapprovedby = $this->config->item('ttrs_approvedby');

        //$hasil = array();

        $sSQL = "       
            SELECT count(*) as total_lststatus
            FROM $tblapprovedby 
            WHERE request_no = '$no_lhv'
            AND status  <>  3
            ORDER BY id asc
        ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
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

    public function MDL_Set_Void($no_lhv, $void_notes) {
        $this->db->where('no_lhv', $no_lhv);
        $this->db->update('ttrs_lhv', array('laststatus_lhv' => 9, 'void_notes' => $void_notes));
    }

    public function MDL_Select_Uploaded_Document($client_id) {
        $tblclient = $this->config->item('tmst_client');

        $result = array();

        $sSQL = "
			SELECT * FROM tmst_client_document WHERE client_id= '$client_id'
		";

        $result = $this->db->query($sSQL)->row();

        return $result;
    }
    
    public function MDL_Select_DetailEmail($id) {
        $tblemployee = $this->config->item('tmst_employee');
        $tbltypevar = $this->config->item('tmst_typevar');
        $tbl_approvedby = $this->config->item('ttrs_approvedby');

        $userid = $this->session->userdata('userid');
        $hasil = array();

        $sSQL = "       
            SELECT a.request_no, c.emp_id, CONCAT(c.first_name,' ',c.middle_name,' ',c.last_name) as emp_name
                , a.status, a.fixed_approver
            FROM $tbl_approvedby a, $tblemployee c
            WHERE 1=1
                AND c.emp_id IN (trim(TRAILING',' FROM a.approved_by))
                AND a.request_no = '$id'
                AND a.approved_by = '$userid,'
        ";

        $ambil = $this->db->query($sSQL);
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil = $data;
            }
        }
        return $hasil;
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
                AND e.approved_by LIKE '%$userid%'
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
}

?>