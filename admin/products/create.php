<?php
    $title = "Add Product Page";
    $page = "product";

?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php
    $category = $conn -> query("SELECT * FROM product_categories");
   

?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Create Products</h2>
        </div>
        <div class="card-body">

            <div class="col-12 mb-3">
                <a href="<?php echo $burl . "/admin/products/index.php?"?>" class="btn btn-danger"><i class="fa-solid fa-rotate-left"></i> Back</a>
            </div>

            <?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/sms.php");?>
            <form action="<?php echo $burl . "/admin/products/actions/create.php"; ?>" method="post"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="product_category">Category</label>
                    <select name="product_category" id="product_category" class="form-control" >
                        <option selected value="">Pleas Select</option>
                        <?php
                            while($row = $category -> fetch_object()){ ?>
                                <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                            <?php }?> 
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" class="form-control" required>
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