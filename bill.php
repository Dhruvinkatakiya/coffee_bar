<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="bill-design\bill.css">

    <title>Invoice..!</title>
</head>

<body>
    <div class="my-5 page" size="A4">
        <?php
             $con = mysqli_connect("localhost","root","","coffee_bar");
             if(isset($_GET['custname'])){
                $customer_name = $_GET['custname'];
                echo "<script>alert('$customer_name');</script>";
             }
             if(isset($_POST['btn'])) {
               $customer_name = $_POST['cname'];
               $selected_items = $_POST['checkbox'];
               $item_purchase = implode(",",$selected_items);
            // $customer_name = "dk";  
            // $customer_name = $_GET['custname'];
               $total_price = 0;
        
              $q = "SELECT * FROM customerinfo WHERE Customer_name = '$customer_name'";
              $res = mysqli_query($con, $q);
              $add = 0;
            //   display the data in a table
              echo "<br><table>";
              echo "<tr><th>Item Purchase</th><th>Price</th></tr>";
             }
          ?>
         
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <h2>Coffee Bar</h2>
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Bill</p>
                    </div>
                    <p>Order Number : 10</p>
                </div>
            </section>

            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        
                        <div class="col-5">
                            
                            <h2>
                                <?php
                                while ($row1 = mysqli_fetch_assoc($res)) {
                                $customer_name = $row1['Customer_name'];
                                $item_purchase = $row1['Item_purchase'];
                                $price = $row1['Total_bill'];
                                $total_bill = $row1['Total_bill'];
                                $add += $total_bill;
                                // split the item_purchase list into an array   
                                $items = explode(",", $item_purchase);
                            
                                // display each item and its price
                                echo "<div>$customer_name</div>";
                            
                                ?>
                            </h2>
                            
                            <div class="txn mt-2">TXN: XXXXXXX</div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">
                            <p>Payment Method: <span>Cash</span></p>
                                  
                        </div>
                        
                    </div>
                </div>
            </section>

            <section class="product-area mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Item Description</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="media">
                                    <!-- <img class="mr-3 img-fluid" src="mobile.jpg" alt="Product 01"> -->
                                    <div class="media-body">
                                        <p class="mt-0 title">
                                            <?php
                                            echo $item_purchase;
                                    
                             echo "<td>$price</td>";
                             if (is_array($item_purchase)) {
                                $c = count($item_purchase);
                            
                             echo "<td>$c</td>";
                             }
                             echo "<td>1</td>";
                             echo "<td>$total_bill</td>";
                              
                             ?>         
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="balance-info">
                <div class="row">
                    <div class="col-8">
                        <p class="m-0 font-weight-bold"> Note: </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In delectus, adipisci vero est dolore praesentium.</p>
                    </div>
                    <div class="col-4">
                        <table class="table border-0 table-hover">
                            <tr>
                                <td>Tax:</td>
                                <td>18₹</td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <td>Total:</td>
                                    <td>
                                        <?php
                                        $tax = 18;
                                        echo $total_bill+$tax;
                                }
                                ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Signature -->
                        <div class="col-12">
                            <img src="./image/signature.png" class="img-fluid" alt="">
                            <p class="text-center m-0"> Director Signature </p>
                        </div>
                    </div>
                </div>
            </section>

            
            
            <!-- <footer>
                 <hr>
                   <p>❤️ Thank You For Visit Us ❤️</p>
           </footer> -->
           <div class="centered">
           <img src="./image/coffee.png" class="img-fluid cart-bg" alt="">
            <p>❤️ Thank You For Visit Us ❤️</p> 
            </div>
        </div>
    </div>
</body>
</html>  