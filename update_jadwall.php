<?php
// Include file koneksi database
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jadwal = mysqli_real_escape_string($conn, $_POST['id_jadwal']);
    $id_hari = mysqli_real_escape_string($conn, $_POST['id_hari']);
    $id_mapel = mysqli_real_escape_string($conn, $_POST['id_mapel']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
    
    // Gabungkan start_time dan end_time menjadi satu string dengan format "HH:MM - HH:MM"
    $durasi = $start_time . ' - ' . $end_time;

    // Query untuk update data jadwal
    $query = "UPDATE jadwal_pelajaran 
              SET id_hari = '$id_hari', id_mapel = '$id_mapel', durasi = '$durasi' 
              WHERE id_jadwal = '$id_jadwal'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Jadwal pelajaran berhasil diperbarui.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: admin.php");
    exit();
}

mysqli_close($conn);
?>
