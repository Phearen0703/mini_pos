<?php
    $title = "Customer Page";
    $page = "customer";

?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php
    $per_page = 100;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_page = isset( $_GET['page'] ) ? ($per_page * $_GET['page']) - 1 : 0;
    $CountCustomer = $conn ->query("SELECT COUNT(*) AS total from customers")->fetch_object();

    $totalPage = round($CountCustomer->total / $per_page);
 

    $customers = $conn -> query("SELECT * FROM customers Limit $per_page OFFSET $start_page");

    var_dump($totalPage);

?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2>customer</h2>
        </div>
           <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                <a href="<?php echo $burl . "/admin/customers/create.php?"?>" class="btn btn-success"><i class="fa-solid fa-plus"></i> Create</a>
                </div>
                <?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/sms.php");?>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <?php for($i=1; $i<=$totalPage; $i++){ ?>
                        <li class="page-item <?php echo $page == $i ? 'active' : '' ?>">
                            <a class="page-link" href="<?php echo $burl . "/admin/customers/index.php?page=" . $i; ?>"><?php echo $i; ?></a></li>
                    <?php }?>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
                </nav>
             </div>                
            </div>

           <table class="table table-hover table-sm table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php $i =0; ?>
                <?php while($customer = $customers->fetch_object()) {?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php 
                            if($customer->photo){?>
                                <img src="<?php echo $base_url . $customer->photo ?>" width="50px" height="50px" alt="img">
                                
                       <?php } ?></td>

                        <td><?php echo $customer->name ?></td>
                        <td>
                        <a href="<?php echo $burl . "/admin/customers/edit.php?customer_id=" . $customer->id ?>" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</a>
                        <a href="<?php echo $burl . "/admin/customers/actions/delete.php?customer_id=" . $customer->id ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>
                        
                        </td>

                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

           </div>
    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>