<?php
//function to fetch single user transactions 
function getData(){
    $parameters = array();
   $arr_results = array();

$mysqli =mysqli_connect("localhost","root","","customers");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT sender, receiver, sentAmount,timeUpdated FROM history where sender =(SELECT name FROM transactionhistory WHERE id = ?) or receiver =(SELECT name FROM transactionhistory WHERE id = ?)";
 $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $_GET['q'],$_GET['q']);
 $stmt->execute();
 
   $meta = $stmt->result_metadata();
 
   while ( $rows = $meta->fetch_field() ) {
 
     $parameters[] = &$row[$rows->name]; 
   }
   call_user_func_array(array($stmt, 'bind_result'), $parameters);
   while ( $stmt->fetch() ) {
      $x = array();
      foreach( $row as $key => $val ) {
         $x[$key] = $val;
      }
      $arr_results[] = $x;
   }
   return $arr_results; 
}
$arr_results = getData();
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<table>
<tr>
<th>sender
 <th>receiver
 <th>Transaction
 <th>Date & Time
 </tr>
<?php foreach ($arr_results as $row) : ?>
 <tr>
 <td><?php echo $row['sender']; ?></td>
 <td><?php echo $row['receiver']; ?></td>
 <td><?php echo $row['sentAmount']; ?></td>
 <td><?php echo $row['timeUpdated']; ?></td>
 </tr>
<?php endforeach; ?>
</table>
</body>
</html>