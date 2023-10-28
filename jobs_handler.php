<?php
$servername = "localhost";
$username = "auburnzq_admin";
$password = "Platinum10**"; 
$database = "auburnzq_newsite";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_GET['action'];

switch ($action) {
    case 'getJobs':
        $sql = "SELECT * FROM jobs WHERE status='active'";
        $result = $conn->query($sql);
        $jobs = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        echo json_encode($jobs);
        break;

    // Add more cases here for other CRUD operations
    // e.g., 'addJob', 'updateJob', 'deleteJob'
    
    default:
        echo "Invalid action";
}

$conn->close();
?>
