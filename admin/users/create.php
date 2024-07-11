<?php
    $title = "Add Users Page";
    $page = "user";

?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php
    $users = $conn -> query("SELECT * FROM users");
   

?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Create Users</h2>
        </div>
        <div class="card-body">

            <div class="col-12 mb-3">
                <a href="<?php echo $burl . "/admin/users/index.php?"?>" class="btn btn-danger"><i class="fa-solid fa-rotate-left"></i> Back</a>
            </div>

            <?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/sms.php");?>
            <form action="<?php echo $burl . "/admin/users/actions/create.php"; ?>" method="post"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="re-password">Re-Password</label>
                    <input type="re-password" id="re-password" name="re-password" class="form-control" required>
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