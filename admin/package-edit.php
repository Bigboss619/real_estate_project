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
         
        if(isset($_POST['form_update']))
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
                    $statement = $conn->prepare("UPDATE packages SET name=?, price=?, allowed_days=?, allowed_properties=?, allowed_feature_properties=?, allowed_photo=?, allowed_videos=? WHERE id=?");
                    $statement->execute([
                        $_POST['name'], 
                        $_POST['price'], 
                        $_POST['allowed_days'], 
                        $_POST['allowed_properties'], 
                        $_POST['allowed_feature_properties'], 
                        $_POST['allowed_photo'], 
                        $_POST['allowed_videos'], 
                        $id
                    ]);

                    $success_message = 'Package updated successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . ADMIN_URL . 'package-edit.php?id=' . $id);
                    exit;

            } catch (Exception $e ) {
                $error_message = $e->getMessage();
            }
        }
        $statement = $conn->prepare("SELECT * FROM packages WHERE id=?");
        $statement->execute([$id]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    ?>

    <div class="main-content">
    <section class="section">
    <div class="section-header justify-content-between">
    <h1>Edit Package</h1>
    <div class="ml-auto">
    <a href="<?php echo ADMIN_URL; ?>package-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
    </div>
    </div>
    <div class="section-body">
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="package-edit.php?id=<?php echo $id; ?>" method="post">

                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $result['0']['name']; ?>">
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Price</label>
                                <input type="text" class="form-control" name="price" value="<?php echo $result['0']['price']; ?>">
                            </div>
                    
                            <div class="form-group mb-3">
                                <label>Allowed Days</label>
                                <input type="text" class="form-control" value="<?php echo $result['0']['allowed_days']; ?>" name="allowed_days">
                            </div>
                            <div class="form-group mb-3">
                                <label>Allowed Properties</label>
                                <input type="text" class="form-control" value="<?php echo $result['0']['allowed_properties']; ?>" name="allowed_properties">
                            </div>

                            <div class="form-group mb-3">
                                <label>Allowed Featured Properties</label>
                                <input type="text" class="form-control" value="<?php echo $result['0']['allowed_feature_properties']; ?>" name="allowed_feature_properties">
                            </div>
                            <div class="form-group mb-3">
                                <label>Allowed Photos</label>
                                <input type="text" class="form-control" value="<?php echo $result['0']['allowed_photo']; ?>" name="allowed_photo">
                            </div>
                            <div class="form-group mb-3">
                                <label>Allowed Videos</label>
                                <input type="text" class="form-control" value="<?php echo $result['0']['allowed_videos']; ?>" name="allowed_videos">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="form_update" class="btn btn-primary">Update</button>
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