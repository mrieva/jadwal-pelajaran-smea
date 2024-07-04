<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            max-width: 500px;
            width: 100%;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Tambah Jadwal Pelajaran</h2>
    <form id="myForm" action="insert_jadwal.php" method="POST">
        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <select name="kelas" id="kelas" class="form-control">
                <?php
                include "koneksi.php";
                $query = "SELECT * FROM kelas";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_kelas']}'>{$row['nama_kelas']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="hari">Hari:</label>
            <select name="hari" id="hari" class="form-control">
                <?php
                $query = "SELECT * FROM hari";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_hari']}'>{$row['nama_hari']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mata_pelajaran">Mata Pelajaran:</label>
            <select name="mata_pelajaran" id="mata_pelajaran" class="form-control">
                <?php
                $query = "SELECT * FROM mata_pelajaran";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_mapel']}'>{$row['nama_mata_pelajaran']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" class="form-control" required>
        </div>
        <button type="submit" class="btn-submit">Submit</button>
    </form>
</div>
</body>
</html>
