<?php
include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

    if(isset($_POST['myOrder'])){
        $myOrder = (array) json_decode($_POST['myOrder']);

        $customer_id = $myOrder['customer_id'];
        $orders = $myOrder['orders'];

        //find grand total

        $grand_total = 0;
         foreach ($orders as $index => $order){
            //query product detail

            $order = (array) $order;
            $product_id = $order['product_id'];
            $product = $conn->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();
            $grand_total += ($product->price * $order['qty']);
         }
         $inv_code = time();
         $created_at = date('Y-m-d H:i:s');
         $created_by = $_SESSION['auth'];

         //insert into table product_order
         $prodcut_order = $conn->query("INSERT INTO product_orders (customer_id, inv_code, grand_total, active, created_at, created_by)
         VALUES ('$customer_id', '$inv_code', '$grand_total', '1','$created_at','$created_by')");


        $prodcut_order = $conn->query("SELECT * FROM product_orders ORDER BY id DESC LIMIT 1")->fetch_object();

        $prodcut_order_id = $prodcut_order -> id;

        //insert into tabel product_order_details
         foreach ($order as $index => $order){
            
            //query product detail
            $order = (array) $order;
            $product_id = $order['product_id'];
            $qty = $order['qty'];

            $product = $conn->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();

            $price = $product->price;
            $total = ($product->price * $order['qty']);




            $conn->query("INSERT INTO product_order_details (product_order_id, product_id, price, qty, total)
            VALUE ('$prodcut_order_id','$product_id','$price','$qty','$total')
            ");
         }

         $_SESSION['message'] = [
            'status' => 'success',
            'sms' => 'Order Successfully'
        ];

    }else{
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Something Wrong !!'
        ];
        header("Location:". $base_url. "/admin/product_order/index.php");
    }
?>