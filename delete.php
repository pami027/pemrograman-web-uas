<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id_mahasiswa = $_GET['id'];

    $query = "DELETE FROM siswa WHERE id_mahasiswa = $id_mahasiswa";

    if ($koneksi->query($query) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $koneksi->error;
    }
} else {
    echo "ID siswa tidak diberikan.";
    exit();
}

$koneksi->close();
?>