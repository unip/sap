<?php

include "fpdf.php";
include "../vendors/koneksi.php";

$pdf = new FPDF();
$pdf ->AddPage();

$pdf -> Setfont('Arial', 'B', 16);
$pdf -> Cell(0,5, 'DATA LOADING ORDER','0','1','C',false);
$pdf -> Setfont('Arial', 'i', 8);
$pdf -> Ln(3);
$pdf -> Cell(190,0.6,'','0','1','C',true);
$pdf -> Ln(5);

$pdf -> Setfont('Arial', 'B',9);
$pdf -> Cell(50,5, 'Laporan Data Loading Order','0','1','L',false);
$pdf -> Ln(3);

$pdf -> Setfont('Arial','B',7);
$pdf -> Cell(8,6,'No',1,0,'C');
$pdf -> Cell(35,6,'ID'1,0,'C');
$pdf -> Cell(35,6,'No Referensi'1,0,'C');
$pdf -> Cell(35,6,'Tanggal'1,0,'C');
$pdf -> Cell(35,6,'Nama Pemilik'1,0,'C');
$pdf -> Cell(35,6,'Nama Perusahaan'1,0,'C');
$pdf -> Cell(35,6,'No SPBU'1,0,'C');
$pdf -> Cell(35,6,'Lokasi SPBU'1,0,'C');
$pdf -> Cell(35,6,'QTY'1,0,'C');
$pdf -> Cell(35,6,'Jenis BBM'1,0,'C');
$pdf -> Ln(2);
$no = 0;
$string = mysql_query("SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price`,d.`id_lo`,d.no_referensi FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` LEFT JOIN `loading_order` AS d ON a.`id_pemesanan`=d.`pemesanan` WHERE a.status=1 AND a.customer='$iduser' GROUP BY a.`id_pemesanan` ORDER BY d.`tanggal`");
while($data = mysql_fetch_array($sql)); {
	$no++;
	$pdf -> Ln(4);
	$pdf -> Setfont('Arial','',7);
	$pdf -> Cell(8,4,$no.".",1,0,'C');
	$pdf -> Cell(35,4,$data['ID'],1,0,'L');
	$pdf -> Cell(35,4,$data['no_referensi'],1,0,'L');
	$pdf -> Cell(35,4,$data['Tanggal'],1,0,'L');
	$pdf -> Cell(35,4,$data['nama_pemilik'],1,0,'L');
	$pdf -> Cell(35,4,$data['nama_perusahaan'],1,0,'L');
	$pdf -> Cell(35,4,$data['no_spbu'],1,0,'L');
	$pdf -> Cell(35,4,$data['lokasi'],1,0,'L');
	$pdf -> Cell(35,4,$data['QTY'],1,0,'L');
	$pdf -> Cell(35,4,$data['gas_type'],1,0,'L');
}

$pdf -> output();

?>