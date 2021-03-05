<?php

$title = 'CMS | Events';
$page = 'events';

include 'components/header.php';
include 'components/footer.php';
include 'includes/DbConnect.php'

?>
<div class="section-invert pb-4">
    <div class="container">

        <h2 class="section-title mt-5 mb-3">Event Listing</h2>
        <div class="underline mb-2"></div>

        <p> Listed below are current and upcoming events with their respective details. <br> If you have created an event, it'll appear here</p>

        <!-- Table ! -->
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header ">
                        <h6 class="m-0">Event Details</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <?php
                        $query = mysqli_query($con, "SELECT `content_id`,`content_title`,`content_desc`,`content_link`,`venue`,`content_type`,`content_date_time` FROM content WHERE `content_status` = 1 AND current_timestamp >`display_date_from` AND current_timestamp < `display_date_to` ORDER BY content_title asc");

                        echo '<table class="table mb-0">
                        <tr>
                            <th scope="col" class="border-0">No</th>
                            <th scope="col" class="border-0">Event</th>
                            <th scope="col" class="border-0">Description</th>
                            <th scope="col" class="border-0">Poster</th>
                            <th scope="col" class="border-0">Venue</th>
                            <th scope="col" class="border-0">Event Type</th>
                            <th scope="col" class="border-0">Event Date</th>
                        </tr>';

                        while($rows=mysqli_fetch_assoc($query)){
                            echo '<tr>';
                                echo'<td>'.$rows['content_id'].'</td>';
                                echo'<td>'.$rows['content_title'].'</td>';
                                echo'<td>'.$rows['content_desc'].'</td>';
                                echo '<td> <img height="200" width="180" src='.$rows['content_link'].'></td>';
                                echo'<td>'.$rows['venue'].'</td>';
                                echo'<td>'.$rows['content_type'].'</td>';
                                echo'<td>'.$rows['content_date_time'].'</td>';
                        }

                        /**foreach ($query as $row) {
                            echo '<tr>';
                            foreach ($row as $column) {
                                echo '<td>';
                                echo $column;
                                echo '</td>';
                            }
                            echo '</tr>';
                        }**/
                        echo '</table>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>