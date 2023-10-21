<?php
ob_start();
session_start();
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
<form id="paymentForm">
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center p-5">
            <div class="col-12 col-md-8 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 class="text-success text-center">Account Details</h4>

                            <div class="form-group">
                                <label for="text">First Name:</label>
                                <input type="text" class="form-control" name="FNAME" id="FNAME" required>
                            </div>

                            <div class="form-group">
                                <label for="text">Last Name:</label>
                                <input type="text" class="form-control" name="LNAME" id="LNAME" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" name="EMAIL" id="EMAIL" required>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" required>
                                <label class="form-check-label" for="check1">I agree to all <a href="#">Terms of Service</a></label>
                            </div>

                            <div class="d-grid gap-2 form-submit">
                                <button type="button" name="submit" class="btn btn-success" onclick="payAndStore()"> Pay </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

function payAndStore() {
    let firstName = document.getElementById("FNAME").value;
    let lastName = document.getElementById("LNAME").value;
    let email = document.getElementById("EMAIL").value;
    let amount = 1900.00; // Replace with your predetermined amount
    let paymentReference = 'REF' + Math.floor((Math.random() * 1000000000) + 1); // Generate a random reference
    let product = 'Kakiva Leave-in Conditioner- 250ml';
    let description = 'A perfect Kakiva Leave-in Conditioner- 250ml that will make this look all good';
 
    let handler = PaystackPop.setup({
        key: 'XXXXXXXXXXXXXXXXXXXXX', // Replace with your public key from paystack
        email: email,
        amount: amount * 100, // Convert to kobo
        ref: paymentReference,
        onClose: function(){
            alert('Transaction Closed');
        },
        callback: function(response) {
            // Send form data to insert page using AJAX
            $.ajax({
                type: 'POST',
                url: 'insert', 
                data: {
                    FNAME: firstName,
                    LNAME: lastName,
                    EMAIL: email,
                    amount: amount,
                    payment_reference: paymentReference,
                    product: product,
                    description: description
                },
                success: function(data) {
                  // Redirect to success.php
                  window.location.href = 'success';
        },
            error: function(xhr, status, error) {
                    console.error(error); // Output error, if any
                }
            });
        }
    });

    handler.openIframe();
}
</script>

<?php
ob_end_flush();
?>
</body>
</html>
