<?php
// Cleans up any connection made
// We centralize this file to
// avoid unnecessary redundancy

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);

?>
