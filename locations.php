<?php require_once('header.php'); ?>

<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/banner.jpg)">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Location: Boston</h2>
            </div>
        </div>
    </div>
</div>
<div class="property">
    <div class="container">
        <div class="row">
            <?php
                $statement = $conn->prepare("SELECT * FROM locations WHERE slag=?");
                $statement->execute([$_GET['slug']]);
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                $id = $row['id'];
                }
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
                     WHERE p.location_id=?");
                $statement->execute([$id]);
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $total = $statement->rowCount();
                if (!$total) {
                ?>
                    <div class="col-md-12">
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
                        <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
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
                                <a href=""><?php echo $row['fullname']; ?>(<?php echo $row['company']; ?>))</a>
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