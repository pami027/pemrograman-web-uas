<?php

$server     = "localhost";
$username   = "root";
$password   = "";
$db         = "sekolah";

$koneksi = new mysqli($server, $username, $password, $db);

if ($koneksi->connect_error) {
    die("connect failed: " . $koneksi->connect_error);
}
?>