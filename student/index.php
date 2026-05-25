<?php
session_start();
include('../config/dbcon.php');

if(!isset($_SESSION['auth'])){
    header('Location: ../login.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Career Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="../assets/css/custom.css">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            border-radius: 0 0 30px 30px;
            margin-bottom: 30px;
        }
        .status-badge { font-size: 0.8rem; padding: 5px 12px; border-radius: 50px; }
    </style>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent absolute-top" style="background: #667eea;">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fa fa-graduation-cap"></i> CareerHub</a>
        <div class="d-flex">
            <a href="profile.php" class="btn btn-light btn-sm me-2 rounded-circle" title="Profile"><i class="fa fa-user"></i></a>
            <a href="../logout.php" class="btn btn-danger btn-sm rounded-pill">Logout</a>
        </div>
      </div>
    </nav>

    <div class="hero-section text-center animate__animated animate__fadeIn">
        <div class="container">
            <h1 class="display-5 fw-bold">Find Your Dream Job</h1>
            <p class="lead">Welcome, <?= $_SESSION['auth_user']['name']; ?>! Companies are looking for you.</p>
        </div>
    </div>

    <div class="container">
        
        <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__bounceIn" role="alert">
                <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php unset($_SESSION['message']); } ?>

        <h4 class="mb-4 fw-bold text-dark border-start border-4 border-primary ps-3 animate__animated animate__fadeInLeft">
            Latest Opportunities
        </h4>

        <div class="row mb-5">
            <?php
            $current_date = date('Y-m-d');
            $query = "SELECT * FROM jobs WHERE last_date >= '$current_date' ORDER BY last_date ASC";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
                $delay = 0;
                foreach($query_run as $item)
                {
                    $delay += 100;
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: <?= $delay; ?>ms;">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <span class="badge bg-light text-primary mb-2 shadow-sm">
                                    <i class="fa fa-building"></i> <?= $item['company_name']; ?>
                                </span>
                                <h5 class="card-title fw-bold text-dark"><?= $item['job_title']; ?></h5>
                                <h6 class="text-success fw-bold mb-3"><?= $item['salary_package']; ?></h6>
                                <p class="card-text text-muted small"><?= substr($item['description'], 0, 80); ?>...</p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-danger fw-bold"><i class="fa fa-clock"></i> Exp: <?= date('d M', strtotime($item['last_date'])); ?></small>
                                    <form action="code.php" method="POST">
                                        <input type="hidden" name="job_id" value="<?= $item['id']; ?>">
                                        <button type="submit" name="apply_job_btn" class="btn btn-primary btn-sm px-3 rounded-pill">Apply Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else { echo '<p class="text-muted ms-3">No new jobs available.</p>'; }
            ?>
        </div>

        <h4 class="mb-4 fw-bold text-dark border-start border-4 border-success ps-3 animate__animated animate__fadeInLeft">
            My Applied Jobs & Status
        </h4>

        <div class="card shadow-sm border-0 mb-5 animate__animated animate__fadeInUp">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Company</th>
                                <th>Role</th>
                                <th>Applied Date</th>
                                <th class="text-center">Current Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user_id = $_SESSION['auth_user']['user_id'];
                            $applied_query = "SELECT a.status, a.applied_at, j.company_name, j.job_title 
                                             FROM job_applications a, jobs j 
                                             WHERE a.job_id = j.id AND a.user_id = '$user_id' 
                                             ORDER BY a.applied_at DESC";
                            $applied_run = mysqli_query($con, $applied_query);

                            if(mysqli_num_rows($applied_run) > 0)
                            {
                                foreach($applied_run as $app)
                                {
                                    ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-primary"><?= $app['company_name']; ?></td>
                                        <td><?= $app['job_title']; ?></td>
                                        <td><?= date('d M, Y', strtotime($app['applied_at'])); ?></td>
                                        <td class="text-center">
                                            <?php 
                                            $st = $app['status'];
                                            if($st == 'Under Review') {
                                                echo '<span class="badge bg-warning text-dark rounded-pill px-3">Under Review</span>';
                                            } elseif($st == 'Accepted') {
                                                echo '<span class="badge bg-success text-white rounded-pill px-3"><i class="fa fa-check-circle me-1"></i> Shortlisted</span>';
                                            } elseif($st == 'Rejected') {
                                                echo '<span class="badge bg-danger text-white rounded-pill px-3">Not Selected</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="4" class="text-center py-4 text-muted">You haven\'t applied for any jobs yet.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>