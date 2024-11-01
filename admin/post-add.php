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
                if($_POST['title'] == "")
                {
                    throw new Exception("Title cannot be empty" );
                }
                if($_POST['short_description'] == "")
                {
                    throw new Exception("Short Description cannot be empty" );
                }
                if($_POST['description'] == "")
                {
                    throw new Exception("Description cannot be empty" );
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
                move_uploaded_file($path_tmp, '../uploads/blog/'.$filename);
               

                $statement = $conn->prepare("INSERT INTO posts (title, short_description, long_description, photo, posted_on, total_view) VALUES(?, ?, ?, ?, ?, ?)");
                $statement->execute([ $_POST['title'],  $_POST['short_description'], $_POST['description'], $filename, date('Y-m-d H:i:s'),1]);

                $success_message = 'Post is added successfully';

                $_SESSION['success_message'] = $success_message;

                header('location: ' . ADMIN_URL . 'post-view.php');
                exit;

        } catch (Exception $e ) {
            $error_message = $e->getMessage();
        }
    }
    
?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Add Blog Post</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>post-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="post-add.php" method="post" enctype="multipart/form-data">

                        <div class="form-group mb-3">
                            <label>Photo</label>
                            <div>
                                <input type="file" class="form-control" name="photo">
                            </div>   
                        </div>
    
                        <div class="form-group mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="<?php if(isset($_POST['title'])) {echo $_POST['title'];} ?>">
                        </div>
                
                        <div class="form-group mb-3">
                            <label>Short Description</label>
                            <textarea class="form-control h_100" name="short_description" id="" rows="3"><?php if(isset($_POST['short_description'])) {echo $_POST['short_description'];} ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea class="form-control editor" name="description" id="" rows="3"><?php if(isset($_POST['description'])) {echo $_POST['description'];} ?></textarea>
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