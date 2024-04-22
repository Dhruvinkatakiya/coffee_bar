<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coffee Bar / Add Menu</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <style>
    .Menu-text {
      font-family: Lucida Handwriting;
      display: flex;
      font-weight: 800;
      font-size: 30px;
      color: #14e529;
      justify-content: center;
    }
    .Enterd {
      color: aliceblue;
    }
    input[type=submit] {
      background-color: #ffffff;
      margin-top: 20;
      border-radius: 7px;
      border: none;
      font-size: 15px;
      font-weight: 800;
      color: rgb(0, 0, 0);
      padding: 4px 8px;
      cursor: pointer;
    }
    input[type=text]:hover {
      color: #ffffff;
      background-color: #14e529;
    }
    input[type=submit]:hover {
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
  </style>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <section>
      <header>
        <h2><a href="#" class="logo">Coffee Bar</a></h2>
        <div class="navigation">
          <a href="home.php">Home</a>
          <a href="addmenu.php">Add Menu Item</a>
          <a href="material.php">Check Raw Material</a>
        </div>
      </header>
      <center>
        <div class="Menu-text">Create Bill</div>
        <div class="Enterd">
          <table style="margin: 4px; padding: 20px; border-collapse: separate; border-spacing: 40px 15px;">
            <tr>
              <th>Customer Name :</th>
              <td><input type="text" name="cname" required></td><br>
            </tr>
          </table>
          <table>
            <?php
            $con = mysqli_connect("localhost","root","","coffee_bar");
            $q = "select foodName from foodmenu";
            $a = mysqli_query($con,$q);
            if(mysqli_num_rows($a) > 0) {
              while($res = mysqli_fetch_assoc($a)) {
                echo "<tr><td ><input type='checkbox' id='checkbox' name='checkbox[]' value='" . $res['foodName'] . "'>" . $res['foodName'] . "</td></tr>";
              }
            }
            ?>
          </table>
        </div>
        <input type="submit" name="btn" value="submit">
      </center>
    </form>
    <?php
    $con = mysqli_connect("localhost","root","","coffee_bar");
    if(isset($_POST['btn'])) {
      $customer_name=$_POST['cname'];
      $selected_items = $_POST['checkbox'];
      $item_purchase = implode(",", $selected_items);
      $total_price = 0;
      foreach($selected_items as $selected_item) {
        $qu = "SELECT * FROM foodmenu WHERE FoodName = '$selected_item'";
        $result = mysqli_query($con, $qu);
        $row = mysqli_fetch_assoc($result);
        $total_price += $row['foodPrice'];
      }
      $insert_query = "INSERT INTO Bill(Customer_name, Item_purchase, Total_bill) VALUES ('$customer_name', '$item_purchase', $total_price)";
      if(mysqli_query($con, $insert_query)) { 
        echo "<script>alert('Created Bill successfully...');</script>";
        $q = "SELECT * FROM Bill WHERE Customer_name = '$customer_name'";
        $res = mysqli_query($con, $q);
        $add = 0;
        date_default_timezone_set('Asia/Kolkata');
        $date = date("d-m-Y");
        $time = date("h:i:s A");
        echo "<br><center><div class='bill' style='background-color: #fff; padding: 20px; width: 399px; border-style: solid; border-color:#14e529; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,.2);'><table>";
        echo "<tr><th style='background-color: #f2f2f2; border: 1px solid #ddd; padding: 8px; text-align: left;'>Item Purchase</th><th style='background-color: #f2f2f2; border: 1px solid #ddd; padding: 8px; text-align: left;'>Price </th></tr>";
        echo "<span><p class='bill-heading' style='margin-bottom: 10px; font-weight: bold; text-align:left; font-size: 20px;'>Name : $customer_name </p>";
        echo "<span><p class='bill-Time' style='text-align:left;font-size: 15px;'>Date : $date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time : $time</p></span>";
        while ($row1 = mysqli_fetch_assoc($res)) {
          $customer_name = $row1['Customer_name'];
          $item_purchase = $row1['Item_purchase'];
          $order_no= $row1['Order_id'];
          $total_bill = $row1['Total_bill'];
          $add += $total_bill;
          $items = !empty($item_purchase) ? explode(",", $item_purchase) : array();
          if (!empty($items)) {
            foreach ($items as $item) {
              $query = "SELECT * FROM foodmenu WHERE FoodName = '$selected_item'";
              $result2 = mysqli_query($con, $query);
              $row2 = mysqli_fetch_assoc($result2);
              $price = $row2['foodPrice'];
              echo "<tr><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>$item</td><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>$price ₹</td></tr>";
            }
          } else {
            echo "<tr><td colspan='2'>No items found</td></tr>";
          }
        }     
        echo "<br>";   
        echo "<div class='Order-no' style='margin-top: -15px; font-weight: bold; color: #4194FF; font-size: 20px;'>Order No: $order_no</div>";
        echo "<div class='total-price' style='font-weight: bold; font-size: 18px; margin-top: 3px;'>Total Price : ".$add."₹</div>";
        // echo "Owner: <img src='.\signature.png' alt='sign' class='signature' style='width: 150px; margin-top: 20px;'>";
        echo "</table></div></center><br>";
      }
    }
    ?>
  </section>
</body>
</html>
