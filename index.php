<?php

$title = 'CMS Home';
$page = 'index';
include 'components/header.php';
include 'components/footer.php';
include 'includes/DbConnect.php';
?>

<!-- Carousel-->
<div class="mt-auto mb-auto container my-5 py-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
        <ul class="carousel-indicators">
            <?php $result = $con->query("SELECT `content_link`,`content_title` FROM content WHERE `content_status` = 1 AND current_timestamp >`display_date_from` AND current_timestamp < `display_date_to`"); ?>
            <?php
            $i = 0;
            foreach ($result as $row) {
                $actives = '';
                if ($i == 0) {
                    $actives = 'active';
                }
                ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
                <?php $i++;
            } ?>
        </ul>

        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($result as $row) {
                $actives = '';
                if ($i == 0) {
                    $actives = 'active';
                }
                ?>
                <div class="carousel-item <?= $actives; ?>">
                    <img src="<?= $row['content_link'] ?>" width="100%" height="400" class="d-block w-100"
                         alt="<?= $row['content_title'] ?>">
                </div>
                <?php $i++;
            } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>


<!-- Events Section-->
<div class="section-invert my-4">
    <h2 class="section-title text-center my-5 ">Latest Events</h2>
    <h3 class="section-title text-center"> Talks </h3>
    <div class="container ">
        <div class="py-4 ">
            <div class="row">
                <div class="card-deck ">
                    <?php $talksResult = $con->query("SELECT `content_link`,`content_title`, `content_desc` FROM content WHERE `content_type` = 'talks' AND `content_status` = 1 AND current_timestamp >`display_date_from` AND current_timestamp < `display_date_to`"); ?>
                    <?php
                    $i = 0;
                    foreach ($talksResult as $resultRow) {
                        ?>
                        <div class="col-md-12 col-lg-6">
                            <div class="card mb-4 ">
                                <img class="card-img-top " src="<?= $resultRow['content_link'] ?>"
                                     alt="<?= $resultRow['content_title'] ?> ">
                                <div class="card-body ">
                                    <h4 class="card-title "><?= $resultRow['content_title'] ?></h4>
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#Modal<?= $i ?>">Description
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="Modal<?= $i ?>" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= $resultRow['content_title'] ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?php echo $resultRow['content_desc'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Modal-->
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Workshops-->

<div class="section py-4 ">
    <h3 class="section-title text-center m-5 ">Workshops</h3>
    <div class="container ">
        <div class="py-4 ">
            <div class="row ">
                <div class="card-deck ">
                    <?php $workshopResult = $con->query("SELECT `content_link`,`content_title`, `content_desc` FROM content WHERE `content_type` = 'workshop' AND `content_status` = 1 AND current_timestamp >`display_date_from` AND current_timestamp < `display_date_to`"); ?>
                    <?php
                    $w = 0;
                    foreach ($workshopResult as $wResultRow) {
                        ?>
                        <div class="col-md-12 col-lg-6">
                            <div class="card mb-4 ">
                                <img class="card-img-top " src="<?= $wResultRow['content_link'] ?>"
                                     alt="<?= $wResultRow['content_title'] ?> ">
                                <div class="card-body ">
                                    <h4 class="card-title "><?= $wResultRow['content_title'] ?></h4>
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#WModal<?= $w ?>">Description
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="WModal<?= $w ?>" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= $wResultRow['content_title'] ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?php echo $wResultRow['content_desc'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Modal-->
                                </div>
                            </div>
                        </div>
                        <?php
                        $w++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Announcements-->
<div class="section-invert py-4">
    <h2 class="section-title text-center my-5 ">Announcements</h2>
    <h3 class="section-title text-center"> Keep Up to Date </h3>
    <div class="container ">
        <div class="py-4 ">
            <div class="row">
                <div class="card-deck ">
                    <?php $announceResult = $con->query("SELECT `content_link`,`content_title`, `content_desc` FROM content WHERE `content_type` = 'announcement' AND `content_status` = 1 AND current_timestamp >`display_date_from` AND current_timestamp < `display_date_to`"); ?>
                    <?php
                    $a = 0;
                    foreach ($announceResult as $aResultRow) {
                        ?>
                        <div class="col-md-12 col-lg-6">
                            <div class="card mb-4 ">
                                <img class="card-img-top " src="<?= $aResultRow['content_link'] ?>"
                                     alt="<?= $aResultRow['content_title'] ?> ">
                                <div class="card-body ">
                                    <h4 class="card-title "><?= $aResultRow['content_title'] ?></h4>
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#AModal<?= $a ?>">Description
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="AModal<?= $a ?>" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= $aResultRow['content_title'] ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?php echo $aResultRow['content_desc'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Modal-->
                                </div>
                            </div>
                        </div>
                        <?php
                        $a++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image popup section -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body mb-0 p-0">
                <img src="/images/notification.png" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div>

