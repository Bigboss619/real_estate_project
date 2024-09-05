<?php
require_once('header.php');
?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
<?php
if(isset($_POST['update_form']))
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
             // Updating the database
             $statement = $conn->prepare("UPDATE admins SET fullname=?, email=? WHERE id=?");
             $statement->execute([$_POST['name'],$_POST['email'],$_SESSION['admin']['id']]);
 
            //  Update Password
            if($_POST['new_password'] != '' || $_POST['retype_password'] != '')
            {
                if($_POST['new_password'] != $_POST['retype_password'])
                {
                    throw new Exception('Password does not match');
                }
                else
                {
                    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    $statement = $conn->prepare("UPDATE admins SET password=? WHERE id=?");
                    $statement->execute([$password,$_SESSION['admin']['id']]);
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
                    if($_SESSION['admin']['photo'] != '')
                    {
                        unlink('../uploads/admin-dp/'.$_SESSION['admin']['photo']);
                    }
        
                    move_uploaded_file($path_tmp, '../uploads/admin-dp/'.$filename);
    
                     // Updating the database
                     $statement = $conn->prepare("UPDATE admins SET photo=? WHERE id=?");
                     $statement->execute([$filename,$_SESSION['admin']['id']]);
                     
                     $_SESSION['admin']['photo'] = $filename;
                    
                }
                else
                {
                    throw new Exception("Please upload a valid photo");
                }
            }
            
            
           
            $success_message = 'Profile data is updated successfully';

            $_SESSION['admin']['fullname'] = $_POST['name'];
            $_SESSION['admin']['email'] = $_POST['email'];

            header('location: ' . ADMIN_URL . 'dashboard.php');
            exit;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Edit Profile</h1>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <!-- 
                                            This code checks if an admin upload profile picture let is show but if He didn't use the default image 
                                             -->
                                            <?php if($_SESSION['admin']['photo'] == ''): ?>
                                                <img src="<?php echo BASE_URL; ?>uploads/admin-dp/default.png" class="profile-photo w_100" alt="">

                                                <?php else: ?>
                                                    <img src="<?php echo BASE_URL; ?>uploads/admin-dp/<?php echo $_SESSION['admin']['photo']; ?>"  class="profile-photo w_100" alt="">
                                                    <?php endif; ?>

                                                <input type="file" class="mt_10" name="photo">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="mb-4">
                                                    <label class="form-label">Name *</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo $_SESSION['admin']['fullname']; ?>">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Email *</label>
                                                    <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['admin']['email']; ?>">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="new_password">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Retype Password</label>
                                                    <input type="password" class="form-control" name="retype_password">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label"></label>
                                                    <button type="submit" class="btn btn-primary" name="update_form">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php require_once('footer.php'); ?>
