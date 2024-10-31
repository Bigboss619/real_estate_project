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
                    if($_POST['heading'] == "")
                    {
                        throw new Exception("Heading cannot be empty" );
                    }
                    if($_POST['text'] == "")
                    {
                        throw new Exception("Text cannot be empty" );
                    }
                    if($_POST['icon'] == "")
                    {
                        throw new Exception("Icons cannot be empty" );
                    }
                             
                    $statement = $conn->prepare("UPDATE why_choose_items SET heading=?, text=?, icon=? WHERE id=?");
                    $statement->execute([
                        $_POST['heading'],  
                        $_POST['text'],  
                        $_POST['icon'],  
                        $id
                    ]);

                    $success_message = 'Why Choose item is updated successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . ADMIN_URL . 'why-choose-view.php');
                    exit;

            } catch (Exception $e ) {
                $error_message = $e->getMessage();
            }
        }

       
    ?>
    <?php
        $statement = $conn->prepare("SELECT * FROM why_choose_items WHERE id=?");
        $statement->execute([$id]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Edit Why Choose Item</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>why-choose-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="why-choose-edit.php?id=<?php echo $id ?>" method="post">
                        <div class="form-group mb-3">
                            <label>Heading</label>
                            <input type="text" class="form-control" name="heading" value="<?php echo $result[0]['heading']; ?>">
                        </div>

                        <div class="form-group mb-3">
                                <label for="" class="form-label">Text</label>
                                <textarea class="form-control h_100" name="text" id="" rows="3" ><?php echo $result[0]['text']; ?></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="icon" value="<?php echo $result[0]['icon']; ?>">
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