<?php
$firstName = $_POST['confname'];
$lastName = $_POST['conlname'];
$conEmail = $_POST['conEmail'];
$conPhone = $_POST['conPhone'];
$conSubject = $_POST['conSubject'];
$conWebsite = $_POST['conWebsite'];
$conMessage = $_POST['conMessage'];

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Set the recipient email address.
 * 
 * FIXME: Update this to your desired email address.
 */
$recipient = "theme.junction.live@gmail.com";

// Set the email subject.
$sender = $conSubject;


//Email Header
$head = "You have a new message from your Rafter website Contact Form\n=============================";

// Build the email content.
$form_content = "$head\n\n";

$form_content .= "Full Name: $firstName $lastName\n";

$form_content .= "Email: $conEmail\n";

$form_content .= "Phone: $conPhone\n";

$form_content .= "Subject: $conSubject\n";

$form_content .= "Website: $conWebsite\n";

$form_content .= "Message: \n$conMessage\n";


// Build the email headers.
$headers = "From: $firstName $lastName < $conEmail >\r\n" .
    "Reply-To:" . $conEmail . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($recipient, $sender, $form_content, $headers)) {
    echo "Y";
} else {
    echo "N";
}
