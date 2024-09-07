<?php require_once('header.php'); ?>
<?php
    if(!isset($_SESSION['agents']))
    {
        header('location: '.BASE_URL.'agent-login');
        exit;
    }
?>
<?php
    $statement = $conn->prepare("SELECT * FROM property WHERE id=?");
    $statement->execute([$_GET['id']]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
?>
<?php
   if(isset($_POST['form_submit']))
   {
        try {
                // IF this agent already added his maximum number of allowed video, he will be redirected to the properties view page and any of the added properties should be removed in order to add a new one or he can upgrade his package
                $statement = $conn->prepare("SELECT * FROM orders 
                JOIN packages ON orders.package_id = packages.id
                WHERE orders.agent_id=? AND orders.currently_active=?");
                $statement->execute([$_SESSION['agents']['id'],1]);
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $allowed_videos = $row['allowed_videos'];
                }

                $statement = $conn->prepare("SELECT * FROM property_video WHERE property_id=?");
                $statement->execute([$_GET['id']]);
                $total_videos = $statement->rowCount();
                if($total_videos == $allowed_videos){
                    throw new Exception("Your reached the maximum limit to add photo. Please delete previous photos to add new one or you can upgrade your package");
                    header('location: ' . BASE_URL . 'agent-property');
                    exit;
                }
            if(empty($_POST['video_id']))
            {
                throw new Exception("Video id cannot be empty");
                
            }
            

                    $statement = $conn->prepare("INSERT INTO property_video (property_id, video_id) VALUES(?, ?)");
                    $statement->execute([$_GET['id'], $_POST['video_id']]);

                    $success_message = 'Video is added successfully';

                    $_SESSION['success_message'] = $success_message;

                    header('location: ' . BASE_URL . 'agent-video-gallery/'.$_GET['id']);
                    exit;
            
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
   }
?>
<?php
    if(isset($_POST['form_delete'])){

        $statement = $conn->prepare("DELETE FROM property_video WHERE id=?");
        $statement->execute([$_POST['gallery_id']]);

        $success_message = 'Video is deleted successfully';
        $_SESSION['success_message'] = $success_message;
        header('location: ' . BASE_URL . 'agent-video-gallery/'.$_GET['id']);
        exit;
    }
?>

<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner.jpg')">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Video  of "<?php echo $result[0]['name']; ?>" </h2>
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
                    <h4>Add Video</h4>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <input type="text" name="video_id" class="form-control" placeholder="Video is Here" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-sm" value="Submit" name="form_submit" />
                            </div>
                        </div>
                    </form>

                    <h4 class="mt-4">Existing Videos</h4>
                    <div class="video-all">
                        <div class="row">
                        <?php
                             $statement = $conn->prepare("SELECT * FROM property_video WHERE property_id=?");
                             $statement->execute([$_GET['id']]);
                             $result1 = $statement->fetchAll(PDO::FETCH_ASSOC);
                             $total = $statement->rowCount();
                             if(!$total)
                             {
                                echo '<div class="text-danger col-md-12"><p>No videos found.</p></div>';
                                }
                             foreach($result1 as $row){
                            ?> 
                                <div class="col-md-6 col-lg-3">
                                <div class="item item-delete">
                                    <a class="video-button" href="http://www.youtube.com/watch?<?php echo $row['video_id']; ?>">
                                        <img src="http://img.youtube.com/vi/<?php echo $row['video_id']; ?>" alt="" />
                                        <div class="icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                        <div class="bg"></div>
                                    </a>
                                </div>
                                <form action="" method="post">
                                        <input type="hidden" name="gallery_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="form_delete" class="badge bg-danger mb_20 custom-delete-button" onClick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                            </div>
                            <?php
                             }
                             ?>
                        
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </div>


<?php require_once('footer.php'); ?>