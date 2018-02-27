<?php

$host = 'mpcs53001.cs.uchicago.edu';
$username = 'cphalen';
$secret = 'U7%om3wcJF';
$database = 'cphalenDB';

$conn = mysqli_connect($host, $username, $secret, $database)
    // Handle possible MySQL connection error
    or die('Could not connect: ' . mysqli_connect_error());

// Run query (defined outside the scope of this file)
$result = mysqli_query($conn, $query)
    or die("Query $query tables failed: " . mysqli_error());

?>
