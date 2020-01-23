<?php 
include 'koneksi.php';

$db = new Koneksi("");
if($db->buatDatabase('flip') == true){
   echo "DB berhasil Dibuat";
}
else{
   echo "DB gagal Dibuat";
}

?>