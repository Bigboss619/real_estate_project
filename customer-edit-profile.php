<?php require_once('header.php'); ?>
<?php
if(isset($_POST['form_update']))
{
    try {
            if($_POST['name'] == '')
            {
            throw new Exception('Fullname can not be empty');
            }
            if($_POST['email'] == '')
            {
                throw new Exception('Email can not be empty');
            }
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email is invalid");
            }
            $statement = $conn->prepare("SELECT * FROM customer WHERE email=? AND id!=?");
            $statement->execute([$_POST['email'],$_SESSION['customer']['id']]);
            $total = $statement->rowCount();
            if($total > 0) {
                throw new Exception("Email already exists");
            }
             // Updating the database
             $statement = $conn->prepare("UPDATE customer SET fullname=?, email=? WHERE id=?");
             $statement->execute([$_POST['name'],$_POST['email'],$_SESSION['customer']['id']]);
 
            //  Update Password
            if($_POST['password'] != '' || $_POST['retype_password'] != '')
            {
                if($_POST['password'] != $_POST['retype_password'])
                {
                    throw new Exception('Password does not match');
                }
                else
                {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $statement = $conn->prepare("UPDATE customer SET password=? WHERE id=?");
                    $statement->execute([$password,$_SESSION['customer']['id']]);
                }
            }



            // Update Photo
            $path = $_FILES['photo']['name'];
            $path_tmp = $_FILES['photo']['tmp_name'];

            if($path != '')
            {
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                $filename = time().".".$extension;
    
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $path_tmp);
    
                if($mime == 'image/jpeg' || $mime == 'image/png' || $mime == 'application/pdf')
                 {

                    // Checking if ther was a various photo and unlink it
                    if($_SESSION['customer']['photo'] != '' && file_exists('uploads/customer-dp/'.$_SESSION['customer']['photo']))
                    {
                        unlink('uploads/customer-dp/'.$_SESSION['customer']['photo']);
                    }
        
                    move_uploaded_file($path_tmp, 'uploads/customer-dp/'.$filename);
    
                     // Updating the database
                     $statement = $conn->prepare("UPDATE customer SET photo=? WHERE id=?");
                     $statement->execute([$filename,$_SESSION['customer']['id']]);
                     
                     $_SESSION['customer']['photo'] = $filename;
                    
                }
                else
                {
                    throw new Exception("Please upload a valid photo");
                }
            }
            
            
           
            $success_message = 'Profile data is updated successfully';

            $_SESSION['customer']['fullname'] = $_POST['name'];
            $_SESSION['customer']['email'] = $_POST['email'];
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner.jpg')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Profile</h2>
                </div>
            </div>
        </div>
    </div>
<div class="page-content user-panel">
<div class="container">
<div class="row">
    <div class="col-lg-3 col-md-12">
       <?php require_once('customer-sidebar.php'); ?>
    </div>
    <div class="col-lg-9 col-md-12">
        <form action="customer-edit-profile.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Existing Photo</label>
                    <div class="form-group">
                        <?php if($_SESSION['customer']['photo'] == ''): ?>
                            <img src="<?php echo BASE_URL; ?>uploads/customer-dp/user.jpg" alt="" class="user-photo">
                            <?php else: ?>
                                <img src="<?php echo BASE_URL; ?>uploads/customer-dp/<?php echo htmlspecialchars($_SESSION['customer']['photo']); ?>" alt="" class="user-photo">
                            <?php endif; ?>
                    </div>
                </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Change Photo</label>
                        <div class="form-group">
                            <input type="file" name="photo">
                        </div>
                    </div>
                <div class="col-md-6 mb-3">
                    <label for="">Full Name *</label>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['customer']['fullname'] ?>">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Email Address</label>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['customer']['email'] ?>">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Password</label>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Retype Password</label>
                        <div class="form-group">
                            <input type="text" name="retype_password" class="form-control">
                        </div>
                    </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input name="form_update" type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<?php require_once('footer.php'); ?>