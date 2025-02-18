<?php
require_once('header.php');
?>
<?php
    if(!isset($_SESSION['agents']))
    {
        header('location: '.BASE_URL.'agent-login');
        exit;
    }
?>
  <div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/settings/banner.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Messages</h2>
                </div>
            </div>
        </div>
</div>
<div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <?php require_once('agent-sidebar.php'); ?>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SL</th>
                                    <th>Subject</th>
                                    <th>Customer</th>
                                    <th>Posted On</th>
                                    <th class="w-100">Action</th>
                                </tr>
                                <?php
                                    $i=0;
                                    $statement = $conn->prepare("SELECT m.*, m.id as message_id, c.fullname
                                     FROM messages m
                                    JOIN customer c
                                    ON m.customer_id = c.id
                                    WHERE m.agent_id=?
                                    ");
                                    $statement->execute([$_SESSION['agents']['id']]);
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        $i++;
                                        ?>
                                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['subject']; ?></td>
                                    <td><?php echo $row['fullname']; ?></td>
                                    <td><?php echo $row['posted_on']; ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>agent-message/<?php echo $row['message_id']; ?>" class="btn btn-primary btn-sm text-white"><i class="fas fa-eye"></i></a>

                                    </td>
                                </tr>
                                        <?php
                                    }
                                 ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>