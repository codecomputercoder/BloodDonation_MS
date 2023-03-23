<?php
session_start();
include 'config.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_type='$user_type'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_type'] = $row['user_type'];
        if($user_type == 'admin') {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: donor_dashboard.php');
        }
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Login</title>
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
    <h2>Login Portal</h2>
    <form method="post">
        <?php if(isset($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label
for="password">Password:</label>
<input type="password" class="form-control" name="password" required>
</div>
<div class="form-group">
<label for="user_type">User Type:</label>
<select class="form-control" name="user_type" required>
<option value="">Select User Type</option>
<option value="admin">Admin</option>
<option value="donor">Donor</option>
</select>
</div>
<button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

</div>
</body>
</html> 