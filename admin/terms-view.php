<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
    <?php

        // $id = $_GET['id'];                   

                
        if(isset($_POST['form_submit']))
        {

            try {
                    if($_POST['terms'] == "")
                    {
                        throw new Exception("Terms cannot be empty" );
                    }
                     
                    $statement = $conn->prepare("UPDATE terms_privacy_items SET terms=? WHERE id=?");
                    $statement->execute([
                        $_POST['terms'],  
                        1
                    ]);

                    $success_message = 'Data is updated successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . ADMIN_URL . 'terms-view.php');
                    exit;

            } catch (Exception $e ) {
                $error_message = $e->getMessage();
            }
        }

       
    ?>
    <?php
        
        $statement = $conn->prepare("SELECT * FROM terms_privacy_items WHERE id=?");
        $statement->execute([1]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $terms = $result[0]['terms'];
    ?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Edit Terms Page Content</h1>
<div class="ml-auto">

</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                        <div class="form-group mb-3">
                            <label>Content</label>
                            <textarea class="form-control editor" name="terms" id="" rows="3"><?php echo $terms; ?></textarea>
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