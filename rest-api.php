<?php
include_once("config.php");
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE id=$id");

$empData = array();
while ($empRecord = mysqli_fetch_assoc($result)) {
    $empData[] = $empRecord;
}

header('Content-Type: application/json');
echo json_encode($empData);
