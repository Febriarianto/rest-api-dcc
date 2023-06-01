<?php
include_once("config.php");
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE id=$id");

while ($user_data = mysqli_fetch_array($result)) {
    $nama = $user_data['nama'];
    $kelas = $user_data['kelas'];
    $alamat = $user_data['alamat'];
    $avatar = $user_data['avatar'];
}

$array =  array(
    'nama' => $nama,
    'kelas' => $kelas,
    'alamat' => $alamat,
    'avatar' => $avatar,
);
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
echo json_encode($array);
