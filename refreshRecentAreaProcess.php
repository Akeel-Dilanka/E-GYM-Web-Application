<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    
    $mail = $_SESSION["u"]["email"];

    $message_rs = Database::search("SELECT * FROM `message` WHERE `from` NOT IN ('" . $mail . "') ORDER BY `date_time` DESC LIMIT 1");
    $n = $message_rs->num_rows;

    for ($x = 0; $x < $n; $x++) {

        $r = $message_rs->fetch_assoc();
        $u = array_unique($r);

        
?>

        <a class="list-group-item list-group-item-action active bg-dark border border-1 border-light text-white rounded-0">
            <div class="media">
                <img src="resources/demo.jpeg" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <h6 class="mb-0"><?php echo $u["from"];  ?></h6><small class="small fw-bold"><?php echo $u["date_time"];  ?></small>
                    </div>
                    <p class="fst-italic mb-0 text-small"><?php echo $u["content"]  ?></p>
                </div>
            </div>
        </a>



<?php

    }
}
?>