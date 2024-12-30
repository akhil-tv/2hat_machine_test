<?php
include('config.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $orderDate = $_POST['orderDate'];  // fetching order date to calculate the shipment
    $currentDateTime = new DateTime('now'); // fetching the current data time;
    $orderDateObject = new DateTime($orderDate);
    if ($orderDateObject >= $currentDateTime){
        $shippingDate =  getShippingDate($orderDate);  // calling the calculated shipping date from functions of php
    }else{
        $error = 'Please Select a proper Date for the shipment';
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Shipping Date</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Calculate Your Shipping Date</h2>

                <form method="POST" class="shadow p-4 bg-light rounded">
                    <div class="mb-3">
                        <label for="orderDate" class="form-label">Select Order Date and Time - Machine test</label>
                        <input type="datetime-local" id="orderDate" name="orderDate" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Place Order</button>
                </form>

                <?php if (isset($shippingDate)): ?>
                    <div class="alert alert-success mt-4">
                        <strong>Success!</strong> Your order will be shipped on: <strong><?php echo $shippingDate; ?></strong>
                    </div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-4">
                        <strong><?php echo $error; ?></strong>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional for functionality like tooltips, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





