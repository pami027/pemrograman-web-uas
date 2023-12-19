<?php
include 'config.php';

$query = "SELECT siswa.id_mahasiswa, siswa.nama_mahasiswa, siswa.nomor_hp, siswa.alamat, siswa.gender, kelas.nama_kelas
FROM siswa
INNER JOIN kelas ON siswa.kelas_id = kelas.id_kelas";
$result = $koneksi->query($query);

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data TIF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;          
        }

        .container {
                width: 80%;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
            }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
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
        <?php
        if ($result->num_rows > 0) {
            echo "<h2>Data TIF</h2>";
            echo "<a href='create.php'>Tambah Data</a>";
            echo "<table>";
            echo "<tr>
                    <th>Nim Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kelas</th>
                    <th>Nomor Hp</th>
                    <th>Alamat</th>
                    <th>Gender</th>
                    <th>Aksi</th>  
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_mahasiswa"] . "</td>"; 
                echo "<td>" . $row["nama_mahasiswa"] . "</td>"; 
                echo "<td>" . $row["nama_kelas"] . "</td>"; 
                echo "<td>" . $row["nomor_hp"] . "</td>"; 
                echo "<td>" . $row["alamat"] . "</td>"; 
                echo "<td>" . $row["gender"] . "</td>"; 
                echo "<td>
                            <a href='update.php?id=" . $row["id_mahasiswa"] . "'>Edit</a> |
                            <a href='delete.php?id=" . $row["id_mahasiswa"] . "'>Hapus</a>                  
                            </td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<h2>Tidak ada data mahasiswa.</h2>";
            echo "<a href='create.php'>Tambah Data</a>";
        }
        ?>

    </div>
    
</body>
</html>