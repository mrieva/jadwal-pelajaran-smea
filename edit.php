<?php
// Include file koneksi database
include "koneksi.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk mendapatkan data jadwal berdasarkan ID
    $query = "SELECT jp.id_jadwal, jp.durasi, h.id_hari, mp.id_mapel 
              FROM jadwal_pelajaran jp
              JOIN hari h ON jp.id_hari = h.id_hari
              JOIN mata_pelajaran mp ON jp.id_mapel = mp.id_mapel
              WHERE jp.id_jadwal = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Memecah nilai kolom durasi menjadi start_time dan end_time
        list($start_time, $end_time) = explode(' - ', $row['durasi']);
    } else {
        echo "<script>alert('Jadwal tidak ditemukan.'); window.location.href = 'admin.php';</script>";
        exit();
    }
} else {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Pelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="time"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="time"]:focus,
        select:focus {
            outline: none;
            border-color: #007bff;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Jadwal Pelajaran</h2>
        <form action="update_jadwall.php" method="post">
            <input type="hidden" name="id_jadwal" value="<?php echo $row['id_jadwal']; ?>">

            <div class="mb-3">
                <label for="id_hari" class="form-label">Hari</label>
                <select name="id_hari" id="id_hari" class="form-control">
                    <?php
                    $query_hari = "SELECT * FROM hari";
                    $result_hari = mysqli_query($conn, $query_hari);
                    while ($hari = mysqli_fetch_assoc($result_hari)) {
                        $selected = $hari['id_hari'] == $row['id_hari'] ? 'selected' : '';
                        echo "<option value='{$hari['id_hari']}' $selected>{$hari['nama_hari']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                <select name="id_mapel" id="id_mapel" class="form-control">
                    <?php
                    $query_mapel = "SELECT * FROM mata_pelajaran";
                    $result_mapel = mysqli_query($conn, $query_mapel);
                    while ($mapel = mysqli_fetch_assoc($result_mapel)) {
                        $selected = $mapel['id_mapel'] == $row['id_mapel'] ? 'selected' : '';
                        echo "<option value='{$mapel['id_mapel']}' $selected>{$mapel['nama_mata_pelajaran']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" id="start_time" name="start_time" value="<?php echo $start_time; ?>" required>
            </div>
            <div class="form-group">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" id="end_time" name="end_time" value="<?php echo $end_time; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
