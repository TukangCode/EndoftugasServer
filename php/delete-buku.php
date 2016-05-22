<?php
	include_once 'koneksi.php';
	$postdata = file_get_contents("php://input");
	$dataObjeck = json_decode($postdata);
	
	$query = "delete from buku where kode = '{$dataObjeck->kode}'";
	$hasil = mysqli_query($koneksi,$query);
?>