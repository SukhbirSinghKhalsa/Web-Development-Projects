<?php
		include 'config.php';
		$sql ="SELECT sender, receiver, sentAmount,timeUpdated FROM history";
		$result = mysqli_query($conn, $sql);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Transactions</title>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="cleanStyle.css">
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
 <!-- header ends here -->
<!-- TRANSACTION DETAILS TEXT -->
<div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
	<h1 class="text-center text-info">Transaction Details</h1>
  <!-- BODY -->
<div id="displayTransactions">
	<?php
		echo "<div class='containerDiv'>
			  	<table id ='show_data' class='table containerDiv'>
				<thead>
			      <tr class='tableBody'><th>Sender</th>
				      <th>Receiver</th>
					  <th>Amount Transferred</th>
					  <th>Date & Time</th>	
			  	  </tr>
			  </thead>";
		if($result){
			while($rows = mysqli_fetch_assoc($result))
			{
				echo "<tr>"
				."<td class=''> ".$rows['sender'] ."</td>"
		        ."<td class=''> ".$rows['receiver'] ."</td>"
		        ."<td class=''> ".$rows['sentAmount'] ."</td>"
		        ."<td class=''> ".$rows['timeUpdated'] ."</td>"
		        ."</tr>";
	    	}
	    	echo "</table>
	    	</div>";
        }else {
            	echo "<script>console.log('Error: " . $sql . "<br>" . mysqli_error($conn)."')</script>";
              }	
        mysqli_close($conn);
		//Close connection
    ?>
    </div>
   </div>
  </div>
 </div>
</div>
<!-- transaction table ends here -->
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
        <!-- Make Transactions -->
        <div id="makeTransactionsBlock" class="col-md-3">
          <div class="card">
            <a href="makeTransactions.php">
              <img class="card-img-top" src="images/money-transfer.jpg" alt="">
                <div class="card-body ">
                  <p class="card-text">Make Transactions.</p>
                </div>
            </a>
          </div>
        </div>
       <a>
         <i class="blockquote float-right"> developed by Sukhbirsingh Khalsa</i>
       </a>
    </div>
  </div>

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