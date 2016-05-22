<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');  
	include '../koneksi.php';
	
	$cari = $_GET['cari'];
	$cari = json_decode($cari);

	$query = "select * from buku where judul like '%{$cari->key}%'";
	$data = [];
	$hasil = mysql_query($query,$connection);
	while($baris = mysql_fetch_array($hasil)){
		array_push($data,$baris);
	}
	
	echo json_encode($data);
	
?>