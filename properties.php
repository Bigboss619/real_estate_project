<?php require_once('header.php'); ?>
<?php
    // For Property Name
    if(!empty($_GET['name']))
    {
        $property_name = '%' . $_GET['name'] . '%';
        $c_name = ' AND p.name LIKE \''.$property_name.'\'';
    }
    else
    {
        $c_name = '';
    }
    // For Location
    if(!empty($_GET['location_id']))
    {
        if($_GET['location_id'] == 'All Locations'){
            $c_location_id = '';
        }
        else
        {
            $c_location_id = ' AND location_id='.$_GET['location_id'];
        }
    }
    else
    {
        $c_location_id = '';
    }

    // For Type
    if(!empty($_GET['type_id']))
    {
        if($_GET['type_id'] == 'All Types'){
            $c_type_id = '';
        }
        else
        {
            $c_type_id = ' AND type_id='.$_GET['type_id'];
        }
    }
    else
    {
        $c_type_id = '';
    }

    // For Amenities
    if(!empty($_GET['amenity_id']))
    {
        if($_GET['amenity_id'] == 'All Amenities'){
            $c_amenity_id = '';
        }
        else
        {
            $c_amenity_id = ' AND FIND_IN_SET("'.$_GET['amenity_id'].'", amenities) > 0';
        }
    }
    else
    {
        $c_amenity_id = '';
    }

    // For Purpose
    if(!empty($_GET['purpose']))
    {
        if($_GET['purpose'] == 'All Purposes'){
            $c_purpose = '';
        }
        else
        {
            $c_purpose = ' AND purpose=\''.$_GET['purpose'].'\'';
        }
    }
    else
    {
        $c_purpose = '';
    }
    
    // For Bathroom
    if(!empty($_GET['bathroom']))
    {
        if($_GET['bathroom'] == 'All Bathrooms'){
            $c_bathroom = '';
        }
        else
        {
            $c_bathroom = ' AND bathroom='.$_GET['bathroom'];
        }
    }
    else
    {
        $c_bathroom = '';
    }

    // For Bedroom
    if(!empty($_GET['bedroom']))
    {
        if($_GET['bedroom'] == 'All Bedrooms'){
            $c_bedroom = '';
        }
        else
        {
            $c_bedroom = ' AND bedroom='.$_GET['bedroom'];
        }
    }
    else
    {
        $c_bedroom = '';
    }

     // For Price
     if(!empty($_GET['price']))
     {
         if($_GET['price'] == 'All Prices'){
             $c_price = '';
         }
         else
         {
            list($minprice, $maxprice) = explode('-', $_GET['price']);
             $c_price = ' AND price >= '.$minprice. ' AND price <= '.$maxprice;
         }
     }
     else
     {
         $c_price = '';
     }

?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/banner.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Property Listing</h2>
                </div>
            </div>
        </div>
