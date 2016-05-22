<?php
	include_once 'koneksi.php';
	$postdata = file_get_contents("php://input");
	$dataObjeck = json_decode($postdata);
	
	$kode = $dataObjeck->data->jenis.$dataObjeck->data->kode;
	$judul = $dataObjeck->data->judul;
	$harga = $dataObjeck->data->harga_sewa;
	$query = "insert into buku (kode,judul,harga_sewa) values ('$kode','$judul','$harga')";
	mysqli_query($koneksi,$query);
?>