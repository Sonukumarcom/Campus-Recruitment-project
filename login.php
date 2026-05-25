<?php
session_start();
if(isset($_SESSION['auth'])){
    if($_SESSION['role_as'] == 1){ header('Location: admin/index.php'); }
    else { header('Location: student/index.php'); }
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Now</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            background: #f8f9fa;
            border: 1px solid #eee;
        }
        .form-control:focus { box-shadow: none; border-color: #667eea; background: #fff; }
        .btn-login {
            border-radius: 50px;
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            padding: 12px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .btn-login:hover { opacity: 0.9; }
    </style>
  </head>
  <body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <?php if(isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show text-center rounded-pill" role="alert">
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php unset($_SESSION['message']); } ?>

                <div class="card login-card animate__animated animate__zoomIn">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold" style="color: #5a67d8;">Welcome Back</h3>
                            <p class="text-muted small">Login to access your dashboard</p>
                        </div>

                        <form action="functions/authcode.php" method="POST">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                            </div>
                            <button type="submit" name="login_btn" class="btn btn-primary w-100 btn-login text-white mb-3">LOGIN</button>
                        </form>
                        
                        <div class="text-center">
                            <small class="text-muted">Don't have an account? <a href="register.php" class="text-decoration-none fw-bold" style="color: #764ba2;">Register Here</a></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>