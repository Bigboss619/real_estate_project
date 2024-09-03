<?php require_once('header.php'); ?>
<?php
if (!isset($_SESSION['agents'])) {
    header('location: ' . BASE_URL . 'agent-login');
}
?>
<?php
    if(isset($_POST['form_submit']))
    {
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
                        status
                        ) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $statement->execute([
                            $_SESSION['agents']['id'], 
                            $_POST['location_id'],
                            $_POST['type_id'],
                            $amenities,
                            $_POST['name'],
                            $_POST['slug'],
                            $_POST['description'],
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
                            'Active'
                        ]);
                        $success_message = 'Property is added successfully';
                        $_SESSION['success_message'] = $success_message;
                        header('location: ' . BASE_URL . 'agent-property-add');
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
        }
    }
?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner.jpg')">
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