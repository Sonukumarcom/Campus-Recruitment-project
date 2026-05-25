<?php
session_start();
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
    <title>Post Premium Job | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="../assets/css/custom.css">
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
      <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><i class="fa fa-arrow-left me-2"></i> Dashboard</a>
      </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                
                <?php if(isset($_SESSION['message'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__bounceIn">
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php unset($_SESSION['message']); } ?>

                <div class="card shadow-lg border-0 animate__animated animate__fadeInUp">
                    <div class="card-header bg-white pt-4 pb-0 border-0">
                        <h4 class="fw-bold text-primary"><i class="fa fa-briefcase me-2"></i> Post New Opportunity</h4>
                        <p class="text-muted small">Fill in the detailed criteria for students.</p>
                        <hr>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <form action="code.php" method="POST">
                            
                            <h6 class="fw-bold text-uppercase text-secondary small mb-3">1. Basic Job Details</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold mb-1">Company Name</label>
                                    <input type="text" name="company_name" class="form-control rounded-pill" placeholder="e.g. Google India" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold mb-1">Job Title / Role</label>
                                    <input type="text" name="job_title" class="form-control rounded-pill" placeholder="e.g. SDE-1 / Intern" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold mb-1">Salary (CTC)</label>
                                    <input type="text" name="salary_package" class="form-control rounded-pill" placeholder="e.g. 12 LPA" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold mb-1">Job Location</label>
                                    <input type="text" name="location" class="form-control rounded-pill" placeholder="e.g. Bangalore / Remote" required>
                                </div>
                            </div>

                            <h6 class="fw-bold text-uppercase text-secondary small mb-3 mt-2">2. Eligibility Criteria</h6>
                            <div class="row bg-light p-3 rounded mb-3">
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold mb-1 small">Target Course</label>
                                    <select name="course" class="form-select rounded-pill">
                                        <option value="B.Tech">B.Tech</option>
                                        <option value="M.Tech">M.Tech</option>
                                        <option value="BCA/MCA">BCA / MCA</option>
                                        <option value="All Courses">All Courses</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold mb-1 small">Target Batch (Year)</label>
                                    <select name="batch" class="form-select rounded-pill">
                                        <option value="2026">2026 Passout</option>
                                        <option value="2027">2027 Passout</option>
                                        <option value="2025">2025 Passout</option>
                                        <option value="Any Batch">Any Batch</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold mb-1 small">Min CGPA / %</label>
                                    <input type="text" name="cgpa" class="form-control rounded-pill" placeholder="e.g. 7.0 or 60%">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold mb-1 small">Eligible Branches</label>
                                    <input type="text" name="branches" class="form-control rounded-pill" placeholder="e.g. CSE, IT, ECE Only (Leave empty for All)" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold mb-1">Job Description & Skills Required</label>
                                <textarea name="description" rows="4" class="form-control" style="border-radius: 15px;" placeholder="• Good knowledge of Java/C++&#10;• Understanding of OOPS&#10;• Good communication skills"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold text-danger mb-1">Last Date to Apply</label>
                                <input type="date" name="last_date" class="form-control rounded-pill" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="add_job_btn" class="btn btn-primary btn-lg shadow-sm rounded-pill">
                                    Publish Job Opening <i class="fa fa-paper-plane ms-2"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </body>
</html>