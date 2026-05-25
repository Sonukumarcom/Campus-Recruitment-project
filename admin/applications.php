<?php
session_start();
include('../config/dbcon.php');

// Security Check
if(!isset($_SESSION['auth']) || $_SESSION['role_as'] != 1){
    header('Location: ../login.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applications | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="../assets/css/custom.css">
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
      <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><i class="fa fa-arrow-left me-2"></i> Back to Dashboard</a>
        <button class="btn btn-light btn-sm text-primary fw-bold ms-auto" onclick="window.location.href='../logout.php'">Logout</button>
      </div>
    </nav>

    <div class="container mt-5 mb-5">
        
        <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__bounceIn">
                <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php unset($_SESSION['message']); } ?>

        <div class="row mb-4 animate__animated animate__fadeInLeft">
            <div class="col-md-12">
                <h2 class="fw-bold text-dark">Job Applications</h2>
                <p class="text-muted">Manage student applications and update their selection status.</p>
            </div>
        </div>

        <div class="card shadow-lg border-0 animate__animated animate__fadeInUp">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th class="py-3">Student Name</th>
                                <th class="py-3">Contact Info</th>
                                <th class="py-3">Company & Role</th>
                                <th class="py-3">Applied Date</th>
                                <th class="py-3">Resume</th>
                                <th class="py-3" style="width: 200px;">Status Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query updated to fetch a.id as app_id
                            $query = "SELECT a.id as app_id, u.name, u.email, u.phone, u.resume, j.company_name, j.job_title, a.applied_at, a.status 
                                      FROM job_applications a 
                                      JOIN users u ON a.user_id = u.id 
                                      JOIN jobs j ON a.job_id = j.id 
                                      ORDER BY a.applied_at DESC";
                            
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                    ?>
                                    <tr class="text-center">
                                        <td class="fw-bold"><?= $row['name']; ?></td>
                                        <td class="small text-start">
                                            <i class="fa fa-envelope text-muted me-1"></i> <?= $row['email']; ?><br>
                                            <i class="fa fa-phone text-muted me-1"></i> <?= $row['phone']; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-primary border border-primary">
                                                <?= $row['company_name']; ?>
                                            </span><br>
                                            <small class="text-muted"><?= $row['job_title']; ?></small>
                                        </td>
                                        <td><?= date('d M, Y', strtotime($row['applied_at'])); ?></td>
                                        <td>
                                            <?php if($row['resume'] != "") { ?>
                                                <a href="../uploads/resumes/<?= $row['resume']; ?>" target="_blank" class="btn btn-info btn-sm rounded-pill text-white px-3">
                                                    <i class="fa fa-download me-1"></i> Resume
                                                </a>
                                            <?php } else { ?>
                                                <span class="text-muted small">No File</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="app_id" value="<?= $row['app_id']; ?>">
                                                <select name="update_status" class="form-select form-select-sm mb-1 rounded-pill" onchange="this.form.submit()">
                                                    <option value="Under Review" <?= $row['status'] == 'Under Review' ? 'selected':'' ?>>Under Review</option>
                                                    <option value="Accepted" <?= $row['status'] == 'Accepted' ? 'selected':'' ?>>Accepted</option>
                                                    <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected':'' ?>>Rejected</option>
                                                </select>
                                                <input type="hidden" name="update_status_btn" value="1">
                                            </form>
                                            <small class="text-muted">Current: <b><?= $row['status']; ?></b></small>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='6' class='text-center py-5 text-muted'>No Applications Found yet.</td></tr>";
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