<?php
    $title = "print";
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");
include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");


    $product_order_id = $_GET['product_order_id'];
   $product_order = $conn->query("SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders
                                Inner Join customers ON customers.id = product_orders.customer_id
                                Inner Join users ON users.id = product_orders.created_by
                                Where product_orders.id = '$product_order_id' LIMIT 1")->fetch_object();
    $product_order_details = $conn->query("SELECT product_order_details.*, products.name as product_name FROM product_order_details
                                INNER JOIN products ON products.id = product_order_details.product_id 
                                WHERE product_order_details.product_order_id = '$product_order_id'                                
                                ");

                               
                    
?>


    <div class="p-0-print">
    <div class="row">
        <div class="col-12 d-none-print">
            <a class="btn btn-danger" href="<?php echo $burl . "/admin/product_order/index.php" ?>"><i class="fa-solid fa-reply"></i> Back</a>
            <button class="btn btn-primary" onclick="window.print()" type="button"><i class="fa-solid fa-print"></i> Print</button>
        </div>
        <div class="col-lg-4 col-12 py-2 pb-5 zoom">
            <div class="w-100 text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/POS_Logo.svg/2560px-POS_Logo.svg.png" class="logo rounded-circle border-1">
            </div>
        </div>
        <div class="col-lg-8 col-12 d-flex justify-contents-center align-items-center zoom">
            <div class="w-100">
                <h1 class="text-center mb-4">MINI POS</h1>
                <table class="table table-sm table-borderless text-center">
                    <tbody>
                        <tr>
                            <td>
                                <h5>Phone: 096</h5>
                            </td>
                            <td>
                                Build To : <?php echo $product_order -> customer_name ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Address: Phnom Penh</h5>
                            </td>
                            <td>
                            Invoid No : <?php echo $product_order -> inv_code ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 zoom">
            <table class="table table-sm table-border">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                  <?php while($product_order_detail = $product_order_details->fetch_object()){ ?>
                  <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php echo $product_order_detail -> product_name; ?></td>
                        <td><?php echo $product_order_detail -> price; ?></td>
                        <td><?php echo $product_order_detail -> qty; ?></td>
                        <td><?php echo $product_order_detail -> total; ?></td>
                    </tr>

                    <?php } ?>
                    <tr>
                        <td colspan="4" class="text-end">Grand Total</td>
                        <td><?php echo $product_order -> grand_total; ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    </div>

<script>
    onclick=(window.print())
</script>


<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>