<?php require_once('top.php'); ?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Location View</h1>
<div class="ml-auto">
                <a href="<?php echo ADMIN_URL; ?>location-add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
            </div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="example1">
<thead>
    <tr>
        <th>SL</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $i = 0;
    $statement = $conn->prepare("SELECT * FROM locations ORDER BY id ASC");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <img src="<?php echo BASE_URL; ?>uploads/location/<?php echo $row['photo']; ?>" alt="" class="w_200" srcset="">
                </td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['slag']; ?></td>
                <td class="pt_10 pb_10">
                    <a href="<?php echo ADMIN_URL; ?>location-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="<?php echo ADMIN_URL; ?>location-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
                </td>
               
            </tr>
        <?php
    }
    ?>
    
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<?php require_once('footer.php'); ?>