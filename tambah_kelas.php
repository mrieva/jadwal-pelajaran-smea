<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        h4 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
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

        .btn-tambah {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-tambah:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .btn-secondary {
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h4 class="mt-4 mb-4 text-center">Tambah Kelas</h4>
        <form action="proses_tambah_kls.php" method="POST">
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
            </div>
            <button type="submit" class="btn-tambah btn btn-primary">Tambah</button>
            <a href="admin.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>
