<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ob_clean();
$this->load->helper('plugin_helper');
tcpdf();
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$title = 'CARSURIN';
$subtitle = 'Quality With Integrity';
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 33, 10);
$pdf->SetAutoPageBreak(TRUE, 10); //PDF_MARGIN_BOTTOM
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$preferences = array(
    'HideToolbar' => true,
    'HideMenubar' => true,
    'HideWindowUI' => true,
    'FitWindow' => true,
    'CenterWindow' => true,
    'DisplayDocTitle' => true,
    'NonFullScreenPageMode' => 'UseNone', // UseNone, UseOutlines, UseThumbs, UseOC
    'ViewArea' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
    'ViewClip' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
    'PrintArea' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
    'PrintClip' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
    'PrintScaling' => 'AppDefault', // None, AppDefault
    'Duplex' => 'DuplexFlipLongEdge', // Simplex, DuplexFlipShortEdge, DuplexFlipLongEdge
    'PickTrayByPDFSize' => true,
    'PrintPageRange' => array(1, 1, 2, 3),
    'NumCopies' => 1
);

$pdf->setViewerPreferences($preferences);
$pdf->SetFont('helvetica', '', 9);
$pdf->AddPage('P', 'letter');

$html = <<<EOF
$content
EOF;

$pdf->writeHTML($html, true, false, true, false, '');

$filename = sprintf("INSW_LS_certificate.pdf");
ob_clean();
if($save){
    $filepath = realpath('./file_upload/insw_lse_document');
    $file_name = $filepath . '/' . $nomorAju . '.pdf';
    $pdf->Output($file_name, 'F');
} else{
    $pdf->Output($filename, 'I');
}
?>
