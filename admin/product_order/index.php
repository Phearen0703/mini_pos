<?php
    $title = "Ordeer Page";
    $page = "order";
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php 
    $products = $conn ->query("SELECT * FROM products");
    $customers = $conn -> query("SELECT * FROM customers");
?>

    <div class="container py-5">
        <div class="row g-4">
            <div class="col-12">
                <form action="">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><i class="fa-solid fa-cart-plus"></i> Order</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-4 col-12">
                                <label for="customer">Customers</label>
                                <select name="customer_id" id="customer" required class="form-select">
                                    <option value="">Pleas Select</option>
                                    <?php
                                    while($customer = $customers -> fetch_object()){ ?>
                                    <option value="<?php echo $customer ->id ?>"><?php echo $customer ->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="product">Product / Item</label>
                                <select name="product_id" id="product" required class="form-select">
                                    <option value="">Pleas Select</option>
                                    <?php
                                    while($product = $products -> fetch_object()){ ?>
                                    <option value="<?php echo $product ->id ?>"><?php echo $product ->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" class="form-control" placeholder="Input Qty of Item" required>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-plus"></i> Add To Card</button>
                    </div>
                </div>
                </form>
            </div>

            <!-- list order -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h2 class="mb-0 text-white">List Orders</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hove text-center">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Accent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Coca</td>
                                    <td>1</td>
                                    <td>5000</td>
                                    <td>5000</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>