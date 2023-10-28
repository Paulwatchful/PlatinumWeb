<?php
$servername = "localhost";
$username = "auburnzq_admin";
$password = "Platinum10**";
$database = "auburnzq_newsite";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

switch ($action) {
    case 'getJobs':
        $sql = "SELECT * FROM jobs WHERE status='active'";
        $result = $conn->query($sql);
        $jobs = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }
        echo json_encode(['success' => true, 'data' => $jobs]);
        break;

    case 'add':
        if (isset($_POST['title']) && isset($_POST['description'])) {
            $stmt = $conn->prepare("INSERT INTO jobs (job_title, job_description, status) VALUES (?, ?, 'active')");
            $stmt->bind_param("ss", $_POST['title'], $_POST['description']);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Job added successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error adding job.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        }
        break;

    case 'edit':
        // Assuming you pass job_title and job_description as POST parameters for editing along with ID.
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description'])) {
            $stmt = $conn->prepare("UPDATE jobs SET job_title = ?, job_description = ? WHERE id = ?");
            $stmt->bind_param("ssi", $_POST['title'], $_POST['description'], $_POST['id']);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Job edited successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error editing job.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        }
        break;

    case 'delete':
        if (isset($_POST['id'])) {
            $stmt = $conn->prepare("DELETE FROM jobs WHERE id = ?");
            $stmt->bind_param("i", $_POST['id']);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Job deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error deleting job.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}

$conn->close();
?>



$conn->close();
?>
