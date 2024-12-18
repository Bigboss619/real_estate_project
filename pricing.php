<?php require_once('header.php'); ?>

<?php
$statement22 = $conn->prepare("SELECT * FROM settings WHERE id=?");
$statement22->execute([1]);
$result22 = $statement22->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/settings/<?php echo $result22[0]['banner']; ?>)">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Pricing</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content pricing">
    <div class="container">
        <div class="row pricing">
            <?php 
                $statement = $conn->prepare("SELECT * FROM packages ORDER BY id ASC");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    if ($row['allowed_properties'] == 0) {
                        $symbol = 'fas fa-times';
                        $number = 'No';
                    } else {
                        $symbol = 'fas fa-check'; 
                        $number = $row['allowed_feature_properties'];
                        if($number == -1){
                            $number = 'Unlimited';
                        }
                    }
                    if ($row['allowed_photo'] == 0) {
                        $symbol2 = 'fas fa-times';
                        $number2 = 'No';
                    } else {
                        $symbol2 = 'fas fa-check';
                        $number2 = $row['allowed_photo'];
                        if($number2 == -1){
                            $number2 = 'Unlimited';
                        }
                    }
                    if ($row['allowed_videos'] == 0) {
                        $symbol3 = 'fas fa-times';
                        $number3 = 'No';
                    } else {
                        $symbol3 = 'fas fa-check'; 
                        $number3 = $row['allowed_videos'];
                        if($number3 == -1){
                            $number3 = 'Unlimited';
                        }
                    }
            ?>
                <div class="col-lg-4 mb_30">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo $row['name']; ?></h2>
                            <h3 class="card-price"><?php echo $row['price']; ?></h3>
                            <h4 class="card-day"><?php echo $row['allowed_days']; ?></h4>
                            <hr />
                            <ul class="fa-ul">
                                <li>
                                    <span class="fa-li"><i class="fas fa-check"></i></span><?php if($row['allowed_properties'] == -1) {echo 'Unlimited';} else{ echo $row['allowed_properties'];} ?> Properties Allowed
                                </li>
                                <li>
                                    <span class="fa-li"><i class="<?php echo $symbol; ?>"></i></span><?php echo $number; ?> Featured Property
                                </li>
                                <li>
                                    <span class="fa-li"><i class="<?php echo $symbol2; ?>"></i></span><?php echo $number2; ?> Photos per Property
                                </li>
                                <li>
                                    <span class="fa-li"><i class="<?php echo $symbol3; ?>"></i></span><?php echo $number3; ?> Videos per Property
                                </li>
                            </ul>
                            <div class="buy">
                                <a href="<?php echo BASE_URL; ?>agent-payment" class="btn btn-primary">
                                    Choose Plan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
    
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
