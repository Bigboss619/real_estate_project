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

                
        if(isset($_POST['faq_edit']))
        {

            try {
                    if($_POST['question'] == "")
                    {
                        throw new Exception("Question cannot be empty" );
                    }
                    if($_POST['answer'] == "")
                    {
                        throw new Exception("Answer cannot be empty" );
                    }
                       
                    $statement = $conn->prepare("UPDATE faqs SET question=?, answer=? WHERE id=?");
                    $statement->execute([
                        $_POST['question'],  
                        $_POST['answer'],  
                        $id
                    ]);

                    $success_message = 'FAQ is updated successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . ADMIN_URL . 'faq-view.php');
                    exit;

            } catch (Exception $e ) {
                $error_message = $e->getMessage();
            }
        }

       
    ?>
    <?php
        
        $statement = $conn->prepare("SELECT * FROM faqs WHERE id=?");
        $statement->execute([$id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $question = $result['question'];
        $answer = $result['answer'];
    ?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Edit FAQ</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>faq-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="faq-edit.php?id=<?php echo $id ?>" method="post">
                        <div class="form-group mb-3">
                            <label>Question</label>
                            <input type="text" class="form-control" name="question" value="<?php echo $question; ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label>Answer</label>
                            <textarea class="form-control editor" name="answer" id="" rows="3"><?php echo $answer; ?></textarea>
                        </div>
                
                       
                        <div class="form-group">
                            <button type="submit" name="faq_edit" class="btn btn-primary">Submit</button>
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