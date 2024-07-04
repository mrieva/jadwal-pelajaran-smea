<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: width 0.5s;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 10px;
        }
        .sidebar ul li a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            transition: 0.3s;
            border-radius: 4px;
        }
        .sidebar ul li a:hover {
            background-color: #495057;
            color: #fff;
        }
        .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
        }
        .logout a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 0;
            display: block;
            transition: 0.3s;
            border-radius: 4px;
        }
        .logout a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.5s;
        }
        .content .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .content .header h2 {
            color: #343a40;
            font-weight: bold;
        }
        .add-button {
            background-color: #198754;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .add-button:hover {
            background-color: #157347;
            transform: scale(1.05);
        }
        .table-container {
            margin-top: 20px; 
            overflow-x: auto; 
        }
        .table-container table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .table-container th {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
        }
        .table-container tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table-container tr:hover {
            background-color: #e9ecef;
        }
        .btn-warning, .btn-danger {
            padding: 5px 10px;
            font-size: 14px;
            margin: 2px 1px;
            border-radius: 3px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>Jadwal <br>Pelajaran</h2>
    <ul>
        <li><a href="tambah_hari.php">Tambah Hari</a></li>
        <li><a href="tambah_kelas.php">Tambah Kelas</a></li>
        <li><a href="tambah_mata_pelajaran.php">Tambah Mata Pelajaran</a></li>
    </ul>
    <div class="logout">
        <a href="logikalogout.php">Logout</a>
    </div>
</div>
<div class="content">
    <div class="header">
        <h2 class="header">Selamat Datang, Barudak!</h2>
        <a href="tambah_jadwal.php" class="add-button">Tambah</a>
    </div>
    <div class="table-container">
        <?php
        include "koneksi.php";
        $query = "SELECT jp.*, k.nama_kelas, h.nama_hari, m.nama_mata_pelajaran 
                  FROM jadwal_pelajaran jp 
                  JOIN kelas k ON jp.id_kelas = k.id_kelas 
                  JOIN hari h ON jp.id_hari = h.id_hari 
                  JOIN mata_pelajaran m ON jp.id_mapel = m.id_mapel 
                  ORDER BY jp.id_kelas, jp.id_jadwal DESC";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $current_class = '';
        while ($row = mysqli_fetch_assoc($result)) {
            if ($current_class != $row['id_kelas']) {
                if ($current_class != '') {
                    echo "</tbody></table><br/>";
                }
                $current_class = $row['id_kelas'];
                echo "<h2>Kelas: " . $row['nama_kelas'] . "</h2>";
                echo "<table class='table table-bordered'>";
                echo "<thead><tr>
                        <th>Hari</th>
                        <th>Mata Pelajaran</th>
                        <th>Durasi</th>
                        <th>Aksi</th>
                      </tr></thead><tbody>";
            }
            echo "<tr>
                    <td>" . $row['nama_hari'] . "</td>
                    <td>" . $row['nama_mata_pelajaran'] . "</td>
                    <td>" . $row['durasi'] . "</td>
                    <td>
                        <a href='edit.php?id=" . $row['id_jadwal'] . "' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='delete.php?id=" . $row['id_jadwal'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus jadwal ini?\")'>Hapus</a>
                    </td>
                  </tr>";
        }
        if ($current_class != '') {
            echo "</tbody></table><br/>";
        }
        ?>
    </div>
</div>
</body>
</html>
