<?php
  $con = mysqli_connect("localhost","root","","coffee_bar");
  if(isset($_GET['name'])){
    $name = $_GET['name'];
    $q = "SELECT * FROM customerinfo WHERE Customer_name = '$name'";
        $res = mysqli_query($con, $q);
        $add = 0;
        // display the data in a table
        echo "<br><table>";
        echo "<tr><th>Item Purchase</th><th>Price</th></tr>";
    
        while ($row1 = mysqli_fetch_assoc($res)) {
        $customer_name = $row1['Customer_name'];
        $item_purchase = $row1['Item_purchase'];
        $total_bill = $row1['Total_bill'];
        $add += $total_bill;
        // split the item_purchase list into an array
        $items = explode(",", $item_purchase);
    
        // display each item and its price
        echo "<div>$customer_name</div>";
        foreach ($items as $item) {
          $query = "SELECT * FROM foodmenu WHERE Food_name = '$item'";
            $result2 = mysqli_query($con, $query);
            $row2 = mysqli_fetch_assoc($result2);
            $price = $row2['Food_Price'];
            echo "<tr><td>$item</td><td>$price</td></tr>";
            echo "<br><p>Total Price : ".$add."</p>";
        }
    }
    
    echo "</table><br>";
  }

?>