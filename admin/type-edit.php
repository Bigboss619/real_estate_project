<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
    <?php

        $id = $_GET['id'];                   

                
        if(isset($_POST['type_edit']))
        {

            try {
                    if($_POST['name'] == "")
                    {
                        throw new Exception("Name cannot be empty" );
                    }
                    $statement = $conn->prepare("SELECT * FROM types WHERE name=? AND id!=?");
                    $statement->execute([$_POST['name'],$_GET['id']]);
                    $total = $statement->rowCount();
                    if($total > 0)
                    {
                        throw new Exception("Name Already Exist");            
                    }   
                    $statement = $conn->prepare("UPDATE types SET name=? WHERE id=?");
                    $statement->execute([
                        $_POST['name'],  
                        $id
                    ]);

                    $success_message = 'Type is updated successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . ADMIN_URL . 'type-view.php');
                    exit;

            } catch (Exception $e ) {
                $error_message = $e->getMessage();
            }
        }

       
    ?>
    <?php
        
        $statement = $conn->prepare("SELECT * FROM types WHERE id=?");
        $statement->execute([$id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $name = $result['name'];
    ?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Edit Types</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>type-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="type-edit.php?id=<?php echo $id ?>" method="post">
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                        </div>
                
                       
                        <div class="form-group">
                            <button type="submit" name="type_edit" class="btn btn-primary">Submit</button>
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