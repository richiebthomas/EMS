<?php
// Include the config file and any other necessary files
require_once("config.php");

// Check if the user is logged in (you should have a session check here)
// If not logged in, you might want to redirect to the login page
if (!isset($_SESSION['login_sess']) || $_SESSION['login_sess'] !== "1") {
    header("location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();  // Unset all session variables
    session_destroy();  // Destroy the session
    header("location: login.php");
    exit();
}

// Process the form submission to add a new event
if(isset($_POST['addEvent']))
{
    // Extract form data
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $eventVenue = $_POST['eventVenue'];
    $coordinator = $_POST['coordinator'];
    $budget = $_POST['budget'];

    // Perform any additional validation on form data if needed

    // Insert the event into the database
    $query = "INSERT INTO events (event_name, event_date, event_time, event_venue, coordinator, budget) 
              VALUES ('$eventName', '$eventDate', '$eventTime', '$eventVenue', '$coordinator', '$budget')";
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Event added successfully
        echo '<script>alert("Event added successfully!");</script>';
    } else {
        // Error adding event
        echo '<script>alert("Error adding event. Please try again.");</script>';
    }
}

// Fetch and display all events
$query = "SELECT * FROM events";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Event Management System</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container-fluid">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="https://fcrit.ac.in/img/fcritlogo.png" alt="FCRIT Logo" height="40">
                Campus Event Manager
            </a>
            <form class="form-inline ml-auto" method="post" action="">
                <button class="btn btn-outline-danger" type="submit" name="logout">Logout</button>
            </form>
        </nav>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <h1 class="text-center">Events Dashboard</h1>
            </div>
        </div>

        <!-- Add Event Form -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Add New Event</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="eventName" placeholder="Event Name" required>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="eventDate" required>
                    </div>
                    <div class="form-group">
                        <input type="time" class="form-control" name="eventTime" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="eventVenue" placeholder="Venue" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="coordinator" placeholder="Coordinator" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="budget" placeholder="Budget" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="addEvent">Add Event</button>
                </form>
            </div>
        </div>

        <!-- Display Events Table -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <h2 class="text-center">All Events</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Venue</th>
                                <th>Coordinator</th>
                                <th>Budget</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$counter}</td>";
                                echo "<td>{$row['event_name']}</td>";
                                echo "<td>{$row['event_date']}</td>";
                                echo "<td>{$row['event_time']}</td>";
                                echo "<td>{$row['event_venue']}</td>";
                                echo "<td>{$row['coordinator']}</td>";
                                echo "<td>{$row['budget']}</td>";
                                echo "</tr>";
                                $counter++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
