<?php
session_start();
if(isset($_SESSION['auth'])){
    header('Location: student/index.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body {
            background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: none;
        }
        .form-control {
            border-radius: 50px;
            padding: 10px 20px;
            background: #f1f3f5;
            border: 1px solid transparent;
        }
        .form-control:focus { background: #fff; border-color: #66a6ff; box-shadow: none; }
        .btn-register {
            border-radius: 50px;
            background: linear-gradient(to right, #66a6ff, #89f7fe);
            border: none;
            padding: 12px;
            font-weight: bold;
            color: white;
        }
        .btn-register:hover { opacity: 0.9; transform: scale(1.02); transition: 0.3s; }
    </style>
  </head>
  <body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <?php if(isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning text-center rounded-pill"><?= $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); } ?>

                <div class="card register-card animate__animated animate__fadeInUp">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">Create Account</h3>
                            <p class="text-muted small">Join us to find your dream job</p>
                        </div>

                        <form action="functions/authcode.php" method="POST">
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="phone" class="form-control" placeholder="Phone Number" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            
                            <button type="submit" name="register_btn" class="btn btn-primary w-100 btn-register mt-2">REGISTER NOW</button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <small>Already have an account? <a href="login.php" class="text-decoration-none fw-bold">Login Here</a></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

  </body>
</html>