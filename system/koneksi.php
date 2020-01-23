<?php
class Koneksi
{
   private $host     = "127.0.0.1";
   private $username = "root" ;
   private $password = "";
   private $DBname = "test";
   public $conn;

   public function getKoneksi()
   {
      $this->conn = new mysqli($this->host, $this->username, $this->password, $this->DBname);

      if (mysqli_connect_errno()) {
         echo "koneksi gagal";
      }
      else{
         echo "koneksi berhasil";
         return $this->conn;
      }
   }
}


?>