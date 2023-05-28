<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get form data
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $email = $_POST["email"];
  $streetAddress = $_POST["street-address"];
  $streetAddressLine2 = $_POST["street-address-line2"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zipCode = $_POST["zip-code"];
  $phone = $_POST["phone"];

  // Compose email message
  $message = "First Name: $firstName\n";
  $message .= "Last Name: $lastName\n";
  $message .= "Email: $email\n";
  $message .= "Street Address: $streetAddress\n";
  $message .= "Street Address Line 2: $streetAddressLine2\n";
  $message .= "City: $city\n";
  $message .= "State: $state\n";
  $message .= "Zip Code: $zipCode\n";
  $message .= "Phone Number: $phone\n";

  // Send email using Formspree API
  $url = "https://formspree.io/f/myyaalal";
  $data = array(
    "name" => "$firstName $lastName",
    "email" => $email,
    "message" => $message
  );
  $options = array(
    "http" => array(
      "header" => "Content-type: application/x-www-form-urlencoded\r\n",
      "method" => "POST",
      "content" => http_build_query($data)
    )
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  
  // Check if the email was sent successfully
  if ($result !== false) {
    // Redirect to thank you page
    header("Location: thank-you.html");
    exit();
  } else {
    echo "Failed to send the email. Please try again later.";
  }
}
?>
