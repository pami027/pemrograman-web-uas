<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mahasiswa = $_POST["id_mahasiswa"];
    $nama_mahasiswa = $_POST["nama_mahasiswa"];
    $kelas_id = $_POST["kelas_id"];
    $nomor_hp = $_POST["nomor_hp"];
    $alamat = $_POST["alamat"];
    $gender = $_POST["gender"];


    $query_check_id = "SELECT id_mahasiswa FROM siswa WHERE id_mahasiswa = '$id_mahasiswa'";
    $result_check_id = $koneksi->query($query_check_id);

    if ($result_check_id->num_rows > 0) {
        echo "ID Mahasiswa sudah digunakan. Pilih ID mahasiswa lain.";
        exit();
    }


    $query = "INSERT INTO siswa (id_mahasiswa, nama_mahasiswa, kelas_id, nomor_hp, alamat, gender)
              VALUES ('$id_mahasiswa', '$nama_mahasiswa', $kelas_id, '$nomor_hp', '$alamat', '$gender')";

    if ($koneksi->query($query) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error adding record: " . $koneksi->error;
    }
}


$query_kelas = "SELECT * FROM kelas";
$result_kelas = $koneksi->query($query_kelas);

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <style>
                body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            text-decoration: none;
            color: #3498db;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Data</h2>
        <form action="" method="POST">
            <label for="id_mahasiswa">ID Siswa:</label>
            <input type="text" name="id_mahasiswa" required>

            <label for="nama_mahasiswa">Nama Siswa:</label>
            <input type="text" name="nama_mahasiswa" required>

            <label for="kelas_id">Kelas:</label>
            <select name="kelas_id" required>
                <?php
                while ($row_kelas = $result_kelas->fetch_assoc()) {
                    echo "<option value='" . $row_kelas["id_kelas"] . "'>" . $row_kelas["nama_kelas"] . "</option>";
                }
                ?>
            </select>

            <label for="nomor_hp">Nomor HP:</label>
            <input type="text" name="nomor_hp" required>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required></textarea>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <button type="submit">Tambah Data</button>
        </form>
        <a href="index.php">Kembali</a>
    </div>
</body>
</html>
