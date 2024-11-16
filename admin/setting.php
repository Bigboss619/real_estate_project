<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
 <?php

// $id = $_GET['id'];                   

        
if(isset($_POST['form_update']))
{

    try {
            // if($_POST['terms'] == "")
            // {
            //     throw new Exception("Terms cannot be empty" );
            // }

            // Logo Section
             $path_logo = $_FILES['logo']['name'];
             $path_tmp_logo = $_FILES['logo']['tmp_name'];
             
             if($path_logo != '')
             {
                $extension_logo = pathinfo($path_logo, PATHINFO_EXTENSION);
                $filename_logo = "logo.".$extension_logo;

                $finfo_logo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_logo = finfo_file($finfo_logo, $path_tmp_logo);
                if($mime_logo != 'image/jpeg' && $mime_logo != 'image/png')
                {
                    throw new Exception("Please upload a valid logo");
                }
             
                unlink('../uploads/settings/'.$_POST['current_logo']);
                move_uploaded_file($path_tmp_logo, '../uploads/settings/'.$filename_logo);
            }else
             {
                $filename_logo = $_POST['current_logo'];
             }

            // Favicon Section
             $path_favicon = $_FILES['favicon']['name'];
             $path_tmp_favicon = $_FILES['favicon']['tmp_name'];
             if($path_favicon != '')
             {
                $extension_favicon = pathinfo($path_favicon, PATHINFO_EXTENSION);
                $filename_favicon = "favicon.".$extension_favicon;

                $finfo_favicon = finfo_open(FILEINFO_MIME_TYPE);
                $mime_favicon = finfo_file($finfo_favicon, $path_tmp_favicon);
                if($mime_favicon != 'image/jpeg' && $mime_favicon != 'image/png')
                {
                    throw new Exception("Please upload a valid Favicon");
                }
             
                unlink('../uploads/settings/'.$_POST['current_favicon']);
                move_uploaded_file($path_tmp_favicon, '../uploads/settings/'.$filename_favicon);
            }else
             {
                $filename_favicon = $_POST['current_favicon'];
             }


            //  Banner Section
            $path_banner = $_FILES['banner']['name'];
             $path_tmp_banner = $_FILES['banner']['tmp_name'];
             if($path_banner != '')
             {
                $extension_banner = pathinfo($path_banner, PATHINFO_EXTENSION);
                $filename_banner = "banner.jpg";

                $finfo_banner = finfo_open(FILEINFO_MIME_TYPE);
                $mime_banner = finfo_file($finfo_banner, $path_tmp_banner);
                if($mime_banner != 'image/jpeg' && $mime_banner != 'image/png')
                {
                    throw new Exception("Please upload a valid Banner Photo");
                }

                $current_banner_path = '../uploads/settings/' . $_POST['current_banner'];
                unlink($current_banner_path);
                move_uploaded_file($path_tmp_banner, '../uploads/settings/'.$filename_banner);
            }else
             {
                $filename_banner = 'banner.jpg';
             }
            
             
            $statement = $conn->prepare("UPDATE settings SET logo=?, favicon=? banner=? WHERE id=?");
            $statement->execute([
                $filename_logo,
                $filename_favicon,
                $filename_banner,  
                1
            ]);

            $success_message = 'Data is updated successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'setting.php');
            exit;

    } catch (Exception $e ) {
        $error_message = $e->getMessage();
    }
}


?>
<?php
        
        $statement = $conn->prepare("SELECT * FROM settings WHERE id=?");
        $statement->execute([1]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $existing_logo = $result[0]['logo'];
        $existing_favicon = $result[0]['favicon'];
        $existing_banner = $result[0]['banner'];
        $existing_address = $result[0]['address'];
        $existing_email = $result[0]['email'];
        $existing_phone = $result[0]['phone'];
        $existing_copyright = $result[0]['copyright'];
        $existing_facebook = $result[0]['facebook'];
        $existing_twitter = $result[0]['twitter'];
        $existing_youtube = $result[0]['youtube'];
        $existing_linkedln = $result[0]['linkedln'];
        $existing_instagram = $result[0]['instagram'];
    ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Setting</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="setting.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="current_logo" value="<?php echo $existing_logo; ?>">
                                <input type="hidden" name="current_favicon" value="<?php echo $existing_favicon; ?>">
                                <input type="hidden" name="current_banner" value="<?php echo $existing_banner ?>">

                                <!-- Logo Section -->
                                <div class="partial-item">
                                    <div class="form-group mb-3">
                                        <label>Existing Logo</label>
                                        <div>
                                            <img src="<?php echo BASE_URL;  ?>uploads/settings/<?php echo $existing_logo; ?>" alt="" class="w_100">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Change Logo</label>
                                        <div>
                                            <input type="file" name="logo">
                                        </div>
                                    </div>
                                </div>

                                <!-- Favicon Section -->
                                <div class="partial-item">
                                    <div class="form-group mb-3">
                                        <label>Existing Favicon</label>
                                        <div>
                                            <img src="<?php echo BASE_URL;  ?>uploads/settings/<?php echo $existing_favicon; ?>" alt="" class="w_50">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Change Favicon</label>
                                        <div>
                                            <input type="file" name="favicon">
                                        </div>
                                    </div>
                                </div>

                                <!-- Banner Photo Section -->
                                <div class="partial-item">
                                    <div class="form-group mb-3">
                                        <label>Existing Banner</label>
                                        <div>
                                            <img src="<?php echo BASE_URL;  ?>uploads/settings/<?php echo $existing_banner; ?>" alt="" class="w_200">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Change Banner</label>
                                        <div>
                                            <input type="file" name="banner">
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer Section -->
                                <div class="partial-item">
                                    <div class="form-group mb-3">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="<?php echo $existing_address; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $existing_email; ?>s">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Copyright Text</label>
                                        <input type="text" class="form-control" name="copyright" value="<?php echo $existing_copyright; ?>s">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $existing_email; ?>s">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo $existing_phone; ?>s">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Status</label>
                                        <div class="toggle-container">
                                            <input type="checkbox" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" name="" value="Show" checked>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt_30">
                                    <button type="submit" class="btn btn-primary" name="form_update">Update</button>
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