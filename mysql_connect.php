<?php

// Initializes connection database wheneber unnecessary
// "returns" a connection variable $conn

$host = 'mpcs53001.cs.uchicago.edu';
$username = 'cphalen';
$secret = 'U7%om3wcJF';
$database = 'cphalenDB';

$conn = mysqli_connect($host, $username, $secret, $database)
    // Handle possible MySQL connection error
    or die('<div class="alert alert-danger" role="alert"> It appears as though there as been an issue connecting to our servers: ' . mysqli_connect_error() . '<br>Please contact a site administrator</div>');

?>
