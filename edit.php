<?php
// include database connection file
include_once("config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];

    // ambil data file
    $namaFile = $_FILES['avatar']['name'];
    $namaSementara = $_FILES['avatar']['tmp_name'];

    // tentukan lokasi file akan dipindahkan
    $dirUpload = "Upload/";

    // pindahkan file
    $file_type = $_FILES['avatar']['type']; //returns the mimetype

    $allowed = array("image/jpeg", "image/gif", "image/png", "image/jpg");
    if (!in_array($file_type, $allowed)) {
        # code...
        return 'file harus Gambar';
    } else {
        $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);
    }

    if ($terupload) {
        $avatar = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]/dcc/" . $dirUpload . $namaFile;
    } else {
        $avatar = $_POST['fileLama'];
    }

    // update user data
    $result = mysqli_query($mysqli, "UPDATE mahasiswa SET nama='$nama',kelas='$kelas',alamat='$alamat', avatar='$avatar' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
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
?>
<html>

<head>
    <title>Edit User Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="update_user" method="post" action="edit.php" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value=<?php echo $nama; ?>></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td><input type="text" name="kelas" value=<?php echo $kelas; ?>></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value=<?php echo $alamat; ?>></td>
            </tr>
            <tr>
                <td>Avatar</td>
                <td><input type="file" name="avatar"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>><input type="hidden" name="fileLama" value=<?php echo $avatar; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>