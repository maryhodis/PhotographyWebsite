<?php
include("C:/xampp/htdocs/photography/config.php");

if (isset($_POST["id"])) {
    $db->deleteById('events',$_POST['id']);
}
