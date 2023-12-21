<?php
require_once("config.php");

if (!isset($_SESSION['login_sess']) || $_SESSION['login_sess'] !== "1") {
    header("location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit();
}

if (isset($_POST['addEvent'])) {
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $eventVenue = $_POST['eventVenue'];
    $coordinator = $_POST['coordinator'];
    $budget = $_POST['budget'];

    $query = "INSERT INTO events (event_name, event_date, event_time, event_venue, coordinator, budget) 
              VALUES ('$eventName', '$eventDate', '$eventTime', '$eventVenue', '$coordinator', '$budget')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Event added successfully!");</script>';
        
        header("location: dashboard.php");
        exit();
    } else {
        echo '<script>alert("Error adding event. Please try again.");</script>';
    }
}


$query = "SELECT event_id, event_name, event_date, event_time, event_venue, coordinator, budget FROM events";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Event Management System</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      
        .dashboard-bg {
            background-color: #808080; /* Grey background color */
          
            
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
           
        }
    </style>
</head>
<body>

    <div class="container-fluid dashboard-bg">
       
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">
                <img src="https://fcrit.ac.in/img/fcritlogo.png" alt="FCRIT Logo" height="40">
                Campus Event Manager
            </a>
            <form class="form-inline ml-auto" method="post" action="">
                <button class="btn btn-danger" type="submit" name="logout">Logout</button>
            </form>
        </nav>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <h1 class="text-center">Events Dashboard</h1>
            </div>
        </div>

        
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 bg-light p-4">
                <h2 class="text-center mb-4">Add New Event</h2>
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

        
        <div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <h2 class="text-center mb-4">All Events</h2>
        <div class="table-responsive bg-light p-4">
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
                        <th>Action</th> 
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
                        if (isset($row['event_id'])) {
                            echo '<td><a href="edit_event.php?event_id=' . $row['event_id'] . '" class="btn btn-primary btn-sm">Edit</a></td>';
                        } else {
                            echo '<td>Error: ID not found</td>';
                        }
                        
                        echo "</tr>";
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
