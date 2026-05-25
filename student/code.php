<?php
session_start();
include('../config/dbcon.php');

// Security Check: Agar login nahi hai to login page par bhej do
if(!isset($_SESSION['auth'])){
    header('Location: ../login.php');
    exit();
}

// ==========================================
// 1. APPLY FOR JOB LOGIC
// ==========================================
if(isset($_POST['apply_job_btn']))
{
    $job_id = mysqli_real_escape_string($con, $_POST['job_id']);
    $user_id = $_SESSION['auth_user']['user_id'];

    // Check karo: Kya user ne pehle hi is job ke liye apply kiya hai?
    $check_query = "SELECT * FROM job_applications WHERE user_id='$user_id' AND job_id='$job_id' ";
    $check_query_run = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_query_run) > 0)
    {
        // Agar pehle se apply kiya hua hai
        $_SESSION['message'] = "You have ALREADY applied for this job!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        // Naya application insert karo
        $query = "INSERT INTO job_applications (user_id, job_id, status) VALUES ('$user_id','$job_id','Applied')";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Applied Successfully! Good Luck.";
            header("Location: index.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Something went wrong!";
            header("Location: index.php");
            exit(0);
        }
    }
}

// ==========================================
// 2. UPDATE PROFILE & RESUME LOGIC
// ==========================================
if(isset($_POST['update_profile_btn']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    // File ka data lena
    $resume = $_FILES['resume']['name'];
    $resume_temp = $_FILES['resume']['tmp_name']; // Temporary location server par

    // Agar file select ki gayi hai
    if($resume != "")
    {
        // File extension check (Optional but good practice)
        $allowed_ext = ['pdf'];
        $file_ext = pathinfo($resume, PATHINFO_EXTENSION);

        if (!in_array($file_ext, $allowed_ext)) {
            $_SESSION['message'] = "Only PDF files are allowed!";
            header("Location: profile.php");
            exit(0);
        }

        // Resume ka naya unique naam banao (Time + Original Name)
        // Example: 1678234_resume.pdf
        $new_resume_name = time() . '-' . $resume; 
        
        // Database Update Query
        $update_query = "UPDATE users SET name='$name', phone='$phone', resume='$new_resume_name' WHERE id='$user_id' ";
        $update_query_run = mysqli_query($con, $update_query);

        if($update_query_run)
        {
            // IMPORTANT: File ko 'uploads/resumes/' folder mein move karo
            // Make sure ye folder exist karta ho
            move_uploaded_file($resume_temp, "../uploads/resumes/" . $new_resume_name);
            
            $_SESSION['message'] = "Profile & Resume Updated Successfully!";
            header("Location: profile.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Database Error: Something went wrong!";
            header("Location: profile.php");
            exit(0);
        }
    }
    else
    {
        // Agar file upload nahi ki, sirf details update karni hain
        $update_query = "UPDATE users SET name='$name', phone='$phone' WHERE id='$user_id' ";
        $query_run = mysqli_query($con, $update_query);

        if($query_run)
        {
            $_SESSION['message'] = "Profile Details Updated (No New Resume)";
            header("Location: profile.php");
            exit(0);
        }
    }
}
?>