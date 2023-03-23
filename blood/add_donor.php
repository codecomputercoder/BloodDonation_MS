<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Add new donor
if(isset($_POST['add_donor'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];


    // check email_id already in use or not
    $sql_check_email = "SELECT * FROM donors WHERE email='$email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);
    if(mysqli_num_rows($result_check_email) > 0) {
        echo "This email is already in use.";
        exit();
    }



    
    $sql = "INSERT INTO donors (name, email,contact_number , blood_group,last_donation_date) VALUES ('$name', '$email', '$phone', '$blood_group',now())";
    mysqli_query($conn, $sql);

    $password = $name;
   // $subject = "Welcome to our website";
   // $message = "Hello " . $name . ",\n\nYour username is " . $email . " and your default password is " . $password . ".\n\nPlease log in using these credentials and change your password.\n\nThank you.";
   // $headers = "From: missiontosign@gmail.com";

   // mail($email, $subject, $message, $headers);
    $sql = "INSERT INTO users (username,password,user_type) VALUES ('$email','$password', 'donor')";
    mysqli_query($conn, $sql);
    $sql = "SELECT id FROM donors WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $donor_id = $row["id"];




    $sql="INSERT INTO blood_donations (donor_id, donation_date) VALUES ('$donor_id', now())";
    $result = mysqli_query($conn, $sql);












    header('Location: all_donors.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add donor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

 <!-- Navbar -->
 <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Blood Donation Management System</a>
            </div>
            <ul class="nav navbar-nav">
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

<div class="container">

    <h2>Add a New Donor</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="form-group">
            <label for="blood_group">Blood Group:</label>
            <input type="text" class="form-control" name="blood_group" required>

    </div>
    <button type="submit" name="add_donor" class="btn btn-success">Add donor</button>
    <a href="admin_dashboard.php" class="btn btn-default">Back to Dashboard</a>
</form>
</div>
</body>
</html>