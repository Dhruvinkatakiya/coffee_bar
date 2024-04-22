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
        width: 90px;;
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
    <section>
      <header>
        <h2><a href="#" class="logo">Coffee Bar</a></h2>
        <div class="navigation">
          <a href="home.php">Home</a>
         
          <a href="./createbill.php">Create bill</a>
          <a href="#"></a>
        </div>
      </header>
      <center>
      <div class="Menu-text">Update Menu Item</div>
        <!-- </div> -->
  
<?php
$con = mysqli_connect("localhost","root","","coffee_bar") or die('cannot connect'.mysqli_error($con));
if(isset($_GET['Food_Name'])){
    $FoodName = $_GET['Food_Name'];
    // echo $FoodName."<br>";
    $a = "select * from foodMenu where foodName='$FoodName'";
    $res = mysqli_query($con,$a);
    $row = mysqli_fetch_assoc($res);
?>
        <form action="" method="post">
        <div class="Enterd">
            <table  style="margin: 4px;padding: 20px;  border-collapse: separate;
            border-spacing: 40px 15px;">
            <tr>
              <th>Update Item Name</th>
              <th>Update Item Price (₹)</th>
            </tr>
            <tr>
              <td><input type="text" name="FoodName" value="<?php echo $row['foodName']; ?>"></td>
              <td><input type="text" name="Price" value="<?php echo $row['foodPrice']; ?>"></td>
            </tr>
               </table>
        </div>
              <input type="submit" value="UPDATE" name="update">
    </form>
        <?php
        if(isset($_POST['update'])){
            echo "Update<br>";
            $Food_Name = $_POST['FoodName'];
            $Food_Price = $_POST['Price'];
            $q ="update foodMenu set foodName='$Food_Name',foodPrice='$Food_Price' where foodName='$FoodName'";
            if(mysqli_query($con,$q)) 
            {
                echo "<script>alert('Updated!');</script>";
                header("location:addMenu.php");
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        }
        }
        mysqli_close($con);
        ?>
        </center>
    </body>
</html>
