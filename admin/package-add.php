<?php require_once('top.php'); ?>
<?php
    if(isset($_POST['form_submit']))
    {
        try {
                if($_POST['name'] == "")
                {
                    throw new Exception("Name cannot be empty" );
                }
                if($_POST['price'] == "")
                {
                    throw new Exception("Price cannot be empty");
                    
                }
                if($_POST['allowed_days'] == "")
                {
                    throw new Exception("Allowed_days cannot be empty");
                    
                }
                if($_POST['allowed_properties'] == "")
                {
                    throw new Exception("Allowed Properties cannot be empty");
                    
                }
                if($_POST['allowed_feature_properties'] == "")
                {
                    throw new Exception("Allowed Features Properties cannot be empty");
                    
                }
                if($_POST['allowed_photo'] == "")
                {
                    throw new Exception("Allowed Photo cannot be empty");
                    
                }
                if($_POST['allowed_videos'] == "")
                {
                    throw new Exception("Allowed Videos cannot be empty");
                    
                }
                $statement = $conn->prepare("INSERT INTO packages (name, price, allowed_days, allowed_properties, allowed_feature_properties, allowed_photo, allowed_videos) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $statement->execute([$_POST['name'], $_POST['price'], $_POST['allowed_days'], $_POST['allowed_properties'], $_POST['allowed_feature_properties'], $_POST['allowed_photo'], $_POST['allowed_videos']]);

                $success_message = 'Package is added successfully';

                $_SESSION['success_message'] = $success_message;

                header('location: ' . ADMIN_URL . 'package-add.php');
                exit;

        } catch (Exception $e ) {
            $error_message = $e->getMessage();
        }
    }
    
?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Add Package</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>package-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="package-add.php" method="post">

                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>">
                        </div>
    
                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="<?php if(isset($_POST['price'])) {echo $_POST['price'];} ?>">
                        </div>
                
                        <div class="form-group mb-3">
                            <label>Allowed Days</label>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['allowed_days'])) {echo $_POST['allowed_days'];} ?>" name="allowed_days">
                        </div>
                        <div class="form-group mb-3">
                            <label>Allowed Properties</label>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['allowed_properties'])) {echo $_POST['allowed_properties'];} ?>" name="allowed_properties">
                        </div>

                        <div class="form-group mb-3">
                            <label>Allowed Featured Properties</label>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['allowed_feature_properties'])) {echo $_POST['allowed_feature_properties'];} ?>" name="allowed_feature_properties">
                        </div>
                        <div class="form-group mb-3">
                            <label>Allowed Photos</label>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['allowed_photo'])) {echo $_POST['allowed_photo'];} ?>" name="allowed_photo">
                        </div>
                        <div class="form-group mb-3">
                            <label>Allowed Videos</label>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['allowed_videos'])) {echo $_POST['allowed_videos'];} ?>" name="allowed_videos">
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