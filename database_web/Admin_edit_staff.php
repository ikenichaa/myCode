
<?php
session_start();
if(isset($_SESSION['s_role'])){
  if($_SESSION['s_role']!='Admin'){
    header("Location: login.php");
  }
} else {
  header("Location: login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title> Edit Staff </title>
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
        <h2>Edit STAFF Information</h2><hr><br>
      <?php
        if(isset($_POST['sub'])){
          var_dump($_POST);
          echo($_POST['position']);
          $fname = trim($_POST['firstname']);
          $lname = trim($_POST['lastname']);
          $tele = trim($_POST['telephone']);
          $email = trim($_POST['email']);
          $addr = trim($_POST['subject']);
          $pos = trim($_POST['position']);
          $sal = trim($_POST['salary']);
          $stid = trim($_POST['staffid']);
          $loid = trim($_POST['logid']);
          $q = "UPDATE staff SET " .  //sql query = single quote
          "FirstName = '".$fname."', " .
          "LastName = '".$lname."', " .
          "Tel = '".$tele."', " .
          "Address = '".$addr."', " .
          "Position = '".$pos."', " .
          "Salary = '".$sal."' " .
          "WHERE SID = '".$stid."'; " ;
          $t = "UPDATE login SET " .
           "Email = '".$email."' " .
          "WHERE UID = '".$loid."'; " ;

          
          include('dbconnect.php');
          if($res=$mysqli->query($q) & $res2=$mysqli->query($t)){
            header("Location: Admin_staff_info.php");
          }
          else{
            echo "UPDATE faill!!";
          }
        }
        else if(isset($_GET['eid'])){
            include('dbconnect.php');
            $staff_id = $_GET['eid'];
            $q = "SELECT * FROM staff, login WHERE SID = $staff_id AND staff.Login_UID = login.UID";
            if($res = $mysqli->query($q)){
                $row = $res->fetch_array();

       ?>
    <form action="Admin_edit_staff.php" method="POST">
          <input type="hidden" name="staffid" value="<?php echo $row['SID']; ?>">
          <input type="hidden" name="logid" value="<?php echo $row['UID']; ?>">
          <label for="fname">First Name</label>
          <input type="text" id="fname" name="firstname" value="<?php echo $row['FirstName']; ?>">

          <label for="lname">Last Name</label>
          <input type="text" id="lname" name="lastname" value="<?php echo $row['LastName']; ?>">


          <label for="tel">Telephone No.</label>
          <input type="text" id="tel" name="telephone" value="<?php echo $row['Tel']; ?>">

          <label for="email">Email</label>
          <input type="text" id="email" name="email" value="<?php echo $row['Email']; ?>">


          <label for="add">Address</label>
          <textarea id="subject" name="subject" style="height:50px"><?php echo $row['Address']; ?></textarea>

          <label>Position</label>
          <br><br>
          <input type="radio" name="position" <?php if ($row['Position']=="Admin") echo "checked";?>
          value="Admin"> Admin
          <input type="radio" name="position" <?php if ($row['Position']=="Delivery Staff") echo "checked";?>
          value="Delivery Staff"> Delivery Staff
          <br><br>



          <label for="email">Salary</label>
          <input type="text" id="salary" name="salary" value="<?php echo $row['Salary']; ?>">


          <input type="submit" id="signin" value="SUBMIT" name="sub">

        </form>
    <?php
        }
      }
    ?>
      </div>
    </div>




</body>
</html>
