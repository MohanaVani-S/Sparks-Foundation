<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Cust_id, Name, Email,phone_no,acc_no,acc_bal FROM custdetails";
$result = $conn->query($sql);

?>
<!--html-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Bstyle.css">
    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    <title>Customer Details</title>
    
  </head>
  <body>
    <a href="bankhome.html"></a>
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



<!--Customer details-->
<section id=Customer_details class=container>
<h1 style="color: black;"><center> Customer Details</center></h1>
<hr style="color: black;"style="border: 2px solid black;">
</section>
<style>
  body {
  background-image: url('bankback.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
<!--Table--><center>
  <style>
  table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 50px;
  color: solid black;

}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
tr:nth-child(odd){background-color: #f2f2f2}

th {
  background-color: purple;
  color: solid black;
}
</style>
<center><table class="table table-striped table-hover"style="width: 500px;">
  

  <tr style="background-color: grey;">
    <th>Customer ID</th>
    <th>Name</th>
    <th>Email_ID</th>
    <th>Phone No.</th>
    <th>Account No.</th>
    <th>Account Balance</th>
  </tr>


<?php
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
   <tr>
    <td> <?php echo $row["Cust_id"];?></td>
    <td> <?php echo $row["Name"];?></td>
    <td> <?php echo $row["Email"];?></td>
    <td> <?php echo $row["phone_no"];?></td>
    <td> <?php echo $row["acc_no"];?></td>
    <td> <?php echo $row["acc_bal"];?></td>
  </tr>
   <?php
    
  }
} else {
  echo "0 results";
}
?>
</table></center>
<?php
$conn->close();
?>





