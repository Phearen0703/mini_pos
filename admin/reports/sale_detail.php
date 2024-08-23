<?php
    $title = "Sale Detail Page";
    $page = "report";

    include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");
    include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");


    $from = isset($_GET['from']) ? date('Y-m-d',strtotime($_GET['from'])) : date('Y');
    $to = isset($_GET['to']) ? date('Y-m-d',strtotime($_GET['to'])) : date('Y-m-d');
    $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : '';


    $query = "SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders
                                LEFT JOIN customers ON customers.id = product_orders.customer_id
                                LEFT JOIN users ON users.id = product_orders.created_by
                                WHERE product_orders.created_at >= '$from' and product_orders.created_at <= '$to'";
    if($customer_id){
        $query .= "AND customers.id = '$customer_id'";
    }
    
    $product_orders = $conn->query($query);

    $customers = $conn->query("SELECT * FROM customers");


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
                <form action="<?php echo $burl . "/admin/reports/sale_detail.php" ?>" method="get">
                    <div class="row bg-warning text-center p-3 mx-auto rounded">
                        <div class="col m-auto">From</div>
                        <div class="col-3 m-auto">
                            <input type="date" name="from" value="<?php echo $from ?>" class="form-control">
                        </div>
                        <div class="col m-auto">To</div>
                        <div class="col-3">
                            <input type="date" name="to" value="<?php echo $to ?>" class="form-control">
                        </div>
                        <div class="col-3">
                            <select name="customer_id" class="form-control">
                                <option value="">Pleas Select</option>
                                <?php while($customer=$customers->fetch_object()) { ?>
                                <option <?php echo $customer->id == $customer_id ? 'selected' : '' ?> value="<?php echo $customer->id ?>"><?php echo $customer->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-2 ">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
                                Search</button>
                        </div>
                    </div>
                </form>
                <div class="p-1"></div>
                <table class="table table-sm table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Invoice Code</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle text-center">
                        <?php $i = 0; ?>
                        <?php while($product_order=$product_orders->fetch_object()){ ?>

                        <?php
                                    $product_order_id = $product_order->id;
                                    $details = $conn->query("SELECT product_order_details.*, products.name as product_name FROM product_order_details 
                                    LEFT JOIN products ON products.id = product_order_details.product_id
                                    WHERE product_order_id = '$product_order_id'");

                                    $firstDetail = $details->fetch_object();
                                    
                                    ?>
                        <tr>
                            <td rowspan="<?php echo $details->num_rows ?>"><?php echo ++$i  ?></td>
                            <td rowspan="<?php echo $details->num_rows ?>"><?php echo $product_order->inv_code ?></td>
                            <td rowspan="<?php echo $details->num_rows ?>"><?php echo $product_order->customer_name ?>
                            </td>
                            <td><?php echo $firstDetail->product_name ?></td>
                            <td><?php echo $firstDetail->price ?></td>
                            <td><?php echo $firstDetail->qty ?></td>
                        </tr>
                        <?php while($detail = $details->fetch_object()) { ?>
                        <td><?php echo $firstDetail->product_name ?></td>
                        <td><?php echo $firstDetail->price ?></td>
                        <td><?php echo $firstDetail->qty ?></td>
                        <?php }?>


                        <?php } ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>