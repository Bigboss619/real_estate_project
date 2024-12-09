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
       
            if($_POST['address'] == "")
            {
                throw new Exception("Address cannot be empty" );
            }
            if($_POST['email'] == "")
            {
                throw new Exception("Email cannot be empty" );
            }
            if($_POST['phone'] == "")
            {
                throw new Exception("Phone cannot be empty" );
            }
            if($_POST['copyright'] == "")
            {
                throw new Exception("Copyright Text cannot be empty" );
            }
            if($_POST['map'] == "")
            {
                throw new Exception("Map cannot be empty" );
            }
            if($_POST['hero_heading'] == "")
            {
                throw new Exception(" Hero Heading cannot be empty" );
            }
            if($_POST['hero_subheading'] == "")
            {
                throw new Exception(" Hero subheading cannot be empty" );
            }
            if($_POST['featured_property_heading'] == "")
            {
                throw new Exception("Featured Property Heading cannot be empty" );
            }
            if($_POST['featured_property_subheading'] == "")
            {
                throw new Exception("Featured Property Sub-Heading cannot be empty" );
            }
            if($_POST['why_choose_heading'] == "")
            {
                throw new Exception("Why Choose Heading cannot be empty" );
            }
            if($_POST['why_choose_subheading'] == "")
            {
                throw new Exception("Why Choose Sub-Heading cannot be empty" );
            }



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


            //  Hero Section
            $path_hero_photo = $_FILES['hero_photo']['name'];
            $path_tmp_hero_photo = $_FILES['hero_photo']['tmp_name'];
            if($path_hero_photo != '')
            {
               $extension_hero_photo = pathinfo($path_hero_photo, PATHINFO_EXTENSION);
               $filename_hero_photo = "hero_photo.".$extension_hero_photo;

               $finfo_hero_photo = finfo_open(FILEINFO_MIME_TYPE);
               $mime_hero_photo = finfo_file($finfo_hero_photo, $path_tmp_hero_photo);
               if($mime_hero_photo != 'image/jpeg' && $mime_hero_photo != 'image/png')
               {
                   throw new Exception("Please upload a valid hero photo");
               }
            
               unlink('../uploads/settings/'.$_POST['current_hero_photo']);
               move_uploaded_file($path_tmp_hero_photo, '../uploads/settings/'.$filename_hero_photo);
           }else
            {
               $filename_hero_photo = $_POST['current_hero_photo'];
            }

            // Why Choose Section
            $path_why_choose = $_FILES['why_choose']['name'];
            $path_tmp_why_choose = $_FILES['why_choose']['tmp_name'];
            if($path_why_choose != '')
            {
               $extension_why_choose = pathinfo($path_why_choose, PATHINFO_EXTENSION);
               $filename_why_choose = "why_choose.".$extension_why_choose;

               $finfo_why_choose = finfo_open(FILEINFO_MIME_TYPE);
               $mime_why_choose = finfo_file($finfo_why_choose, $path_tmp_why_choose);
               if($mime_why_choose != 'image/jpeg' && $mime_why_choose != 'image/png')
               {
                   throw new Exception("Please upload a valid hero photo");
               }
            
               unlink('../uploads/settings/'.$_POST['current_why_choose_photo']);
               move_uploaded_file($path_tmp_why_choose, '../uploads/settings/'.$filename_why_choose);
           }else
            {
               $filename_why_choose = $_POST['current_why_choose_photo'];
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
            
            //  Featured Property
             if(isset($_POST['featured_property_status']) && $_POST['featured_property_status'] == 'Show'){
                $featured_property_status = $_POST['featured_property_status'];
            }else{
                $featured_property_status = 'Hide';
            }

            // Why Choose Status
            if(isset($_POST['why_choose_status']) && $_POST['why_choose_status'] == 'Show'){
                $why_choose_status = $_POST['why_choose_status'];
            }else{
                $why_choose_status = 'Hide';
            }

            $statement = $conn->prepare("UPDATE settings SET 
            logo=?,
            hero_heading=?,
            hero_subheading=?,
            hero_photo=?,
            favicon=?,
            banner=?,
            address=?,
            phone=?,
            copyright=?,
            email=?,
            facebook=?,
            instagram=?,
            twitter=?,
            youtube=?,
            linkedln=?,
            map=?,
            featured_property_heading=?,
            featured_property_subheading=?,
            featured_property_status=?,
            why_choose_heading=?,
            why_choose_subheading=?,
            why_choose_photo=?,
            why_choose_status=?,
            WHERE id=?");

            $statement->execute([
                $filename_logo,
                $_POST['hero_heading'],
                $_POST['hero_subheading'],                
                $filename_hero_photo,
                $filename_favicon,
                $filename_banner,
                $_POST['address'],
                $_POST['phone'],
                $_POST['copyright'],
                $_POST['email'],
                $_POST['facebook'],
                $_POST['instagram'],
                $_POST['twitter'],
                $_POST['youtube'],
                $_POST['linkedln'],
                $_POST['map'],
                $_POST['featured_property_heading'],
                $_POST['featured_property_subheading'],
                $featured_property_status,
                $_POST['why_choose_heading'],
                $_POST['why_choose_subheading'],
                $filename_why_choose,
                $why_choose_status,
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
        $existing_hero_photo = $result[0]['hero_photo'];
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
        $existing_hero_heading = $result[0]['hero_heading'];
        $existing_hero_subheading = $result[0]['hero_subheading'];
        $featured_property_heading = $result[0]['featured_property_heading'];
        $featured_property_subheading = $result[0]['featured_property_subheading'];
        $why_choose_heading = $result[0]['why_choose_heading'];
        $why_choose_photo = $result[0]['why_choose_photo'];
        $why_choose_subheading = $result[0]['why_choose_subheading'];


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
                                <input type="hidden" name="current_banner" value="<?php echo $existing_banner; ?>">
                                <input type="hidden" name="current_hero_photo" value="<?php echo $existing_hero_photo; ?>">
                                <input type="hidden" name="current_why_choose_photo" value="<?php echo $why_choose_photo; ?>">

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
                                        <input type="text" class="form-control" name="email" value="<?php echo $existing_email; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Copyright Text</label>
                                        <input type="text" class="form-control" name="copyright" value="<?php echo $existing_copyright; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo $existing_phone; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Facebook</label>
                                        <input type="text" class="form-control" name="facebook" value="<?php echo $existing_facebook; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Twitter</label>
                                        <input type="text" class="form-control" name="twitter" value="<?php echo $existing_twitter; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Linkedln</label>
                                        <input type="text" class="form-control" name="linkedln" value="<?php echo $existing_linkedln; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Instagram</label>
                                        <input type="text" class="form-control" name="instagram" value="<?php echo $existing_instagram; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Youtube</label>
                                        <input type="text" class="form-control" name="youtube" value="<?php echo $existing_youtube; ?>">
                                    </div>
                                   
                                </div>

                                <!-- Hero Section -->
                                <div class="partial-header">Home Page - Hero Sections</div>
                                <div class="partial-item">
                                    <div class="form-group mb-3">
                                        <label>Heading</label>
                                        <input type="text" class="form-control" name="hero_heading" value="<?php echo $existing_hero_heading; ?>">
                                    </div>
                            
                                    <div class="form-group mb-3">
                                        <label>Sub Heading</label>
                                        <input type="text" class="form-control" name="hero_subheading" value="<?php echo $existing_hero_subheading; ?>">
                                    </div>
                               
                                
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="<?php echo BASE_URL;  ?>uploads/settings/<?php echo $existing_hero_photo; ?>" alt="" class="w_300">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Change Photo</label>
                                        <div>
                                            <input type="file" name="hero_photo">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Feature Property Section -->
                                <div class="partial-header">Home Page - Featured Properties Section</div>
                                <div class="partial-item">
                                    <div class="form-group mb-3">
                                        <label>Heading</label>
                                        <input type="text" class="form-control" name="featured_property_heading" value="<?php echo $featured_property_heading; ?>">
                                    </div>
                            
                                    <div class="form-group mb-3">
                                        <label>Sub Heading</label>
                                        <input type="text" class="form-control" name="featured_property_subheading" value="<?php echo $featured_property_subheading; ?>">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label>Status</label>
                                        <div class="toggle-container">
                                            <input type="checkbox" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" name="featured_property_status" value="Show" <?php if($result[0]['featured_property_status'] == 'Show') {echo "checked";} ?>>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- Why Choose Us Section -->
                                <div class="partial-header">Home Page - Why Choose Us Section</div>
                                <div class="partial-item">
                                    <div class="form-group mb-3">
                                        <label>Heading</label>
                                        <input type="text" class="form-control" name="why_choose_heading" value="<?php echo $why_choose_heading; ?>">
                                    </div>
                            
                                    <div class="form-group mb-3">
                                        <label>Sub Heading</label>
                                        <input type="text" class="form-control" name="why_choose_subheading" value="<?php echo $why_choose_subheading; ?>">
                                    </div>
                               
                                
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="<?php echo BASE_URL;  ?>uploads/settings/<?php echo $why_choose_photo; ?>" alt="" class="w_300">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Change Photo</label>
                                        <div>
                                            <input type="file" name="why_choose">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Status</label>
                                        <div class="toggle-container">
                                            <input type="checkbox" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" name="why_choose_status" value="Show" <?php if($result[0]['why_choose_status'] == 'Show') {echo "checked";} ?>>
                                        </div>
                                    </div>
                                </div>

                                <div class="partial-header">Contact Page Map</div>
                                <div class="partial-item">
                                    <label for="">Map iframe code</label>
                                    <textarea name="map" class="form-control h_100" id=""><?php echo $result[0]['map']; ?></textarea>
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