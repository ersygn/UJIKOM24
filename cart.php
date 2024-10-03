<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSS-Toko Alat Kesehatan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
    <script>
        function initUserId() {
            let userId = localStorage.getItem('user_id');
            if (!userId) {
                userId = 1;
            } else {
                userId = parseInt(userId) + 1;
            }
            localStorage.setItem('user_id', userId);
            document.getElementById('user-id').value = userId;
        }
        window.onload = initUserId;
    </script>
</head>
<body>
    <nav class="text-black py-3 d-flex justify-content-between align-items-center" style="background-color: #9ddeb0;">
        <p class="mb-0" style="font-size: large; font-weight: bold; padding-left: 40px;">SEHAT KUY</p>
        <div class="icon-cart" style="padding-right: 40px;">
        <div class="d-flex align-items-center" style="padding-right: 20px;">
        <li class="list-unstyled mr-3" style="font-size: medium; font-weight: bold;">Hi, <?php echo $_SESSION['username']; ?></li>
        <a href="index.html" id="logout-btn" style="color: black; font-size: medium;">Logout</a>
    </div>
        </div>
    </nav>
    <form action="process_order.php" method="post" id="order-form">
        <div class="container">
            <div class="user-details mt-2">
                <h4 style="text-align: center; text-decoration: underline; margin-bottom: 2%;">Form User Details</h4>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="user-id">User ID:</label>
                            <input type="text" name="user_id" id="user-id" class="form-control" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="user-name">Nama:</label>
                            <input type="text" name="name" id="user-name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="user-address">Alamat:</label>
                            <input type="text" name="address" id="user-address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="user-date">Tanggal:</label>
                            <input type="date" name="date" id="user-date" class="form-control" required>
                        </div>
                    </div>          
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="user-phone">No HP:</label>
                            <input type="text" name="phone" id="user-phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="user-paypal">ID PayPal:</label>
                            <input type="text" name="paypal_id" id="user-paypal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user-bank">Nama Bank:</label>
                            <input type="text" name="bank_name" id="user-bank" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user-payment">Cara Bayar:</label>
                            <select name="payment_method" id="user-payment" class="form-control">
                                <option value="Prepaid">Prepaid</option>
                                <option value="Postpaid">Postpaid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-4" style="background-color: black; color: white;">
                            <div class="card-body text-center">
                                <label>Pembayaran Prepaid bisa melalui BANK BNI : 1234567654 a.n Sehat Kuy
                                    <br>(Mohon Cetak PDF setelah melakukan inputan sebelum klik Submit Order)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="text-center my-4" style="text-decoration: underline">Product List</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <label>STETOSKOP</label>
                            <p>Price: Rp25000</p>
                            <button type="button" class="btn btn-primary add-to-cart" data-name="STETOSKOP" data-price="25000">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <label>THERMOMETER</label>
                            <p>Price: Rp15000</p>
                            <button type="button" class="btn btn-primary add-to-cart" data-name="THERMOMETER" data-price="15000">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <label>TENSIMETER</label>
                            <p>Price: Rp35000</p>
                            <button type="button" class="btn btn-primary add-to-cart" data-name="TENSIMETER" data-price="35000">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <label>WHEEL CHAIR</label>
                            <p>Price: Rp100000</p>
                            <button type="button" class="btn btn-primary add-to-cart" data-name="WHEEL CHAIR" data-price="100000">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <label>KRUK</label>
                            <p>Price: Rp75000</p>
                            <button type="button" class="btn btn-primary add-to-cart" data-name="KRUK" data-price="75000">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <label>WALKER</label>
                            <p>Price: Rp90000</p>
                            <button type="button" class="btn btn-primary add-to-cart" data-name="WALKER" data-price="90000">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="cart text-center">
                        <h4 style="text-decoration: underline;">Cart</h4>
                        <ul id="cart-items" class="list-group mx-auto" style="width: 50%;"></ul>
                        <input type="hidden" name="cart_items" id="cart-items-input">
                        <input type="hidden" name="total_price" id="cart-total-input">
                        <p>Total: Rp.<span id="cart-total">0</span></p>
                        <button type="button" id="clear-cart" class="btn btn-danger">Clear Cart</button>
                        <button type="button" id="print-cart" class="btn btn-info">Cetak PDF</button>
                        <button type="submit" class="btn btn-success">Submit Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <footer class="text-black text-center py-3" style="background-color: #9ddeb0; font-size: small;">
        <p class="mb-0">&copy; 2024 OSS-Toko Alat Kesehatan. Ujikom.</p>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
