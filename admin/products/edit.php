<?php
    $title = "Edit Product Page";
    $page = "products";

?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php
    $product_id = $_GET['product_id'];
    $product = $conn -> query("SELECT * FROM products WHERE id = '$product_id'");
    $product = $product-> fetch_object();  
    $category = $conn -> query("SELECT * FROM product_categories");
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Edit product</h2>
        </div>
        <div class="card-body">

            <div class="col-12 mb-3">
                <a href="<?php echo $burl . "/admin/products/index.php?"?>" class="btn btn-danger"><i class="fa-solid fa-rotate-left"></i> Back</a>
            </div>

            <?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/sms.php");?>

            <form action="<?php echo $burl . "/admin/products/actions/edit.php"; ?>" method="post"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $product->id ?>">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $product -> name ?>">
                </div>


                <div class="mb-3">
                    <label for="product_category">Category</label>
                    <select name="product_category" id="product_category" class="form-control" >
                        <option selected value="">Pleas Select</option>
                        <?php
                            while($row = $category -> fetch_object()){ ?>
                                <option value="<?php echo $row->id; ?>" <?php echo $product->product_category_id == $row->id ? 'selected' : '' ?>><?php echo $row -> name ?></option>
                            <?php }?> 
                    </select>
                </div>
               
            
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" class="form-control" value="<?php echo $product -> price ?>">
                </div>
               
                <div class="mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" accept="image/*" id="photo" name="photo" class="form-control">
                </div>

                <div class="mb-3">
                    <img src="<?php echo $base_url . $product -> photo ?>" width="150px" height="150px" alt="IMG">
            
                </div>

                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                </div>


            </form>
        </div>
    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>