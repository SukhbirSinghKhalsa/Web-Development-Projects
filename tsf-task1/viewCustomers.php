<!DOCTYPE html>
<html>
<head>
	<title>View Customers</title>
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
 <!-- customer details table -->
<div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
	<h1 class="text-center text-info">Customer Details</h1>
	<?php
		//FOR ESTABLISHING CONNECTION TO DATABASE 
		include 'config.php';
		 //FOR FETCHING ID,name,current_balance from table
		$sql = "SELECT ID, name, email, current_balance FROM transactionhistory"; 
		$result = mysqli_query($conn, $sql);
		//creating table starts here
		echo "<div class='containerDiv'>
				<table id ='show_data' class='table containerDiv'>
					<thead>
				      <tr class='tableBody'>
				      	<th>Sr.no</th>
				      	<th>Name</th>
				      	<th>Email</th>
				      	<th>Current Balance</th>
				      	<th>View Transactions</th>
				      </tr>
				    </thead>"; 
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    //displaying / fetch customer data from database in form of table iteratively
		    while($row = mysqli_fetch_assoc($result)) {  
		      
		?>
		<tr onclick="onClickGetRowIndex(this.rowIndex)">
		    <td><?php echo $row["ID"];?></td>
		    <td><?php echo $row["name"];?></td>
		    <td><?php echo $row["email"];?></td>
		    <td><?php echo $row["current_balance"];?></td>
		    <td>
		    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
		    		view
		    	</button>
		    	<?php
		    		 }//while loop closed 
		    	?>
		    </td>
		 </tr>

		      
	</table>
   </div>
  </div>
 </div>
</div>
    <!--closing table-->
		<?php
	    	}else {
		        echo "0 results , empty database";
			}
			
		?>
</div>

<!-- customer details ends here -->
<!-- content body -->
<div class="container-fluid">
    <div class="row">
        <!-- Make Transactions -->
        <div id="makeTransactionsBlock" class="col-md-3">
          <div class="card">
            <a href="makeTransactions.php">
              <img class="card-img-top" src="images/money-transfer.jpg" alt="">
                <div class="card-body">
                  <p class="card-text">Make Transactions.</p>
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
      <a>
       <i class="blockquote float-right"> developed by Sukhbirsingh Khalsa</i>
      </a>
    </div>
  </div>

  <!-- content body ends here -->

<div class="container">
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Transactions Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        	<div id="txtHint">Customer info will be listed here...</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>
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
<script>
function onClickGetRowIndex(index){
	// JAVASCRIPT FUNCTION TO RETURN ROW INDEX
	// onchange="showCustomer(index.rowIndex)";
	// console.log(onchange);
	onchange=showCustomer(index);
	// alert(index);
}
function showCustomer(str) {
  // AJAX FOR CHANGING MODAL VALUES WITHOUT RELOADING THE PAGE
  var xhttp;  
  console.log(str);
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "singleTransactions.php?q="+str, true);
  xhttp.send();
}
</script>
</html>