<?php
		session_start();
	
		$user = [
			'nama' => 'guest',
			'type' => 'guest'
		];
		
		$_SESSION['user'] = $user;
	
?>