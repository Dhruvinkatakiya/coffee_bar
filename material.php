<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Bar / Material </title>
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

.Material-name, 
.material-quantity, 
.material-Price,
.material-timestamp {
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
        <h2><a href="#" class="logo">Coffee Bar</a></h2>
        <div class="navigation">
          <a href="home.php">Home</a>
          <a href="addMenu.php">ADD New Menu</a>  
          <a href="./createbill.php">Create bill</a>
        
        </div>
      </header>
      <center>
       
        <div class="Menu-text">Enter New Stock Of Material Item</div>
    
        <div class="Enterd">
        <table  style="margin: 4px;padding: 20px;  border-collapse: separate;
        border-spacing: 40px 15px;">
        <tr>
          <th>Material Name</th>
          <th>Material Quantity</th>
          <th>Material Price</th>
        </tr>
        <tr>
          <td><input type="text" name="MaterialName"></td>
          <td><input type="text" name="MaterialQuantity"></td>
          <td> <input type="text" name="MaterialPrice"></td>
        </tr>
           </table>
          </div>
      
          <input type="submit" name="btn" value="submit">
       
            </div>
      </center>
      </form>
  <?php
  $con = mysqli_connect("localhost","root","","coffee_bar");
      //  $a="create table Material(Materialid ,MaterialName varchar(255),MaterialPrice int)";
echo "<center>";
$qry="select *from  material  ";
$show=mysqli_query($con,$qry);
echo "<center>";
echo "<div class='menu-heading'><h1>Available  Material </h1></div>";
echo "<table class='menu-table'>";
echo "<tr><th> Material Name</th> <th>Quantity</th ><th>Price (₹)</th> <th> Time </th></tr>";

while($row = mysqli_fetch_array($show)) {
  echo "<tr>";
  echo "<td><span class='Material-name'>".$row['MaterialName']."</span></td>";
  echo "<td><span class='material-quantity'>".$row['MaterialQuantity']."</span></td>";
  echo "<td><span class='material-Price'>".$row['MaterialPrice']."</span></td>";
  echo "<td><span class='material-timestamp'>".$row['Timestamp']."</span></td>";
 
//   echo "<td><a href='edit.php?Food_Name={$row['foodName']}'>Edit</a>&nbsp;&nbsp;&nbsp;";
//   echo "<a href='delete.php?Food_Name={$row['foodName']}'>Delete</a>&nbsp;&nbsp;</td>";
  echo "</tr>";
}
  if(isset($_POST['btn'])) {
    $Material_Name = $_POST['MaterialName'];
    $Material_Quantity = $_POST['MaterialQuantity'];
    $Material_Price = $_POST['MaterialPrice'];
    $User_Id= $_COOKIE['user'];
      $Adddata = "INSERT INTO Material (MaterialName, MaterialPrice, Userid ,MaterialQuantity) VALUES ('$Material_Name', '$Material_Price','$User_Id' ,'$Material_Quantity')";
      $s = "select * from material where MaterialName = '$Material_Name'and MaterialPrice='$Material_Price' and  MaterialQuantity='$Material_Quantity'";
      $res2 = mysqli_query($con,$s);
   //bug this is 
    //   if(mysqli_num_rows($res2) > 0)
    //   {
    //     // User exists, login successful
    //     echo "<script>alert('Food Item Already Exist!!');</script>";
        
    //   }
    //   else{
        if(mysqli_query($con, $Adddata)) { 
          echo "<center>";
          echo "<script>alert('Entered Data successfully..');</script>";
     
      } else {
          echo "Error: " . mysqli_error($con);
      }
    }
  
  
  

 mysqli_close($con);

  ?>
  
  </section>
   
  </body>
</html>

