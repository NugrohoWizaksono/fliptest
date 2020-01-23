<?php 
include 'system/koneksi.php';

$koneksi = new koneksi("");
// close connection mysqli_close($koneksi);
var_dump($koneksi->getKoneksi() );
?>