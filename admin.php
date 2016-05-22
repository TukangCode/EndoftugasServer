<?php
include('session.php');
include_once('koneksi.php');
include('operation.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Hiwata</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap.responsive.min.css" />
		<link rel="stylesheet" href="css/bootstrap-theme.css" />
		<link rel="stylesheet" href="css/admin.css" />
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
			MENU
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				Administrator
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
			<form class="navbar-form navbar-left" role="search" action="search.php" method="post">
				<div class="form-group">
					<input name="search" type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">cari</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php" >Log Out</a></li>
			</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>  	
<div class="container-fluid main-container">
<!-- Modal -->
<div class="modal fade" id="ModalBuku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Tambah Buku</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">                
                <form  action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="InputJenis">Jenis</label>
					<div class="col-sm-10">
					<select name="inputJenis" class="form-control" placeholder="pilih" required="required">
						<option value="CO">komik cowok</option>
						<option value="CE">komik cewek</option>
						<option value="NI">Novel Indonesia</option>
						<option value="NB">Novel Barat</option>
					</select>
					</div>
				</div>
				<div class="form-group">
                    <label  class="col-sm-2 control-label" for="InputKode">Kode</label>
                    <div class="col-sm-10">
                        <input type="text" name="inputKode" class="form-control" id="InputKode" placeholder="Kode" required="required"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label" for="InputJudul">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="inputJudul" class="form-control" id="InputJudul" placeholder="Judul" required="required"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="InputHarga" >Harga</label>
                    <div class="col-sm-10">
                        <input type="number" min="0"  name="inputHarga" class="form-control" id="InputHarga" placeholder="Harga Sewa" required="required"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="InputDeskripsi" >Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="inputDeskripsi" class="form-control" rows="5" id="InputDeskripsi" placeholder="Deskripsi"></textarea>
                    </div>
                  </div>
				  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="inputSubmit" class="btn btn-primary" value="Tambah" id="InputSubmit" />
                    </div>
                  </div>
                </form>
            </div>            
            <!-- Modal Footer -->
            <div class="modal-footer">
				<p>Catatan : Deskripsi boleh diisi ataupun dikosongkan</p>
            </div>
        </div>
    </div>
</div>
 <div class="btn-toolbar">
    <button class="btn btn-primary" data-toggle="modal" data-target="#ModalBuku">Tambah Buku</button>
	<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
</div>
<div class="well">
    <table class="table table-striped">
      <thead>
        <tr>
		<th>Gambar</th>
        <th>Kode</th>
        <th>Judul</th>
        <th>Harga Sewa</th>
        <th>Operation</th>
        <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>

<?php
//pagging
$per_hal=20;
$jumlah_record=mysql_query("SELECT COUNT(*) from buku");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
	$query = "select * from buku  ORDER BY no DESC limit $start, $per_hal";
	$hasil = mysql_query($query,$connection);
	while($baris = mysql_fetch_array($hasil))
	{?>
	    <tr>
		<td><img src="images/<?php echo $baris['gambar'];?>" height="100 px" width="100 px"></td>
        <td><?php echo $baris['kode'];?></td>
        <td><?php echo $baris['judul'];?></td>
        <td><?php echo $baris['harga_sewa'];?></td>
        <td>
 <div class="btn-group-xs" role="group" aria-label="...">
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ImageModal<?php echo $baris['kode'];?>">image</button>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#EditModal<?php echo $baris['kode'];?>">edit</button>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal<?php echo $baris['kode'];?>">delete</button>
</div>

<!-- Modal -->
<div class="modal fade" id="ImageModal<?php echo $baris['kode'];?>" role="dialog">
	<div class="modal-dialog">	    
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Tambah/Ganti Gambar</h4>
		</div>
	<div class="modal-body">
		<form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<div class="form-group">
            <label  class="col-sm-2 control-label" for="ImageKode">Kode :</label>
            <div class="col-sm-10">
				<h4 id="ImageKode"><?php echo $baris['kode'];?></h4>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="ImageJudul" >Judul :</label>
            <div class="col-sm-10">
                <h4 name="ImageJudul" id="ImageJudul"><?php echo $baris['judul'];?></h4>
            </div>
        </div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="InputGambar" >Pilih :</label>
			<div class="col-sm-10">
			<input type="file" name="upload" id="upload"/>
			</div>
		</div>		
		<div>
			<input type="hidden" name="imageJudul" class="form-control" value="<?php echo $baris['judul'];?>"/>
			<input type="submit" name="uploadSubmit" class="btn btn-info" value="Upload" id="UploadSubmit"/>
		</div>
		</form>
	</div>
	<div class="modal-footer">

	</div>
	</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="EditModal<?php echo $baris['kode'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Buku</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">                
                <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<div class="form-group">
                    <label  class="col-sm-2 control-label" for="EditKode">Kode</label>
                    <div class="col-sm-10">
						<input type="hidden" name="editKode" value="<?php echo $baris['kode'];?>" />
                        <input type="text" class="form-control" id="EditKode" value="<?php echo $baris['kode'];?>" disabled="disabled"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label" for="EditJudul">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="editJudul" class="form-control" id="EditJudul" value="<?php echo $baris['judul'];?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="EditHarga" >Harga</label>
                    <div class="col-sm-10">
                        <input type="number" min="0" name="editHarga" class="form-control" id="EditHarga" value="<?php echo $baris['harga_sewa'];?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="EditDeskripsi" >Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="editDeskripsi" class="form-control" rows="5" id="EditDeskripsi" ><?php echo $baris['deskripsi'];?></textarea>
                    </div>
                  </div>
				  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="editSubmit" value="Simpan" class="btn btn-primary"/>
                    </div>
                  </div>
                </form>
            </div>            
            <!-- Modal Footer -->
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
	<div class="modal fade" id="DeleteModal<?php echo $baris['kode'];?>" role="dialog">
	<div class="modal-dialog">	    
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Apakah anda yakin menghapus ini ?</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label  class="col-sm-2 control-label" for="DeleteKode">Kode :</label>
				<div class="col-sm-10">
					<h4 id="DeleteKode"><?php echo $baris['kode'];?></h4>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-2 control-label" for="DeleteJudul">Judul :</label>
				<div class="col-sm-10">
					<h4 id="DeleteJudul"><?php echo $baris['judul'];?></h4>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<input type="hidden" name="deleteKode" value="<?php echo $baris['kode'];?>"/>
				<input type="submit" name="deleteSubmit" class="btn btn-info" value="Ya"/>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
			</form>
		</div>
	</div>
	</div>
	</div>
          </td>
        </tr>
<?php
	}
?>
      </tbody>
    </table>
</div>
<nav>
  <ul class="pagination">
    <li>
      <a href="?page=<?php echo $page -1 ?>" aria-label="Previous">
        <span aria-hidden="true">Prev</span>
      </a>
    </li>
<?php 
for($x=1;$x<=$halaman;$x++){
	?>
	<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
	<?php
} 
?>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">Next</span>
      </a>
    </li>
  </ul>
</nav>
  		</div>
  		<footer class="pull-left footer">
  			<p class="col-md-12">
  				<hr class="divider">
  				Copyright &COPY; 2016 <a href="">Hiwata</a>
  			</p>
  		</footer>
  	</div>

	  <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>