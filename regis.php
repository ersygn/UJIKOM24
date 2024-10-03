<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "ujikom";
$con = mysqli_connect($host, $user, $password, $database);

$username = $_POST["username"];
$password = $_POST["password"];
$retype_pass = $_POST["retype_pass"];
$email = $_POST["email"];
$date_birth = $_POST["date_birth"];
$gender = $_POST["gender"];
$address = $_POST["address"];
$city = $_POST["city"];
$contact_no = $_POST["contact_no"];
$pay_pal_id = $_POST["pay_pal_id"];


$query = "INSERT INTO registrasi (username,password,retype_pass,email,date_birth,gender,address,city,contact_no,pay_pal_id) VALUES ('$username','$password','$retype_pass','$email','$date_birth','$gender','$address','$city','$contact_no','$pay_pal_id')";

if (mysqli_query($con, $query)) {
	echo "<script>alert('Registrasi Berhasil!!!')</script>";
	echo "<script>window.location = 'login.html';</script>";
}else {
    echo "Pendaftaran Gagal : ".mysqli_error($con);
}
?>