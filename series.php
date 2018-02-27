<?php
session_start();

include "navigation.php";

echo '<h1 class="jumbotron"> ' . htmlspecialchars($_GET["SeriesTitle"]) . '</h1>';
?>
