<?php require_once('header.php'); ?>
<?php
    if(!isset($_SESSION['agents'])){
        header('Location: ' . BASE_URL . 'agent-login');
        exit;
    }
?>
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
            $statement = $conn->prepare("SELECT * FROM agents WHERE email=? AND id!=?");
            $statement->execute([$_POST['email'], $_SESSION['agents']['id']]);
            $total = $statement->rowCount();
            if($total > 0) {
                throw new Exception("Email already exists");
            }
             // Updating the database
             $statement = $conn->prepare("UPDATE agents SET fullname=?, email=?, company=?, designation=?, biography=?, phone=?, country=?, address=?, estate=?, city=?, zip_code=?, website=?, facebook=?, twitter=?, linkedln=?, pinterest=?, instagram=?, youtube=? WHERE id=?");
             $statement->execute([$_POST['name'],$_POST['email'],$_POST['company'],$_POST['designation'],$_POST['biography'],$_POST['phone'],$_POST['country'],$_POST['address'],$_POST['estate'],$_POST['city'],$_POST['zip_code'],$_POST['website'],$_POST['facebook'],$_POST['twitter'],$_POST['linkedln'],$_POST['pinterest'],$_POST['instagram'],$_POST['youtube'],$_SESSION['agents']['id']]);
 
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
                    $statement = $conn->prepare("UPDATE agents SET password=? WHERE id=?");
                    $statement->execute([$password,$_SESSION['agents']['id']]);
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
                    if($_SESSION['agents']['photo'] != '' && file_exists('uploads/agent-dp/'.$_SESSION['agents']['photo']))
                    {
                        unlink('uploads/agent-dp/'.$_SESSION['agents']['photo']);
                    }
        
                    move_uploaded_file($path_tmp, 'uploads/agent-dp/'.$filename);
    
                     // Updating the database
                     $statement = $conn->prepare("UPDATE agents SET photo=? WHERE id=?");
                     $statement->execute([$filename,$_SESSION['agents']['id']]);
                     
                     $_SESSION['agents']['photo'] = $filename;
                    
                }
                else
                {
                    throw new Exception("Please upload a valid photo");
                }
            }
            
            
           
            $success_message = 'Profile data is updated successfully';

            $_SESSION['agents']['fullname'] = $_POST['name'];
            $_SESSION['agents']['email'] = $_POST['email'];
            $_SESSION['agents']['company'] = $_POST['company'];
            $_SESSION['agents']['designation'] = $_POST['designation'];
            $_SESSION['agents']['biography'] = $_POST['biography'];
            $_SESSION['agents']['phone'] = $_POST['phone'];
            $_SESSION['agents']['country'] = $_POST['country'];
            $_SESSION['agents']['address'] = $_POST['address'];
            $_SESSION['agents']['estate'] = $_POST['estate'];
            $_SESSION['agents']['city'] = $_POST['city'];
            $_SESSION['agents']['zip_code'] = $_POST['zip_code'];
            $_SESSION['agents']['website'] = $_POST['website'];
            $_SESSION['agents']['facebook'] = $_POST['facebook'];
            $_SESSION['agents']['twitter'] = $_POST['twitter'];
            $_SESSION['agents']['linkedln'] = $_POST['linkedln'];
            $_SESSION['agents']['pinterest'] = $_POST['pinterest'];
            $_SESSION['agents']['instagram'] = $_POST['instagram'];
            $_SESSION['agents']['youtube'] = $_POST['youtube'];
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/settings/banner.jpg')">
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
       <?php require_once('agent-sidebar.php'); ?>
    </div>
    <div class="col-lg-9 col-md-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Existing Photo</label>
                    <div class="form-group">
                        <?php if($_SESSION['agents']['photo'] == ''): ?>
                            <img src="<?php echo BASE_URL; ?>uploads/agent-dp/default.png" alt="" class="user-photo">
                            <?php else: ?>
                                <img src="<?php echo BASE_URL; ?>uploads/agent-dp/<?php echo htmlspecialchars($_SESSION['agents']['photo']); ?>" alt="" class="user-photo">
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
                        <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['agents']['fullname'] ?>">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Email Address</label>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['agents']['email'] ?>">
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
                    <div class="col-md-6 mb-3">
                        <label for="">Company</label>
                        <div class="form-group">
                            <input type="text" name="company" class="form-control" value="<?php echo $_SESSION['agents']['company'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Designation</label>
                        <div class="form-group">
                            <input type="text" name="designation" class="form-control" value="<?php echo $_SESSION['agents']['designation'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                                <label for="">Biography</label>
                                <textarea name="biography" class="form-control editor" cols="30" rows="10"><?php echo $_SESSION['agents']['biography']; ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                                <label for="">Phone *</label>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control" value="<?php echo $_SESSION['agents']['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Country *</label>
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control" value="<?php echo $_SESSION['agents']['country'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address *</label>
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control" value="<?php echo $_SESSION['agents']['address'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">State *</label>
                                <div class="form-group">
                                    <input type="text" name="estate" class="form-control" value="<?php echo $_SESSION['agents']['estate'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">City *</label>
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control" value="<?php echo $_SESSION['agents']['city'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Zip Code *</label>
                                <div class="form-group">
                                    <input type="text" name="zip_code" class="form-control" value="<?php echo $_SESSION['agents']['zip_code'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Website</label>
                                <div class="form-group">
                                    <input type="text" name="website" class="form-control" value="<?php echo $_SESSION['agents']['website'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Facebook</label>
                                <div class="form-group">
                                    <input type="text" name="facebook" class="form-control" value="<?php echo $_SESSION['agents']['facebook'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Twitter</label>
                                <div class="form-group">
                                    <input type="text" name="twitter" class="form-control" value="<?php echo $_SESSION['agents']['twitter'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">LinkedIn</label>
                                <div class="form-group">
                                    <input type="text" name="linkedln" class="form-control" value="<?php echo $_SESSION['agents']['linkedln'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Pinterest</label>
                                <div class="form-group">
                                    <input type="text" name="pinterest" class="form-control" value="<?php echo $_SESSION['agents']['pinterest'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Instagram</label>
                                <div class="form-group">
                                    <input type="text" name="instagram" class="form-control" value="<?php echo $_SESSION['agents']['instagram'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Youtube</label>
                                <div class="form-group">
                                    <input type="text" name="youtube" class="form-control" value="<?php echo $_SESSION['agents']['youtube'] ?>">
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