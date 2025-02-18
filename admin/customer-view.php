<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>View Customers</h1>
<div class="ml-auto">
               
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
        <th>Email</th>
        <th>Status</th>
        <th>Change Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $i = 0;
    $statement = $conn->prepare("SELECT * FROM customer ORDER BY fullname ASC");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <img src="<?php echo BASE_URL; ?>uploads/customer-dp/<?php echo $row['photo']; ?>" alt="" class="w_100 rounded-circle" srcset="">
                </td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <?php
                        if($row['status'] == 1){
                            echo '<span class="badge badge-success">Active</span>';
                        } else{
                            echo '<span class="badge badge-danger">Inactive</span>';
                        }
                     ?>
                </td>
                <td>
                    <a href="<?php echo ADMIN_URL; ?>customer-change-status.php?id=<?php echo $row['id']; ?>">Change Status</a>
                </td>
                <td class="pt_10 pb_10">
                    
                    <a href="<?php echo ADMIN_URL; ?>customer-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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