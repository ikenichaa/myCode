<?php
session_start();
if(isset($_SESSION['s_role'])){
  if($_SESSION['s_role']!='Admin'){
    header("Location: login.php");
  }
} else {
  header("Location: login.php");
}

include('dbconnect.php');


?>


<!DOCTYPE html>
<html>
<head>
<title> Edit Customer </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>
body  {
    background-image: url("bg/christmas.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100%;
    background-position: center;
    background-size: cover;
}
</style>

</head>
<body>


<?php include 'staff_header.php'; ?>
  <!-- Contact us-->
  <div class="container">

    <div class="row">

      <div class="col">
        <h2>Edit CUSTOMER Information</h2><hr><br>
       <?php
        if(isset($_POST['sub'])){
          if (isset($_POST['address'])){
            if ($_POST['address']!=''){
            $t = "INSERT INTO Address (Address, Customer_CID) VALUES ('".$_POST['address']."',".$_GET['eid'].")";

            echo "<script>alert('".$_POST['address']."')</script>";
            echo $t."<br><br>";
            $mysqli->query($t);
          }


          }
          var_dump($_POST);
          $fname = trim($_POST['firstname']);
          $lname = trim($_POST['lastname']);
          $gender = trim($_POST['gender']);
          $tele = trim($_POST['telephone']);
          $email = trim($_POST['email']);
          $pass = trim($_POST['password']);
          $addr = trim($_POST['subject']);
          $custid = trim($_POST['custid']);
          $loid = trim($_POST['logid']);
          $addrid = trim($_POST['addrid']);
          echo $addr;
          $q = "UPDATE customer SET " .  //sql query = single quote
          "FirstName = '".$fname."', " .
          "LastName = '".$lname."', " .
          "Tel = '".$tele."', " .
          "Gender = '".$gender."' " .
          "WHERE CID = '".$custid."'; " ;

          $t = "UPDATE login SET " .
           "Email = '".$email."' " .
          "WHERE UID = '".$loid."'; " ;

          $v = "UPDATE address SET " .
          "Address = '".$addr."' " .
          "WHERE AddressID = '".$addrid."'; " ;

          echo "<hr>";
          echo $loid;
          echo "<hr>";
          echo $q;
          echo "<hr>";
          echo $t;
          echo "<hr>";
          echo $v;

          if($res=$mysqli->query($q) & $res2=$mysqli->query($t) & $res3=$mysqli->query($v)){
            header("Location: Admin_customer_info.php");
          }
          else{
            echo "UPDATE faill!!";
          }
        }
        else if(!isset($_GET['deleteID'])){
            include('dbconnect.php');
            $customer_id = $_GET['eid'];
            $q = "SELECT * FROM customer, login, address WHERE CID = $customer_id AND customer.LogIn_UID = login.UID AND customer.CID = address.customer_CID" ;
            if($res = $mysqli->query($q)){
                $row = $res->fetch_array();

       ?>
        <form action="Admin_edit_customer.php?eid=<?php echo $_GET['eid']; ?>" method="POST">
          <input type="hidden" name="custid" value="<?php echo $row['CID']; ?>">
          <input type="hidden" name="logid" value="<?php echo $row['UID']; ?>">
          <input type="hidden" name="addrid" value="<?php echo $row['AddressID']; ?>">
          <label for="fname">First Name</label>
          <input type="text" id="fname" name="firstname" value="<?php echo $row['FirstName']; ?>">

          <label for="lname">Last Name</label>
          <input type="text" id="lname" name="lastname" value="<?php echo $row['LastName']; ?>">

          <label for="gender">Gender</label>
          <input type="radio" name="gender" value="male" <?php if($row['Gender']=='Male' || $row['Gender']=='male' ){echo 'checked';}?>> Male
          <input type="radio" name="gender" value="female" <?php if($row['Gender']=='Female' || $row['Gender']=='female' ){echo 'checked';}?>> Female
          <input type="radio" name="gender" value="other" <?php if($row['Gender']=='Other' || $row['Gender']=='other' ){echo 'checked';}?>> Other<br><br>
          <?php //if($row['Gender']=='Female' || $row['Gender']=='female' ){echo 'checked';}?>
          <label for="tel">Telephone No.</label>
      <input type="text" id="tel" name="telephone" value="<?php echo $row['Tel']; ?>">

      <label for="email">Email</label>
      <input type="text" id="email" name="email" value="<?php echo $row['Email']; ?>">




      <?php

          $q2 = "SELECT address,AddressID FROM address WHERE Customer_CID=$customer_id AND Status='on'";
          if($q = $mysqli->query($q2)){
            $count = $q->num_rows;
            //echo $count;
            //echo '<br>';
            $co = 1;
            while($row = $q->fetch_array()){

              for($i=0; $i<1;$i++){

                //var_dump($row);
                //print_r($row[$i]);
        ?>
                <label for="add">Address <?php echo $co; ?></label>
                <a href="Admin_edit_customer.php?deleteID=<?php echo $row['AddressID']?>"><img style="margin: 0px 10px"src="error.png" width="25px" height="25px"></a>
                <textarea id="subject" name="subject" style="height:50px"><?php echo $row['address']; ?></textarea>

        <?php
              }
              $co += 1;
            }
          }

       ?>


      <img id="addAddress" style="margin: 0px 2px; cursor:pointer"src="plus-2.png" width="25px" height="25px"> Add Address <br><br>
      <textarea id="address" style="display:none" name="address" id="" cols="30" rows="6"></textarea>








      <input type="submit" id="signin" value="SUBMIT" name="sub">

        </form>
    <?php
        }
      }
      else if(isset($_GET['deleteID']))
        {
          include('dbconnect.php');
          $getAdd = $_GET['deleteID'];
          //echo $getAdd;


          $que = "UPDATE Address SET Status='off' WHERE AddressID=$getAdd";
          if($mysqli->query($que)=== TRUE){
            //echo 'Query Success!';
            header("Location: Admin_customer_info.php");
          }
          else{
            echo 'Query Failed';
          }
        }
    ?>
      </div>
    </div>




</body>
</html>



<script>
  document.getElementById('addAddress').addEventListener("click", function(){
    document.getElementById('address').style.display = "block"
  })
</script>

</body>
</html>
