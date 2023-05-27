<html>

<head>
    <title>Add Users</title>
</head>

<body>
    <a href="index.php">Go to Home</a>
    <br /><br />

    <form action="add.php" method="post" name="form1" enctype="multipart/form-data">
        <table width="25%" border="0">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td><input type="text" name="kelas"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td>Avatar</td>
                <td><input type="file" name="avatar"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $alamat = $_POST['alamat'];

        // ambil data file
        $namaFile = $_FILES['avatar']['name'];
        $namaSementara = $_FILES['avatar']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "Upload/";

        $file_type = $_FILES['avatar']['type']; //returns the mimetype

        $allowed = array("image/jpeg", "image/gif", "image/png", "image/jpg");
        if (!in_array($file_type, $allowed)) {
            # code...
            return 'file harus Gambar';
        } else {
            $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);
        }
        // pindahkan file

        $avatar = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]/dcc/" . $dirUpload . $namaFile;

        // include database connection file
        include_once("config.php");

        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO mahasiswa(nama,kelas,alamat,avatar) VALUES('$nama','$kelas','$alamat','$avatar')");

        // Show message when user added
        echo "User added successfully. <a href='index.php'>View Users</a>";
    }
    ?>
</body>

</html>