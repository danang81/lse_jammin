<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan_provisional extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
        parent::__construct();
        $this->load->model('md_penjualan_provisional');
        $this->load->model('md_ref_json');

        $this->tblName = $this->config->item('ttrs_penjualan_provisional');
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

            $data['results'] = $this->md_penjualan_provisional->MDL_Select($req_startdate, $req_enddate);
            
            $nm_title = $this->auth->Auth_getNameMenu();
            $data['title'] = sprintf("%s", $nm_title);
            $data['url_view'] = sprintf("%penjualan_provisional/CTRL_View/", site_url());
            $data['page'] = 'penjualan_provisional/view';
            $data['plugin'] = 'penjualan_provisional/plugin';
            $this->load->view('template_admin', $data);
        }
    }

    public function getAllDatas($req_startdate, $req_enddate) {
        $req_startdate = strlen($req_startdate) ? $req_startdate : date("Y-m-01");
        $req_enddate = strlen($req_enddate) ? $req_enddate : date("Y-m-t");

        $results = $this->md_penjualan_provisional->MDL_Select($req_startdate, $req_enddate);
        
        echo json_encode($results);
    }
    
  
}