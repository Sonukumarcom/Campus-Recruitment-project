<?php
session_start();
include('../config/dbcon.php');

if(isset($_POST['add_job_btn']))
{
    // 1. Basic Details
    $company_name = mysqli_real_escape_string($con, $_POST['company_name']);
    $job_title = mysqli_real_escape_string($con, $_POST['job_title']);
    $salary_package = mysqli_real_escape_string($con, $_POST['salary_package']);
    $last_date = mysqli_real_escape_string($con, $_POST['last_date']);
    
    // Description aur Location ko jod dete hain
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $desc_raw = mysqli_real_escape_string($con, $_POST['description']);
    $final_description = "Location: $location \n\n" . $desc_raw;

    // 2. Eligibility Criteria Ko Combine Karna (Magic Step)
    $course = $_POST['course'];
    $batch = $_POST['batch'];
    $cgpa = $_POST['cgpa'];
    $branches = mysqli_real_escape_string($con, $_POST['branches']);

    // Example Result: "B.Tech (CSE, IT) | 2026 Batch | Min 7.0 CGPA"
    $final_criteria = "$course ($branches) | Batch: $batch | Min: $cgpa";

    // 3. Database Query (Wahi purani query, bas values nayi hain)
    $query = "INSERT INTO jobs (company_name, job_title, description, eligibility_criteria, salary_package, last_date) 
              VALUES ('$company_name','$job_title','$final_description','$final_criteria','$salary_package','$last_date')";
    
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Job Posted Successfully with Detailed Criteria!";
        header("Location: add-job.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something went wrong!";
        header("Location: add-job.php");
        exit(0);
    }
}
if(isset($_POST['update_status_btn']))
{
    $app_id = $_POST['app_id'];
    $status = $_POST['update_status'];

    $query = "UPDATE job_applications SET status='$status' WHERE id='$app_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $_SESSION['message'] = "Status updated to $status successfully!";
        header("Location: applications.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong!";
        header("Location: applications.php");
        exit(0);
    }
}
?>