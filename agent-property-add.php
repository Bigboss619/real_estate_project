<?php require_once('header.php'); ?>
<?php
if (!isset($_SESSION['agents'])) {
    header('location: ' . BASE_URL . 'agent-login');
    exit;
}

// If this agent did not purchase any package, he will be redirected to payment page
$statement = $conn->prepare("SELECT * FROM orders WHERE agent_id=?");
$statement->execute([$_SESSION['agents']['id']]);
$total = $statement->rowCount();
if(!$total)
{
    $_SESSION['error_message'] = 'Please purchase a package first';
    header('location: ' . BASE_URL . 'agent-payment');
    exit;
}

    // If this agent's package is expired, he will be redirected to payment page

    // IF this agent already added his number of allowed properties, he will be redirected to the properties view page and any of the added properties should be removed in order to add a new one
    $statement = $conn->prepare("SELECT * FROM orders 
    JOIN packages ON orders.package_id = packages.id
    WHERE orders.agent_id=? AND orders.currently_active=?");
    $statement->execute([$_SESSION['agents']['id'],1]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $allowed_properties = $row['allowed_properties'];

        // This code check if the agent package is not expired, but if it is expired the agent can't add any properties
        $expire_date = $row['expire_date'];
    }
    $statement = $conn->prepare("SELECT * FROM property WHERE agent_id=?");
    $statement->execute([$_SESSION['agents']['id']]);
    $total_properties = $statement->rowCount();
    if($total_properties == $allowed_properties){
        $_SESSION['error_message'] = 'You have already added the maximum number of allowed properties. Please remove any of the added properties in order to add a new one or you purchase a higher package';
        header('location: ' . BASE_URL . 'agent-property');
        exit;
    }

    // IF the expre date is passed, the agent will be redirected to the payment page
    if(strtotime(date('Y-m-d')) > strtotime($expire_date)){
        $_SESSION['error_message'] = 'Your package has expired. Please purchase a new package';
        header('location: ' . BASE_URL . 'agent-payment');
        exit;
    }
?>
<?php
    if(isset($_POST['form_submit']))
    {
        // Function to strip inline styles
        function stripInlineStyles($html) {
            // Remove style attributes from tags
            return preg_replace('/\s*style="[^"]*"/i', '', $html);
        }

        try {
                if(empty($_POST['name']))
                {
                    throw new Exception("Name can not be empty");
                    
                }
                if(empty($_POST['slug']))
                {
                    throw new Exception("Slug can not be empty");
                    
                }
                if(!preg_match('/^[a-z0-9-]+$/', $_POST['slug']))
                {
                    throw new Exception("Invalid slug format. Slug should only contain lowercase letters, numbers and hyphens");
                    
                }
                if(empty($_POST['price']))
                {
                    throw new Exception("Price can not be empty");
                    
                }
                if(empty($_POST['description']))
                {
                    throw new Exception("Description can not be empty");
                }
                if(empty($_POST['bedroom']))
                {
                    throw new Exception("Bedroom can not be empty");
                }
                if(empty($_POST['size']))
                {
                    throw new Exception("Size can not be empty");
                }
                if(empty($_POST['floor']))
                {
                    throw new Exception("Floor can not be empty");
                }
                if(empty($_POST['garage']))
                {
                    throw new Exception("Garage can not be empty");
                }
                if(empty($_POST['balcony']))
                {
                    throw new Exception("Balcony can not be empty");
                }
                if(empty($_POST['address']))
                {
                    throw new Exception("Address can not be empty");
                }
                if(empty($_POST['built_year']))
                {
                    throw new Exception("Built Year can not be empty");
                }
                if(empty($_POST['map']))
                {
                    throw new Exception("Map can not be empty");
                }
                if($_POST['is_featured'] == 'Yes'){
                    $statement = $conn->prepare("SELECT * FROM orders o
                    JOIN packages p
                    ON o.package_id = p.id
                    WHERE o.agent_id=? AND o.currently_active=?");
                    $statement->execute([$_SESSION['agents']['id'],1]);
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                            $allowed_feature_properties = $row['allowed_feature_properties'];
                    }
                    if($allowed_feature_properties == 0){
                        throw new Exception("You are not allowed to add new features");
                    }

                    // Checks how many featured property you have added
                    $statement = $conn->prepare("SELECT * FROM property WHERE agent_id=? AND is_featured=?");
                    $statement->execute([$_SESSION['agents']['id'], 'Yes']);
                    $total_featured_added = $statement->rowCount();
                    if($total_featured_added == $allowed_feature_properties){
                        throw new Exception("You have no featured property left. Please upgrade your package.");
                        
                    }
                }
                if(!isset($_POST['amenities']))
                {
                    throw new Exception("Please select at least one amenity");
                }   
                else
                {
                    $amenities = '';
                    for($i=0; $i<count($_POST['amenities']);$i++)
                    {
                            if($i==0)
                            {
                                $amenities .= $_POST['amenities'][$i];
                            }
                            else
                            {
                                $amenities .= ','.$_POST['amenities'][$i];
                            }
                     }
                } 
                $description = strip_tags(stripInlineStyles($_POST['description']));
                
                $path = $_FILES['featured_photo']['name'];
                $path_tmp = $_FILES['featured_photo']['tmp_name'];

                if($path != '')
                {
                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = time().".".$extension;

                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = finfo_file($finfo, $path_tmp);

                    if($mime == 'image/jpeg' || $mime == 'image/png' || $mime == 'application/pdf')
                    {
                    
                        move_uploaded_file($path_tmp, './uploads/property/'.$filename);

                        $statement = $conn->prepare("INSERT INTO property (
                        agent_id,
                        location_id, 
                        type_id, 
                        amenities,
                        name, 
                        slug, 
                        description, 
                        feature_photo,
                        price,  
                        purpose, 
                        bedroom, 
                        bathroom, 
                        size, 
                        floor, 
                        garage, 
                        balcony, 
                        Address, 
                        built_year, 
                        map,
                        is_featured,
                        status,
                        posted_on
                        ) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $statement->execute([
                            $_SESSION['agents']['id'], 
                            $_POST['location_id'],
                            $_POST['type_id'],
                            $amenities,
                            $_POST['name'],
                            $_POST['slug'],
                            $description,
                            $filename,
                            $_POST['price'],
                            $_POST['purpose'],
                            $_POST['bedroom'],
                            $_POST['bathroom'],
                            $_POST['size'],
                            $_POST['floor'],
                            $_POST['garage'],
                            $_POST['balcony'],
                            $_POST['address'],
                            $_POST['built_year'],
                            $_POST['map'],
                            $_POST['is_featured'],
                            'Active',
                            date('Y-m-d')
                        ]);
                        $success_message = 'Property is added successfully';
                        $_SESSION['success_message'] = $success_message;
                        header('location: ' . BASE_URL . 'agent-property');
                        exit;
                    }
                    else
                        {
                        throw new Exception("Please upload a valid photo");
                    }
                }else{
                    throw new Exception("Please upload a photo. Image Cannot be empty");
                    
                }
        }
            catch (Exception $e) {
            $error_message = $e->getMessage();
            header('location: ' . BASE_URL . 'agent-property-add');
                        exit;
        }
    }
?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/settings/banner.jpg')">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Property</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content user-panel">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <?php require_once('agent-sidebar.php'); ?>
            </div>
            <div class="col-lg-9 col-md-12">
                <form action="agent-property-add.php" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Slug *</label>
                            <input type="text" name="slug" class="form-control" value="<?php if(isset($_POST['slug'])) {echo $_POST['slug'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Price *</label>
                            <input type="text" name="price" class="form-control" value="<?php if(isset($_POST['price'])) {echo $_POST['price'];} ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" class="form-control editor" cols="30" rows="10"><?php if(isset($_POST['description'])) {echo $_POST['description'];} ?></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Location *</label>
                            <select name="location_id" class="form-control select2">
                                <?php
                                    $statement = $conn->prepare("SELECT * FROM locations ORDER BY name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        ?>
                                            <option value="<?php echo $row['id']; ?>"<?php if(isset($_POST['location_id'])) {if ($_POST['location_id'] == $row['id']) {echo 'selected'; } } ?>> <?php echo $row['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Type *</label>
                            <select name="type_id" class="form-control select2">
                            <?php
                                    $statement = $conn->prepare("SELECT * FROM types ORDER BY name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        ?>
                                            <option value="<?php echo $row['id']; ?>"<?php if(isset($_POST['type_id'])) {if ($_POST['type_id'] == $row['id']) {echo 'selected'; } } ?>> <?php echo $row['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Purpose *</label>
                            <select name="purpose" class="form-control select2">
                                
                                <option value="Sale" <?php if(isset($_POST['purpose']) == 'Sale') {echo 'selected'; } ?>>Sale</option>
                                <option value="Rent" <?php if(isset($_POST['purpose']) == 'Rent') {echo 'selected'; } ?>>Rent</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Bedrooms *</label>
                                <input type="number" class="form-control" name="bedroom" min="0" value="<?php if(isset($_POST['bedroom'])) {echo $_POST['bedroom'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Bathrooms *</label>
                            <input type="number" class="form-control" name="bathroom" min="0" value="<?php if(isset($_POST['bathroom'])) {echo $_POST['bathroom'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Size (Sqft) *</label>
                            <input type="text" class="form-control" name="size" value="<?php if(isset($_POST['size'])) {echo $_POST['size'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Floor</label>
                            <input type="number" class="form-control" name="floor" min="0" value="<?php if(isset($_POST['floor'])) {echo $_POST['floor'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Garage</label>
                            <input type="number" class="form-control" name="garage" min="0" value="<?php if(isset($_POST['garage'])) {echo $_POST['garage'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Balcony</label>
                            <input type="number" class="form-control" name="balcony" min="0" value="<?php if(isset($_POST['balcony'])) {echo $_POST['balcony'];} ?>">
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php if(isset($_POST['address'])) {echo $_POST['address'];} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Built Year</label>
                            <input type="text" name="built_year" class="form-control" value="<?php if(isset($_POST['built_year'])) {echo $_POST['built_year'];} ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Location Map</label>
                            <textarea name="map" class="form-control h-150" cols="30" rows="10"><?php if(isset($_POST['map'])) {echo $_POST['map'];} ?></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Is Featured? *</label>
                            <select name="is_featured" class="form-control select2">
                                
                                <option value="Yes" <?php if(isset($_POST['is_featured'])){ if($_POST['is_featured'] == 'Yes') {echo 'selected'; }} ?>>Yes</option>
                                <option value="No" <?php if(isset($_POST['is_featured'])) { if($_POST['is_featured'] == 'No') {echo 'selected'; }} ?>>No</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Amenities</label>
                            <div class="row">
                                <?php
                                    $i=0;
                                    $statement = $conn->prepare("SELECT * FROM amenities ORDER BY name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        $i++;
                                        ?>
                                            <div class="col-md-12">
                                             <div class="form-check">
                                            <input name="amenities[]" class="form-check-input" type="checkbox" value="<?php echo $row['id']; ?>" id="chk<?php echo $i; ?>" <?php if(isset($_POST['amenities'])) { if(in_array($row['id'],$_POST['amenities'])) {echo 'checked';} } ?>>
                                            <label class="form-check-label" for="chk<?php echo $i; ?>">
                                            <?php echo $row['name']; ?>
                                            </label>
                                             </div>
                                             </div>
                                        <?php
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Featured Photo Year</label>
                                <div>
                                <input type="file" name="featured_photo">
                                </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <input type="submit" name="form_submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>