<?php require_once('top.php'); ?>
    
<?php
if(!isset($_SESSION['admin']))
{
    header('location: '.ADMIN_URL.'login.php');
}
?>
<?php
$statement = $conn->prepare("SELECT * FROM locations");
$statement->execute();
$total_locations = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM types");
$statement->execute();
$total_types = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM amenities");
$statement->execute();
$total_amenities = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM property");
$statement->execute();
$total_properties = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM orders");
$statement->execute();
$total_orders = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM subscribers");
$statement->execute();
$total_subscribers = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM posts");
$statement->execute();
$total_blog_post = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM customer");
$statement->execute();
$total_customers = $statement->rowCount();

$statement = $conn->prepare("SELECT * FROM agents");
$statement->execute();
$total_agents = $statement->rowCount();
?>

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="row"> 
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Locations</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_locations; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Types</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_types; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Amenities</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_amenities; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"> 
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Properties</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_properties; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Orders</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_orders; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Subscribers</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_subscribers; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"> 
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Blog Post</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_blog_post; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Customers</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_customers; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-hand-point-right"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Agents</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $total_agents; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    <?php require_once('footer.php'); ?>