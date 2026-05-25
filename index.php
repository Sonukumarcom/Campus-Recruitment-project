<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Placement Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fc; }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        .btn-glow {
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
            transition: 0.3s;
        }
        .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 0 25px rgba(255, 255, 255, 0.8); }
        
        .feature-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .feature-card:hover { transform: translateY(-10px); }
        .icon-box {
            width: 80px; height: 80px;
            background: #eef2ff;
            color: #667eea;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
            font-size: 30px;
        }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark absolute-top" style="background: #667eea;">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fa fa-graduation-cap"></i> MITM Placement</a>
        <div class="ms-auto">
            <?php if(isset($_SESSION['auth'])) { ?>
                <a href="student/index.php" class="btn btn-light rounded-pill px-4 btn-sm fw-bold">Dashboard</a>
            <?php } else { ?>
                <a href="login.php" class="btn btn-outline-light rounded-pill px-4 btn-sm me-2">Login</a>
                <a href="register.php" class="btn btn-light rounded-pill px-4 btn-sm fw-bold">Register</a>
            <?php } ?>
        </div>
      </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 animate__animated animate__fadeInDown">
                    <h1 class="display-3 fw-bold mb-4">Launch Your Career With Us</h1>
                    <p class="lead mb-5 opacity-75">Connect with top companies, apply for jobs, and track your applications in real-time. Your future starts here.</p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="register.php" class="btn btn-light btn-lg rounded-pill px-5 fw-bold btn-glow text-primary">Get Started</a>
                        <a href="#features" class="btn btn-outline-light btn-lg rounded-pill px-5">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5 mt-5">
        <div class="container">
            <div class="row text-center">
                
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box"><i class="fa fa-briefcase"></i></div>
                        <h4 class="fw-bold">Top Companies</h4>
                        <p class="text-muted">Get placed in top MNCs and Startups directly from campus drives.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box"><i class="fa fa-rocket"></i></div>
                        <h4 class="fw-bold">Easy Apply</h4>
                        <p class="text-muted">One-click application process. No more filling lengthy forms again and again.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box"><i class="fa fa-file-alt"></i></div>
                        <h4 class="fw-bold">Resume Builder</h4>
                        <p class="text-muted">Upload and manage your resume to showcase your skills effectively.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0 small">© 2026 MITM Placement Portal. Designed by Sonu Kumar.</p>
    </footer>

  </body>
</html>