</div>
<div class="property-result">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="property-filter">
                        <form action="" method="GET">
                        <div class="widget">
                            <h2>Find Anything</h2>
                            <input type="text" name="name" class="form-control" placeholder="Property Name" value="<?php if(isset($_GET['name'])) {echo $_GET['name'];} ?>" />
                        </div>

                        <div class="widget">
                            <h2>Location</h2>
                            <select name="location_id" class="form-select select2" onchange="this.form.submit()">
                            <option value="">All Location</option>
                                <?php
                                    $statement = $conn->prepare("SELECT * FROM locations ORDER BY name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) 
                                    {
                                        ?>
                                          <option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['location_id']))
                                           { if($_GET['location_id'] == $row['id']) {echo 'selected';} }?>>
                                            <?php echo $row['name']; ?></option>

                                        <?php
                                    }
                                            ?>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Type</h2>
                            <select name="type_id" class="form-select select2" onchange="this.form.submit()">
                            <option value="">All Types</option>
                                <?php
                                    $statement = $conn->prepare("SELECT * FROM types ORDER BY name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) 
                                    {
                                        ?>
                                          <option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['type_id']))
                                           { if($_GET['type_id'] == $row['id']) {echo 'selected';} }?>>
                                            <?php echo $row['name']; ?></option>

                                        <?php
                                    }
                                            ?>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Purpose</h2>
                            <select name="purpose" class="form-control select2" onchange="this.form.submit()">
                                <option value="">All Purposes</option>
                                <option value="Rent" <?php if(isset($_GET['purpose'])) {if($_GET['purpose'] == 'Rent') {echo 'selected';} } ?>>Rent</option>
                                <option value="Sale" <?php if(isset($_GET['purpose'])) {if($_GET['purpose'] == 'Sale') {echo 'selected';} } ?>>Sale</option>
                            </select>
                        </div>

        <div class="widget">
            <h2>Amenities</h2>
                <select name="amenity_id" class="form-select select2" onchange="this.form.submit()">
                <option value="">All Amenities</option>
                    <?php
                        $statement = $conn->prepare("SELECT * FROM amenities ORDER BY name ASC");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) 
                        {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['amenity_id']))
                                { if($_GET['amenity_id'] == $row['id']) {echo 'selected';} }?>>
                                <?php echo $row['name']; ?></option>

                            <?php
                        }
                    ?>
                </select>
        </div>

                        <div class="widget">
                            <h2>Bedrooms</h2>
                            <select name="bedroom" class="form-control select2" onchange="this.form.submit()">
                                <option value="">All Bedrooms-</option>
                                <?php
                                    for ($i=1; $i<=10; $i++) { 
                                    //    echo '<option value="'.$i.'">'.$i.'</option>';
                                       ?>
                                             <option value="<?php echo $i ?>"<?php if(isset($_GET['bedroom']))
                                            { if($_GET['bedroom'] == $i) {echo 'selected';} } ?>><?php echo $i ?></option>
                                        <?php
                                    }
                                 ?>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Bathrooms</h2>
                            <select name="bathroom" class="form-control select2" onchange="this.form.submit()">
                                <option value="">All Bathrooms</option>
                                <?php
                                    for ($i=1; $i<=10; $i++) { 
                                        ?>
                                            <option value="<?php echo $i ?>"<?php if(isset($_GET['bathroom']))
                                            { if($_GET['bathroom'] == $i) {echo 'selected';} } ?>><?php echo $i ?></option>
                                        <?php
                                    }
                                 ?>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Price</h2>
                            <select name="price" class="form-control select2" onchange="this.form.submit()">
                                <option value="">All Prices</option>
                                <option value="1-5000" <?php if(isset($_GET['price'])) {if($_GET['price'] == '1-5000') {echo 'selected';} } ?>>$1-$5000</option>
                                <option value="5001-10000" <?php if(isset($_GET['price'])) {if($_GET['price'] == '5001-10000') {echo 'selected';} } ?>>$5001-$10000</option>
                                <option value="10001-120000" <?php if(isset($_GET['price'])) {if($_GET['price'] == '10001-120000') {echo 'selected';} } ?>>$10001-$120000</option>
                            </select>
                        </div>



                        <div class="filter-button">
                            <input type="hidden" name="p" value="1">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                    </div>
                </div>
<div class="col-lg-8 col-md-12">
<div class="property">
<div class="container">
<div class="row">
<!-- Basic Pagination  -->
<!-- Basic Pagination -->
<?php
$query = ''; // Your existing query logic here
$query = $c_location_id . $c_type_id . $c_amenity_id . $c_purpose . $c_bathroom . $c_bedroom . $c_price . $c_name;

