<?php
include 'database.php';

class Disburse
{
   //inisialisasi data awal
   private $url = "https://nextar.flip.id/";
   private $key = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41:";
   private $db;

   function __construct()
   {
      //isialisasi database
      $this->db = new Database();
   }

   public function postData($data)
   {
      //conversi data
      $DataPost = "";
      foreach ($data as $key => $value) {
         $DataPost .= "$key=$value&";
      }

      // set CURL
      $curl = curl_init();
      curl_setopt_array($curl, [
         CURLOPT_URL             => $this->url."disburse",
         CURLOPT_RETURNTRANSFER  => true,
         CURLOPT_SSL_VERIFYHOST  => false,
         CURLOPT_SSL_VERIFYPEER  => false,
         CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
         CURLOPT_POST            => 1,
         CURLOPT_POSTFIELDS      => $DataPost,

      ]);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
         "Content-Type: application/x-www-form-urlencoded",
         "Authorization: basic ".base64_encode("$this->key")
      ]);

      // menampung data curl
      $response = curl_exec($curl);
      $error    = curl_error($curl);

      // tutup curl
      curl_close($curl);

      if ($error) {
         // kirim balikan data error jika error
         return $error;
      } else {
         // conversi response
         $hasil = json_decode($response);
         // proses save data response
         if($this->db->saveData($hasil) === true){
            echo "Data berhasil disimpan";
         }
         else{
            echo "Data gagal disimpan";
         }
      }
   }


   public function getData($id)
   {
      // set CURL
      $curl = curl_init();
      curl_setopt_array($curl, [
         CURLOPT_URL => $this->url."disburse/".$id,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_SSL_VERIFYHOST => false,
         CURLOPT_SSL_VERIFYPEER => false,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",

      ]);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
         "Content-Type: application/x-www-form-urlencoded",
         "Authorization: basic ".base64_encode($this->key)
      ]);

      // menampung data curl
      $response = curl_exec($curl);
      $error = curl_error($curl);

      // tutup curl
      curl_close($curl);

      if ($error) {
         // kirim balikan data error jika error
         return $error;
      } else {
         // conversi response
         $hasil = json_decode($response);

         if ($this->db->updateData($id, $hasil) === true) {
            echo "Data berhasil diupdate";
         }
         else{
            echo "Data gagal diupdate";
         }

      }
   }
}


?>