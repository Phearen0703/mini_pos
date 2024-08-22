<?php
    $title = "Invoice Page";
    $page = "invoice";
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>

<?php

    $per_page = 100;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_page = ($page - 1) * $per_page;

    $CountProductOrder = 0;
    $totalPage = 0;
    $search = "";
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'ASC';
    $keyOrder = isset($_GET['keyOrder']) ? $_GET['keyOrder'] :'product_orders.inv_code';
   


    $productOrder = '';	
    if(isset($_GET["search"]) && $_GET['search'] != ''){
        $search = $_GET['search'];

      
    
        $CountProductOrder = $conn ->query("SELECT COUNT(*) AS total FROM product_orders
        INNER JOIN customers ON customers.id = product_orders.customer_id
        INNER JOIN users ON users.id = product_orders.created_by
        WHERE product_orders.inv_code LIKE '%$search%' OR
        customers.name LIKE '%$search%' OR
        users.name LIKE '%$search%' OR
        product_orders.grand_total LIKE '%$search%'
         ORDER BY $keyOrder $orderBy")->fetch_object();
    
        $totalPage = round($CountProductOrder->total / $per_page);

       
        $productOrders = $conn -> query("SELECT product_orders.*, customers.name as customer_name, users.name as user_name FROM product_orders
        INNER JOIN customers ON customers.id = product_orders.customer_id
        INNER JOIN users ON users.id = product_orders.created_by
        WHERE product_orders.inv_code LIKE '%$search%' OR
        customers.name LIKE '%$search%' OR
        users.name LIKE '%$search%' OR
        product_orders.grand_total LIKE '%$search%'
         ORDER BY $keyOrder $orderBy");

    }else{

        $CountProductOrder = $conn ->query("SELECT COUNT(*) AS total from product_orders")->fetch_object();
    
        $totalPage = round($CountProductOrder->total / $per_page);
       
        $productOrders = $conn -> query("SELECT product_orders.*, customers.name as customer_name, users.name as user_name from product_orders
        INNER JOIN customers ON customers.id = product_orders.customer_id
        INNER JOIN users ON users.id = product_orders.created_by
         ORDER BY $keyOrder $orderBy
        ");

    }



    $orderBy = isset($_GET['orderBy']) ? ($_GET['orderBy'] == 'ASC' ? 'DESC' : 'ASC') : 'ASC';
 

   


?>

<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2>Invoice</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="<?php echo $burl . "/admin/product_order/index.php?"?>" class="btn btn-success"><i
                            class="fa-solid fa-plus"></i> Create</a>
                </div>
                <?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/sms.php");?>
            </div>


            <form action="<?php echo $burl . '/admin/invoices/index.php' ?>" method="get">
                <div class="mb-2 col-4 float-end">
                    <div class="input-group">
                        <input type="hidden" name="page" value="<?php echo $page ?>">
                        <input type="search" name="search" class="form-control" value="<?php echo $search; ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <table class="table table-hover table-sm table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Invoice Code<a href="<?php echo $burl . '/admin/invoices/index.php?search=' .$search . '&orderBy=' . $orderBy . '&keyOrder=' . 'product_orders.inv_code'; ?>" class="sort float-end mx-3"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Customer<a href="<?php echo $burl . '/admin/invoices/index.php?search=' .$search . '&orderBy=' . $orderBy . '&keyOrder=' . 'customers.name'; ?>" class="sort float-end mx-3"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Total<a href="<?php echo $burl . '/admin/invoices/index.php?search=' .$search . '&orderBy=' . $orderBy . '&keyOrder=' . 'product_orders.grand_total'; ?>" class="sort float-end mx-3"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Sal By<a href="<?php echo $burl . '/admin/invoices/index.php?search=' .$search . '&orderBy=' . $orderBy . '&keyOrder=' . 'users.name'; ?>" class="sort float-end mx-3"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php $i =0; ?>
                    <?php while($productOrder = $productOrders->fetch_object()) {?>
                    <tr>
                        <td><?php echo ++$i ?></td>

                        <td><?php echo $productOrder->inv_code ?></td>
                        <td><?php echo $productOrder->customer_name ?></td>
                        <td><?php echo $productOrder->grand_total ?></td>
                        <td><?php echo $productOrder->user_name ?></td>              
           
                        <td>
                            <a target="_blank" href="<?php echo $burl . "/admin/product_order/print.php?product_order_id=" . $productOrder->id ?>"
                                class="btn btn-dark"><i class="fa-solid fa-print"></i> Print</a>
                           

                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?php echo $page - 1 == 0  ? 'disabled' : '' ?>"><a class="page-link"
                                    href="<?php echo $burl . "/admin/product_orders/index.php?page=" . $page - 1 ?>">Previous</a>
                            </li>
                            <?php for($i=1; $i<=$totalPage; $i++){ ?>
                            <li class="page-item <?php echo $page == $i ? 'active' : '' ?>">
                                <a class="page-link"
                                    href="<?php echo $burl . "/admin/product_orders/index.php?page=" . $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php }?>
                            <li class="page-item <?php echo $page +1 > $totalPage ? 'disabled' : '' ?>"><a
                                    class="page-link"
                                    href="<?php echo $burl . "/admin/product_orders/index.php?page=" . $page + 1 ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>
<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>