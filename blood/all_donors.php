    <?php
    session_start();
    if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
        header('Location: index.php');
        exit();
    }

    include 'config.php';

    // Delete donor
    if(isset($_POST['delete_donor'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM donors WHERE id='$id'";
        mysqli_query($conn, $sql);
        header('Location: all_donors.php');
        exit();
    }


    // Update last donation date
    if(isset($_POST['update_last_donation_date'])) {
        $id = $_POST['id'];
        $new_last_donation_date = $_POST['new_last_donation_date'];

        $sql = "UPDATE donors SET last_donation_date='$new_last_donation_date' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $sql="INSERT INTO blood_donations (donor_id, donation_date) VALUES ('$id', '$new_last_donation_date')";
    $result = mysqli_query($conn, $sql);

    #if ($result) {
    #    echo "Last donation date updated successfully!";
    #} else {
    #    echo "Error updating last donation date: " . mysqli_error($conn);
    #}
    }








    // Update donor
    if(isset($_POST['update_donor'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact_number = $_POST['contact_number'];
        $blood_group = $_POST['blood_group'];
        
        
        $sql = "UPDATE donors SET name='$name', email='$email', contact_number='$contact_number', blood_group='$blood_group' WHERE id='$id'";
        mysqli_query($conn, $sql);


        header('Location: all_donors.php');
        exit();
    }

    $sql = "SELECT * FROM donors";
    $result = mysqli_query($conn, $sql);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>All Donors</title>
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
        <h2>All donors</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Blood Group</th>
                    <th>Last Blood Donation Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact_number']; ?></td>
                    <td><?php echo $row['blood_group']; ?></td>
                    <td><?php echo $row['last_donation_date']; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                        <form method="post" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger" name="delete_donor">Delete</button>
                        </form>
                    </td>
                </tr>
                
               <!-- Edit Modal -->
<div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="editModalLabel">Edit donor</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Phone:</label>
                        <input type="text" class="form-control" name="contact_number" value="<?php echo $row['contact_number']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="blood_group">Blood Group:</label>
                        <input type="text" class="form-control" name="blood_group" value="<?php echo $row['blood_group']; ?>" required>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-primary" name="update_donor">Save changes</button>
                </form>
                <br>
                
                <form method="post">
                    <div class="form-group">
                        <label for="last_donation_date">New Blood Donation Date:</label>
                        <input type="date" class="form-control" name="new_last_donation_date" value="" required>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-primary" name="update_last_donation_date">Add New Blood Donation Date</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
        <?php } ?>
        <a href="admin_dashboard.php" class="btn btn-default left" style="float: right;">Back to Dashboard</a>
        </tbody>
        </table>
        </div>
        </body>
        </html>