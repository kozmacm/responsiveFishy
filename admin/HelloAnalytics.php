<?php
include_once 'includes/functions.php';

$analytics = getService();
$profile = getFirstProfileId($analytics);
$results = getResults($analytics, $profile);
printResults($results);

?>
