   <?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'donor') {
    header('Location: index.php');
    exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$username=$_SESSION['username'];

// Get donor information
$sql_donor_info = "SELECT * FROM donors WHERE email='$username'";
$result_donor_info = mysqli_query($conn, $sql_donor_info);
$donor_info = mysqli_fetch_assoc($result_donor_info);

// Get all donation dates
$sql_donation_dates = "SELECT donation_date FROM blood_donations ,donors WHERE donors.email='$username' and donors.id=blood_donations.donor_id";
$result_donation_dates = mysqli_query($conn, $sql_donation_dates);
$donation_dates = array();
while($row = mysqli_fetch_assoc($result_donation_dates)) {
    $donation_dates[] = $row['donation_date'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>donor Dashboard</title>
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
    <h2>Welcome, <?php echo $donor_info['name']; ?></h2>
    <h3>Your Information:</h3>
    <table class="table">
        <tr>
            <td>Name:</td>
            <td><?php echo $donor_info['name']; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $donor_info['email']; ?></td>
        </tr>
        <tr>
            <td>Blood Group:</td>
            <td><?php echo $donor_info['blood_group']; ?></td>
        </tr>
        <tr>
            <td>Contact Number:</td>
            <td><?php echo $donor_info['contact_number']; ?></td>
        </tr>
        <tr>
            <td>Last Donation Date:</td>
            <td><?php echo $donor_info['last_donation_date']; ?></td>
        </tr>
    </table>

    <h3>Your Donation Dates:</h3>
    <?php if(count($donation_dates) > 0) { ?>
        <ul>
        <?php foreach($donation_dates as $date) { ?>
            <li><?php echo $date; ?></li>
        <?php } ?>
        </ul>
    <?php } else { ?>
        <p>You haven't donated yet.</p>
    <?php } ?>

    
</div>

</body>
</html>

</div>

</body>
</html>
