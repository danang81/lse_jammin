<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_lse_lc extends CI_Controller {

    private $tblName;
    private $field;

    public function __construct() {
	parent::__construct();

	$this->load->model('Md_report_lse_lc');
        $this->load->model('Md_report_lse');
	$this->load->model('md_template_email');
	$this->tblName = $this->config->item('ttrs_lse');
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
	    $this->breadcrumbs->add($nm_menu, base_url());
	    $breadcrum = $this->breadcrumbs->output();
	    $data['breadcrum'] = $breadcrum;
	    /* end */

	    $req_startdate = $this->input->post('req_startdate');
	    $req_startdate = strlen($req_startdate) ? $req_startdate : date("Y-m-01");
	    $req_enddate = $this->input->post('req_enddate');
	    $req_enddate = strlen($req_enddate) ? $req_enddate : date("Y-m-t");

	    $data['req_startdate'] = $req_startdate;
	    $data['req_enddate'] = $req_enddate;


	    $data['results'] = $this->Md_report_lse_lc->MDL_Select($req_startdate, $req_enddate);


	    $data['url_excel'] = sprintf("%s%s/%s/%s", site_url(), "report_lse_lc/CTRL_PrintData_Excel/", $data['req_startdate'], $data['req_enddate']);

	    $nm_title = $this->auth->Auth_getNameMenu();
	    $data['title'] = sprintf("%s", $nm_title);
	    $data['page'] = 'Report_lse_lc/view';
	    $data['plugin'] = 'Report_lse_lc/plugin';
	    $this->load->view('template_admin', $data);
	}
    }

    public function CTRL_PrintData_Excel($start, $end) {
	if (!$this->auth->Auth_isPerm()) {
	    $this->load->view('error_akses');
	} elseif (!$this->auth->Auth_isPrivButton('list')) {
	    $data['action'] = 'list';
	    $data['page'] = 'error_sysmenu';
	    $this->load->view('template_admin', $data);
	} else {
	    $nm_title = $this->auth->Auth_getNameMenu();
	    $title = sprintf("Report %s", $nm_title);

	    $aryRows = $this->Md_report_lse_lc->MDL_SelectReport($start, $end);

	    $this->load->helper('plugin_helper');
	    error_reporting(E_ALL);
	    ini_set('display_errors', TRUE);
	    ini_set('display_startup_errors', TRUE);

	    if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');

	    /** Include PHPExcel */
	    phpexcel();

	    $sheet = "Sheet1";
	    $objPHPExcel = new PHPExcel();

	    $objPHPExcel->getActiveSheet()->setTitle($sheet);

	    $objPHPExcel->setActiveSheetIndex(0);

	    $stardate = date("d F Y", strtotime($start));
	    $enddate = date("d F Y", strtotime($end));
	    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI LAPORAN SURVEYOR TERKAIT KEBIJAKAN KETENTUAN PENGGUNAKAN LETTER OF CREDIT UNTUK EKSPOR BARANG TERTENTU');
	    $objPHPExcel->getActiveSheet()->mergeCells('A1:V1');

	    $objPHPExcel->getActiveSheet()->setCellValue('A3', 'No.');
	    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Nama Perusahaan');
	    $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Alamat Perusahaan');
	    $objPHPExcel->getActiveSheet()->setCellValue('D3', 'No LS');
	    $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Uraian Barang');
	    $objPHPExcel->getActiveSheet()->setCellValue('E3', 'Nomor pos tarif/HS');
	    $objPHPExcel->getActiveSheet()->setCellValue('G3', 'Volume');
	    $objPHPExcel->getActiveSheet()->setCellValue('H3', 'Satuan volume');
	    $objPHPExcel->getActiveSheet()->setCellValue('I3', 'Nilai FOB');
	    $objPHPExcel->getActiveSheet()->setCellValue('J3', 'Valuta nilai FOB');
	    $objPHPExcel->getActiveSheet()->setCellValue('K3', 'Metode Pembayaran LC  / Penangguhan');
	    $objPHPExcel->getActiveSheet()->setCellValue('L3', 'Jenis LC');
	    $objPHPExcel->getActiveSheet()->setCellValue('M3', 'Nomor LC  / Penangguhan');
	    $objPHPExcel->getActiveSheet()->setCellValue('N3', 'Tanggal LC  / Penangguhan');
	    $objPHPExcel->getActiveSheet()->setCellValue('O3', 'Harga dalam LC');
	    $objPHPExcel->getActiveSheet()->setCellValue('P3', 'Valuta harga dalam LC');
	    $objPHPExcel->getActiveSheet()->setCellValue('Q3', 'Bank Devisa Penerima Dalam Negeri / lembaga pembiayaan ekspor');
	    $objPHPExcel->getActiveSheet()->setCellValue('R3', 'Tanggal kesepakatan harga dalam LC');
	    $objPHPExcel->getActiveSheet()->setCellValue('S3', 'Referensi harga pasar dunia');
	    $objPHPExcel->getActiveSheet()->setCellValue('T3', 'Harga pasar dunia');
	    $objPHPExcel->getActiveSheet()->setCellValue('U3', 'Valuta harga pasar dunia');
	    $objPHPExcel->getActiveSheet()->setCellValue('V3', 'Satuan harga pasar dunia');

	    //rows
	    $no = 1;
	    $i = 4;
	    foreach ($aryRows as $row) {

		$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $no);
		$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $row->client_name);
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $row->address);
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $row->no_lse);
                
                 $aryHS = $this->Md_report_lse->MDL_SelectHS($row->no_lse);
                 
              
                  $y= $i;
                 // $this->auth->TVD($aryHS);die();
                 foreach ($aryHS as $rowHS) {
                     
                     
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $y, $rowHS->description);
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $y, $rowHS->hs);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $y, $rowHS->quantity);
		$objPHPExcel->getActiveSheet()->setCellValue('H' . $y, 'TON');
		$objPHPExcel->getActiveSheet()->setCellValue('I' . $y, $rowHS->fas);
                
                
		$objPHPExcel->getActiveSheet()->setCellValue('K' . $y, 'LC');
                    $objPHPExcel->getActiveSheet()->setCellValue('L' . $y, 'IRREVOCABLE');
                    $objPHPExcel->getActiveSheet()->setCellValue('M' . $y, $row->no_lc);

                    $objPHPExcel->getActiveSheet()->setCellValue('N' . $y, date("d M Y", strtotime($row->date_lc)));

                    $objPHPExcel->getActiveSheet()->setCellValue('U' . $y, 'USD');
                    $objPHPExcel->getActiveSheet()->setCellValue('V' . $y, 'TON');
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $y, 'USD');
		
		$objPHPExcel->getActiveSheet()->setCellValue('O' . $y, $row->harga_dalam_lc);
		$objPHPExcel->getActiveSheet()->setCellValue('P' . $y, $row->valuta_harga_dalam_lc);
		$objPHPExcel->getActiveSheet()->setCellValue('Q' . $y, $row->bank_devisa);
		$objPHPExcel->getActiveSheet()->setCellValue('R' . $y, date("d M Y", strtotime($row->tanggal_kesepakatan_lc)));
		$objPHPExcel->getActiveSheet()->setCellValue('S' . $y, $row->referensi_harga_dunia);
		$objPHPExcel->getActiveSheet()->setCellValue('T' . $y, $row->harga_pasar_dunia);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('F' . $y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $y++;
                }

                //$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $row->SumQuantity);
		//$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, 'TON');
		//$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $row->SumFas);
		

		$objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
