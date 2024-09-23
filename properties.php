<?php require_once('header.php'); ?>
<?php
    if(!empty($_GET['location_id']))
    {
        if($_GET['location_id'] == 'All locations')
        {
            $c_location_id = '';
        }
        else
        {
            $c_location_id = 'AND location_id=?'.$_GET['location_id'];
        }
    }
    else
    {
        $c_location_id = ''; 
    }

    if(!empty($_GET['type_id']))
    {
        if($_GET['type_id'] == 'All Types')
        {
            $c_type_id = '';
        }
        else
        {
            $c_type_id = 'AND type_id=?'.$_GET['type_id'];
        }
    }
    else
    {
        $c_type_id = ''; 
    }
?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner.jpg');">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Pricing</h2>
            </div>
        </div>
    </div>
</div>

<div class="property-result">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="property-filter">
                    <form action="" method="get">
                        <div class="widget">
                            <h2>Find Anything</h2>
                            <input type="text" name="" class="form-control" placeholder="Search Titles ..." />
                        </div>

                        <div class="widget">
                            <h2>All Location</h2>
                            <select name="location_id" class="form-control select2" onchange="this.form.submit()">
                                <?php
                                $statement = $conn->prepare("SELECT * FROM locations ORDER BY name ASC");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if (isset($_GET['location_id'])) {
                                                                                    if ($_GET['location_id'] == $row['id']) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>><?php echo $row['name']; ?></option>

                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Type</h2>
                            <select name="type_id" class="form-control select2" onchange="this.form.submit()">
                                <?php
                                $statement = $conn->prepare("SELECT * FROM types ORDER BY name ASC");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if (isset($_GET['type_id'])) {
                                                                                    if ($_GET['type_id'] == $row['id']) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>><?php echo $row['name']; ?></option>

                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Status</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">For Rent</option>
                                <option value="">For Sale</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Amenities</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">Free Wifi</option>
                                <option value="">Swimming Pool</option>
                                <option value="">Car Parking</option>
                                <option value="">Air Conditioning</option>
                                <option value="">Kitchen</option>
                                <option value="">Gym and Fitness Center</option>
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

                            <?php
                            $query = '';
                            $query = $c_location_id.$c_type_id;
                            $per_page = 3;
                            $q = $conn->prepare("SELECT * FROM property WHERE 1=1".$query);
                            $q->execute();
                            $total = $q->rowCount();

                            $total_pages = ceil($total / $per_page);
                            if (!isset($_GET['p'])) {
                                $start = 1;
                            } else {
                                $start = $per_page * ($_GET['p'] - 1) + 1;
                            }
                            $j = 0;
                            $k = 0;
                            $arr1 = [];
                            $res = $q->fetchAll();
                            foreach ($res as $row) {
                                $j++;
                                if ($j >= $start) {
                                    $k++;
                                    if ($k > $per_page) {
                                        break;
                                    }
                                    $arr1[] = $row['id'];
                                }
                            }
                            ?>

                            <?php
                            $statement = $conn->prepare("SELECT * FROM property WHERE 1=1".$query);
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            $total_rows =  $statement->rowCount();
                            foreach ($result as $row) {

                                if (!in_array($row['id'], $arr1)) {
                                    continue;
                                }
                            ?>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="item">
                                        <div class="photo">
                                            <img class="main" src="<?php echo BASE_URL; ?>uploads/property/<?php echo $row['feature_photo']; ?>" alt="">
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
                                            <h3><a href="property.html"><?php echo $row['name']; ?></a></h3>
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
                            <?php
                            }

                            if($total_rows):
                            if (isset($_GET['p'])) {
                                if ($_GET['p'] == 1) {
                                    echo '<a class="links" href="javascript:void;" style="background:#ddd;"> << </a>';
                                } else {
                                    echo '<a class="links" href="http://localhost/php_practice/index.php?p=' . ($_GET['p'] - 1) . '"> << </a>';
                                }
                            } else {
                                echo '<a class="links" href="javascript:void;" style="background:#ddd;"> << </a>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<a class="links" href="http://localhost/php_practice/index.php?p=' . $i . '">' . $i . '</a>';
                            }
                            if (isset($_GET['p'])) {
                                if ($_GET['p'] == $total_pages) {
                                    echo '<a class="links" href="javascript:void;" style="background:#ddd;"> >> </a>';
                                } else {
                                    echo '<a class="links" href="http://localhost/php_practice/index.php?p=' . ($_GET['p'] + 1) . '"> >> </a>';
                                }
                            } else {
                                echo '<a class="links" href="http://localhost/php_practice/index.php?p=2"> >> </a>';
                            }
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