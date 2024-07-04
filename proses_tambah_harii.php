<?php
include "koneksi.php";

$nama_hari = $_POST['nama_hari'];

$query = "INSERT INTO hari (nama_hari) VALUES ('$nama_hari')";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href='admin.php';
        </script>";
    exit();
} else {
    echo "<script>
            alert('Data gagal ditambahkan');
            window.location.href='admin.php';
        </script>";
    exit();
}
