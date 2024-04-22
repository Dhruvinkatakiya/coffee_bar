<?php
$Foodname=$_GET['Food_Name'];

    $con = mysqli_connect("localhost","root","","coffee_bar");
    $q="delete from foodmenu where foodName='$Foodname'";
    if(mysqli_query($con,$q))
    {
        echo "<script>alert('want to Delete Menu Item!');</script>";
        header("location:addMenu.php");
    }    
?>