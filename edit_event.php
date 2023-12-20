<?php

require_once("config.php");


if (!isset($_SESSION['login_sess']) || $_SESSION['login_sess'] !== "1") {
    header("location: login.php");
    exit();
}


if (!isset($_GET['event_id']) || !is_numeric($_GET['event_id'])) {
    // Redirect to the events page if ID is not provided or not numeric
    header("location: events.php");
    exit();
}

$eventId = $_GET['event_id'];


$query = "SELECT * FROM events WHERE event_id = $eventId;";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) == 0) {
   
    header("location: events.php");
    exit();
}


$eventDetails = mysqli_fetch_assoc($result);


if(isset($_POST['updateEvent'])) {

    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $eventVenue = $_POST['eventVenue'];
    $coordinator = $_POST['coordinator'];
    $budget = $_POST['budget'];

    

   
    $updateQuery = "UPDATE events SET
                    event_name = '$eventName',
                    event_date = '$eventDate',
                    event_time = '$eventTime',
                    event_venue = '$eventVenue',
                    coordinator = '$coordinator',
                    budget = '$budget'
                    WHERE event_id = $eventId";
    
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
       
        echo '<script>alert("Event updated successfully!");</script>';
        
        
        header("location: dashboard.php" );
        exit();
    } else {
      
        echo '<script>alert("Error updating event. Please try again.");</script>';
    }
}

if(isset($_POST['deleteEvent'])) {
    
    
   
    $deleteQuery = "DELETE FROM events WHERE event_id = $eventId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        
        echo '<script>alert("Event deleted successfully!");</script>';
  
        header("location: dashboard.php");
        exit();
    } else {
     
        echo '<script>alert("Error deleting event. Please try again.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Campus Event Management System</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container-fluid">
     
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
                <h2 class="text-center">Edit Event</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" class="form-control" name="eventName" value="<?php echo $eventDetails['event_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDate">Date</label>
                        <input type="date" class="form-control" name="eventDate" value="<?php echo $eventDetails['event_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="eventTime">Time</label>
                        <input type="time" class="form-control" name="eventTime" value="<?php echo $eventDetails['event_time']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="eventVenue">Venue</label>
                        <input type="text" class="form-control" name="eventVenue" value="<?php echo $eventDetails['event_venue']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="coordinator">Coordinator</label>
                        <input type="text" class="form-control" name="coordinator" value="<?php echo $eventDetails['coordinator']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="budget">Budget</label>
                        <input type="text" class="form-control" name="budget" value="<?php echo $eventDetails['budget']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="updateEvent">Update Event</button>
                    <form method="POST" action="">
                    <input type="hidden" name="deleteEvent" value="1"> <!-- Hidden input to indicate delete action -->
                    <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this event?');">Delete Event</button>
        </form>
                </form>
            </div>
        </div>
        
    </div>
</div>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
