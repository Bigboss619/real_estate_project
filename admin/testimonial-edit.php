<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
    <?php

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die('ID parameter is missing');
    }
        $id = $_GET['id'];

                     $statement = $conn->prepare("SELECT * FROM testimonials WHERE id=?");
                    $statement->execute([$id]);
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                                // Check if the result array has data
                    if (!empty($result)) {
                        // echo 'Everything is GOod';
                        // Now it's safe to access $result[0]['name'] and $result[0]['slag']
                        $name = $result['name'] ?? '';
                        $designation = $result['designation'] ?? '';
                        $comment = $result['comment'] ?? '';
                        $photo = $result['photo'] ?? '';
                        $currentImagePath = __DIR__ . '/../uploads/testimonials/' . $photo; // Corrected path for file_exists check
                        $currentImageURL = '../uploads/testimonials/' . $photo; // Path used in the HTML <img> tag
                    } else {
                        die('No data found for the given ID.');
                    }
      

                
        if(isset($_POST['testimonial_edit']))
        {

            try {
                    if($_POST['name'] == "")
                    {
                        throw new Exception("Name cannot be empty" );
                    }
                    if($_POST['designation'] == "")
                    {
                        throw new Exception("Designation cannot be empty" );
                    }
                    if($_POST['comment'] == "")
                    {
                        throw new Exception("Comment cannot be empty" );
                    }
                    
                                    
                         // Upload Photo
                            $path = $_FILES['photo']['name'];
                            $path_tmp = $_FILES['photo']['tmp_name'];
                                if ($path != '') {
                                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                                    $filename = time() . "." . $extension;
                                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                    $mime = finfo_file($finfo, $path_tmp);
                                        if ($mime == 'image/jpeg' || $mime == 'image/png' || $mime == 'application/pdf') {
                                        // Move the uploaded file to the uploads directory
                                        move_uploaded_file($path_tmp, '../uploads/testimonials/' . $filename);

                                        // Remove the existing image from the uploads directory if it exists
                                        if (!empty($photo) && file_exists($currentImagePath)) {
                                            unlink($currentImagePath);
                                        }
                                    } else {
                                        throw new Exception("Please upload a valid photo");
                                    }
                                } else {
                                    // If no new image is uploaded, use the existing image filename
                                    $filename = $photo;
                                 }
                        
                    $statement = $conn->prepare("UPDATE testimonials SET name=?, designation=?, comment=?, photo=? WHERE id=?");
                    $statement->execute([
                        $_POST['name'], 
                        $_POST['designation'],
                        $_POST['comment'],
                        $filename, 
                        $id
                    ]);

                    $success_message = 'Testimonial updated successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . ADMIN_URL . 'testimonial-view.php');
                    exit;

            } catch (Exception $e ) {
                $error_message = $e->getMessage();
            }
        }
        // var_dump($result);
       
    ?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Edit Testimonial</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>testimonial-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="testimonial-edit.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label>Existing Photo</label>
                            <div>
                                <img src="<?php echo $currentImageURL; ?>" class="w_200" alt="">
                            </div>   
                        </div>
                        <div class="form-group mb-3">
                            <label>Change Photo</label>
                            <div>
                                <input type="file" class="form-control" name="photo">
                            </div>   
                        </div>
    
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name);  ?>">
                        </div>
                
                        <div class="form-group mb-3">
                            <label>Designation</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($designation); ?>" name="designation">
                        </div>

                        <div class="form-group mb-3">
                            <label for="" class="form-label">Comment</label>
                            <textarea class="form-control h_100" name="comment" id="" rows="3"><?php echo htmlspecialchars($comment); ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="testimonial_edit" class="btn btn-primary">Submit</button>
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