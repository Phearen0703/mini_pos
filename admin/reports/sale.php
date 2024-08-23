<?php
    $title = "Sale Page";
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
    
    $product_order = $conn->query($query);

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
                <form action="<?php echo $burl . "/admin/reports/sale.php" ?>" method="get">
                    <div class="row bg-warning text-center p-3 mx-auto rounded">
                        <div class="col m-auto">From</div>
                        <div class="col-3 m-auto">
                            <input type="date" name="from" value="<?php echo $from ?>" class="form-control">
                        </div>
                        <div class="col m-auto">To</div>
                        <div class="col-3">
                            <input type="date" name="to" value="<?php echo $to ?>"  class="form-control">
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
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice Code</th>
                            <th>Customer</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <t>
                        <?php $i = 0; $total = 0; ?>
                        <?php while($order = $product_order->fetch_object()){?>
                        <?php $total += $order->grand_total?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $order->inv_code ?></td>
                            <td><?php echo $order->customer_name ?></td>
                            <td><?php echo $order->grand_total ?></td>
                        </tr>

                        <?php } ?>
                        <tr>
                            <td colspan="3" class="text-end">Total</td>
                            <td><?php echo $total; ?></td>
                        </tr>
                        </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>