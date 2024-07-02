<nav class="navbar navbar-expand-lg bg-info-subtle postition-sticky sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'home' ? "text-primary" : "" ?>" aria-current="page"
                        href="#"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'customer' ? "text-primary" : "" ?>" aria-current="page"
                        href="#"><i class="fa-solid fa-person-walking"></i> Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'product' ? "text-primary" : "" ?>" aria-current="page"
                        href="#"><i class="fa-solid fa-box"></i> Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'order' ? "text-primary" : "" ?>" aria-current="page"
                        href="#"><i class="fa-solid fa-cart-shopping"></i> Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'category' ? "text-primary" : "" ?>" aria-current="page"
                        href="#"><i class="fa-solid fa-cart-flatbed-suitcase"></i> Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'user' ? "text-primary" : "" ?>" aria-current="page"
                        href="#"><i class="fa-regular fa-user"></i> Users</a>
                </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-success" type="submit">Login</button>
            </form>
        </div>
    </div>
</nav>