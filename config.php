<?php
// Set farm location e.g. /var/www/html/farm
$farm = "/var/www/html/farm";

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'mwadmin');
define('DB_PASSWORD', 'SecurePassword1234');
define('DB_NAME', 'mwadmin');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
