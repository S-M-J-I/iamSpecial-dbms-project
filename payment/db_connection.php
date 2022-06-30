<?php

$servername = "sql6.freemysqlhosting.net";
$username = "sql6503144"; // Put the MySQL Username
$password = "qErrULbMKs"; // Put the MySQL Password
$database = "sql6503144"; // Put the Database Name

// Create connection for integration
$conn_integration = mysqli_connect($servername, $username, $password, $database);

// Check connection for integration
if (!$conn_integration) {
    die("Connection failed: " . mysqli_connect_error());
}
