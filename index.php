<head>
    <style>
        body {
            background-image: url("/~cphalen/images/background.png");
        }
    </style>
</head>

<?php

include "navigation.php";

?>
<div class="container">
    <br>
    <br>
    <div class="jumbotron">
        <h3>Quick start guide to the website</h3>
        <br>
        <ul>
            <li>
                All static data can be searched for using the different tabs in the navigation bar -- each link corresponds to a different entity set which can be searched with its own parameters
            </li>
            <li>
                After searching the existing data can be updated or deleted with the 'edit' functionality. Once you have found a given tuple, selecting the edit button will bring you to an 'update' page where you can either delete tuple, update some value within it, or modify the relations between that given tuple and another
            </li>
            <li>
                If you would like to insert your own tuples that can be acomplished by selecting the 'add' tab and picking which entity set inot which you would like to insert. All values that are required will be shown as such before the user is allowed to complete the insert
            </li>
            <li>
                The general methodology here is search to update or delete and insert to create an entirely new tuple. Once the new tuple is added it can be given new relationships through the 'edit' functionality if those relationships are not immediately specified within the insert form
            </li>
        </ul>
    </div>
</div>
