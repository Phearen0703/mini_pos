<?php
    $title = "Edit User Page";
    $page = "user";

?>

<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/nav.php");?>
<?php
    $user_id = $_GET['user_id'];
    $user = $conn -> query("SELECT * FROM users WHERE id = '$user_id'");
    $user = $user-> fetch_object();  

?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Edit user</h2>
        </div>
        <div class="card-body">

            <div class="col-12 mb-3">
                <a href="<?php echo $burl . "/admin/users/index.php?"?>" class="btn btn-danger"><i class="fa-solid fa-rotate-left"></i> Back</a>
            </div>

            <?php include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/sms.php");?>

            <form action="<?php echo $burl . "/admin/users/actions/edit.php"; ?>" method="post"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $user -> name ?>">
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $user -> username ?>">
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" accept="image/*" id="photo" name="photo" class="form-control">
                </div>

                <div class="mb-3">
                    <img src="<?php echo $base_url . $user -> photo ?>" width="150px" height="150px" alt="IMG">
            
                </div>

                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                </div>


            </form>
        </div>
    </div>
</div>

<?php   include($_SERVER['DOCUMENT_ROOT']."/mini_pos/admin/layouts/footer.php");?>