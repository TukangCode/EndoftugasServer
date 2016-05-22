<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST'); 
	include_once '../koneksi.php';
	$per_hal=20;
	$jumlah_record=mysql_query("SELECT COUNT(*) from buku");
	$jum=mysql_result($jumlah_record, 0);
	$halaman=ceil($jum / $per_hal);
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $per_hal;
	
	$query = "select * from buku limit $start, $per_hal";
	$hasil = mysql_query($query,$connection);
	$data = [];
	while($baris = mysql_fetch_array($hasil)){
		array_push($data,$baris);
	}
	echo json_encode($data);
?>