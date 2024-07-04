<?php
session_start();

include "koneksi.php";

$kelas = $_POST['nama_kelas'];

$sql = "INSERT INTO kelas (nama_kelas) VALUES ('$kelas')";

$result = $conn->query($sql);

if ($result) {
    echo "<script>alert('Data berhasil ditambahkan'); window.location.href='admin.php';</script>";
} else {
    echo "<script>alert('Data gagal ditambahkan'); window.location.href='admin.php';</script>";
}
