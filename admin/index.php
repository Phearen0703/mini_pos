<?php
    $title = "Home Page";
    $page = "home";
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>

<?php
    $total_sale = $conn->query("SELECT COUNT(*) as total FROM product_orders")->fetch_object()->total;
    $total_customer = $conn->query("SELECT COUNT(*) as total FROM customers")->fetch_object()->total;
    $total_income = $conn->query("SELECT SUM(grand_total) as total FROM product_orders")->fetch_object()->total;

    $from = date('Y:m-d 00:00:00');
    $to = date('Y:m-d 23:59:59');
    $total_today = $conn->query("SELECT SUM(grand_total) as total FROM product_orders WHERE created_at >= '$from' AND created_at <= '$to'")->fetch_object()->total;


?>

<div class="row p-3">
    <div class="col-lg-4 col-md-6 col-12 p-3">
        <div class="p-5 bg-primary rounded">
            <h1 class="mb-0 text-white text-center">Total Sale : <?php echo $total_sale ?></h1>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 p-3">
        <div class="p-5 bg-success rounded">
            <h1 class="mb-0 text-white text-center">Total Castomer : <?php echo $total_customer ?></h1>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 p-3">
        <div class="p-5 bg-danger rounded">
            <h1 class="mb-0 text-white text-center">Total Income : <?php echo $total_income ?></h1>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 p-3">
        <div class="p-5 bg-warning rounded">
            <h1 class="mb-0 text-white text-center">Total Incom Today : <?php echo $total_today ?></h1>
        </div>
    </div>
</div>


<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>