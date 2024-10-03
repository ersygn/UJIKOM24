<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ujikom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$paypal_id = $_POST['paypal_id'];
$bank_name = $_POST['bank_name'];
$payment_method = $_POST['payment_method'];
$cart_items = $_POST['cart_items'];
$total_price = $_POST['total_price'];

$sql = "INSERT INTO orders (user_id, name, address, phone, date, paypal_id, bank_name, payment_method, cart_items, total_price) 
        VALUES ('$user_id', '$name', '$address', '$phone', '$date', '$paypal_id', '$bank_name', '$payment_method', '$cart_items', '$total_price')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Pesanan Telah Masuk Pada Admin, Mohon Tunggu Email / Pesan dari Admin untuk Konfirmasi Pesanan Lebih Lanjut.. Mohon Simpan Bukti Pesan Dengan Sebaik Mungkin!!!');
            window.location.href = 'index.html';
          </script>";
} else {
    echo "<script>
            alert('Error: " . $sql . " - " . $conn->error . "');
            window.location.href = 'cart.php';
          </script>";
}

$conn->close();
?>
