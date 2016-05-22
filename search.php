<?php
include_once('koneksi.php');
?>
<!DOCTYPE html>
<html>
    <head lang="en">
      <meta charset="utf-8">
      <title>Hiwata</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap.responsive.min.css" />
		<link rel="stylesheet" href="css/bootstrap-theme.css" />
		<link rel="stylesheet" href="css/thumbnail.css" />
    </head>
    <body>
<div class="navbar navbar-default">
 <div class="container">
 <div class="navbar-header">
 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar-content">
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 </button>
 <a class="navbar-brand" href="#">
	<img style="margin-top: -9px;"src="img/hiwata.png">
 </a>
 </div>
 <div class="collapse navbar-collapse" id="mynavbar-content">
 <ul class="nav navbar-nav">
 <li><a href="index.php">Home</a></li>
 <li><a href="#">Tentang Kami</a></li>
 </ul>
 <form class="navbar-form navbar-left" role="search" action="search.php" method="post">
  <div class="form-group">
    <input name="search" type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-sm">cari</button>
</form>
 </div>
 </div>
</div>
<div class="container" style = "background-color: #E6E6FA;">
<h2 class="text-center">Daftar Buku</h2>
<div class="row book">
<?php
$search= $_POST['search']; //get the nama value from form
//pagging
$per_hal=12;
$jumlah_record=mysql_query("SELECT COUNT(*) from buku where judul like '%$search%'");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
	$query = "select * from buku where judul like '%$search%' limit $start, $per_hal";
	$hasil = mysql_query($query,$connection);
	while($baris = mysql_fetch_array($hasil))
	{?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="img/hiwata.png" alt="" height="" width="">
      <div class="caption">
        <h3><?php echo $baris['judul'];?></h3>
        <p>deskripsi</p>
        <p><span class="label label-info">Sewa : Rp.<?php echo $baris['harga_sewa'];?></span></p>
      </div>
    </div>
  </div>
  <div class="clear"></div>

<?php
}
?>
</div>
<nav>
  <ul class="pagination">
    <li>
      <a href="?page=<?php echo $page -1 ?>" aria-label="Previous">
        <span aria-hidden="true"><</span>
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
        <span aria-hidden="true">></span>
      </a>
    </li>
  </ul>
</nav>
</div>
</body>
</html>