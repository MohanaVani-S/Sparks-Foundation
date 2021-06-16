<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "bank"; 
$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) { 
  die("Connection failed: " . $conn->connect_error); 
} 
$sql = "SELECT * FROM history" ;
$result = $conn->query($sql);
?>
            
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Bstyle.css">
    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    
        <style>
        html {
            position: relative;
            min-height: 50%;
        }
             
       
        .container{      
            padding-top:3px;
            display: block;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 60%; 
        }
            body{
	background-image: url('rec.jpeg');
	background-repeat: no-repeat; 
	background-size: cover;

  }      
        table{
            border-collapse: collapse;
  width: 100%;
  margin-top: 50px;
  color: solid black;

}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #ADD8E6}
tr:nth-child(odd){background-color: #D3D3D3}

th {
 
  color: solid black;
}

          
        
    </style>
</head>

<body>
  <!--NAVBAR-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <img src="money-bag.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
    <a class="navbar-brand" href="#">The Sparks Bank</a>
    
     
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="bankhome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="customerdetails.php">Customer Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="fundtransfer.php">Fund Transfer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="RecordsPage.php">Transaction History</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
 
	<div class="container">
        <h1 style="text-align: center">Transaction History</h1>
        <hr>
       <div>
    <center><table class="table table-striped table-hover"style="width: 500px;">
        <thead>
            <tr style="background-color:grey;">
                
                <th>Payer</th>
                <th>Payer Acc.No.</th>
                <th>Payee</th>
                <th>Payee Acc.No.</th>
                <th>Amount</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
        
        <?php

    while($row = $result->fetch_assoc()) { 
  ?> 
 <tr>
        
        <td><?php echo $row['Payer']; ?></td>
        <td><?php echo $row['Payer_acc_no']; ?></td>
        <td><?php echo $row['Payee']; ?></td>
        <td><?php echo $row['Payee_acc_no']; ?></td>
        <td><?php echo $row['amount']; ?></td>
        <td><?php echo $row['time']; ?></td>

     
        </tr>
 <?php
    }
  
$conn->close();
?> 
</
</table></center>
    </div>
</div>

<body>

</html>