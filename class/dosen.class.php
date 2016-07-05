<?php
require_once('DB.class.php');
class Dosen extends DB{
	
	public function Read(){
	$query = "select * from buku";
	$hasil = mysqli_query($this->connect_db,$query);
	$data = [];
	while($baris = mysqli_fetch_array($hasil)){
		array_push($data,$baris);
	}
	echo json_encode($data);
	}
}

?>