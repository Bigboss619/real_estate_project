<?php
require_once('header.php');
?>
<?php
    if(!isset($_SESSION['agents']))
    {
        header('location: '.BASE_URL.'agent-login');
        exit;
    }
?>
<?php
    $statement = $conn->prepare("SELECT * FROM property WHERE agent_id=?");
    $statement->execute([$_SESSION['agents']['id']]);
    $total_properties = $statement->rowCount();

    $statement = $conn->prepare("SELECT * FROM orders WHERE agent_id=?");
    $statement->execute([$_SESSION['agents']['id']]);
    $total_orders = $statement->rowCount();

    $statement = $conn->prepare("SELECT * FROM messages WHERE agent_id=?");
    $statement->execute([$_SESSION['agents']['id']]);
    $total_messages = $statement->rowCount();
?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/settings/banner.jpg')">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content user-panel">
<div class="container">
<div class="row">
    <div class="col-lg-3 col-md-12">
        <?php require_once('agent-sidebar.php') ?>
    </div>
    <div class="col-lg-9 col-md-12">
        <h3 class="b_20">Hello, <?php echo $_SESSION['agents']['fullname'] ?></h3>

        <div class="row box-items">
            <div class="col-md-4">
                <div class="box1">
                    <h4><?php echo $total_properties; ?></h4>
                    <p>Active Properties</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box2">
                    <h4><?php echo $total_orders; ?></h4>
                    <p>Orders</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box3">
                    <h4><?php echo $total_messages; ?></h4>
                    <p>Messages</p>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Feature Properties</h3>
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Location</th>
                        <td>Status</td>
                        <th>Action</th>
                    </tr>
                </thead>    
                <tbody>
                    <?php
                        $i = 0;
                        $statement = $conn->prepare("SELECT property.*,  locations.name  as location_name, types.name as types_name, GROUP_CONCAT(amenities.name) as amenity_names
                        FROM property
                        JOIN locations 
                        ON property.location_id = locations.id 
                        JOIN types
                        ON property.type_id = types.id
                        JOIN amenities
                        ON FIND_IN_SET(amenities.id, property.amenities)
                        WHERE property.agent_id=? AND property.is_featured='Yes' 
                        GROUP BY property.id
                        ORDER BY property.id DESC");
                        $statement->execute([$_SESSION['agents']['id']]);
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $row) {
                            $i++;
                            ?>
                                <tr>                                 <td>
                                     <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['types_name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['location_name']); ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] == 'Active'): ?>
                                            <span class="badge bg-success"><?php echo htmlspecialchars($row['status']); ?></span>
                                        <?php else:  ?>
                                            <span class="badge bg-danger"><?php echo htmlspecialchars($row['status']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary text-white btn-sm" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $i; ?>"><i class="fas fa-eye"></i></a>
                                        <div class="modal fade" id="modal_<?php echo $i; ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Feature Photo: </label></div>
                                                            <div class="col-md-8"><img src="<?php echo BASE_URL; ?>uploads/property/<?php echo htmlspecialchars($row['feature_photo']); ?>" alt="" class="w-200"></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Property Name: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['name']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Location: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['location_name']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Property Type: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['types_name']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Purpose: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['purpose']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Slug: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['slug']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Description: </label></div>
                                                            <div class="col-md-8" <?php echo htmlspecialchars($row['description']); ?>></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Price: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['price']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Amenities: </label></div>
                                                            <div class="col-md-8">
                                                                <?php
                                                                $amenities = explode(',', $row['amenity_names']);
                                                                foreach ($amenities as $amenity) {
                                                                    echo '-' . htmlspecialchars($amenity) . '<br>';
                                                                }
                                                                // $amenities = $row['amenities'];
                                                                // $amenities = explode(',', $row['amenities']);
                                                                // foreach ($amenities as $amenity)
                                                                // {
                                                                //     $statement = $conn->prepare("SELECT * FROM amenities WHERE id=?");
                                                                //     $statement->execute([$amenity]);
                                                                //     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                                //     foreach($result as $row1){
                                                                //         echo $row1['name'].', ';
                                                                //         }
                                                                // }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Bedroom: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['bedroom']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Bathroom: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['bathroom']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Size: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['size']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Floor: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['floor']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Garage: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['garage']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Balcony: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['balcony']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Address: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['Address']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Built Year: </label></div>
                                                            <div class="col-md-8"><?php echo htmlspecialchars($row['built_year']); ?></div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Map: </label></div>
                                                            <div class="col-md-8 map1"><?php echo htmlspecialchars($row['map']); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                            <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<?php
require_once('footer.php');
?>