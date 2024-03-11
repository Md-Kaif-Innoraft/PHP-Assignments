<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php'; 

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate email
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            exit;
        }

        // Send welcome email.
        $mail = new PHPMailer(true);
        try {
            // Server settings.
            $mail->isSMTP();
            // Specify SMTP server.
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            // SMTP username.
            $mail->Username = 'ansarimdkaif0@gmail.com'; 
            // SMTP password.
            $mail->Password = 'pdfa cgcx xxox myud'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients.
            $mail->setFrom('kaif.ansari@innoraft.com', 'Md Kaif');
            $mail->addAddress($email);

            // Content.
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to our website';
            $mail->Body = 'Thank you for your submission.';

            $mail->send();
            echo 'Welcome email sent successfully!';
        } 
        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

?>