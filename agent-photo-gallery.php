<?php require_once('header.php'); ?>
<?php
    $statement = $conn->prepare("SELECT * FROM property WHERE id=?");
    $statement->execute([$_GET['id']]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
?>
<?php
   if(isset($_POST['form_submit']))
   {
        try {
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
                    move_uploaded_file($path_tmp, './uploads/property/'.$filename);

                    $statement = $conn->prepare("INSERT INTO property_photo (property_id, photo) VALUES(?, ?)");
                    $statement->execute([$_GET['id'], $filename]);

                    $success_message = 'Photo is added successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . BASE_URL . 'agent-photo-gallery/'.$_GET['id']);
                    exit;
            
                    }
                else
                {
                    throw new Exception("Please upload a valid photo");
                }
            }
            else
            {
                throw new Exception("Photo cannot be empty");
                
            }
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
   }
?>
<?php
    if(isset($_POST['form_delete'])){
        $statement = $conn->prepare("SELECT * FROM property_photo WHERE id=?");
        $statement->execute([$_POST['gallery_id']]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
                unlink('uploads/property/'.$row['photo']);
        }

        $statement = $conn->prepare("DELETE FROM property_photo WHERE id=?");
        $statement->execute([$_POST['gallery_id']]);

        $success_message = 'Photo is deleted successfully';
        $_SESSION['success_message'] = $success_message;
        header('location: ' . BASE_URL . 'agent-photo-gallery/'.$_GET['id']);
        exit;
    }
?>

<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner.jpg')">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Photo Gallery of "<?php echo $result[0]['name']; ?>" </h2>
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
                    <h4>Add Photo</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="file" name="photo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-sm" value="Submit" name="form_submit" />
                            </div>
                        </div>
                    </form>

                    <h4 class="mt-4">Existing Photos</h4>
                    <div class="photo-all">
                        <div class="row">
                            <?php
                             $statement = $conn->prepare("SELECT * FROM property_photo WHERE property_id=?");
                             $statement->execute([$_GET['id']]);
                             $result1 = $statement->fetchAll(PDO::FETCH_ASSOC);
                             $total = $statement->rowCount();
                             if(!$total)
                             {
                                echo '<div class="text-danger col-md-12"><p>No photo found.</p></div>';
                                }
                             foreach($result1 as $row){
                              ?>
                                <div class="col-md-6 col-lg-3">
                                    <div class="item item-delete">
                                    <a href="<?php echo BASE_URL;  ?>uploads/property/<?php echo $row['photo']; ?>" class="magnific">
                                        <img src="<?php echo BASE_URL;  ?>uploads/property/<?php echo $row['photo']; ?>" alt="" />
                                        <div class="icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="bg"></div>
                                    </a>
                                    </div>
                                    <form action="" method="post">
                                        <input type="hidden" name="gallery_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="form_delete" class="badge bg-danger mb_20 custom-delete-button" onClick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                              </div>
                              <?php
                              }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php require_once('footer.php'); ?>