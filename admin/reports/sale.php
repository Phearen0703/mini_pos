<?php
    $title = "Sale Page";
    $page = "report";

    include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");
    include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");


    $from = date('Y-m-d 00:00:00');
    $to = date('Y-m-d 23:59:59');
    
    $product_order = $conn->query("SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders
                                Inner Join customers ON customers.id = product_orders.customer_id
                                Inner Join users ON users.id = product_orders.created_by
                                WHERE product_orders.created_at >= '$from' and product_orders.created_at <= '$to'
                               ");

?>



<div class="container py-5">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    Sale Report
                </h2>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice Code</th>
                            <th>Customer</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($order = $product_order->fetch_object()){?>
                            <tr>
                            <th>#</th>
                            <th>Invoice Code</th>
                            <th>Customer</th>
                            <th>Price</th>
                        </tr>

                      <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>