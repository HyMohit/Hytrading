<?php
require('vendor/autoload.php'); // Include Razorpay PHP SDK (installed via Composer)

// Your Razorpay API credentials
$razorpayKey = "YOUR_RAZORPAY_KEY"; // Your Razorpay API Key
$razorpaySecret = "YOUR_RAZORPAY_SECRET"; // Your Razorpay Secret Key

// Get Razorpay payment ID from the query string
$payment_id = $_GET['payment_id'];

// Initialize Razorpay API Client
$api = new Razorpay\Api\Api($razorpayKey, $razorpaySecret);

try {
    // Fetch payment details from Razorpay API using payment_id
    $payment = $api->payment->fetch($payment_id);

    // Check if payment is successful
    if ($payment->status == 'captured') {
        // Payment is successful, provide the PDF download
        $pdfFilePath = 'path/to/your/book.pdf'; // Specify the path to your PDF file

        // Force the browser to download the PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="your-book.pdf"');
        readfile($pdfFilePath);
        exit;
    } else {
        // Payment failed or was not captured
        echo "Payment verification failed. Please try again.";
    }
} catch (Exception $e) {
    // Handle any errors that may occur during API call
    echo "Error: " . $e->getMessage();
}
?>
