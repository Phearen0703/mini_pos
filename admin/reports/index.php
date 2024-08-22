<?php
    $title = "Report Page";
    $page = "report";

?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4 col-6 p-2">
            <a href="<?php echo $burl . "/admin/reports/sale.php" ?>" class="text-white text-decoration-none text-center">
                <div class="bg-primary p-3 rounded">
                    <h3>Sale Report</h3>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-6 p-2">
            <a href="<?php echo $burl . "/admin/reports/saledetal.php" ?>" class="text-white text-decoration-none text-center">
                <div class="bg-primary p-3 rounded">
                    <h3>Sale Detail Report</h3>
                </div>
            </a>
        </div>
    </div>

</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>