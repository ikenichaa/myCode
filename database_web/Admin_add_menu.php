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
<title> add customer </title>
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

            <div class="column">
              <h2>Add MENU</h2><hr><br>
              <form action='Admin_edit_menu.php' method='POST'>
                  ProductName : <input type='text' placeholder='Enter ProductName' name='pname'><br><br>
                  Cal : <input type='text' placeholder='Enter Cal' name='cal'><br><br>
                  Price : <input type='text' placeholder='Enter Price' name='price'><br><br>
                  ProductType: <select  name='pid'>
            <option value="1">Main Course</option>
            <option value="2">Desserts</option>
            <option value="3">Drink</option>
          </select><br><br>
          imgurl : <input type='text' placeholder='Enter imgurl'  name='url'><br><br>


            <input type="submit" id="signin" value="Add">

              </form>
            </div>
          </div>
        </div>


</body>
</html>
