<?php
session_start();
include('../config/dbcon.php');

if(isset($_POST['register_btn']))
{
    // User data input lena
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    // Check agar passwords match karte hain
    if($password == $cpassword)
    {
        // Check agar Email pehle se exist karta hai
        $check_email_query = "SELECT email FROM users WHERE email='$email'";
        $check_email_query_run = mysqli_query($con, $check_email_query);

        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $_SESSION['message'] = "Email already registered!";
            header("Location: ../register.php");
        }
        else
        {
            // Data Insert karna (Role 0 matlab Student)
            $insert_query = "INSERT INTO users (name, email, phone, password, role_as) VALUES ('$name','$email','$phone','$password', 0)";
            $insert_query_run = mysqli_query($con, $insert_query);

            if($insert_query_run)
            {
                $_SESSION['message'] = "Registered Successfully! Please Login.";
                header("Location: ../login.php");
            }
            else
            {
                $_SESSION['message'] = "Something went wrong!";
                header("Location: ../register.php");
            }
        }
    }
    else
    {
        $_SESSION['message'] = "Passwords do not match";
        header("Location: ../register.php");
    }
}

// ... Upar wala register code waisa hi rahega ...

else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Database mein check karo
    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        // Data fetch karo
        $userdata = mysqli_fetch_array($login_query_run);
        $user_id = $userdata['id'];
        $user_name = $userdata['name'];
        $role_as = $userdata['role_as']; // 0 = Student, 1 = Admin

        // Session variables set karo (Login ho gaya)
        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'name' => $user_name,
            'email' => $email
        ];
        $_SESSION['role_as'] = $role_as;

        // Role check karke redirect karo
        if($role_as == 1)
        {
            $_SESSION['message'] = "Welcome to Admin Dashboard";
            header("Location: ../admin/index.php");
        }
        else
        {
            $_SESSION['message'] = "Logged in Successfully";
            header("Location: ../student/index.php");
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid Email or Password";
        header("Location: ../login.php");
    }
}
?>