<?php 
include_once('koneksi.php');

    function GetImageExtension($imagetype){
		if(empty($imagetype)) return false;
		switch($imagetype)
		{
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
		}
    }
	 
	function TambahBuku(){
		$inputJenis=$_POST['inputJenis'];
		$inputKode=$_POST['inputKode'];
		$inputJudul=$_POST['inputJudul'];
		$inputHarga=$_POST['inputHarga'];
		$inputDeskripsi=$_POST['inputDeskripsi'];
		
		$query_edit="INSERT INTO buku (kode,judul,harga_sewa,deskripsi) VALUES('".$inputJenis.''.$inputKode."','".$inputJudul."',".$inputHarga.",'".$inputDeskripsi."')";
		mysql_query($query_edit) or die("error in $query_edit == ----> ".mysql_error());
	}
	function UploadImage(){
		$imageJudul=$_POST['imageJudul'];
		if (!empty($_FILES["upload"]["name"])) {
			$file_name=$_FILES["upload"]["name"];
			$temp_name=$_FILES["upload"]["tmp_name"];
			$imgtype=$_FILES["upload"]["type"];
			$ext= GetImageExtension($imgtype);
			$imagename=date("d-m-Y")."-".time().$ext;
			$target_path = "images/".$imagename;
	

		if(move_uploaded_file($temp_name, $target_path)) {
			$query_upload="UPDATE buku SET gambar='".$imagename."' WHERE judul='".$imageJudul."'";
			mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());  
	
		}else{
			exit("Error While uploading image on the server");
			} 
		}
	}
	function EditBuku(){
		$editKode=$_POST['editKode'];
		$editJudul=$_POST['editJudul'];
		$editHarga=$_POST['editHarga'];
		$editDeskripsi=$_POST['editDeskripsi'];
		
		$query_edit="UPDATE buku SET judul='".$editJudul."', harga_sewa=".$editHarga.", deskripsi='".$editDeskripsi."' WHERE kode='".$editKode."'";
		mysql_query($query_edit) or die("error in $query_edit == ----> ".mysql_error());
	}
	function DeleteBuku(){
		$deleteKode=$_POST['deleteKode'];
		$query_edit="DELETE FROM buku WHERE kode='".$deleteKode."'";
		mysql_query($query_edit) or die("error in $query_edit == ----> ".mysql_error());
	}
	if(isset($_POST['inputSubmit'])){
		TambahBuku();
	}
	 
	if(isset($_POST['uploadSubmit'])){
		UploadImage();
	}

	if(isset($_POST['editSubmit'])){
		EditBuku();
	}
	if(isset($_POST['deleteSubmit'])){
		DeleteBuku();
	}
?>