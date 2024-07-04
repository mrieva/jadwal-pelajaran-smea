<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - Tambah Mata Pelajaran</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 15px 15px 0 0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center mb-0">Tambah Mata Pelajaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nama_mata_pelajaran">Nama Mata Pelajaran</label>
                                <input type="text" class="form-control" id="nama_mata_pelajaran" name="nama_mata_pelajaran" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="submit">Tambah</button>
                            <a href="admin.php" class="btn btn-secondary btn-block mt-2">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
