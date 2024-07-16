<?php
    $title = "Category Page";
    $page = "category";
?>


<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>

<?php

    $per_page = 100;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_page = ($page - 1) * $per_page;

    $Countproduct_category = 0;
    $totalPage = 0;
    $search = "";
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'ASC';
   


    $product_category = '';	
    if(isset($_GET["search"]) && $_GET['search'] != ''){
        $search = $_GET['search'];

      
    
        $Countproduct_category = $conn ->query("SELECT COUNT(*) AS total from product_categories WHERE name LIKE '%$search%' ORDER BY name $orderBy")->fetch_object();
    
        $totalPage = round($Countproduct_category->total / $per_page);

        $product_categorys = $conn -> query("SELECT * FROM product_categories WHERE name LIKE '%$search%' ORDER BY name $orderBy Limit $per_page OFFSET $start_page");

    }else{
       
        $Countproduct_category = $conn ->query("SELECT COUNT(*) AS total from product_categories")->fetch_object();
    
        $totalPage = round($Countproduct_category->total / $per_page);

        $product_categorys = $conn -> query("SELECT * FROM product_categories ORDER BY name $orderBy Limit $per_page OFFSET $start_page");
    }

    $orderBy = isset($_GET['orderBy']) ? ($_GET['orderBy'] == 'ASC' ? 'DESC' : 'ASC') : 'ASC';
 

   


?>

<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2>product_category</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="<?php echo $burl . "/admin/product_categorys/create.php?"?>" class="btn btn-success"><i
                            class="fa-solid fa-plus"></i> Create</a>
                </div>
                <?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/sms.php");?>
            </div>


            <form action="<?php echo $burl . '/admin/product_category/index.php' ?>" method="get">
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
                        <th>Photo</th>
                        <th>Name<a href="<?php echo $burl . '/admin/product_categorys/index.php?search=' .$search . '&orderBy=' . $orderBy; ?>" class="sort float-end mx-3"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php $i =0; ?>
                    <?php while($product_category = $product_categorys->fetch_object()) {?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php 
                            if($product_category->photo){?>
                            <img src="<?php echo $base_url . $product_category->photo ?>" width="50px" height="50px" alt="img">

                            <?php } ?>
                        </td>

                        <td><?php echo $product_category->name ?></td>
                        <td>
                            <a href="<?php echo $burl . "/admin/product_categorys/edit.php?category_id=" . $product_category->id ?>"
                                class="btn btn-success"><i class="fa-solid fa-pen"></i> Edit</a>
                            <a href="<?php echo $burl . "/admin/product_categorys/actions/delete.php?category_id=" . $product_category->id ?>"
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>

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
                                    href="<?php echo $burl . "/admin/product_categorys/index.php?page=" . $page - 1 ?>">Previous</a>
                            </li>
                            <?php for($i=1; $i<=$totalPage; $i++){ ?>
                            <li class="page-item <?php echo $page == $i ? 'active' : '' ?>">
                                <a class="page-link"
                                    href="<?php echo $burl . "/admin/product_categorys/index.php?page=" . $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php }?>
                            <li class="page-item <?php echo $page +1 > $totalPage ? 'disabled' : '' ?>"><a
                                    class="page-link"
                                    href="<?php echo $burl . "/admin/product_categorys/index.php?page=" . $page + 1 ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>