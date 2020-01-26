<?php 
include 'system/disburse.php';
include_once 'system/database.php';

$disburse = new Disburse();
$db       = new Database();
$allData = $db->getData("");

if(isset($_POST['post'])) 
{ 
   // set data untuk post
   $data = array(
      // "bank_code"       => "0".mt_rand(1, 20),
      "bank_code"       => "bni",      
      "account_number"  => mt_rand(10000000, 99999999),
      "amount"          => mt_rand(10000, 9999999),
      "remark"          => "transfer",
   );
   // kirim data ke post data 
   $disburse->postData($data); 
   header("Refresh:1; url=index.php");
}
if(isset($_POST['cekAll'])) 
{ 
   // set select data dan ambil semua data
   $cekData = $db->getData("PENDING");
   foreach ($cekData as $ress) {
      // kirim data untuk di cek statusnya
      $disburse->getData($ress->id_transaction);
   }
   
   header("Refresh:1; url=index.php");
}
if(isset($_POST['cekstatus'])) 
{ 
   $id_transaction = $_POST['idtrx'];
   // kirim id transaksi untuk dicek datanya
   $disburse->getData($id_transaction);
   header("Refresh:1; url=index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <style>
   table{
      border-collapse: collapse;
   }
   td{
      padding: 5px 10px;
   }
   </style>

   <script>
      function cek(id) {     
         document.getElementById('idtrx').value = id;
      }
   </script>
</head>
<body>
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="idtrx" id="idtrx">
      <input type="submit" name="post" value="Post data">  
      <input type="submit" name="cekAll" value="cek semua data">
      <br><hr>
      <table border="1">
         <tr>
            <td>id</td>
            <td>id_transaction</td>
            <td>amount</td>
            <td>status</td>
            <td>timestamp</td>
            <td>bank code</td>
            <td>account number</td>
            <td>beneficiary name</td>
            <td>remark</td>
            <td>receipt</td>
            <td>time served</td>
            <td>fee</td>
            <td>action</td>
         </tr>
         
         <?php 
            foreach ($allData as $res) {
               echo "<tr>
                        <td>$res->id</td>
                        <td>$res->id_transaction</td>
                        <td>$res->amount</td>
                        <td>$res->status</td>
                        <td>$res->timestamp</td>
                        <td>$res->bank_code</td>
                        <td>$res->account_number</td>
                        <td>$res->beneficiary_name</td>
                        <td>$res->remark</td>
                        <td> <a href='$res->receipt' target='_blank'><img src='$res->receipt' alt='' height='50px'></a></td>
                        <td>$res->time_served</td>
                        <td>$res->fee</td>
                        <td> <input type='submit' name='cekstatus' value='cek status' onclick='cek($res->id_transaction)'></td>
                     </tr>";
            }
         ?>
      </table>
   </form>
</body>
</html>
