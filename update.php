<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mahasiswa = $_POST["id_mahasiswa"];
    $nama_mahasiswa = $_POST["nama_mahasiswa"];
    $kelas_id = $_POST["kelas_id"];
    $nomor_hp = $_POST["nomor_hp"];
    $gender = $_POST["gender"];
    $alamat = $_POST["alamat"];

    $query = "UPDATE siswa
              SET nama_mahasiswa='$nama_mahasiswa', kelas_id='$kelas_id', nomor_hp='$nomor_hp', alamat='$alamat', gender='$gender'
              WHERE id_mahasiswa='$id_mahasiswa'";

    if ($koneksi->query($query) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
}

if (isset($_GET["id"])) {
    $id_mahasiswa = $_GET["id"];

    $query_siswa = "SELECT * FROM siswa WHERE id_mahasiswa = $id_mahasiswa";
    $result_siswa = $koneksi->query($query_siswa);

    if ($result_siswa->num_rows > 0) {
        $row_siswa = $result_siswa->fetch_assoc();
    } else {
        echo "Data siswa tidak ditemukan";
    }
} else {
    echo "ID mahasiswa tidak diberikan";
    exit();
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
    <title>Edit Data Siswa</title>
    <style>
        body{
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
            display: flex;
            flex-direction: column;
        }
        
        label {
            margin-bottom: 8px;
        }

        input, select, textarea {
            margin-bottom: 16px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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

        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Siswa</h2>
        <form action=""method="POST">
            <input type="hidden" name="id_mahasiswa" value="<?php echo $row_siswa["id_mahasiswa"]; ?>">

            <label for="nama_mahasiswa">Nama Mahasiswa:</label>
            <input type="text" name="nama_mahasiswa" value="<?php echo $row_siswa["nama_mahasiswa"];?>"required>
             
            <label for="kelas_id">Kelas:</label>
            <select name="kelas_id" required>
                <?php
                while ($row_kelas =$result_kelas->fetch_assoc()) {
                    $selected = ($row_kelas["id_kelas"] == $row_siswa["kelas_id"]) ? "selected" : "";
                    echo "<option value='" . $row_kelas["id_kelas"] . "' $selected>" . $row_kelas["nama_kelas"] . "</option>";
                }
                ?>
            </select>

            <label for="nomor_hp">Nomor HP</label>
            <input type="text" name="nomor_hp" value="<?php echo $row_siswa["nomor_hp"]; ?>" requied>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required><?php echo $row_siswa["alamat"]; ?> </textarea>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="Laki-laki" <?php echo ($row_siswa["gender"] == "Laki-laki") ? "selected" : "";?>>Laki-laki</option>
                <option value="Perempuan" <?php echo ($row_siswa["gender"] == "Perempuan") ? "selected" : "";?>>Perempuan</option>
            </select>

            <button type="submit">Simpan Perubahan</button>
        </form>
            <a href="index.php"></a>
    </div>
    
</body>
</html>