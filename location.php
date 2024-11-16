<?php require_once('header.php'); ?>
<?php
$allowed_agents = [];
$q = $conn->prepare("SELECT agent_id FROM orders WHERE expire_date >= CURDATE() AND currently_active=?");
$q->execute([1]);
$result = $q->fetchAll();
foreach($result  as $row){
    $allowed_agents[] = $row['agent_id'];
}
$agents_list = implode(',',$allowed_agents);
?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/settings/banner.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Locations</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="location pb_40">
    <div class="container">
        <div class="row">
        <?php
        // Pagination setup
        $per_page = 4;
        $q = $conn->prepare("SELECT l.id, l.name as location_name, l.slag as location_slag, l.photo as location_photo, COUNT(*) as location_count
            FROM property p 
            JOIN locations l
            ON p.location_id = l.id
            WHERE p.agent_id IN ($agents_list)
            GROUP BY l.id, l.name, l.photo, l.slag
            ORDER BY location_count DESC");
        $q->execute();
        $total = $q->rowCount();
        $total_pages = ceil($total / $per_page);
        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1; // Current page number
        $start = ($page - 1) * $per_page; // Start index for pagination

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
        foreach ($res as $row) {
            if (!in_array($row['id'], $arr1)) {
                continue;
            }
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="item">
                    <div class="photo">
                        <a href="<?php echo BASE_URL; ?>locations/<?php echo $row['location_slag']; ?>">
                            <img src="<?php echo BASE_URL; ?>uploads/location/<?php echo $row['location_photo']; ?>" alt="">
                        </a>
                    </div>
                    <div class="text">
                        <h2>
                            <a href="<?php echo BASE_URL; ?>locations/<?php echo $row['location_slag']; ?>"><?php echo $row['location_name']; ?></a>
                        </h2>
                        <h4><?php echo $row['location_count']; ?> Property</h4>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="pagination"> <!-- Start pagination section -->
            <?php
            if ($total_pages > 1) {
                // Previous button
                if ($page > 1) {
                    echo '<a class="links-pagina" href="'.BASE_URL.'location/'.($page-1).'"> << </a>';
                } else {
                    echo '<a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> << </a>';
                }

                // Page numbers
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($i == $page) ? 'active' : '';
                    echo '<a class="links-pagina '.$active.'" href="'.BASE_URL.'location/'.$i.'">'.$i.'</a>';
                }

                // Next button
                if ($page < $total_pages) {
                    echo '<a class="links-pagina" href="'.BASE_URL.'location/'.($page+1).'"> >> </a>';
                } else {
                    echo '<a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> >> </a>';
                }
            }
            ?>
        </div> <!-- End pagination section -->
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>