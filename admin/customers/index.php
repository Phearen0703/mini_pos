<?php
    $title = "Customer Page";
    $page = "customer";

?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php
    $customers = $conn -> query("SELECT * FROM customers");
   

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
            </div>
           <table class="table table-hover table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($customer = $customers->fetch_object()) {?>
                    <tr>
                        <td><?php 1 ?></td>
                        <td><?php 
                            if($customer->photo){?>
                                <img src="" alt="img">
                       <?php } ?></td>

                        <td><?php echo $customer->name ?></td>
                        <td>
                        <a href="<?php echo $burl . "/admin/customers/eidt.php?" . $customer->id ?>" class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</a>
                        <a href="<?php echo $burl . "/admin/customers/delete.php?" . $customer->id ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>
                        
                        </td>

                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>