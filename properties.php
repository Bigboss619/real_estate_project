<?php require_once('header.php'); ?>
<?php
    // Incase no type or location is selected(Display all types)
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
?>
<div class="page-top" style="background-image: url('uploads/banner.jpg')">
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
                            <input type="text" name="" class="form-control" placeholder="Search Titles ..." />
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
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">For Rent</option>
                                <option value="">For Sale</option>
                            </select>
                        </div>

        <div class="widget">
            <h2>Amenities</h2>
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
                            <h2>Bedrooms</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                                <option value="">7</option>
                                <option value="">8</option>
                                <option value="">9</option>
                                <option value="">10</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Bathrooms</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                                <option value="">7</option>
                                <option value="">8</option>
                                <option value="">9</option>
                                <option value="">10</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Min Price</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">500</option>
                                <option value="">1000</option>
                                <option value="">2000</option>
                                <option value="">3000</option>
                                <option value="">5000</option>
                                <option value="">10000</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Max Price</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">500</option>
                                <option value="">1000</option>
                                <option value="">2000</option>
                                <option value="">3000</option>
                                <option value="">5000</option>
                                <option value="">10000</option>
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
<?php
    $query = '';
    $query = $c_location_id.$c_type_id;
    $per_page = 4;
    $q = $conn->prepare("SELECT p.*,
        l.name as location_name,
        t.name as type_name,
        a.fullname, a.company, a.photo
        FROM property p
        JOIN locations l
        ON p.location_id = l.id
        JOIN types t 
        ON p.type_id = t.id
        JOIN agents a
        ON p.agent_id = a.id
         WHERE 1=1 ".$query." ORDER BY p.is_featured DESC");
    $q->execute();
    $total = $q->rowCount();
    $total_pages = ceil($total/$per_page);

    if(!isset($_REQUEST['p'])) {
    $start = 1;
    } else {
    $start = $per_page * ($_REQUEST['p']-1) + 1;
    }
    $j=0;
    $k=0;
    $arr1 = [];
    $res = $q->fetchAll();
    foreach($res as $row) {
    $j++;
    if($j>=$start) {
    $k++;
    if($k>$per_page) {break;}
    $arr1[] = $row['id'];
    }
    }
    ?>
    <?php
    $total_row = $statement->rowCount();
    foreach ($res as $row) {
    if(!in_array($row['id'],$arr1)) {
    continue;
    }
        ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="item">
                    <div class="photo">
                        <img class="main" src="<?php echo BASE_URL; ?>uploads/property/<?php echo $row['feature_photo']; ?>" alt="">
                        <div class="top">
                        <div class="status-<?php if ($row['purpose'] == 'Rent') {echo 'rent';} else {echo 'sale';} ?> ">
                                For <?php echo $row['purpose']; ?>
                            </div>
                            <?php if($row['is_featured'] == 'Yes'): ?>
                            <div class="featured">
                               Featured
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="price"><?php echo $row['price']; ?></div>
                        <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                    </div>
                    <div class="text">
                        <h3><a href="property.html"><?php echo $row['name']; ?></a></h3>
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
                                         <?php if (empty($row['photo'])): ?>
                                            <img class="agent-photo" src="<?php echo BASE_URL; ?>uploads/agent-dp/default.png" alt="">
                                        <?php else: ?>
                                            <img class="agent-photo" src="<?php echo BASE_URL; ?>uploads/agent-dp/<?php echo $row['photo']; ?>" alt="">
                                        <?php endif; ?>
                                <a href=""><?php echo $row['fullname']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    if($total_row):
    
    $common_url_part = BASE_URL.'properties.php?location_id='.$_GET['location_id'].'&type_id='.$_GET['type_id'];

    ?>
        <div class="col-md-12">  
    <?php
    if(isset($_REQUEST['p'])) {
    if($_REQUEST['p'] == 1) {
    echo '<a class="links-pagination links_gray" href="javascript:void;"> << </a>';
    } else {
    echo '<a class="links-pagination links_gray" href="'.$common_url_part.'&p='.($_REQUEST['p']-1).'"> << </a>';
    }
    } else {
    echo '<a class="links-pagination links_gray" href="javascript:void;"> << </a>';
    }
    for($i=1;$i<=$total_pages;$i++) {
    echo '<a class="links-pagination links_gray" href="'.$common_url_part.'&p='.$i.'">'.$i.'</a>';
    }
    if(isset($_REQUEST['p'])) {
    if($_REQUEST['p'] == $total_pages) {
    echo '<a class="links-pagination links_gray" href="javascript:void;"> >> </a>';
    } else {
    echo '<a class="links-pagination links_gray" href="'.$common_url_part.'&p='.($_REQUEST['p']+1).'"> >> </a>';
    }
    } else {
    echo '<a class="links-pagination links_gray" href="'.$common_url_part.'&p=2"> >> </a>';
    }
    ?>
        </div>
    <?php
endif;
?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once('footer.php'); ?>