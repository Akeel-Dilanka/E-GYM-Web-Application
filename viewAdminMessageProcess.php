<?php
session_start();
require "connection.php";




 $recivers = $_SESSION["a"]["email"];







$senders = $_POST["e"];


$message_rs = Database::search("SELECT * FROM `message` WHERE `from`='" . $senders . "' OR `to` ='" . $senders . "'");

$message_num = $message_rs->num_rows;

if ($message_num == 0) {

?>
    <!-- empty -->
    <div class="col-12 mb-3 text-center">
        <div class="msgbodyimg"></div>
        <p class="fs-4 mt-3 fw-bold text-black-50">No Messages To Show.</p>
    </div>
    <!-- empty -->


    <?php

} else {
    for ($x = 0; $x < $message_num; $x++) {

        $f = $message_rs->fetch_assoc();

        if ($f["from"] == $recivers) {
    ?>

            <div class="col-5"></div>
            <div class="col-7 media mt-auto mb-3">
                <div class="media-body">
                    <div class="bg-dark rounded py-2 px-3 mb-2">
                        <p class="text-small mb-0 mb-0 text-white"><?php echo $f["content"]; ?></p>
                    </div>
                    <p class="small text-muted"><?php echo $f["date_time"]; ?></p>
                </div>
            </div>

        <?php

        } else {

          
            $images_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $senders . "' ");
           
            $image_data = $images_rs->fetch_assoc();
            

            
         

        ?>
            <div class="col-7 media mt-auto mb-3">
                <img src="<?php echo  $image_data["path"]; ?>" alt="user" width="50" class="rounded-circle">
                <div class="media-body mt-3">
                    <div class="bg-light rounded py-2 px-3 mb-2">
                        <p class="text-small mb-0 mb-0 text-dark"><?php echo $f["content"]; ?></p>
                    </div>
                    <p class="small text-muted"><?php echo $f["date_time"]; ?></p>
                </div>
            </div>
            <div class="col-5"></div>

<?php
        }
    }
}



?>