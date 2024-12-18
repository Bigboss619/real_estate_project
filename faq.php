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
                <h2>FAQ</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content faq">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="accordion" id="accordionExample">
                        <?php
                            $i = 0;
                            $statement = $conn->prepare("SELECT * FROM faqs ORDER BY id ASC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading_<?php echo $i; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $i; ?>">
                                                <?php echo $row['question']; ?>
                                            </button>
                                        </h2>
                                        <div id="collapse_<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading_<?php echo $i; ?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?php echo $row['answer']; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                        



                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>