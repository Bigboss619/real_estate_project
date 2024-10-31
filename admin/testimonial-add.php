<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
<?php
    if(isset($_POST['form_submit']))
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
                
                $path = $_FILES['photo']['name'];
                $path_tmp = $_FILES['photo']['tmp_name'];
                if($path == '')
                {
                    throw new Exception("Please upload a photo");

                }
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                $filename = time().".".$extension;

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $path_tmp);
                if($mime != 'image/jpeg' && $mime != 'image/png')
                {
                    throw new Exception("Please upload a valid photo");
                }
                move_uploaded_file($path_tmp, '../uploads/testimonials/'.$filename);
               

                $statement = $conn->prepare("INSERT INTO testimonials (photo, name, designation, comment) VALUES(?, ?, ?, ?)");
                $statement->execute([$filename, $_POST['name'],  $_POST['designation'], $_POST['comment']]);

                $success_message = 'Testimonial is added successfully';

                $_SESSION['success_message'] = $success_message;

                header('location: ' . ADMIN_URL . 'testimonial-view.php');
                exit;

        } catch (Exception $e ) {
            $error_message = $e->getMessage();
        }
    }
    
?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Add Testimonial</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>testimonial-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="testimonial-add.php" method="post" enctype="multipart/form-data">

                        <div class="form-group mb-3">
                            <label>Photo</label>
                            <div>
                                <input type="file" class="form-control" name="photo">
                            </div>   
                        </div>
    
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>">
                        </div>
                
                        <div class="form-group mb-3">
                            <label>Designation</label>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['designation'])) {echo $_POST['designation'];} ?>" name="designation">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Comment</label>
                            <textarea class="form-control h_100" name="comment" id="" rows="3"><?php if(isset($_POST['comment'])) {echo $_POST['comment'];} ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="form_submit" class="btn btn-primary">Submit</button>
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