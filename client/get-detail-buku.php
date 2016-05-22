<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');  
	include '../koneksi.php';
	
	$id = $_GET['id'];
	$query = "select * from buku where kode = '{$id}'";
	$data = [];
	$hasil = mysql_query($query,$connection);
	if($baris = mysql_fetch_array($hasil)){
		$data = $baris;		
	}
	
	echo json_encode($data);
?>