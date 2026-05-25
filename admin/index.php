<?php
session_start();
include('../config/dbcon.php');

// Security Check
if(!isset($_SESSION['auth']) || $_SESSION['role_as'] != 1){
    header('Location: ../login.php');
    exit();
}

// Data Fetching for Stats (Dashboard Logic)
$total_students = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE role_as=0"));
$total_jobs = mysqli_num_rows(mysqli_query($con, "SELECT * FROM jobs"));
$total_applications = mysqli_num_rows(mysqli_query($con, "SELECT * FROM job_applications"));
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="../assets/css/custom.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fa fa-user-shield me-2"></i> Admin Panel</a>
        <button class="btn btn-light btn-sm text-primary fw-bold ms-auto" onclick="window.location.href='../logout.php'">
            <i class="fa fa-sign-out-alt"></i> Logout
        </button>
      </div>
    </nav>

    <div class="container mt-5">
        
        <div class="row mb-4 animate__animated animate__fadeInDown">
            <div class="col-md-12">
                <h2 class="fw-bold text-dark">Dashboard Overview</h2>
                <p class="text-muted">Welcome back, Admin! Here is what's happening today.</p>
            </div>
        </div>

        <div class="row mb-4">
            
            <div class="col-md-4 mb-3 animate__animated animate__fadeInLeft">
                <div class="card stats-card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Students</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_students; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300 text-primary opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 animate__animated animate__fadeInUp">
                <div class="card stats-card border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Jobs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_jobs; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-briefcase fa-2x text-gray-300 text-success opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 animate__animated animate__fadeInRight">
                <div class="card stats-card border-left-warning h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Applications</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_applications; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300 text-warning opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mb-3 mt-5 fw-bold text-dark animate__animated animate__fadeIn">Quick Actions</h4>
        <div class="row animate__animated animate__fadeInUp">
            
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center p-5">
                        <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                        <h4>Post New Job</h4>
                        <p class="text-muted">Create a new vacancy for students.</p>
                        <a href="add-job.php" class="btn btn-primary px-4">Create Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center p-5">
                        <i class="fas fa-list-alt fa-3x text-success mb-3"></i>
                        <h4>View Applications</h4>
                        <p class="text-muted">Check who applied and download resumes.</p>
                        <a href="applications.php" class="btn btn-success px-4">View All</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>