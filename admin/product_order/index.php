<?php
    $title = "Ordeer Page";
    $page = "order";
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php 

    $products = $conn ->query("SELECT * FROM products");
    $customers = $conn -> query("SELECT * FROM customers");



    

        function findCustomerIndex($orders, $customer_id) {
            foreach ($orders as $index => $order) {
                if (isset($order['customer_id']) && $order['customer_id'] == $customer_id) {
                    return $index;
                }
            }
            return -1;
        }
        
        function findProductIndex($customer_orders, $product_id) {
            foreach ($customer_orders as $index => $order) {
                if ($order['product_id'] == $product_id) {
                    return $index;
                }
            }
            return -1;
        }
        
        if (!isset($_SESSION['orders']) || !is_array($_SESSION['orders'])) {
            $_SESSION['orders'] = [];
        }
        
        if (isset($_POST['customer_id']) && isset($_POST['product_id']) && isset($_POST['qty'])) {
            $customer_id = $_POST['customer_id'];
            $product_id = $_POST['product_id'];
            $qty = $_POST['qty'];
        
            $customerIndex = findCustomerIndex($_SESSION['orders'], $customer_id);
        
            if ($customerIndex >= 0) {
                $productIndex = findProductIndex($_SESSION['orders'][$customerIndex]['orders'], $product_id);
        
                if ($productIndex >= 0) {
                    // If product exists, update the quantity
                    $_SESSION['orders'][$customerIndex]['orders'][$productIndex]['qty'] += $qty;
                } else {
                    // If product does not exist, add it as a new item
                    array_push($_SESSION['orders'][$customerIndex]['orders'], [
                        'customer_id' => $customer_id,
                        'product_id' => $product_id,
                        'qty' => $qty
                    ]);
                }
            } else {
                // If customer does not exist, create a new customer order
                array_push($_SESSION['orders'], [
                    'customer_id' => $customer_id,
                    'orders' => [
                        ['customer_id' => $customer_id, 'product_id' => $product_id, 'qty' => $qty]
                    ]
                ]);
            }
        }
    
    // Add more items (increment quantity) for an existing product
    if (isset($_POST['add_customer_id']) && isset($_POST['add_product_id'])) {
        $add_customer_id = $_POST['add_customer_id'];
        $add_product_id = $_POST['add_product_id'];
    
        $customerIndex = findCustomerIndex($_SESSION['orders'], $add_customer_id);
    
        if ($customerIndex >= 0) {
            $productIndex = findProductIndex($_SESSION['orders'][$customerIndex]['orders'], $add_product_id);
    
            if ($productIndex >= 0) {
                // If product exists, increment the quantity
                $_SESSION['orders'][$customerIndex]['orders'][$productIndex]['qty']++;
            }
        }
    }
    

   

?>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-12">
            <form action="<?php echo $burl . "/admin/product_order/index.php" ?>" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><i class="fa-solid fa-cart-plus"></i> Order</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-4 col-12">
                                <label for="customer">Customers</label>
                                <select name="customer_id" id="customer" required class="form-select">
                                    <option value="">Pleas Select</option>
                                    <?php
                                    while($customer = $customers -> fetch_object()){ ?>
                                    <option value="<?php echo $customer ->id ?>"><?php echo $customer ->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="product">Product / Item</label>
                                <select name="product_id" id="product" required class="form-select">
                                    <option value="">Pleas Select</option>
                                    <?php
                                    while($product = $products -> fetch_object()){ ?>
                                    <option value="<?php echo $product ->id ?>"><?php echo $product ->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" class="form-control" placeholder="Input Qty of Item"
                                    required>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-plus"></i> Add To
                            Card</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- list order -->
        <?php
            foreach($_SESSION['orders'] as $index => $order){ ?>
            <?php
                $cus_id = $order['customer_id'];
                $cus = $conn -> query("SELECT * FROM customers WHERE id = '$cus_id'")->fetch_object();
                
            
            ?>

<div class="col-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h2 class="mb-0 text-white">List Orders of <span class="text-warning"><?php echo $cus->name ?></span></h2>
                </div>
                <div class="card-body">
                    <table class="table table-hove text-center">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Accent</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                           <?php
                           $i = 1;
                           foreach ($order['orders'] as $key => $orderitem){?>
                                <?php
                                    $product_id = $orderitem['product_id'];
                                    $product = $conn->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();
                               
                                ?>
                                <tr>
                                <td><?php echo $i ++ ?></td>
                                <td><?php echo $product -> name ?></td>
                                <td><?php echo $product -> price ?></td>

                                <td class="d-flex justify-content-center">

                                    <form action="<?php echo $burl . "/admin/product_order/" ?>" method="post">
                                        <button class="btn btn-danger btn-sm mx-4">-</button>
                                        <input type="hidden" name="decrease_customer_id" value="<?php echo $cus_id;?>">
                                        <input type="hidden" name="decrease_product_id" value="<?php echo $product_id;?>">

                                    </form>

                                     <?php echo $orderitem['qty']; ?>
                                
                                    <form action="<?php echo $burl . "/admin/product_order/" ?>" method="post">
                                        <input type="hidden" name="add_customer_id" value="<?php echo $cus_id;?>">
                                        <input type="hidden" name="add_product_id" value="<?php echo $product_id;?>">
                                        <button class="btn btn-primary btn-sm mx-4">+</button>
                                    </form>
                                </td>


                                <td><?php echo ($product->price * $orderitem['qty']) ?></td>
                                <td></td>
                            </tr>

                          <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-warning"><i class="fa-solid fa-floppy-disk"></i> Checkout</button>
                </div>
            </div>
        </div>

           <?php }  ?>

    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>