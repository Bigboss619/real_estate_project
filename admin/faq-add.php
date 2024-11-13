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
                if($_POST['question'] == "")
                {
                    throw new Exception("Question cannot be empty" );
                }
                if($_POST['answer'] == "")
                {
                    throw new Exception("Answer cannot be empty" );
                }

                $statement = $conn->prepare("INSERT INTO faqs (question, answer) VALUES(?, ?)");
                $statement->execute([$_POST['question'], $_POST['answer']]);

                $success_message = 'FAQ is added successfully';

                $_SESSION['success_message'] = $success_message;

                header('location: ' . ADMIN_URL . 'faq-view.php');
                exit;

        } catch (Exception $e ) {
            $error_message = $e->getMessage();
        }
    }
    
?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Add FAQ</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>faq-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="faq-add.php" method="post">
    
                        <div class="form-group mb-3">
                            <label>Question</label>
                            <input type="text" class="form-control" name="question" value="<?php if(isset($_POST['question'])) {echo $_POST['question'];} ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Answer</label>
                                <textarea class="form-control editor" name="answer" id="" rows="3"><?php if(isset($_POST['answer'])) {echo $_POST['answer'];} ?></textarea>
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