<?php
class Koneksi
{
   private $host     = "127.0.0.1";
   private $username = "root" ;
   private $password = "";
   private $DBname;
   public $conn;

   function __construct($nameDB)
   {
      $this->DBname = $nameDB;
      $this->conn = new mysqli($this->host, $this->username, $this->password, $this->DBname);
   }

   public function getKoneksi()
   {
      if ($this->conn->connect_errno) {
         echo "koneksi gagal";
      }
      else{
         echo "koneksi berhasil";
         return $this->conn;
      }
   }

   public function buatDatabase($databasename)
   {
      if ($this->conn->connect_errno) {
         die("Error Tidak bisa terhubung kedatabase". $this->conn->connect_error);
      }

      $query = "CREATE DATABASE $databasename";

      if($this->conn->query($query) == true){
         echo "Database berhasil di buat";
         return true;
      }
      else{
         echo "Database gagal di buat".$this->conn->connect_error;
         return false;
      }

   }

   public function buatTabel($sql)
   {
      if ($this->conn->connect_errno) {
         die("Error Tidak bisa terhubung kedatabase". $this->conn->connect_error);
      }

      $query = $sql;

      if($this->conn->query($query) == true){
         echo "Tabel berhasil di buat";
      }
      else{
         echo "Tabel gagal di buat".$this->conn->connect_error;
      }
   }
}


?>