<?php
ob_start();
session_start();

// servername, username, password, database name
$host = "localhost";
$username = "bookworm_store";
$password = "1998.1989lawp";
$database = "bookworm_data";

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (
    isset($_POST['FNAME']) && isset($_POST['LNAME']) &&
    isset($_POST['EMAIL']) && isset($_POST['amount']) &&
    isset($_POST['payment_reference']) && isset($_POST['product']) &&
    isset($_POST['description'])
) {
    $firstName = mysqli_real_escape_string($connection, $_POST['FNAME']);
    $lastName = mysqli_real_escape_string($connection, $_POST['LNAME']);
    $email = mysqli_real_escape_string($connection, $_POST['EMAIL']);
    $amount = mysqli_real_escape_string($connection, $_POST['amount']);
    $paymentReference = mysqli_real_escape_string($connection, $_POST['payment_reference']);
    $product = mysqli_real_escape_string($connection, $_POST['product']); 
    $description = mysqli_real_escape_string($connection, $_POST['description']); 

    $query = "INSERT INTO `user_data`(`FNAME`, `LNAME`, `EMAIL`, `amount`, `payment_reference`, `product`, `description`)
              VALUES ('$firstName', '$lastName', '$email', '$amount', '$paymentReference', '$product', '$description')";

    if (mysqli_query($connection, $query)) {
       // After successful insertion
$_SESSION['payment_reference'] = $paymentReference;
header("Location: success");
exit();
    } else {
        echo "Error storing data: " . mysqli_error($connection);
    }
} else {
    echo "Incomplete data received";
}

mysqli_close($connection);
ob_end_flush();
?>
