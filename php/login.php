<?php
	include_once 'koneksi.php';
	$postdata = file_get_contents("php://input");
	$dataObjeck = json_decode($postdata);
	
	$query = "select nama from admin where username = '{$dataObjeck->data->username}' and  password = '{$dataObjeck->data->password}' limit 1";
	$hasil = mysqli_query($koneksi,$query);
	
	if($row = mysqli_fetch_array($hasil)){
		session_start();
		$user = [
			'nama' => $row['nama'],
			'type' => 'admin'
		];
		
		$_SESSION['user'] = $user;
		
	}
	
	
?>