$i =  $y;
		$i++;
		$no++;
	    }

	    // Set column widths
	    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(35);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);

	    $styleHeader = array(
		'font' => array(
		    'name' => 'Calibri',
		    'size' => 14,
		    'bold' => true,
		    'color' => array('argb' => PHPExcel_Style_Color::COLOR_WHITE)
		)
	    );

	    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	    $objPHPExcel->getActiveSheet()->getStyle('A3:V3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	    // Set thin black border outline around column
	    $styleThinBlackBorderOutline = array(
		'borders' => array(
		    'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		    ),
		),
	    );
	    $objPHPExcel->getActiveSheet()->getStyle('A3:V' . $i)->applyFromArray($styleThinBlackBorderOutline);

	    $objPHPExcel->getActiveSheet()->getStyle('A3:V3')->applyFromArray(
		    array(
			'font' => array(
			    'bold' => true
			),
			'borders' => array(
			    'top' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			    ),
			    'bottom' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			    )
			),
		    )
	    );

	    $filename = "LSE - Report LC " . $stardate . "-" . $enddate . ".xlsx";
	    ob_end_clean();

	    header('Content-Type: application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment;filename="' . $filename . '"');
	    header('Cache-Control: max-age=0');
	    header('Cache-Control: max-age=1');
	    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	    header('Pragma: public'); // HTTP/1.0 


	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	    $objWriter->save('php://output');
	    exit;
	}
    }

}
