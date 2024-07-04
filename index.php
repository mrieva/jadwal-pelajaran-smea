<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
         body {
             background-size: cover;
             font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-light .navbar-brand,
        .navbar-light .nav-link {
            color: #ffffff;
        }
        .navbar .navbar-collapse h1 {
            color: #ffffff;
            margin: 0 auto;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .table-container {
            margin: 20px auto;
            max-width: 1000px;
        }
        .table {
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .card-day {
            margin: 10px 0;
            border: none;
        }
        .card-day .card-body {
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 8px;
        }
        h1, h2 {
            text-align: center;
        }
        h1 {
            color: black;
        }
        h2 {
            margin-top: 30px;
            color: #343a40;
        }
        .btn-outline-primary {
            border-color: #ffffff;
            color: #ffffff;
        }
        .btn-outline-primary:hover {
            background-color: #ffffff;
            color: #007bff;
        }
        .search-bar {
            margin-right: 10px;
        }
        .search-bar input {
            border-radius: 20px;
            border: 1px solid #ffffff;
            padding: 5px 20px;
            width: 200px;
            transition: all 0.3s ease;
        }
        .search-bar input:focus {
            width: 300px;
            outline: none;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>
   
<nav class="navbar navbar-expand-lg navbar-light py-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://library.livecanvas.com/sections/">
            <img class="img-fluid" src="https://3.bp.blogspot.com/-Dvg-vFXrZkY/Wv_eG0d4RJI/AAAAAAAAAXg/kR8OLisP8JUbZ3VanZvKI7I5-7keCkDUACEwYBhgL/s1600/SMKN%2B1%2BBanjar.png" alt="" width="48px" height="48px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav_lc" aria-controls="nav_lc" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav_lc">
            <h1>Jadwal Pelajaran</h1>
            <div class="ms-lg-auto d-flex">
                <div class="search-bar">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Kelas" onkeyup="searchClass()">
                </div>
                <a class="btn btn-outline-primary me-2" href="login.php">Log In</a>
            </div>
        </div>
    </div>
</nav>

<div class="table-container" id="tableContainer">
    <?php
    include "koneksi.php";
    $query = "SELECT jp.*, k.nama_kelas, h.nama_hari, m.nama_mata_pelajaran 
              FROM jadwal_pelajaran jp 
              JOIN kelas k ON jp.id_kelas = k.id_kelas 
              JOIN hari h ON jp.id_hari = h.id_hari 
              JOIN mata_pelajaran m ON jp.id_mapel = m.id_mapel 
              ORDER BY jp.id_kelas, jp.id_hari";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kelas = $row['nama_kelas'];
        $hari = $row['nama_hari'];
        if (!isset($data[$kelas])) {
            $data[$kelas] = [];
        }
        if (!isset($data[$kelas][$hari])) {
            $data[$kelas][$hari] = [];
        }
        $data[$kelas][$hari][] = $row;
    }

    $classNames = array_keys($data);
    $currentClass = isset($_GET['class']) ? $_GET['class'] : $classNames[0];
    
    if (!array_key_exists($currentClass, $data)) {
        echo "<p>Kelas tidak ditemukan</p>";
    } else {
        echo "<div class='class-schedule' data-class-name='" . $currentClass . "'>";
        echo "<h2 class='mt-4'>Kelas: " . $currentClass . "</h2>";
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>Hari</th><th>Mata Pelajaran</th><th>Durasi</th></thead>";
        echo "<tbody>";
        foreach ($data[$currentClass] as $hari => $jadwal) {
            usort($jadwal, function($a, $b) {
                return $a['durasi'] <=> $b['durasi'];
            });
            echo "<tr>";
            echo "<td>" . $hari . "</td>";
            echo "<td>";
            foreach ($jadwal as $item) {
                echo "<div class='card card-day'>
                        <div class='card-body'>
                            " . $item['nama_mata_pelajaran'] . " 
                        </div>
                      </div>";
            }
            echo "</td>";
            echo "<td>";
            foreach ($jadwal as $item) {
                echo "<div class='card card-day'>
                        <div class='card-body'>
                            " . $item['durasi'] . "
                        </div>
                      </div>";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</div>";
    }
    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
            foreach ($classNames as $className) {
                $active = ($className == $currentClass) ? 'active' : '';
                echo "<li class='page-item $active'><a class='page-link' href='?class=$className'>$className</a></li>";
            }
            ?>
        </ul>
    </nav>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl0CL2TMvA5g8e9e3AYtnU6iG2e2MOJz9fAd91hUJ/zgCMLiYm4vB4fZ0dN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiSkKK4eVV6pP9J6lhV2pIoh8Kwf1QPx69kV2R6zzf5R5I5w5Pe5p3r7p" crossorigin="anonymous"></script>
<script>
    function searchClass() {
        var input, filter, container, schedules, h2, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        container = document.getElementById('tableContainer');
        schedules = container.getElementsByClassName('class-schedule');

        for (i = 0; i < schedules.length; i++) {
            h2 = schedules[i].getElementsByTagName('h2')[0];
            txtValue = h2.textContent || h2.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                schedules[i].style.display = '';
            } else {
                schedules[i].style.display = 'none';
            }
        }
    }
</script>

