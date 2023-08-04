<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['userid']) && !isset($_COOKIE['userid'])) {
    header('Location: login.php');
    exit();
}

extract($_SESSION);
extract($_COOKIE);

$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$userid'");

if ($query) {
    $row = mysqli_fetch_assoc($query);
    extract($row);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Session Destruction on Inactivity</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?></h1>
    
    <script>
        function redirectToLogin() {
            window.location.href = 'login.php';
            <?php session_destroy()?>
        }

        let lastActivityTime = Date.now();

        function resetLastActivityTime() {
            lastActivityTime = Date.now();
        }

        document.addEventListener('mousemove', resetLastActivityTime);
        document.addEventListener('keydown', resetLastActivityTime);

        const inactivityTimeout = 5000; // 5000 milliseconds = 5 seconds

        setInterval(function() {
            const currentTime = Date.now();
            const timeSinceLastActivity = currentTime - lastActivityTime;

            if (timeSinceLastActivity >= inactivityTimeout) {
                alert('Your session will be destroyed due to inactivity.');               
                redirectToLogin();
            }
        }, 1000); 
    </script>
</body>
</html>
