<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Bar / Add Menu</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <style>
       .Menu-text{
        font-family: Lucida Handwriting;
        display: flex;
        font-weight: 800;
        font-size: 30px;
        color: #14e529;
        justify-content: center;
      }
      .Enterd{
        color: aliceblue;
      }
      input[type=submit] {
        background-color: #ffffff;
        border-radius: 7px;
        border: none;
        font-size: 15px;
        font-weight: 800;
        color: rgb(0, 0, 0);
        padding: 4px 8px;
      cursor: pointer;
     }
     input[type=text]:hover{
            color: #ffffff;
            background-color: #14e529;
     }

     input[type=submit]:hover{
            color: #ffffff;
            background-color: #14e529;
     }
     
     input[type=text] {
     
      font-size: medium;
      font-weight: 800;
         margin: 8px 0;
         box-sizing: border-box;
         border: 3px solid #3d3a3a;
         transition: 0.5s;
        outline: none;
      }

      .menu-table {
  border-collapse: collapse;
  margin: 20px 0;
}

.menu-heading {
    color: #14e529;
  text-align: center;
  margin: 20px 0;

}

.menu-heading h1 {
  font-size: 24px;
  font-weight: bold;
  color:  #14e529;
}
.menu-table th,
.menu-table td {
  padding: 20px;
  text-align: left;
  border: 1px solid #ddd;
}

.menu-table th {
  background-color: #f2f2f2;
  font-weight: bold;
}

.food-name {
  font-size: 18px;
  font-weight: bold;
  color:  #14e529;
}

.food-price {
  font-size: 16px;
  color:  #14e529;
}


      </style>
  </head>
  <body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

    <section>
      <header>
        <h2><a href="" class="logo">Coffee Bar</a></h2>
        <div class="navigation">
          <a href="home.php">Home</a>
         
          <a href="./createbill.php">Create bill</a>
          <a href="material.php">Check Raw Material</a>
        </div>
      </header>
      <center>
       
        <div class="Menu-text">Enter Menu Item</div>
    
        <div class="Enterd">
        <table  style="margin: 4px;padding: 20px;  border-collapse: separate;
        border-spacing: 40px 15px;">
        <tr>
          <th>Food Name</th>
          <th>Food Price</th>
          <th>Food Categories</th>
        </tr>
        <tr>
          <td><input type="text" name="FoodName"></td>
          <td><input type="text" name="Price"></td>
          <td><label for="dropdown">Select an option:</label>
          <?php 
             $con = mysqli_connect("localhost","root","","coffee_bar");
             //  $a="create table foodMenu(Food_Name varchar(255),Food_Price int)";


       $qry2="select *from foodcategory";
       $show2= mysqli_query($con,$qry2);
       echo '<select name="dropdown">'; 
        while($row = $show2->fetch_assoc()) {
          echo '<option value="' . $row["CategoryID"] . '">' . $row["CategoryName"] . '</option>';
        }
        echo '</select>';

          ?>
    
        </td>
        </tr>
           </table>
          </div>
      
          <input type="submit" name="btn" value="submit">
       
            </div>
      </center>
      </form>
  <?php
  $con = mysqli_connect("localhost","root","","coffee_bar");
      //  $a="create table foodMenu(Food_Name varchar(255),Food_Price int)";
echo "<center>";
$qry="select *from foodMenu ";
$qry2="select *from foodcategory";
$show2= mysqli_query($con,$qry2);
$show=mysqli_query($con,$qry);
echo "<center>";
echo "<div class='menu-heading'><h1>Available Menu Item</h1></div>";
echo "<table class='menu-table'>";
echo "<tr><th>Food Name</th><th>Price (₹)</th><th>Action</th></tr>";
//TODO : fetch catarory from db => dispkay in drpo down => at submit insert append food catagory it to foodMenu table

while($row = mysqli_fetch_array($show)) {
  echo "<tr>";
  echo "<td><span class='food-name'>".$row['foodName']."</span></td>";
  echo "<td><span class='food-price'>".$row['foodPrice']."</span></td>";
  echo "<td><a href='edit.php?Food_Name={$row['foodName']}'>Edit</a>&nbsp;&nbsp;&nbsp;";
  echo "<a href='delete.php?Food_Name={$row['foodName']}'>Delete</a>&nbsp;&nbsp;</td>";
  echo "</tr>";
}


  if(isset($_POST['btn'])) {
    $Food_Name = $_POST['FoodName'];
    $Food_Price = $_POST['Price'];
    $categoryID =intval($_POST['dropdown']);
      // $Adddata = "INSERT INTO foodMenu (foodName, foodPrice, CategoryID) VALUES ('$Food_Name', '$Food_Price',1)";
      $Adddata = "INSERT INTO foodMenu (foodName, foodPrice, CategoryID) VALUES ('$Food_Name', '$Food_Price','$categoryID')";
      $s = "select * from foodMenu where foodName = '$Food_Name'and FoodPrice='$Food_Price'";
      $res2 = mysqli_query($con,$s);
      if(mysqli_num_rows($res2) > 0)
      {
        // User exists, login successful
        echo "<script>alert('Food Item Already Exist!!');</script>";
        
      }
      else{
        if(mysqli_query($con, $Adddata)) { 
          echo "<center>";
          echo "<script>alert('Entered Data successfully..');</script>";
     
      } else {
          echo "Error: " . mysqli_error($con);
      }
    }
  }
  
  

 mysqli_close($con);

  ?>
  
  </section>
   
  </body>
</html>

