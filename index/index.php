<?php
// Koneksi ke database (Anda dapat menyesuaikan informasi koneksi)
$databaseHost = 'localhost';
$databaseName = 'testdb';
$databaseUsername = 'root';
$databasePassword = 'root';

$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Fungsi untuk menambah data
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $mysqli->query("INSERT INTO users (name, address, phone) VALUES('$name', '$address', '$phone')");
}

// Fungsi untuk mengedit data
if(isset($_POST['edit'])){
    $id = $_POST['edit_id'];
    $newName = $_POST['new_name'];
    $newAddress = $_POST['new_address'];
    $newPhone = $_POST['new_phone'];

    $mysqli->query("UPDATE users SET name='$newName', address='$newAddress', phone='$newPhone' WHERE id=$id");
}

// Fungsi untuk menghapus data
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM users WHERE id=$id");
}

// Mendapatkan data dari database
$result = $mysqli->query("SELECT * FROM users");

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
</head>
<body>
    <h2>Daftar anggota</h2>

    <!-- Form untuk menambah data -->
    <form method="post">
        <label>Nama:</label>
        <input type="text" name="name" required>
        <label>Alamat:</label>
        <input type="text" name="address" required>
        <label>Nomor Telepon:</label>
        <input type="text" name="phone" required>
        <button type="submit" name="add">Tambah</button>
    </form>

    <h2>Data anggota</h2>

    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Edit</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td>
                    <!-- Form untuk mengedit data -->
                    <form method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="new_name" placeholder="Nama Baru">
                        <input type="text" name="new_address" placeholder="Alamat Baru">
                        <input type="text" name="new_phone" placeholder="Nomor Telepon Baru">
                        <button type="submit" name="edit">Edit</button>
                    </form>
                    <!-- Link untuk menghapus data -->
                    <a href="?delete=<?php echo $row['id']; ?>">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
