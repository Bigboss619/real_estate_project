<?php require_once('top.php'); ?>

<?php
    if(isset($_POST['form_submit']))
    {
        try {
                if($_POST['name'] == "")
                {
                    throw new Exception("Name cannot be empty" );
                }
               
               

                $statement = $conn->prepare("INSERT INTO types (name) VALUES(?)");
                $statement->execute([$_POST['name']]);

                $success_message = 'Type is added successfully';

                $_SESSION['success_message'] = $success_message;

                header('location: ' . ADMIN_URL . 'type-view.php');
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
<a href="<?php echo ADMIN_URL; ?>type-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="type-add.php" method="post">
    
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>">
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