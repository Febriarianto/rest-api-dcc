<?php
// Create database connection using config file
include_once("config.php");

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>

<html>

<head>
    <title>Homepage</title>
</head>

<body>
    <a href="add.php">Add New User</a><br /><br />

    <table width='80%' border=1>

        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Avatar</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $user_data['id'] . "</td>";
            echo "<td>" . $user_data['nama'] . "</td>";
            echo "<td>" . $user_data['kelas'] . "</td>";
            echo "<td>" . $user_data['alamat'] . "</td>";
            echo "<td>" . $user_data['avatar'] . "</td>";
            echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> ";
        }
        ?>
    </table>
</body>

</html>