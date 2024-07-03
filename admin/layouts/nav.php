<!-- for navbar -->

<nav class="navbar navbar-expand-lg bg-info-subtle postition-sticky sticky-top p-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $burl . "/admin"; ?>">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/POS_Logo.svg/2560px-POS_Logo.svg.png" class="rounded-circle" style="width: 70px; hight: 70px" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse fs-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item <?php echo $page == 'home' ? "navActive" : "" ?>">
                    <a class="nav-link " aria-current="page"
                        href="<?php echo $burl . "/admin"; ?>"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="nav-item <?php echo $page == 'customer' ? "navActive" : "" ?>">
                    <a class="nav-link " aria-current="page"
                        href="<?php echo $burl . "/admin/customers/index.php"?>"><i class="fa-solid fa-person-walking"></i> Customer</a>
                </li>
                <li class="nav-item <?php echo $page == 'product' ? "navActive" : "" ?>">
                    <a class="nav-link " aria-current="page"
                        href="<?php echo $burl . "/admin/products/index.php"?>"><i class="fa-solid fa-box"></i> Product</a>
                </li>
                <li class="nav-item <?php echo $page == 'order' ? "navActive" : "" ?>">
                    <a class="nav-link " aria-current="page"
                        href="<?php echo $burl . "/admin/product_order/index.php"?>"><i class="fa-solid fa-cart-shopping"></i> Order</a>
                </li>
                <li class="nav-item <?php echo $page == 'category' ? "navActive" : "" ?>">
                    <a class="nav-link " aria-current="page"
                        href="<?php echo $burl . "/admin/product_category/index.php"?>"><i class="fa-solid fa-cart-flatbed-suitcase"></i> Category</a>
                </li>
                <li class="nav-item <?php echo $page == 'user' ? "navActive" : "" ?>">
                    <a class="nav-link " aria-current="page"
                        href="<?php echo $burl . "/admin/users/index.php"?>"><i class="fa-regular fa-user"></i> Users</a>
                </li>
            </ul>
            <form class="d-flex">
                <a class="btn btn-primary" href="<?php echo $burl . "/admin/auth/action_logout.php"?>">Log Out</a>
            </form>
        </div>
    </div>
</nav>
<!-- end nav bar -->

<?php 
if($_SESSION['login']==false){
   header('Location:'. $burl . '/admin/auth/login.php');
}

?>