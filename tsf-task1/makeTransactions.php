<?php
//FOR ESTABLISHING CONNECTION TO DATABASE 
include 'config.php';
//for name field Validation
$from = $to = $amountTransfer ="";
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $from = $_POST['fromWhom'];
        $to = $_POST['toWhom'];
        $amountTransfer = $_POST['amount'];
        $fromName ="SELECT name FROM transactionhistory WHERE name = '$from'"; //where condition is case insensitive
        $toName ="SELECT name FROM transactionhistory WHERE name = '$to'";
        $currentAmount ="SELECT current_balance FROM transactionhistory where name = '$from'";

        if ( ($fromNameMatch = mysqli_query($conn, $fromName)) && ($toNameMatch = mysqli_query($conn, $toName)) && ($currentAmountMatch = mysqli_query($conn, $currentAmount)) )  {
            // Fetch one and one row
            echo "<script>console.log('inside if');</script>";

          //for name validation if name not in database not jump inside while loop
           while (($fromNameValue = mysqli_fetch_row($fromNameMatch)) && ($toNameValue = mysqli_fetch_row($toNameMatch)) &&($fromNameValue[0] != $toNameValue[0])  &&($currentAmountValue = mysqli_fetch_row($currentAmountMatch)) ) {
              echo "<script>console.log('debug succeed, inside while')</script>";
              echo "<script> console.log(' name check:".$fromNameValue[0]." ".$toNameValue[0]."');</script>";
              //VALIDATING AMOUNT TO BE LESS THEN CURRENT BALANCE
              if($amountTransfer > $currentAmountValue[0]){
                
                  echo '<script>alert("Bad luck! Insufficient funds to transfer"); </script>';
                
              }
              else if($amountTransfer < 1){
                # code...
                  echo '<script>alert("you can transfer minimum 1rs, and with positive numbers only"); </script>';
                }
                //IF ALL TESTS PASSES:FROM,TO,AMOUNT
               else{
                  echo '<script>alert("Dear '.$from .',  Rs.'.$amountTransfer.' successfully transferred to '.$to.'"); </script>';
                  echo '<script> alert("Thank you for using our services");</script>';
                  
                  $deductAmount ="UPDATE transactionhistory SET current_balance = ($currentAmountValue[0] - $amountTransfer) WHERE id = (SELECT ID FROM transactionhistory WHERE name ='$from')";
                  $incrementAmount = "UPDATE transactionhistory SET current_balance =(current_balance + $amountTransfer) WHERE id = (SELECT ID FROM transactionhistory WHERE name ='$to')";
                  $updateH ="INSERT INTO history (sentAmount,sender,receiver) VALUES($amountTransfer,'$from','$to')";
                  if( (mysqli_query($conn,$deductAmount) ) && (mysqli_query($conn,$incrementAmount) ) )
                  {
                      echo "ATOMICITY, transaction successfuL";  
                  }else {
                     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }

                  if(mysqli_query($conn,$updateH)){
                      echo "success2";
                  }else {
                     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }
              }
          }//end of while loop
        }//end of inner if 
      }//end of outer if
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Make Transactions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
   <!-- fontawesome ICONS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- internal CSS -->
  <link rel="stylesheet" type="text/css" href="css/cleanStyle.css">
  <!-- inline css-->
  <style type="text/css">

  </style>
</head>
<body>
<!-- header -->
 <nav class="navbar navbar-expand-sm bg-light navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">
    <img src="images/logo_small.png" alt="logo" style="width:40px;">
  </a>
  <a href="index.php">
    <p class="header-text bg-primary text-uppercase navbar pt-2 m-n1">The Sparks Foundation Bank
    </p>
  </a>
</nav>
  <!-- footer ends here -->
  <!-- form body -->
<div class="conatiner-fluid">
  <form id="transactionForm" class ="font-weight-bold form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      
      <label class="mb-2 mr-sm-2" for="senderPerson">Sender :</label>
      <input type="text" class="form-control mb-2 mr-sm-2" name="fromWhom" id="senderPerson" placeholder="from..." maxlength="30" required/>
      <label class="mb-2 mr-sm-2" for="receivingPerson">Receiver :</label>
      <input type="text" class="form-control mb-2 mr-sm-2" name="toWhom"  id="receivingPerson" placeholder="to..." maxlength="30" required/>
      <label class="mb-2 mr-sm-2" for="amountSend">Amount :</label>
      <input type="tel"  class="form-control mb-2 mr-sm-2"name="amount"  id="amountSend" placeholder="amount to be sent..."  maxlength="6" required />
      <label class="mb-2 mr-sm-2" for="submitBtn"></label>
      <input type="submit" value="Transfer"  id="submitBtn"/>
  </form>
</div>
<!-- form ends here -->
<!-- content body -->
<div class="container-fluid">
    <div class="row">
      <!-- View customers -->
        <div id="viewCustomersBlock" class="col-md-3">
          <div class="card">
            <a href="viewCustomers.php">
              <img class="card-img-top" src="images/view-customers.jpeg" alt="">
                <div class="card-body">
                  <p class="card-text">View Customers.</p>
                </div>
            </a>
          </div>
        </div>
        <!-- View Transactions -->
        <div id="viewTransactionsBlock" class="col-md-3">
          <div class="card">
            <a href="viewTransactions.php">
              <img class="card-img-top" src="images/view-transactions.jpg" alt="">
                <div class="card-body">
                  <p class="card-text">View Transactions.</p>
                </div>
            </a>
          </div>
        </div>
    </div>
  </div>
<a>
   <i class="blockquote float-right"> developed by Sukhbirsingh Khalsa</i>
</a>
<!-- content body ends here -->
<!--footer-->
<div class="footer">
    Follow us:<br>
    <a href="#facebook" class="facebook">
      <i class="fa fa-facebook icon-size"></i>
    </a>
    <a href="#twitter" class="twitter">
      <i class="fa fa-twitter icon-size"></i>
    </a>
    <a href="https://www.linkedin.com/in/sukhbirsinghkhalsa/" class="linkedin">
      <i class="fa fa-linkedin  icon-size"></i>
    </a>
    <a href="#instagram" class="instagram">
      <i class="fa fa-instagram icon-size"></i>
    </a>
</div>
<!--footer ends here-->
</body>
</html>