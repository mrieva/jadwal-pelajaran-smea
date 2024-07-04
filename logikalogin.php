<?php

session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows == 1){
    $_SESSION['username'] = $username;
    header("Location: admin.php");
    exit();
}
else
    echo "<script>
        alert('Username atau Password salah!');
        window.location.href='login.php';
        </script>";
    exit();