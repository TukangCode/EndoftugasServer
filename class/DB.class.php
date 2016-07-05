<?php
// class.DB.php

class DB {
	
	protected $db_name = 'hiwata';
	protected $db_user = 'root';
	protected $db_pass = '';
	protected $db_host = 'localhost';
	protected $connect_db;
	
	// Open a connect to the database.
	// Make sure this is called on every page that needs to use the database.
	
	public function connect() {
		$this->connect_db = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );
		
		if ( mysqli_connect_errno() ) {
			printf("Connection failed: %s", mysqli_connect_error());
			exit();
		}else{
			echo 'berhasil';
		}
		return true;
		
	}
}
?>