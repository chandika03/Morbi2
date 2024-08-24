<?php

function parseTime($timestamp)
{
    // Create a DateTime object from the timestamp
    $date = new DateTime($timestamp);

    // Format the date into the desired format: 'M d Y h:i A'
    return $date->format('M d Y h:i A');
}

?>