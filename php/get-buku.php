<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST'); 
	include_once 'koneksi.php';
	$query = "select * from buku";
	$hasil = mysqli_query($koneksi,$query);
	$data = [];
	while($baris = mysqli_fetch_array($hasil)){
		array_push($data,$baris);
	}
	echo json_encode($data);
?>