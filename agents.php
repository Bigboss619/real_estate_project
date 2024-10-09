<?php require_once('header.php'); ?>

<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner.jpg')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Agents</h2>
                </div>
            </div>
        </div>
</div>

<div class="agent pb_40">
        <div class="container">
            <div class="row">
                <?php
                        $per_page = 4;
                        $q = $conn->prepare("SELECT * FROM agents WHERE status=?");
                        $q->execute([1]);
                        $total = $q->rowCount();
                        $total_pages = ceil($total / $per_page);
                        // Current page number
                        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
                        // Start index for pagination
                        $start = ($page - 1) * $per_page;
                        $j=0;
                        $k=0;
                        $arr1 = [];
                        $res = $q->fetchAll();
                        foreach($res as $row) {
                        $j++;
                        if($j>=$start) {
                        $k++;
                        if($k >$per_page) {break;}
                        $arr1[] = $row['id'];
                        }
                        }
                        ?>
                        <?php
                        foreach ($res as $row) {
                        if(!in_array($row['id'],$arr1)) {
                        continue;
                        }
                        //Your HTML Code inside the php tag
                        ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="item">
                                        <div class="photo">
                                        <a href=""><img src="<?php echo BASE_URL; ?>uploads/agent-dp/<?php echo $row['photo']; ?>" alt=""></a>
                                        </div>
                                        <div class="text">
                                            <h2>
                                            <a href="agent.html"><?php echo $row['fullname']; ?></a>
                                            </h2>
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
                        echo '<a class="links-pagina" href="'.BASE_URL.'agents/'.($page-1).'"> << </a>';
                        } else {
                        echo '<a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> << </a>';
                        }
                        // Page numbers
                        for ($i = 1; $i <= $total_pages; $i++) {
                        $active = ($i == $page) ? 'active' : '';
                        echo '<a class="links-pagina '.$active.'" href="'.BASE_URL.'agents/'.$i.'">'.$i.'</a>';
                        }
                        // Next button
                        if ($page < $total_pages) {
                        echo '<a class="links-pagina" href="'.BASE_URL.'agents/'.($page+1).'"> >> </a>';
                        } else {
                        echo '<a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> >> </a>';
                        }
                        }
                        ?>
                        </div> <!-- End pagination section -->
                ?>
               
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>