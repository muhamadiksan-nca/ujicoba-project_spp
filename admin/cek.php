<?php
session_start();

// Cek apakah session login petugas tersedia
if (isset($_SESSION['id_petugas'])) {
    $id_petugas = $_SESSION['id_petugas'];
    echo "ID Petugas yang sedang login adalah: " . $id_petugas;
} else {
    echo "Petugas belum login atau session telah habis.";
}
?>