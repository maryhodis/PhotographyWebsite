<?php

if (isset($_POST['submit'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname']; 
    $email = $_POST['email'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    $mailTo = "maryhodis99@gmail.com";
    $body = "";

    $headers = "From: My website.".$mailForm;
    $txt = "You have received an e-mail from ".$name.".\n\n".$message;

    mail($mailTo, $subject, $txt, $headers);
    header("Location: index.php?mailsend");

}

?>