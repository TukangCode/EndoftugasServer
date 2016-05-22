<?php
	session_start();
	if(!isset($_SESSION['user'])){
		$user = [
			'nama' => 'guest',
			'type' => 'guest'
		];
		
		$_SESSION['user'] = $user;
	}
	
	echo json_encode($_SESSION['user']);
?>