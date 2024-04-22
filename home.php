<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Bar / home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  
  <style>
 .menu-heading{
        font-family: Lucida Handwriting;;
        display: flex;
        font-weight: 800;
        font-size: 25px;
        color:#14e529;
        justify-content: center;
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
  padding: 10px;
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
          <a href="addmenu.php">Add New Menu</a>
          <a href="createbill.php">Create bill</a>
          <a href="material.php">Check Raw Material</a>
        </div>
      </header>
     
      </form>
      
      <?php


$con = mysqli_connect("localhost","root","","coffee_bar");
      $qry="select *from foodMenu ";
      
  $show=mysqli_query($con,$qry);
  echo "<center>";
  echo "<div class='menu-heading'><h1>Available Menu Item</h1></div>";
  echo "<table class='menu-table'>";
  echo "<tr><th>Food Name</th><th>Category</th><th>Price (₹)</th></tr>";
  
 
  while($row = mysqli_fetch_array($show)) {
    echo "<tr>";
    echo "<td><span class='food-name'>".$row['foodName']."</span></td>";
    echo "<td><span class='food-price'>".$row['CategoryID']."</span></td>";
    echo "<td><span class='food-price'>".$row['foodPrice']."</span></td>";
    echo "</tr>";
}

 mysqli_close($con);
 ?>
    </section>

  </body>
</html>