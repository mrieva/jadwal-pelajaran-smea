<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://source.unsplash.com/1600x900/?nature,water') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Arial', sans-serif;
    }
    .login-container {
      margin-top: 100px;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .login-card h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .form-group label {
      color: #333;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .btn-custom {
      color: #fff;
      text-decoration: none;
    }
    .back-btn {
      margin-top: 10px;
      background-color: #6c757d;
      border: none;
    }
    .back-btn:hover {
      background-color: #5a6268;
    }
  </style>
</head>
<body>
  <?php include 'koneksi.php'; ?>
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4 login-container">
        <div class="login-card">
          <h2 class="text-center">Login</h2>
          <form class="login-form" method="POST" action="logikalogin.php">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <a href="index.php" class="btn btn-primary btn-block back-btn">Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>