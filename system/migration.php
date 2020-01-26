<?php 
include "database.php";

$db = new Database();
$createDB = $db->buatDatabase('flip');//set pembuatan database FLIP

if($createDB === true){   
   $sql = "CREATE TABLE transactions(
      id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      id_transaction VARCHAR(50) NOT NULL,
      amount DECIMAL(30) NULL,
      status VARCHAR(30) NULL,
      timestamp DATETIME NULL,
      bank_code VARCHAR(25) NULL,
      account_number VARCHAR(30) NULL,
      beneficiary_name VARCHAR(30) NULL,
      remark VARCHAR(50) NULL,
      receipt VARCHAR(250) NULL,
      time_served DATETIME NULL,
      fee DECIMAL(30)
   )";
   // set pembuatan tabel  
   $createTable = $db->buatTabel("flip", $sql);
   if ($createTable === true){
      echo "Tabel Berhasil dibuat";
   }
   else{
      // kirim balikan jika gagal
      echo $createTable;
   }
}
else{
   // jika DB sudah ada jalankan buat tabel
   if(strpos($createDB, "database exists") !== false){
      $sql = "CREATE TABLE transactions(
         id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
         id_transaction VARCHAR(50) NOT NULL,
         amount DECIMAL(30) NULL,
         status VARCHAR(30) NULL,
         timestamp DATETIME NULL,
         bank_code VARCHAR(25) NULL,
         account_number VARCHAR(30) NULL,
         beneficiary_name VARCHAR(30) NULL,
         remark VARCHAR(50) NULL,
         receipt VARCHAR(250) NULL,
         time_served DATETIME NULL,
         fee DECIMAL(30) NULL
      )";
      // set pembuatan tabel
      $createTable = $db->buatTabel("flip", $sql);
      if ( $createTable === true){
         echo "Tabel Berhasil dibuat";
      }
      else{
         // kirim balikan jika gagal membuat DB dan tabel
         echo $createDB." and ".$createTable;
      }
   }
   else{
      // kirim balikan jika gagal
      echo $createDB;
   }
}

?>