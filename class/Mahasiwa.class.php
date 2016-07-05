<?php
require_once('Dosen.class.php');
class Mahasiswa extends Dosen{

}

$mhs = new mahasiswa();
$mhs->connect();
$mhs->read();