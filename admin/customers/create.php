<?php
    $title = "Add Customer Page";
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
            <h2 class="mb-0">Create Customer</h2>
        </div>
           <div class="card-body">
                <form action="<?php echo $burl . "/admin/customers/actions/create.php"; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" accept="image/*" id="photo" name="photo" class="form-control" required>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>

                </form>
           </div>
    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>