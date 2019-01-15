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

<?php
include_once 'dbconnect.php';

if(isset($_GET['deleteID']))
{
    $getproductID = $_GET['deleteID'];
    $sqlquery_delete_product = "DELETE FROM Staff WHERE SID = $getproductID";
    mysqli_query($mysqli,$sqlquery_delete_product);
}


?>

<!DOCTYPE html>
<html>
<head>
<title> staff info </title>
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

  <!-- Navigation-->
  <?php include 'staff_header.php'; ?>
    <!-- Contact us-->
        <div class="container">

          <div class="row">

            <div class="mid">
              <h2>STAFF INFORMATION</h2><hr>
              <center>
                <table border="3" style="width:1000px;" cellpadding="8" cellspacing="0">
                <tr>
                <td>SID</td>
                <td>FirstName</td>
                <td>LastName</td>
                <td>Tel.</td>
                <td>Address</td>
                <td>Position</td>
                <td>Salary</td>
                <td>On Duty</td>
                <td>Edit</td>
                <td>Delete</td></tr>
              <?php
						$q = "SELECT * FROM staff";
            $data = [];
											if($result = $mysqli->query($q)){
												while($row = $result->fetch_array()){
                            $data[] = $row;
                          }


                        }





	?>
  <?php foreach($data as $row): ?>
    <td style="color:black"><?= $row['SID'] ?></td>
    <td style="color:black"><?= $row['FirstName'] ?></td>
    <td style="color:black"><?= $row['LastName'] ?></td>
    <td style="color:black"><?= $row['Tel'] ?></td>
    <td style="color:black"><?= $row['Address']?></td>
    <td style="color:black"><?= $row['Position']?></td>
    <td style="color:black"><?= $row['Salary'] ?></td>
    <td>
      <select onchange="changestatus(<?php echo $row['SID']; ?>, event)">
          <option value="on"
          <?php
            if($row['on_work']=='on'){
              echo "selected";
            }
          ?>
          > ON </option>
          <option value="off"
          <?php
            if($row['on_work']=='off'){
              echo "selected";
            }
          ?>>
          OFF</option>
        </select>
    </td>
  <td><a href="Admin_edit_staff.php?eid=<?=$row[0]?>">
    <img style="margin: 0px 10px"src="edit.png" width="25px" height="25px"></a>
    <td><a href="Admin_staff_info.php?deleteID=<?= $row['SID'] ?>">
    <img style="margin: 0px 10px"src="error.png" width="15px" height="15px"></a></td>
  </tr>
  <?php endforeach ?>
</table>
              <br>
              <a href="Admin_add_staff.php"><input type="submit"  value="ADD STAFF"></a>





            </center>


            </div>
          </div>
        </div>
        <script>
          function changestatus(id, event){
            var url = window.location.href
            if(url.indexOf('?')>-1){
              window.location.href = url.split('?')[0] + "?id="+id+"&status="+event.target.value
            } else {
              window.location.href = window.location.href + "?id="+id+"&status="+event.target.value
            }

          }
        </script>
        <?php

          if(isset($_GET['id'])){
            $id = $_GET['id'];
            $status = $_GET['status'];
            $sql = "UPDATE `Staff` SET on_work='$status' WHERE SID=$id";
            $result = $mysqli->query($sql);
            if($result){
              echo "<script>
                      var url = window.location.href
                      window.location.href = url.split('?')[0]
                    </script>";
            } else {
              echo $mysqli->error;
            }
          }

        ?>









</div>


</body>
</html>
