<?php
    $title = "Invoice Page";
    $page = "invoice";
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php 

    $products = $conn ->query("SELECT * FROM products");
    $customers = $conn -> query("SELECT * FROM customers");
  



?>



<div class="container py-5">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-0"><i class="fa-solid fa-file-invoice"></i> Invoice</div>
                </div>
                <div class="card-body">
                <table class="table table-hover table-sm table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name<a href="<?php echo $burl . '/admin/product_categorys/index.php?search=' .$search . '&orderBy=' . $orderBy; ?>" class="sort float-end mx-3"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                   
                    <tr>
                        <td></td>
                        <td>
                        </td>
                        <td></td>
                        <td>
                            <a href=""
                                class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</a>
                            <a href=""
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>

                        </td>


                    </tr>

                </tbody>
            </table>
                </div>
            </div>
        </div>



    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>