$per_page = 4; // Number of items per page
$q = $conn->prepare("SELECT p.*,
    l.name as location_name,
    t.name as type_name,
    a.fullname, a.company, a.photo
    FROM property p
    JOIN locations l ON p.location_id = l.id
    JOIN types t ON p.type_id = t.id
    JOIN agents a ON p.agent_id = a.id
    WHERE 1=1 " . $query . " AND p.agent_id NOT IN(
-- Removes agent post when there packages expires
    SELECT a.id FROM agents a
    JOIN orders o
    ON a.id = o.agent_id
    WHERE o.expire_date < ? AND o.currently_active = ?
    )ORDER BY p.is_featured DESC");
$q->execute([date('Y-m-d'),1]);

$total = $q->rowCount(); // Total records
$total_pages = ceil($total / $per_page); // Total pages
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1; // Current page
$start = ($page - 1) * $per_page; // Start index for pagination

// Fetch all records
$res = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($res as $key => $row): ?>
    <?php if ($key < $start || $key >= $start + $per_page) continue; // Pagination logic ?>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="item">
            <div class="photo">
                <img class="main" src="<?php echo BASE_URL; ?>uploads/property/<?php echo $row['feature_photo']; ?>" alt="">
                <div class="top">
                    <div class="status-<?php echo ($row['purpose'] == 'Rent') ? 'rent' : 'sale'; ?>">
                        For <?php echo $row['purpose']; ?>
                    </div>
                    <?php if ($row['is_featured'] == 'Yes'): ?>
                        <div class="featured">Featured</div>
                    <?php endif; ?>
                </div>
                <div class="price"><?php echo $row['price']; ?></div>
                <div class="wishlist"><a href="<?php echo BASE_URL; ?>customer-wishlist-add.php?id=<?php echo $row['id']; ?>"><i class="far fa-heart"></i></a></div>
            </div>
            <div class="text">
                <h3><a href="<?php echo BASE_URL; ?>single-property/<?php echo $row['id']; ?>/<?php echo $row['slug']; ?>"><?php echo $row['name']; ?></a></h3>
                <div class="detail">
                    <div class="stat">
                        <div class="i1"><?php echo $row['size']; ?></div>
                        <div class="i2"><?php echo $row['bedroom']; ?> Bed</div>
                        <div class="i3"><?php echo $row['bathroom']; ?> Bath</div>
                    </div>
                    <div class="address">
                        <i class="fas fa-map-marker-alt"></i> <?php echo $row['Address']; ?>
                    </div>
                    <div class="type-location">
                        <div class="i1">
                            <i class="fas fa-edit"></i> <?php echo $row['location_name']; ?>
                        </div>
                        <div class="i2">
                            <i class="fas fa-location-arrow"></i> <?php echo $row['type_name']; ?>
                        </div>
                    </div>
                    <div class="agent-section">
                        <img class="agent-photo" src="<?php echo BASE_URL; ?>uploads/agent-dp/<?php echo empty($row['photo']) ? 'default.png' : $row['photo']; ?>" alt="">
                        <a href=""><?php echo $row['fullname']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="pagination"> <!-- Start pagination section -->
    <?php
    $common_url_part = BASE_URL.'properties.php?name='.$_GET['name'].'&location_id='.$_GET['location_id'].'&type_id='.$_GET['type_id'].'&amenity_id='.$_GET['amenity_id'].'&purpose='.$_GET['purpose'].'&bedroom='.$_GET['bedroom'].'&bathroom='.$_GET['bathroom'].'&price='.$_GET['price'];
     if ($total > $per_page): ?>
        
        <!-- Previous button -->
        <?php if ($page > 1): ?>
            <a class="links-pagina" href="<?php echo $common_url_part . '&p=' . ($page - 1); ?>"> << </a>
        <?php else: ?>
            <a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> << </a>
        <?php endif; ?>

        <!-- Page numbers -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a class="links-pagina <?php echo ($i == $page) ? 'active' : ''; ?>" href="<?php echo $common_url_part . '&p=' . $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <!-- Next button -->
        <?php if ($page < $total_pages): ?>
            <a class="links-pagina" href="<?php echo $common_url_part . '&p=' . ($page + 1); ?>"> >> </a>
        <?php else: ?>
            <a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> >> </a>
        <?php endif; ?>
    <?php endif; ?>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once('footer.php'); ?>