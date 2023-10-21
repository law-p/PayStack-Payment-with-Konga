<?php
ob_start();
session_start();
?>

<?php

// servername, username, password, database name
$host = "localhost";
$username = "bookworm_store";
$password = "1998.1989lawp";
$database = "bookworm_data";

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the payment reference is in the session
if (isset($_SESSION['payment_reference'])) {
    $paymentReference = $_SESSION['payment_reference'];

    // Query to retrieve order data
    $query = "SELECT * FROM user_data WHERE payment_reference = '$paymentReference'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the order data
        $orderData = mysqli_fetch_assoc($result);
    } else {
        // Order not found
        echo "Order not found.";
        exit;
    }
} else {
    // Payment reference not found in session
    echo "Payment reference not found.";
    exit;
}

mysqli_close($connection);
?>


<!doctype html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader -->


<div class="container mt-5">
        <h1 class="mb-4">Thank you! for your Order</h1>
        
        <div class="card">
            <div class="card-body">
                  <!-- Display order details here -->
                <p class="card-text"><strong>Order Reference:</strong> <?php echo $orderData['payment_reference']; ?></p>
                <p class="card-text"><strong>Name:</strong> <?php echo $orderData['FNAME'] . ' ' . $orderData['LNAME']; ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo $orderData['EMAIL']; ?></p>
                <p class="card-text"><strong>Amount:</strong> <?php echo $orderData['amount']; ?></p>
                <p class="card-text"><strong>Product:</strong> <?php echo $orderData['product']; ?></p>
                <p class="card-text"><strong>Description:</strong> <?php echo $orderData['description']; ?></p>
              
            </div>
        </div>
        
        <a href="#" class="btn btn-primary mt-3">Back to Product Page</a>
        <p>Check email for more details</p>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
ob_end_flush();
?>
</body>
</html>
