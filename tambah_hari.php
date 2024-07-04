<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Form Tambah Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 40px;
        }
        h2 {
            font-weight: bold;
            color: #343a40;
        }
        .form-label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .text-center {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Tambah Hari ke Jadwal Pelajaran</h2>
                        <form action="proses_tambah_harii.php" method="POST">
                            <div class="mb-3">
                                <label for="nama_hari" class="form-label">Nama Hari</label>
                                <input type="text" class="form-control" id="nama_hari" name="nama_hari" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
