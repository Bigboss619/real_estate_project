<?php require_once('header.php'); ?>
<?php
if (!isset($_GET['id']) || !isset($_GET['slug'])) {
    header('location: ' . BASE_URL);
    exit;
}

$id = $_GET['id'];
$slug = $_GET['slug'];
$statement = $conn->prepare("SELECT p.*, l.name as location_name, t.name as type_name, a.fullname, a.email, a.photo as agent_photo, a.company, a.designation, a.phone,
a.website, a.facebook, a.twitter, a.linkedln, a.youtube, a.instagram, a.pinterest
FROM property p
JOIN locations l
ON p.location_id = l.id
JOIN types t
ON p.type_id = t.id
JOIN agents a
ON p.agent_id = a.id
WHERE p.id=? AND p.slug=?");
$statement->execute([$id, $slug]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);
if (!$result) {
    header('location: ' . BASE_URL);
    exit;
}

?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/banner.jpg)">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?php echo $result[0]['name']; ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="property-result pt_50 pb_50">
    <div class="container">
        <div class="row">
<div class="col-lg-8 col-md-12">
<div class="left-item">
<div class="main-photo">
<img src="<?php echo BASE_URL; ?>uploads/property/<?php echo $result[0]['feature_photo']; ?>" alt="">
</div>
<h2>
Description
</h2>
<p><?php echo $result[0]['description']; ?></p>

</div>
<div class="left-item">
<h2>
Photos
</h2>
<div class="photo-all">
<div class="row">
<?php
    $statement3 = $conn->prepare("SELECT * FROM property_photo WHERE property_id=?");
    $statement3->execute([$_GET['id']]);
    $result3 = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result3 as $row3) {
        ?>
            <div class="col-md-6 col-lg-4">
                <div class="item">
                    <a href="uploads/photo1.jpg" class="magnific">
                        <img src="uploads/photo1.jpg" alt="" />
                        <div class="icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="bg"></div>
                    </a>
                </div>
            </div>
        <?php
    }
?>


</div>
</div>
</div>
<div class="left-item">
<h2>
Videos
</h2>
<div class="video-all">
<div class="row">
<div class="col-md-6 col-lg-4">
    <div class="item">
        <a class="video-button" href="http://www.youtube.com/watch?v=j_Y2Gwaj7Gs">
            <img src="http://img.youtube.com/vi/j_Y2Gwaj7Gs/0.jpg" alt="" />
            <div class="icon">
                <i class="far fa-play-circle"></i>
            </div>
            <div class="bg"></div>
        </a>
    </div>
</div>
<div class="col-md-6 col-lg-4">
    <div class="item">
        <a class="video-button" href="http://www.youtube.com/watch?v=BvngUP0sHhQ">
            <img src="http://img.youtube.com/vi/BvngUP0sHhQ/0.jpg" alt="" />
            <div class="icon">
                <i class="far fa-play-circle"></i>
            </div>
            <div class="bg"></div>
        </a>
    </div>
</div>
<div class="col-md-6 col-lg-4">
    <div class="item">
        <a class="video-button" href="http://www.youtube.com/watch?v=deLf6eynC40">
            <img src="http://img.youtube.com/vi/deLf6eynC40/0.jpg" alt="" />
            <div class="icon">
                <i class="far fa-play-circle"></i>
            </div>
            <div class="bg"></div>
        </a>
    </div>
</div>
</div>
</div>
</div>

<div class="left-item mb_50">
<h2>Share</h2>
<div class="share">
<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=[INSERT_URL]&picture=[INSERT_PHOTO]" target="_blank">
Facebook
</a>
<a class="twitter" href="https://twitter.com/share?url=[INSERT_URL]&text=[INSERT_TEXT]" target="_blank">
Twitter
</a>
<a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=[INSERT_URL]&title=[INSERT_TITLE]&summary=[INSERT_SUMMARY]" target="_blank">
LinkedIn
</a>
</div>
</div>


<div class="left-item">
<h2>
Related Properties
</h2>
<div class="property related-property pt_0 pb_0">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="item">
        <div class="photo">
            <img class="main" src="uploads/property1.jpg" alt="">
            <div class="top">
                <div class="status-sale">
                    For Sale
                </div>
                <div class="featured">
                    Featured
                </div>
            </div>
            <div class="price">$56,000</div>
            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
        </div>
        <div class="text">
            <h3><a href="property.html">Sea Side Property</a></h3>
            <div class="detail">
                <div class="stat">
                    <div class="i1">2500 sqft</div>
                    <div class="i2">2 Bed</div>
                    <div class="i3">2 Bath</div>
                </div>
                <div class="address">
                    <i class="fas fa-map-marker-alt"></i> 937 Jamajo Blvd, Orlando FL 32803
                </div>
                <div class="type-location">
                    <div class="i1">
                        <i class="fas fa-edit"></i> Villa
                    </div>
                    <div class="i2">
                        <i class="fas fa-location-arrow"></i> Orland
                    </div>
                </div>
                <div class="agent-section">
                    <img class="agent-photo" src="uploads/agent1.jpg" alt="">
                    <a href="">Robert Johnson (AA Property)</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="item">
        <div class="photo">
            <img class="main" src="uploads/property2.jpg" alt="">
            <div class="top">
                <div class="status-rent">
                    For Rent
                </div>
                <div class="featured">
                    Featured
                </div>
            </div>
            <div class="price">$4,900</div>
            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
        </div>
        <div class="text">
            <h3><a href="property.html">Modern Villa</a></h3>
            <div class="detail">
                <div class="stat">
                    <div class="i1">2500 sqft</div>
                    <div class="i2">2 Bed</div>
                    <div class="i3">2 Bath</div>
                </div>
                <div class="address">
                    <i class="fas fa-map-marker-alt"></i> 2006 E Central Blvd, Orlando FL 32803
                </div>
                <div class="type-location">
                    <div class="i1">
                        <i class="fas fa-edit"></i> Condo
                    </div>
                    <div class="i2">
                        <i class="fas fa-location-arrow"></i> Orland
                    </div>
                </div>
                <div class="agent-section">
                    <img class="agent-photo" src="uploads/agent2.jpg" alt="">
                    <a href="">Eric Williams (BB Property)</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-12">

