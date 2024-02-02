<?php
$inName = $_POST['inName'];
$inEmail = $_POST['inEmail'];
$inLocation = $_POST['inLocation'];
$inDate = $_POST['inDate'];

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Set the recipient email address.
 * 
 * FIXME: Update this to your desired email address.
 */
$recipient = "theme.junction.live@gmail.com";

// Set the email subject.
$sender = $inName . " { " . $inEmail . " }";


//Email Header
$head = "You have a new message from your Rafter website Inspection 1 Form (service and home-2)\n=============================";

// Build the email content.
$form_content = "$head\n\n";

$form_content .= "Full Name: $inName\n";

$form_content .= "Email: $inEmail\n";

$form_content .= "Location: $inLocation\n";

$form_content .= "Date: $inDate\n";


// Build the email headers.
$headers = "From: $inName < $inEmail >\r\n" .
  "Reply-To:" . $inEmail . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

if (mail($recipient, $sender, $form_content, $headers)) {
  echo "Y";
} else {
  echo "N";
}
