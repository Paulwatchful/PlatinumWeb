<?php
$user = 'admin';
$pass = 'Platinum10';

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pass) {
    header('WWW-Authenticate: Basic realm="Admin Page"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You must enter a valid login ID and password to access this resource.';
    exit;
}
?>

<!-- Your original admin page content follows after this comment -->

<!DOCTYPE html>
<!-- ... rest of your admin page ... -->


<!DOCTYPE html>
<html>

<head>
    <title>Admin Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Platinum Homecare</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auburn.html">Auburn Lodge Care Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Training.html">Training Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="jobs.html">Job Vacancies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="privacy.html">Privacy Notice</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-5">

    <!-- Job Adding Form -->
    <form id="jobForm">
        <input type="text" id="jobTitle" placeholder="Job Title" class="form-control mb-2">
        <textarea id="jobDescription" placeholder="Job Description" class="form-control mb-2"></textarea>
        <button type="button" onclick="addJob()" class="btn btn-primary">Add Job</button>
    </form>

    <!-- Table to show the jobs -->
    <table class="table mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="jobsTableBody">

        </tbody>
    </table>

</div>

<script>
    function addJob() {
        let jobTitle = document.getElementById('jobTitle').value;
        let jobDescription = document.getElementById('jobDescription').value;

        $.ajax({
            type: "POST",
            url: "jobs_handler.php",
            data: {
                action: "add",
                title: jobTitle,
                description: jobDescription
            },
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    loadJobs();
                } else {
                    alert(data.message);
                }
            }
        });
    }

    function loadJobs() {
        $.ajax({
            type: "GET",
            url: "jobs_handler.php",
            data: {
                action: "getJobs"
            },
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    let html = '';
                    for (let job of data.data) {
                        html += '<tr>';
                        html += `<td>${job.id}</td>`;
                        html += `<td>${job.job_title}</td>`;
                        html += `<td>${job.job_description}</td>`;
                        html += '<td>';
                        html += `<button class="btn btn-sm btn-warning" onclick="editJob(${job.id})">Edit</button> `;
                        html += `<button class="btn btn-sm btn-danger" onclick="deleteJob(${job.id})">Delete</button>`;
                        html += '</td>';
                        html += '</tr>';
                    }
                    document.getElementById('jobsTableBody').innerHTML = html;
                } else {
                    alert(data.message);
                }
            }
        });
    }

    function editJob(id) {
        // Logic for editing a job. You'll need a separate modal/dialog or page for this.
    }

    function deleteJob(id) {
        if (confirm("Are you sure you want to delete this job?")) {
            $.ajax({
                type: "POST",
                url: "jobs_handler.php",
                data: {
                    action: "delete",
                    id: id
                },
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        loadJobs();
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    }

    // Initial load of jobs
    $(document).ready(function() {
        loadJobs();
    });

</script>

</body>

</html>
