<?php
include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

if(isset($_POST['myOrder']) && isset($_POST['myOrderIndex'])){

    $myOrderIndex = $_POST['myOrderIndex'];
    $myOrder = (array) json_decode($_POST['myOrder']);
    
    $customer_id = $myOrder['customer_id'];
    $orders = $myOrder['orders'];

    // Calculate grand total
    $grand_total = 0;
    foreach ($orders as $order){
        $order = (array) $order;
        $product_id = $order['product_id'];
        $product = $conn->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();
        $grand_total += ($product->price * $order['qty']);
    }

    $inv_code = time();
    $created_at = date('Y-m-d H:i:s');
    $created_by = $_SESSION['auth'];

    // Insert into product_orders table
    $product_order = $conn->query("INSERT INTO product_orders (customer_id, inv_code, grand_total, active, created_at, created_by)
        VALUES ('$customer_id', '$inv_code', '$grand_total', '1','$created_at','$created_by')");

    if ($product_order) {
        // Retrieve the last inserted product order
        $product_order = $conn->query("SELECT * FROM product_orders ORDER BY id DESC LIMIT 1")->fetch_object();
        $product_order_id = $product_order->id;

        // Insert into product_order_details table
        foreach ($orders as $order){
            $order = (array) $order;
            $product_id = $order['product_id'];
            $qty = $order['qty'];

            $product = $conn->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();
            $price = $product->price;
            $total = ($product->price * $order['qty']);

            $conn->query("INSERT INTO product_order_details (product_order_id, product_id, price, qty, total)
                VALUES ('$product_order_id','$product_id','$price','$qty','$total')");
        }

        $customer = $conn->query("SELECT * FROM customers WHERE id = '$customer_id'")->fetch_object();
        $_SESSION['message'] = [
            'status' => 'success',
            'sms' => 'Order Successfully: '.$customer->name
        ];
        unset($_SESSION['orders'][$myOrderIndex]);
       header("Location:". $burl. "/admin/product_order/print.php?product_order_id=" .$product_order_id);
       exit();
    } else {
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Something went wrong !!'
        ];
       
    }
}
header("Location:". $burl. "/admin/product_order/index.php");
?>
