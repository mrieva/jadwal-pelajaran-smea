<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "koneksi.php";

    $id_kelas = $_POST['kelas'];
    $id_hari = $_POST['hari'];
    $id_mapel = $_POST['mata_pelajaran'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $durasi = "$start_time - $end_time"; // Combine start and end times into one string

    // Debugging: Check the values received from the form
    error_log("Received values - Kelas: $id_kelas, Hari: $id_hari, Mapel: $id_mapel, Start Time: $start_time, End Time: $end_time");

    $valid = true;

    // Check id_kelas
    $query = "SELECT COUNT(*) AS count FROM kelas WHERE id_kelas = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_kelas);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $valid = false;
        error_log("Invalid Kelas ID: $id_kelas");
        echo "<script>alert('Kelas tidak valid'); window.location.href='tambah_jadwal.php';</script>";
    }

    // Check id_hari
    $query = "SELECT COUNT(*) AS count FROM hari WHERE id_hari = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_hari);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $valid = false;
        error_log("Invalid Hari ID: $id_hari");
        echo "<script>alert('Hari tidak valid'); window.location.href='tambah_jadwal.php';</script>";
    }

    // Check id_mapel
    $query = "SELECT COUNT(*) AS count FROM mata_pelajaran WHERE id_mapel = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_mapel);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $valid = false;
        error_log("Invalid Mata Pelajaran ID: $id_mapel");
        echo "<script>alert('Mata pelajaran tidak valid'); window.location.href='tambah_jadwal.php';</script>";
    }

    // Insert data if all foreign key values are valid
    if ($valid) {
        $sql = "INSERT INTO jadwal_pelajaran (id_kelas, id_hari, id_mapel, durasi) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $id_kelas, $id_hari, $id_mapel, $durasi);

        if ($stmt->execute()) {
            echo "<script>alert('Jadwal berhasil ditambahkan'); window.location.href='admin.php';</script>";
        } else {
            error_log("Database Error: " . $stmt->error);
            echo "<script>alert('Gagal menambahkan jadwal'); window.location.href='tambah_jadwal.php';</script>";
        }
        $stmt->close();
    }

    $conn->close();
}
?>
