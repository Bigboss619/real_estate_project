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

                     $statement = $conn->prepare("SELECT * FROM posts WHERE id=?");
                    $statement->execute([$id]);
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                                // Check if the result array has data
                    if (!empty($result)) {
                        // echo 'Everything is GOod';
                        // Now it's safe to access $result[0]['name'] and $result[0]['slag']
                        $title = $result['title'] ?? '';
                        $slag = $result['slug'] ?? '';
                        $short_description = $result['short_description'] ?? '';
                        $long_description = $result['long_description'] ?? '';
                        $photo = $result['photo'] ?? '';
                        $currentImagePath = __DIR__ . '/../uploads/blog/' . $photo; // Corrected path for file_exists check
                        $currentImageURL = '../uploads/blog/' . $photo; // Path used in the HTML <img> tag
                    } else {
                        die('No data found for the given ID.');
                    }
      

                
        if(isset($_POST['blog_edit']))
        {

            try {
                    if($_POST['title'] == "")
                    {
                        throw new Exception("Title cannot be empty" );
                    }
                    $statement = $conn->prepare("SELECT * FROM posts WHERE title=? AND id!=?");
                    $statement->execute([$_POST['title'],$_GET['id']]);
                    $total = $statement->rowCount();
                    if($total > 0)
                    {
                        throw new Exception("Title Already Exist");            
                    }
                    if($_POST['slag'] == "")
                    {
                        throw new Exception("Slug cannot be empty");
                        
                    }
                    $statement = $conn->prepare("SELECT * FROM posts WHERE slug=? AND id!=?");
                    $statement->execute([$_POST['slag'],$_GET['id']]);
                    $total = $statement->rowCount();
                    if($total > 0)
                    {
                        throw new Exception("Slug Already Exist");            
                    }
                    if(!preg_match('/^[a-z0-9-]+$/', $_POST['slag']))
                    {
                        throw new Exception("Invalid slug format. Slug should only contain lowercase letters, numbers and hyphens");
                        
                    }
                    if($_POST['short_description'] == "")
                    {
                        throw new Exception("Short Description cannot be empty" );
                    }
                    if($_POST['description'] == "")
                    {
                        throw new Exception("Description cannot be empty" );
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
                                        move_uploaded_file($path_tmp, '../uploads/blog/' . $filename);

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
                        
                    $statement = $conn->prepare("UPDATE posts SET title=?, slug=?, short_description=?, long_description=?, photo=? WHERE id=?");
                    $statement->execute([
                        $_POST['title'], 
                        $_POST['slag'],
                        $_POST['short_description'],
                        $_POST['description'],
                        $filename, 
                        $id
                    ]);

                    $success_message = 'Blog Post updated successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . ADMIN_URL . 'post-view.php');
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
<h1>Edit Blog Post</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>post-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="post-edit.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
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
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($title);  ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slag" value="<?php echo htmlspecialchars($slag);  ?>">
                        </div>
                
                        <div class="form-group mb-3">
                            <label>Short Description</label>
                            <textarea class="form-control h_100" name="short_description" id="" rows="3"><?php echo htmlspecialchars($short_description); ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea class="form-control editor" name="description" id="" rows="3"><?php echo htmlspecialchars($long_description);  ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="blog_edit" class="btn btn-primary">Submit</button>
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