
<?php
include('login.php'); // Includes Login Script
include_once('koneksi.php');
if(isset($_SESSION['login_user'])){
header("location: admin.php");
}
if(isset($_POST['downloadSubmit'])){
	file_put_contents("file.jpg", file_get_contents("http://localhost/hiwata_route/download/file.jpg"));
}
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
 <li><a href="#">Home</a></li>
 <li><a href="#">Tentang Kami</a></li>
 </ul>
 <form class="navbar-form navbar-left" role="search" action="search.php" method="post">
  <div class="form-group">
    <input name="search" type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-sm">cari</button>
</form>
         <ul class="nav navbar-right">
          <li class="dropdown" id="menuLogin">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login</a>
            <div class="dropdown-menu" style="padding:17px;">
              <form class="form" id="formLogin" action="" method="post"> 
                <input name="username" id="username" placeholder="Username" type="text"> 
                <input name="password" id="password" placeholder="Password" type="password"><br>
                <button name="submit" type="submit" id="btnLogin" class="btn">Login</button>
              </form>
			  <span><?php echo $error; ?></span>
            </div>
          </li>
        </ul>
 </div>
 </div>
</div>

 <div class="container">
    <div class="row">
		<div class="col-md-6">
            <div>
				<h3>Simple make easy</h3>
				<h1>Download Aplikasi Mobile Android !</h1>
				<div class="row">
				<h5>Hiwata kini mempunyai aplikasi android untuk memudahkanmu melihat buku atau komik apa saja yang tersedia di Hiwata.</h5>
				</div>
				<div class="row">
				<form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="submit" name="downloadSubmit" value="Download" class="btn btn-info btn-lg"/>
				</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
				<div align="center">
				<img src="img/smartphone.jpg">
				</div>
        </div>
	</div>
</div>
<div class="container" style = "background-color: #E6E6FA;">
<h2 class="text-center">Daftar Buku</h2>
<div class="row book">
<?php
//pagging
$per_hal=12;
$jumlah_record=mysql_query("SELECT COUNT(*) from buku");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
	$query = "select * from buku limit $start, $per_hal";
	$hasil = mysql_query($query,$connection);
	while($baris = mysql_fetch_array($hasil))
	{?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="images/<?php echo $baris['gambar']?>" alt="" height="400 px" width="400 px">
      <div class="caption">
        <h3><?php echo $baris['judul'];?></h3>
        <div class="row col-md-12"><?php echo $baris['deskripsi'];?></div>
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
	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+234 23 9873237<br>
								<a href="mailto:#">some.email@somewhere.com</a><br>
								<br>
								234 Hidden Pond Road, Ashland City, TN 37015
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">Text widget</h3>
						<div class="widget-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, dolores, quibusdam architecto voluptatem amet fugiat nesciunt placeat provident cumque accusamus itaque voluptate modi quidem dolore optio velit hic iusto vero praesentium repellat commodi ad id expedita cupiditate repellendus possimus unde?</p>
							<p>Eius consequatur nihil quibusdam! Laborum, rerum, quis, inventore ipsa autem repellat provident assumenda labore soluta minima alias temporibus facere distinctio quas adipisci nam sunt explicabo officia tenetur at ea quos doloribus dolorum voluptate reprehenderit architecto sint libero illo et hic.</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> | 
								<a href="about.html">Tentang Kami</a> |
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2016, Hiwata. Designed by <a href="#" rel="designer">Mahasiswa PKL</a> 
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

	</footer>	
	  <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>