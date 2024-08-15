<?php
    $title = "print";
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");


    $product_order_id = $_GET['product_order_id'];
   $product_order = $conn->query("SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders
                                Inner Join customers ON customers.id = product_orders.customer_id
                                Inner Join users ON users.id = product_orders.created_by
                                Where product_orders.id = '$product_order_id' LIMIT 1")->fetch_object();
                                print_r($product_order);
?>

<div class="col-12">
    <div class="row">
        <div class="col-6">
            <table class="table">
                <thead>
                    <tr>
                        <td>Hello</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>