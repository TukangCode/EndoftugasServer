<?php
	include_once 'koneksi.php';
	$postdata = file_get_contents("php://input");
	$dataObjeck = json_decode($postdata);
	
	$query = "update buku set judul = '{$dataObjeck->data->judul}',harga_sewa = {$dataObjeck->data->harga_sewa} where kode = '{$dataObjeck->data->kode}' ";
	$hasil = mysqli_query($koneksi,$query);
?>