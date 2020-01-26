<?php
class Database
{
   private $host     = "127.0.0.1";
   private $username = "root" ;
   private $password = "";
   private $DBname;
   private $koneksi;
   public  $conn;

   function __construct()
   {

   }

   public function getKoneksi($nameDB)
   {      
      $this->DBname = $nameDB;
      $this->conn   = new mysqli($this->host, $this->username, $this->password, $this->DBname);
      if ($this->conn->connect_errno) {
         // matikan jika koneksi gagal
         die("koneksi gagal".$this->conn->connect_error);
      }
      else{
         // jika koneksi berhasil kirim balikan
         return $this->conn;
      }
   }

   public function buatDatabase($databasename)
   {
      // set koneksi ke DB
      $this->koneksi = $this->getKoneksi("");
      if ($this->koneksi->connect_errno) {
         // kirim response error jika gagal terkoneksi
         return $this->Koneksi->connect_error;
      }

      $query = "CREATE DATABASE $databasename";
      // jalankan proses pembuatan DB 
      if($this->koneksi->query($query) == true){
         return true;
      }
      else{
         // jika gagal kirim response error
         return $this->koneksi->error;
      }
      // tutup koneksi
      $this->koneksi->close();

   }

   public function buatTabel($db ,$sql)
   {
      // set koneksi ke DB
      $this->koneksi = $this->getKoneksi($db);
      if ($this->koneksi->connect_errno) {
         // kirim response error jika gagal terkoneksi
         return $this->koneksi->connect_error;
      }

      $query = $sql;
      // proses pembuatan tabel
      if($this->koneksi->query($query) == true){
         return true;
      }
      else{
         return $this->koneksi->error;
      }

      $this->koneksi->close();
   }

   public function saveData($data)
   {
      
      $query = "INSERT INTO transactions
                (id_transaction, amount, status, timestamp, bank_code, account_number,
                 beneficiary_name, remark, receipt, time_served, fee)
                 VALUES ('$data->id', $data->amount, '$data->status', '$data->timestamp', '$data->bank_code', '$data->account_number',
                 '$data->beneficiary_name', '$data->remark', '$data->receipt', '$data->time_served', $data->fee);      
               ";  
      // set koneksi
      $this->koneksi = $this->getKoneksi("flip");
      // proses save data
      $save          = $this->koneksi->query($query);
      
      if ($save === true) {
         return true;
      }
      else{
         return false;
      }

      $this->koneksi->close();
   }

   public function updateData($id, $data)
   {
      $query = "UPDATE transactions
                SET status = '$data->status', receipt = '$data->receipt', time_served = '$data->time_served'
                WHERE id_transaction = $data->id ;      
               ";  
      // set koneksi         
      $this->koneksi = $this->getKoneksi("flip");
      // proses update data
      $save          = $this->koneksi->query($query);
      
      if ($save === true) {
         return true;
      }
      else{
         return false;
      }

      $this->koneksi->close();
      
   }

   public function getData($where)
   {
      if (empty($where)) {
         // jika where kosong
         $query = "SELECT *
                FROM transactions
                $where ; ";  
      }
      else{
         // jika where ada isi
         $query = "SELECT *
                   FROM transactions
                   where status = '$where' ; ";  

      }
      // set koneksi
      $this->koneksi = $this->getKoneksi("flip");
      $get          = $this->koneksi->query($query);
      $hasil=[];
      if ($get->num_rows >0) {
         while ($rows = mysqli_fetch_object($get)) {
            // isi hasil dari proses loop
            $hasil[] = $rows;
         }
      }
      return $hasil;

      $this->koneksi->close();
   }
}


?>