<?php
	include_once 'koneksi.php';
	$postdata = file_get_contents("php://input");
	$dataObjeck = json_decode($postdata);
	
	$query = "select * from buku where kode = '{$dataObjeck->data->kode}'";
	$hasil = mysqli_query($koneksi,$query);
?>