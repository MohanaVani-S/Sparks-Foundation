<?php


header("Cache-Control: private, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat,26 Jul 1997 05:00:00 GMT");
//CONNECTING TO THE DATABASE
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "bank"; 
    
    $conn = new mysqli($servername, $username, $password, $dbname); 
    //IF CONNECTION IS NOT SUCCESSSFUL
    if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
    } 
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
<!--CSS-->
    <link rel="stylesheet" type="text/css" href="Bstyle.css">

    

    <title>Sparks Bank Home</title>
      <style>
    
    .center{

        background: #91c1c9;
        background: -webkit-linear-gradient(to bottom,  #91c1c9, #5e9da8 );
        background: linear-gradient(to bottom, #91c1c9, #3a5f66);
        padding-top:5px;
        display: block;
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 50%;    
    }
    .center2{
        font-size:15px;
        width:100%;
    }
        body{

  background-image: url('party.jpg');
  background-repeat: no-repeat; 
  background-size: cover;
}
    table {
    margin: 0 auto; /* or margin: 0 auto 0 auto */
  }
    td,th { border: 1px solid #ddd; padding: 8px;}
    #Table{ font-family: Arial,Helvetica, sans-serif; border-collapse: collapse;}
    #Table tr:nth-child(even){ background-color: #d2d3d4; }
    #Table tr:nth-child(odd){ background-color: #dee2e3; }
    #Table tr:hover{ background-color: #b5d0eb; }
    #Table th { padding-top: 12px; padding-bottom: 12px; text-align:left; background-color:  #608fb3; color:white; }

    </style>    
     <script type="text/javascript">
    
    if(window.history.replaceState){
        
        window.history.replaceState(null, null, window.location.href); 
    }
    
</script>

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
          <a class="nav-link" aria-current="page" href="#">Home</a>
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

<?php 
  if(isset($_POST['form_submitted'])){

    //These variables are collecting form data
      $PAYER_ID = $_POST['Payer_acc_no'];
      $PAYEE_ID = $_POST['Payee_acc_no'];
      $AMOUNT = $_POST['amount'];

      if(empty($PAYER_ID) || empty($PAYER_ID) || empty($AMOUNT)){
        //javascript code to notify user not to leave field blank         
        echo "<script> alert('Empty Fields !!');
        window.location.href='fundtransfer.php';
        </script>";  
        exit() ;           
      }

      //CHECK IF AMOUNT IS GREATER THAN 0 OR NOT
      if($AMOUNT <=0){
        echo "<script> alert('Amount must be greater than zero !!');
        window.location.href='fundtransfer.php';
        </script>";  
        exit() ;  
      }

      if(!ctype_digit($AMOUNT) || !ctype_digit($PAYER_ID) || !ctype_digit($PAYEE_ID)){
        echo "<script> alert('Entered value can only contain digit!!');
        window.location.href='fundtransfer.php';
        </script>";  
        exit() ;  
      }

      //CHECK IF PAYER ID EXISTS OR NOT
      $sqlcount = "SELECT COUNT(1) FROM custdetails where acc_no='$PAYER_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Payer ID does not exists !!');
        window.location.href='fundtransfer.php';
        </script>";  
        exit() ;      
      }
    
      //CHECK IF PAYEE ID EXISTS OR NOT
      $sqlcount = "SELECT COUNT(1) FROM custdetails where acc_no='$PAYEE_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Payee ID does not exists !!');
        window.location.href='fundtransfer.php';
        </script>";  
        exit() ;      
      }
      
      //CHECK IF PAYER HAS SUFFICIENT MONEY OR NOT
      $sql = "Select * from custdetails where acc_no='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
               if($row1['acc_bal']<$AMOUNT){
                echo "<script> alert('Payer does not have required balance !!');
                window.location.href='fundtransfer.php';
                </script>";  
                exit() ; 
                }  
          }  

   
      //THIS ELSE CODE BELOW IS PERFORMING TRANSACTION FROM PAYER AND PAYEE BANK ACCOUNTS
      //BELOW CODE RUNS WHEN ALL DETAILS ENTERED BY USER ARE CORRECT OR NOT

          echo "<div class ='center'>";
          echo "<div class ='center2'>";
          echo "<h1 style='text-align: center'>Transaction Successfull !!</h1>
                <p  style='text-align: center; font-size:25px;'>Details of payer and payee are as follows<p>
                <table id = 'Table'>
                <tr>
                <th></th>
                <th>Account No</th>
                <th>Name</th>
                <th>Email</th>
               
                </tr>";

          //SELECTING PAYER DETAILS FROM ACCOUNTDETAILS TABLE
          $sql = "Select * from custdetails where acc_no='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
                //row1 contains payer details
                       echo "<tr> 
                            <td> Payer </td>
                            <td>".$row1['acc_no']."</td>
                            <td>".$row1['Name']."</td>
                            <td>".$row1['Email']."</td>
                           
                            </tr>";                        
                       $PayerCurrentBalance = $row1['acc_bal'];            
            }
        
          //SELECTING PAYEE DETAILS FROM ACCOUNTDETAILS TABLE
          $sql2 = "Select * from custdetails where acc_no='$PAYEE_ID'";
          if($result = $conn->query($sql2)){
                //row2 contains payee details
                $row2 = $result->fetch_array();
                       echo "<tr> 
                            <td> Payee </td>
                            <td>".$row2['acc_no']."</td>
                            <td>".$row2['Name']."</td>
                            <td>".$row2['Email']."</td>
                           
                            </tr>"; 
                        $PayeeCurrentBalance = $row2['acc_bal'];                       
               
               
            }               
            echo "</table>";
            $PayeeCurrentBalance += $AMOUNT;
            $PayerCurrentBalance -= $AMOUNT;
            echo "<br>";
            echo "<table id = 'Table' style='margin-bottom:15px;'>
                    <tr>
                        <th></th>
                        <th>Old Balance</th>
                        <th>New Balance</th>
                    </tr>
                    <tr>
                        <th>Payer</th>
                        <td style='color:black'>".$row1['acc_bal']."</td>                        
                        <td style='color:black'>".$PayerCurrentBalance."</td>
                    </tr>
                    <tr>
                        <th>Payee</th>
                        <td style='color:black'>".$row2['acc_bal']."</td>                        
                        <td style='color:black'>".$PayeeCurrentBalance."</td>
                    </tr>";
            echo "</table>";
            //echo "Payer has available Balance = ".$row1['balance']."<br>";           
            //echo "Payer has available Balance = ".$PayerCurrentBalance."<br>";
            //echo "Payee has available Balance = ".$PayeeCurrentBalance."<br>";

           //FOR UPDATING DETAILS OF PAYER
           $updatepayer ="Update custdetails set acc_bal='$PayerCurrentBalance' where acc_no='$PAYER_ID'";
           //FOR UPDATING DETAILS OF PAYEE
           $updatepayee ="Update custdetails set acc_bal='$PayeeCurrentBalance' where acc_no='$PAYEE_ID'";

           //CHECK IF PAYER DETAILS ARE UPADTED OR NOT 
           if($conn->query($updatepayer)==true){
                ?>         
                <script>console.log("PAYER DETAILS UPDATED!!")</script>
                <?php
           }
           else{
                ?>        
                <script>alert("PAYER DETAILS NOT UPDATED!!")</script>
                <?php
           }

           //CHECK IF PAYEE DETAILS ARE UPADTED OR NOT 
           if($conn->query($updatepayee)==true){
                    ?>         
                    <script>console.log("PAYEE DETAILS UPDATED! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("PAYEE DETAILS NOT UPDATED! ERROR OCCURED!")</script>
                    <?php
            }

            //SETTING TIME ZONE
            date_default_timezone_set('Asia/Kolkata');           
            $date = date('Y-m-d H:i:s',time());
            //echo "Current time is : ".$date;

            //FOR UPDATING HISTORY TABLE WHICH MAINTAINS RECORDS OF ALL TRANSACTIONS
            $InsertTransactTable ="Insert into history (Payer, Payer_acc_no, Payee, Payee_acc_no, amount, time) values ('$row1[Name]','$row1[acc_no]','$row2[Name]','$row2[acc_no]','$AMOUNT','$date')";
            //EXECUTING INSERT COMMAND AND CHECKING IF INSERTION WAS SUCCESSULL OR NOT
            if($conn->query($InsertTransactTable)==true){
                    ?>         
                    <script>console.log("Record of this transaction saved! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("Record of this transaction saved! ERROR OCCURED!")</script>
                    <?php
            }


            echo "<br>";
        echo "</div>";
        echo "</div>";
       // echo"<script>alert('Transaction successfull!!')</script>";
        //END OF ELSE OF PROCEED BUTTON
     // }

  //IF ENDS HERE    
  }else{
      ?>
      <h1>All transactions are up to date</h1>
      <?php
  }
  //DATABASE CONNECTION ENDS HERE
  $conn->close();
  //PHP CODE ENDS HERE
?>
 

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>