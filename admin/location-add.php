<?php require_once('top.php'); ?>

<?php
    if(isset($_POST['form_submit']))
    {
        try {
                if($_POST['name'] == "")
                {
                    throw new Exception("Name cannot be empty" );
                }
                $statement = $conn->prepare("SELECT * FROM locations WHERE name=?");
                $statement->execute([$_POST['name']]);
                $total = $statement->rowCount();
                if($total > 0)
                {
                    throw new Exception("Name Already Exist");
                    
                }
                if($_POST['slag'] == "")
                {
                    throw new Exception("Slug cannot be empty");
                    
                }
                $statement = $conn->prepare("SELECT * FROM locations WHERE slag=?");
                $statement->execute([$_POST['slag']]);
                $total = $statement->rowCount();
                if($total > 0)
                {
                    throw new Exception("Slug Already Exist");
                    
                }
                if(!preg_match('/^[a-z0-9-]+$/', $_POST['slag']))
                {
                    throw new Exception("Invalid slug format. Slug should only contain lowercase letters, numbers and hyphens");
                    
                }
                $path = $_FILES['photo']['name'];
                $path_tmp = $_FILES['photo']['tmp_name'];
                if($path == '')
                {
                    throw new Exception("Please upload a valid photo");

                }
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                $filename = time().".".$extension;

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $path_tmp);
                if($mime != 'image/jpeg' && $mime != 'image/png')
                {
                    throw new Exception("Please upload a valid photo");
                }
                move_uploaded_file($path_tmp, '../uploads/location/'.$filename);
               

                $statement = $conn->prepare("INSERT INTO locations (name, photo, slag) VALUES(?, ?, ?)");
                $statement->execute([$_POST['name'], $filename, $_POST['slag']]);

                $success_message = 'Location is added successfully';

                $_SESSION['success_message'] = $success_message;

                header('location: ' . ADMIN_URL . 'location-view.php');
                exit;

        } catch (Exception $e ) {
            $error_message = $e->getMessage();
        }
    }
    
?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Add Location</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>location-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="location-add.php" method="post" enctype="multipart/form-data">

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
                            <label>Slug</label>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['slag'])) {echo $_POST['slag'];} ?>" name="slag">
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