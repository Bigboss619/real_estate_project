<?php require_once('header.php'); ?>

<?php
// This code is to allow only active agent with active order to show on the page with his uploads
$allowed_agents = [];
$q = $conn->prepare("SELECT agent_id FROM orders WHERE expire_date >= CURDATE() AND currently_active=?");
$q->execute([1]);
$result = $q->fetchAll();
foreach($result  as $row){
    $allowed_agents[] = $row['agent_id'];
}
if(!in_array($_GET['id'],$allowed_agents)){
    header('Location: ' . BASE_URL );
    exit;
}
?>

<?php
$statement = $conn->prepare("SELECT * FROM agents WHERE id=?");
$statement->execute([$_GET['id']]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
$statement22 = $conn->prepare("SELECT * FROM settings WHERE id=?");
$statement22->execute([1]);
$result22 = $statement22->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/settings/<?php echo $result22[0]['banner']; ?>)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo $result[0]['fullname']; ?></h2>
                </div>
            </div>
        </div>
</div>
<div class="agent-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner">
                        <div class="photo">
                            <img src="<?php echo BASE_URL; ?>uploads/agent-dp/<?php echo $result[0]['photo']; ?>" alt="">
                        </div>
                        <div class="detail">
                            <h3><?php echo $result[0]['fullname']; ?></h3>

                            <?php if($result[0]['designation'] != '' && $result[0]['company'] != ''): ?>
                            <h4><?php echo $result[0]['designation']; ?>, <?php echo $result[0]['company']; ?></h4>
                            <p><?php echo $result[0]['biography']; ?></p>
                            <?php endif; ?>
                           
                            <div class="contact d-flex justify-content-center">
                                <?php if($result[0]['address'] != ''): ?>
                                <div class="item"><i class="fas fa-map-marker-alt"></i> <?php echo $result[0]['address']; ?>, <?php echo $result[0]['city']; ?>, <?php echo $result[0]['estate']; ?>, <?php echo $result[0]['zip_code']; ?></div>
                                <?php endif; ?>

                                <?php if($result[0]['phone'] != ''): ?>
                                <div class="item"><i class="fas fa-phone"></i> <?php echo $result[0]['phone']; ?></div>
                                <?php endif; ?>

                                <?php if($result[0]['email'] != ''): ?>
                                <div class="item"><i class="far fa-envelope"></i> <?php echo $result[0]['email']; ?></div>
                                <?php endif; ?>

                                <?php if($result[0]['website'] != ''): ?>
                                <div class="item"><i class="fas fa-globe"></i> <?php echo $result[0]['website']; ?></div>
                                <?php endif; ?>
                            </div>
                            <?php if($result[0]['facebook'] != '' || $result[0]['twitter'] != '' || $result[0]['instagram'] != '' || $result[0]['pinterest'] != '' || $result[0]['linkedln'] != '' || $result[0]['youtube'] != ''): ?>
                            <ul class="agent-detail-ul">
                            <?php if($result[0]['facebook'] != ''): ?>
            <li><a href="<?php echo $result[0]['facebook']; ?>"><i class="fab fa-facebook-f"></i></a></li>
            <?php endif; ?>

            <?php if($result[0]['twitter'] != ''): ?>
            <li><a href="<?php echo $result[0]['twitter']; ?>"><i class="fab fa-twitter"></i></a></li>
            <?php endif; ?>

            <?php if($result[0]['instagram'] != ''): ?>
            <li><a href="<?php echo $result[0]['instagram']; ?>"><i class="fab fa-instagram"></i></a></li>
            <?php endif; ?>

            <?php if($result[0]['pinterest'] != ''): ?>
            <li><a href="<?php echo $result[0]['pinterest']; ?>"><i class="fab fa-pinterest-p"></i></a></li>
            <?php endif; ?>

            <?php if($result[0]['linkedln'] != ''): ?>
            <li><a href="<?php echo $result[0]['linkedln']; ?>"><i class="fab fa-linkedin-in"></i></a></li>
            <?php endif; ?>
            
            <?php if($result[0]['youtube'] != ''): ?>
            <li><a href="<?php echo $result[0]['youtube']; ?>"><i class="fab fa-youtube"></i></a></li>
            <?php endif; ?>
                            </ul>
            <?php endif; ?>                
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="property">
        <div class="container">
            <div class="row">

                <?php
      
                     $statement = $conn->prepare("SELECT p.*,
                     l.name as location_name,
                     t.name as type_name,
                     a.fullname, a.company, a.photo as agent_photo
                     FROM property p
                      JOIN locations l 
                      ON p.location_id = l.id 
                      JOIN types t 
                      ON p.type_id = t.id
                      JOIN agents a
                      ON p.agent_id = a.id
                     WHERE p.agent_id=?");
                $statement->execute([$_GET['id']]);
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $total = $statement->rowCount();
                if (!$total) {
                ?>
                    <div class="col-md-12 text-danger text-center">
                        No Property Found
                    </div>
                    <?php
                } else {
                    foreach ($result as $row) {
                    ?>
                                          <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="item">
                    <div class="photo">
                        <img class="main" src="<?php echo BASE_URL; ?>uploads/property/<?php echo $row['feature_photo']; ?>" alt="">
                        <div class="top">
                            <div class="status-<?php if ($row['purpose'] == 'Rent') {echo 'rent';} else {echo 'sale';} ?>">
                                For <?php echo $row['purpose']; ?>
                            </div>
                            <?php if($row['is_featured'] == 'Yes'): ?>
                                <div class="featured">
                                    Featured
                                </div>
                             <?php endif; ?>   
                        </div>
                        <div class="price">$<?php echo $row['price']; ?></div>
                        <div class="wishlist"><a href="<?php echo BASE_URL; ?>customer-wishlist-add.php?id=<?php echo $row['id']; ?>"><i class="far fa-heart"></i></a></div>
                    </div>
                    <div class="text">
                        <h3><a href="<?php echo BASE_URL; ?>single-property/<?php echo $row['id']; ?>/<?php echo $row['slug']; ?>"><?php echo $row['name']; ?></a></h3>
                        <div class="detail">
                            <div class="stat">
                                <div class="i1"><?php echo $row['size']; ?> sqft</div>
                                <div class="i2"><?php echo $row['bedroom']; ?> Bed</div>
                                <div class="i3"><?php echo $row['bathroom']; ?> Bath</div>
                            </div>
                            <div class="address">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $row['Address']; ?>
                            </div>
                            <div class="type-location">
                                <div class="i1">
                                    <i class="fas fa-edit"></i><?php echo $row['type_name']; ?>
                                </div>
                                <div class="i2">
                                    <i class="fas fa-location-arrow"></i> <?php echo $row['location_name']; ?>
                                </div>
                            </div>
                            <div class="agent-section">
                                        <?php if (empty($row['agent_photo'])): ?>
                                            <img class="agent-photo" src="<?php echo BASE_URL; ?>uploads/agent-dp/default.png" alt="">
                                        <?php else: ?>
                                            <img class="agent-photo" src="<?php echo BASE_URL; ?>uploads/agent-dp/<?php echo $row['agent_photo']; ?>" alt="">
                                        <?php endif; ?>
                                <a href="<?php echo BASE_URL; ?>agent/<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?>(<?php echo $row['company']; ?>)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>