<div class="right-item">
<h2>Agent</h2>
<div class="agent-right d-flex justify-content-start">
<div class="left">
<img src="<?php echo BASE_URL; ?>uploads/agent-dp/<?php echo $result[0]['agent_photo']; ?>" alt="">
</div>
<div class="right">
<h3><a href=""><?php echo $result[0]['fullname']; ?></a></h3>
<h4><?php echo $result[0]['designation']; ?>, <?php echo $result[0]['company']; ?></h4>
</div>
</div>
<div class="table-responsive mt_25">
<table class="table table-bordered">
<tr>
    <td>Posted On: </td>
    <td><?php echo $result[0]['posted_on']; ?></td>
</tr>
<tr>
    <td>Email: </td>
    <td><?php echo $result[0]['email']; ?></td>
</tr>
<?php if($result[0]['phone'] != ''): ?>
<tr>
    <td>Phone: </td>
    <td><?php echo $result[0]['phone']; ?></td>
</tr>
<?php endif; ?>

<?php if($result[0]['website'] != ''): ?>
<tr>
    <td>Website: </td>
    <td><?php echo $result[0]['website']; ?></td>
</tr>
<?php endif; ?>

<?php if($result[0]['facebook'] != '' || $result[0]['twitter'] != '' || $result[0]['instagram'] != '' || $result[0]['pinterest'] != '' || $result[0]['linkedln'] != '' || $result[0]['youtube'] != ''): ?>
<tr>
    <td>Social: </td>
    <td>
        <ul class="agent-ul">
            
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
    </td>
</tr>
<?php endif; ?>
</table>
</div>
</div>

<div class="right-item">
<h2>Features</h2>
<div class="summary">
<div class="table-responsive">
<table class="table table-bordered">
    <tr>
        <td><b>Price</b></td>
        <td>$<?php echo $result[0]['price']; ?></td>
    </tr>
    <tr>
        <td><b>Location</b></td>
        <td><?php echo $result[0]['location_name']; ?></td>
    </tr>
    <tr>
        <td><b>Type</b></td>
        <td><?php echo $result[0]['type_name']; ?></td>
    </tr>
    <tr>
        <td><b>Status</b></td>
        <td><?php echo $result[0]['purpose']; ?></td>
    </tr>
    <tr>
        <td><b>Bedroom:</b></td>
        <td><?php echo $result[0]['bedroom']; ?></td>
    </tr>
    <tr>
        <td><b>Bathroom:</b></td>
        <td><?php echo $result[0]['bathroom']; ?></td>
    </tr>
    <tr>
        <td><b>Size:</b></td>
        <td><?php echo $result[0]['size']; ?> sqft</td>
    </tr>
    <tr>
        <td><b>Floor:</b></td>
        <td><?php echo $result[0]['floor']; ?></td>
    </tr>
    <tr>
        <td><b>Garage:</b></td>
        <td><?php echo $result[0]['garage']; ?></td>
    </tr>
    <tr>
        <td><b>Balcony:</b></td>
        <td><?php echo $result[0]['balcony']; ?></td>
    </tr>
    <tr>
        <td><b>Address:</b></td>
        <td><?php echo $result[0]['Address']; ?></td>
    </tr>
    <tr>
        <td><b>Built Year:</b></td>
        <td><?php echo $result[0]['built_year']; ?></td>
    </tr>
</table>
</div>
</div>
</div>

<div class="right-item">
<h2>Amenities</h2>
<div class="amenity">
<ul class="amenity-ul">
    <?php
        $i = 0;
        $temp_arr = array_map('intval', array_map('trim', explode(',', $result[0]['amenities'])));
        $statement = $conn->prepare("SELECT * FROM amenities ORDER BY name ASC");
        $statement->execute();
        $result1 = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result1 as $row) {
            if (in_array($row['id'], $temp_arr)) {
                echo '<li><i class="fas fa-check-square"></i> ' .$row['name'].'</li>';
            }
        }
    ?>
</ul>
</div>
</div>

<div class="right-item">
<h2>Location Map</h2>
<div class="location-map">
<?php echo $result[0]['map']; ?>
</div>
</div>

<div class="right-item">
<h2>Enquery Form</h2>
<div class="enquery-form">
<form action="" method="post">
<div class="mb-3">
    <input type="text" class="form-control" placeholder="Full Name" />
</div>
<div class="mb-3">
    <input type="email" class="form-control" placeholder="Email Address" />
</div>
<div class="mb-3">
    <input type="text" class="form-control" placeholder="Phone Number" />
</div>
<div class="mb-3">
    <textarea class="form-control h-150" rows="3" placeholder="Message"></textarea>
</div>
<div class="mb-3">
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
</div>
</form>
</div>
</div>


</div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>