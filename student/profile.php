<?php
session_start();
include('../config/dbcon.php');

if(!isset($_SESSION['auth'])){
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['auth_user']['user_id'];
$query = "SELECT * FROM users WHERE id='$user_id' ";
$query_run = mysqli_query($con, $query);
$user = mysqli_fetch_array($query_run);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    
    <nav class="navbar navbar-dark bg-primary mb-4">
      <div class="container">
        <a class="navbar-brand" href="index.php">Back to Dashboard</a>
      </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <?php if(isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning"><?= $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); } ?>

                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h4>Update Profile & Resume</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="name" value="<?= $user['name']; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" value="<?= $user['phone']; ?>" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label class="fw-bold">Upload Resume (PDF Only)</label>
                                <input type="file" name="resume" class="form-control" accept=".pdf" required>
                                <small class="text-muted">Current Resume: 
                                    <?php if($user['resume'] != "") { ?>
                                        <a href="../uploads/resumes/<?= $user['resume']; ?>" target="_blank">View File</a>
                                    <?php } else { echo "Not Uploaded"; } ?>
                                </small>
                            </div>

                            <button type="submit" name="update_profile_btn" class="btn btn-primary w-100">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>