<?php require_once('top.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
    header('location: ' . ADMIN_URL . 'login.php');
    exit;
}
$statement = $conn->prepare("SELECT m.*, c.fullname as customer_name, c.photo as customer_photo, c.email as customer_email, a.fullname as agent_name, a.photo as agent_photo, a.email as agent_email
FROM messages m
JOIN customer c
ON m.customer_id = c.id
JOIN agents a
ON m.agent_id = a.id
WHERE m.id=?");
$statement->execute([$_GET['id']]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Subject: <?php echo $result[0]['subject']; ?></h1>
            <div class="ml-auto">
                <a href="<?php echo ADMIN_URL; ?>message-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Prevoius</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <h3 class="message-heading" style="font-size: 20px;font-weight:700;margin-bottom:10px;margin-top:30px;">
                            Main Heading
                            </h3>
                        </div>
                        <div class="message-item" style="margin-bottom:40px;background:#e1e5f7;padding:10px;">

                        <div class="message-top">
                            <div class="photo" style="display:inline-block;">
                                <img src="<?php echo BASE_URL;?>uploads/customer-dp/<?php echo $result[0]['customer_photo']; ?>" class="img-fluid rounded-circle" style="width:60px;height:60px;vertical-align:middle;" alt="">
                                <div class="text" style="display:inline-block;vertical-align:middle;margin-left:10px;;">
                                    <h6 style="margin-top: 10px;font-size:16px;font-weight:700;margin-bottom:5px;"><?php echo $result[0]['customer_name']; ?> <span class="badge rounded-pill text-bg-primary">Customer</span></h6>
                                    <p class="mt-3 mb-0" style="color: #838383;">Posted On: <?php echo $result[0]['posted_on']; ?></p>
                                </div>
                            </div>
                        </div>
                       
                        <div class="message-bottom mt-5">
                            <p><?php echo $result[0]['message']; ?></p>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h3 class="message-heading" style="font-size: 20px;font-weight:700;margin-bottom:10px;margin-top:30px;">
                            All Replies
                            </h3>
                        </div>
                        
                            <?php
                            $statement = $conn->prepare("SELECT
                            mr.*, c.fullname as customer_name, c.photo as customer_photo, c.email as customer_email, a.fullname as agent_name, a.photo as agent_photo, a.email as agent_email
                            FROM message_replies mr
                            JOIN customer c
                            ON mr.customer_id = c.id
                            JOIN agents a
                            ON mr.agent_id = a.id
                            WHERE mr.message_id=? 
                            ORDER BY mr.id ASC");
                            $statement->execute([$_GET['id']]);
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
                            $total = $statement->rowCount();
                            if(!$total){
                                echo '<div class="message-item text-danger">No reply found</div>';
                            }
                            foreach($result as $row){
                                ?>
                                    <div class="message-item" style="margin-bottom:40px;background:#e1e5f7;padding:10px;border:1px solid #7b7b7b;">

                                        <div class="message-top">
                                            <div class="photo" style="display:inline-block;">
                                                <?php 
                                                if($row['sender'] == 'Customer'):
                                                ?>
                                                <img src="<?php echo BASE_URL;?>uploads/customer-dp/<?php echo $row['customer_photo']; ?>" class="img-fluid rounded-circle" style="width:60px;height:60px;vertical-align:middle;" alt="">
                                                <?php endif; ?>

                                                <?php 
                                                if($row['sender'] == 'Agent'):
                                                ?>
                                                <img src="<?php echo BASE_URL;?>uploads/agent-dp/<?php echo $row['agent_photo']; ?>" class="img-fluid rounded-circle" style="width:60px;height:60px;vertical-align:middle;" alt="">
                                                <?php endif; ?>

                                                <div class="text" style="display:inline-block;vertical-align:middle;margin-left:10px;;">
                                                    <h6 style="margin-top: 10px;font-size:16px;font-weight:700;margin-bottom:5px;">
                                                    <?php 
                                                        if($row['sender'] == 'Customer'):
                                                    ?>
                                                        <?php echo $row['customer_name']; ?>
                                                        <span class="badge rounded-pill text-bg-primary">Customer</span>
                                                        <?php else: ?>
                                                            <?php echo $row['agent_name']; ?>
                                                            <span class="badge rounded-pill text-bg-success">Agent</span>
                                                        <?php endif; ?>
                                                    </h6>
                                                    <p class="mt-3 mb-0" style="color: #838383;">Posted On: <?php echo $row['reply_on']; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="message-bottom mt-5">
                                            <p><?php echo $row['reply']; ?></p>
                                        </div>
                                    </div>
                                <?php
                            }  
                        ?>

                        

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once('footer.php'); ?>