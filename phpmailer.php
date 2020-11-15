<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'vendor/phpmailer/phpmailer/src/Exception.php';
  require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
  require 'vendor/phpmailer/phpmailer/src/SMTP.php';

  // Include autoload.php file
  require 'vendor/autoload.php';
  // Create object of PHPMailer class
  $mail = new PHPMailer(true);

  $output = '';
  if (isset($_POST['submit'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname']; 
    $email = $_POST['email'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      // Gmail ID which you want to use as SMTP server
      $mail->Username = 'photographermary99@gmail.com';
      // Gmail Password
      $mail->Password = 'PhotographerWebSite1';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      // Email ID from which you want to send the email
      $mail->setFrom('photographermary99@gmail.com');
      // Recipient Email ID where you want to receive emails
      $mail->addAddress('maryhodis99@gmail.com');

      $mail->isHTML(true);
      $mail->Subject = 'Form Submission from Website';
      $mail->Body = "<h3>LastName : $lastname <br>FirstName : $firstname <br>Email : $email <br>Message : $message</h3>";

      $mail->send();
      $message_sent = true;
      $output = '<div class="alert alert-success">
                  <h5>Thank you! for contacting us, We\'ll get back to you soon!</h5>
                 </div>';
    } catch (Exception $e) {
      $output = '<div class="alert alert-danger">
                  <h5>' . $e->getMessage() . '</h5>
                </div>';
    }
  }

?>