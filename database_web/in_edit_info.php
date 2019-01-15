<?php
include ('dbconnect.php');
session_start();
if(isset($_SESSION['s_role'])){
  if($_SESSION['s_role']!='Customer'){
    header("Location: login.php");
  }
} else {
  header("Location: login.php");
}

?>
<?php

if (isset($_SESSION['s_id']))
			{
        $getID = $_SESSION['s_id'];
				$q = "SELECT * FROM Customer, Address, LogIn
				WHERE Address.Customer_CID = Customer.CID AND
				      LogIn.UID = Customer.LogIn_UID AND
				      Customer.LogIn_UID = $getID";

        $result=$mysqli->query($q);
        $row=$result->fetch_array();
      }
?>
<html>
<head>
<title> clean food </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
<style>
body  {
    background-image: url("bg/nut.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100%;
    background-position: center;
    background-size: cover;
}
</style>

</head>
<body>


  <div id="head">
    <div class="topnav-right">
        <div class="dropdown">
          <a href ="in_home.php"><button class="dropbtn">HOME |</button></a>
        </div>

        <div class="dropdown">
          <button class="dropbtn">MENU |</button>
            <div class="dropdown-content">

              <a href="in_maincourses.php">MAIN COURSES</a>
              <a href="in_desserts.php">DESSERTS</a>
              <a href="in_beverages.php">BEVERAGES</a>
            </div>
          </div>



        <div class="dropdown">
          <a href ="in_aboutus.php"><button class="dropbtn">ABOUT US |</button></a>
        </div>

        <div class="dropdown">
          <button class="dropbtn">CONTACT US |</button>
          <div class="dropdown-content">
            <a href="in_contact_info.php">Contact Info</a>
            <a href="in_message.php">Leave a message</a>
          </div>
        </div>

        <div class="dropdown">
          <button class="dropbtn"><?php echo $row['FirstName']. "|" ;?></button>
          <div class="dropdown-content">
            <a href="in_edit_info.php">Edit Profile</a>
            <a href="in_order_delivery.php">Order Status</a>
            <a href="logout.php">LOG OUT</a>
          </div>
        </div>

        <div class="dropdown">
          <div class="ibutton">
          <div id="close-image">
            <a href="in_shopping.php"><img src="food/shop.png"></a>
      </div>
    </div>
  </div>



  </div>
  </div>
  <!-- Contact us-->
  <div class="container">

    <div class="row">

      <div class="col">
        <?php
          if(isset($_POST['sub'])){
            if (isset($_POST['address'])){
              if ($_POST['address']!=''){
                $t = "INSERT INTO Address (Address, Customer_CID) VALUES ('".$_POST['address']."',".$row['CID'].")";

                echo $t."<br><br>";
                $mysqli->query($t);
              }




            }
          $getUID = $_SESSION['s_id'];
          $fname = trim($_POST['firstname']);
          $lname = trim($_POST['lastname']);
          $gender = trim($_POST['gender']);
          $tele = trim($_POST['telephone']);
          $email = trim($_POST['email']);
          $addr = trim($_POST['subject']);
          echo $getUID;
          echo $fname;
          echo $lname;
          echo $gender;
          echo $tele;
          echo $email;
          echo $addr;

          $q = "UPDATE customer SET " .  //sql query = single quote
          "FirstName = '".$fname."', " .
          "LastName = '".$lname."', " .
          "Tel = '".$tele."', " .
          "Gender = '".$gender."' " .
          "WHERE Login_UID = '".$getUID."'; " ;

          //echo '<hr>';
          //echo $q;

          $t = "UPDATE login SET " .
           "Email = '".$email."' " .
          "WHERE UID = '".$getUID."'; " ;
          //echo '<hr>';
          //echo $t;
         // echo '<hr>';
          //echo $mysqli->connect_errno. "; " .$mysqli->connect_error;
          if($res=$mysqli->query($q)){
            header("Location: in_edit_info.php");
          }
          else{
            echo 'Query Failed';
          }

          }
        ?>
        <h2>Edit Profile</h2><hr><br>
        <form action="in_edit_info.php" method="POST">
          <label for="fname">First Name</label>
          <input type="text" name="firstname" value=<?php echo $row['FirstName']?>>

          <label for="lname">Last Name</label>
          <input type="text"  name="lastname" value=<?php echo $row['LastName']?>>

          <label for="gender">Gender</label>
          <input type="radio" name="gender" value="male" <?php if($row['Gender']=='Male' || $row['Gender']=='male' ){echo 'checked';}?>> Male
          <input type="radio" name="gender" value="female"<?php if($row['Gender']=='Female' || $row['Gender']=='female' ){echo 'checked';}?> > Female
          <input type="radio" name="gender" value="other" <?php if($row['Gender']=='Other' || $row['Gender']=='other' ){echo 'checked';}?>> Other<br><br>
          <label for="tel">Telephone No.</label>
      <input type="text" name="telephone" value=<?php echo $row['Tel']?>>

      <label for="email">Email</label>
      <input type="text" name="email" value=<?php echo $row['Email']?>>
      <?php

                $getUID = $_SESSION['s_id'];
                $q2 = "SELECT address,AddressID FROM address, customer, login WHERE address.Customer_CID = customer.CID
                AND customer.LogIn_UID = login.UID AND login.UID = $getUID
                AND Status='on';";
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
                      <a href="in_edit_info.php?deleteID=<?php echo $row['AddressID']?>"><img style="margin: 0px 10px"src="error.png" width="25px" height="25px"></a>
                      <textarea id="subject" name="subject" style="height:50px" readonly><?php echo $row['address']; ?></textarea>

              <?php
                    }
                    $co += 1;
                  }
                }

             ?>
      <img id="addAddress" style="margin: 0px 2px; cursor:pointer"src="plus-2.png" width="25px" height="25px"> Add Address <br><br>
      <textarea id="address" style="display:none" name="address" id="" cols="30" rows="6"></textarea>

      <p style="color: #9494b8"> <a href="in_change_password.php" style="color: #9494b8">Change password</a> </p>


      <input type="submit" id="signin" value="SUBMIT" name="sub">

        </form>
        <?php
        if(isset($_GET['deleteID']))
        {

          $getAdd = $_GET['deleteID'];
          //echo $getAdd;

          $que = "UPDATE Address SET Status='off' WHERE AddressID=$getAdd";
          //$que = "DELETE FROM address WHERE AddressID = $getAdd";
          if($mysqli->query($que)=== TRUE){
            //echo 'Query Success!';
            header("Location: in_edit_info.php");
          }
          else{
            echo 'Query Failed';
          }
        }
        ?>

      </div>
    </div>


    <script>
      document.getElementById('addAddress').addEventListener("click", function(){
        document.getElementById('address').style.display = "block"
      })
    </script>

</body>
</html>
