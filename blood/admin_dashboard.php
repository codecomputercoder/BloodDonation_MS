<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <div class="row">
        <div class="col-md-6">
            <h3>Manage Donors</h3>
            <ul class="list-group">
                <li class="list-group-item"><a href="add_donor.php">Add Donor</a></li>
                <li class="list-group-item"><a href="all_donors.php">Show/Edit Donors</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html> 