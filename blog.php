<?php require_once('header.php'); ?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/settings/banner.jpg);">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog</h2>
            </div>
        </div>
    </div>
</div>
<div class="blog">
        <div class="container">
            <div class="row">
                <?php
                            $per_page = 3;
                            $q = $conn->prepare("SELECT * FROM posts ORDER BY id DESC");
                            $q->execute();
                            $total = $q->rowCount();
                            $total_pages = ceil($total / $per_page); // Total pages
                            $page = isset($_GET['p']) ? (int)$_GET['p'] : 1; // Current page
                            $start = ($page - 1) * $per_page; // Start index for pagination

                            // Fetch all records
                            $res = $q->fetchAll(PDO::FETCH_ASSOC);
                    
                    ?>
                        <?php foreach ($res as $key => $row): ?>
                            <?php if($key < $start || $key >= $start + $per_page) 
                                continue;
                            ?>
                            <!-- //Your HTML Code inside the php tag -->
                        
                                <div class="col-lg-4 col-md-6">
                                    <div class="item">
                                        <div class="photo">
                                            <img src="<?php echo BASE_URL; ?>uploads/blog/<?php echo $row['photo']; ?>" alt="" />
                                        </div>
                                        <div class="text">
                                            <h2>
                                                <a href="<?php echo BASE_URL; ?>posts/<?php echo $row['slug']; ?>"><?php echo $row['title']; ?></a>
                                            </h2>
                                            <div class="short-des">
                                                <p>
                                                    <?php echo $row['short_description']; ?>
                                                </p>
                                            </div>
                                            <div class="button">
                                                <a href="<?php echo BASE_URL; ?>posts/<?php echo $row['slug']; ?>" class="btn btn-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                        <!-- //Start pagination section  -->
                            <div class="pagination"> 
                        <?php
                           $common_url = BASE_URL . 'blog.php?';
                            if ($total > $per_page): ?>
                                <!-- Previous button -->
                                <?php if ($page > 1): ?>
                                <a class="links-pagina" href="<?php echo $common_url . 'p=' . ($page - 1) ?>"> << </a>
                                <?php else: ?>
                                <a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> << </a>;
                                <?php endif; ?>

                                <!-- Page numbers -->
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a class="links-pagina <?php echo ($page == $i) ? 'active' : ''; ?>" href="<?php echo $common_url . 'p=' . $i; ?>"><?php echo $i; ?></a>;
                                <?php endfor; ?>

                                <!-- Next button -->
                                <?php if ($page < $total_pages): ?>
                                <a class="links-pagina" href="<?php echo $common_url . 'p=' . ($page + 1); ?>"> >> </a>
                                <?php else: ?>
                                <a class="links-pagina disabled" href="javascript:void(0);" style="background:#ddd;"> >> </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div> <!-- End pagination section -->
               
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>