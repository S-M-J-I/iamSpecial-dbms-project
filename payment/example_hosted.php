<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Checkout</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<?php

session_start();
include "db_connection.php";


$id = $_SESSION["id"];
$sql = "SELECT * FROM users WHERE id='$id'";
$res = mysqli_query($conn_integration, $sql);

$user = "";
if ($res) {
    $user = mysqli_fetch_assoc($res);
}


?>

<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Donation</h2>
            <p class="lead">Your donation for: <strong><?php echo $_GET["title"] ?></strong></p>
        </div>

        <form action="checkout_hosted.php" method="POST" class="needs-validation">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your Donation</span>
                    </h4>
                    <br>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (BDT)</span>
                            <input type="text" name="amount" required>
                            <input hidden type="text" name="fundraiser_id" value="<?php echo $_GET["fund_id"] ?>">
                            <div class="invalid-feedback" style="width: 100%;">
                                Your donation amount is required.
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Full name</label>
                            <input type="text" name="customer_name" value="<?php echo $_SESSION["id"] == -1 ? "Anonymous" : $user["first_name"] . ' ' . $user["last_name"];  ?>" class="form-control" id="customer_name" placeholder="" value="John Doe" required>
                            <div class="invalid-feedback">
                                Valid customer name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <div class="input-group">
                            <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile" value="<?php echo $_SESSION["id"] == -1 ? "" : $user["phone"] ?>" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your Mobile number is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" name="customer_email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $_SESSION["id"] == -1 ? "" :  $user["email"] ?>" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" value="<?php echo $_SESSION["id"] == -1 ? "" :  $user["area"] ?>" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted"></span></label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["id"] == -1 ? "" :  $user["city"] ?>" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="Bangladesh">Bangladesh</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" required>
                                <?php

                                if ($_GET["id"] == -1) {
                                    echo "
                                    <option value='Dhaka'>Dhaka</option>
                                    <option value='Chittagong'>Chittagong</option>
                                    <option value='Khulna'>Khulna</option>
                                    <option value='Sylhet'>Sylhet</option>
                                    <option value='Barisal'>Barisal</option>
                                    <option value='Mymensingh'>Mymenshingh</option>
                                    <option value='Rangpur'>Rangpur</option>
                                    ";
                                } else {
                                    echo "<option value='{$user['state']}'>{$user['state']}</option>";
                                }

                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to payment</button>
        </form>
    </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>