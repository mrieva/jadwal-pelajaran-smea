<?php

include "koneksi.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    if (isset($_GET['confirm'])) {
        $query = "DELETE FROM jadwal_pelajaran WHERE id_jadwal = '$id'"; // Menggunakan kolom yang benar

        if (mysqli_query($conn, $query))  {
            echo "<script>alert('Jadwal pelajaran berhasil dihapus.'); window.location.href = 'admin.php';</script>"; // Pesan konfirmasi setelah penghapusan
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "<script>if (confirm('Yakin ingin menghapus jadwal ini?')) {";
        echo "window.location.href='delete.php?id=$id&confirm=true';";
        echo "} else {";
        echo "window.location.href='admin.php';"; // Redirect to admin page on cancel
        echo "}</script>";

        $query = "SELECT jp.id_jadwal, jp.durasi, h.nama_hari, mp.nama_mata_pelajaran 
                  FROM jadwal_pelajaran jp
                  JOIN hari h ON jp.id_hari = h.id_hari
                  JOIN mata_pelajaran mp ON jp.id_mapel = mp.id_mapel
                  WHERE jp.id_jadwal = '$id'";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo "<h4>Jadwal yang akan dihapus:</h4>";
            echo "<h6>Mata Pelajaran: " . $row['nama_mata_pelajaran'] . "</h6>";
            echo "<p>Hari: " . $row['nama_hari'] . "</p>";
            echo "<p>Durasi: " . $row['durasi'] . "</p>";
        } else {
            echo "<script>alert('Jadwal tidak ditemukan.'); window.location.href = 'admin.php';</script>";
        }
    }
} else {
    header("Location: admin.php");
    exit();
}

mysqli_close($conn);
?>
