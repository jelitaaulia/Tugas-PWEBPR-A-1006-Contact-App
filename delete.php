<?php
require_once 'contact.php';

// Memastikan bahwa request yang diterima adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah parameter id telah diterima
    if(isset($_POST['id'])) {
        // Menghapus kontak berdasarkan ID yang diterima
        $id = $_POST['id'];
        Contact::initialize(); // Inisialisasi koneksi database
        $result = Contact::delete($id); // Panggil metode delete dengan parameter ID
        echo $result; // Mengembalikan hasil operasi penghapusan
    } else {
        echo "Error: ID not provided"; // Menampilkan pesan error jika ID tidak diterima
    }
} else {
    echo "Error: Invalid request method"; // Menampilkan pesan error jika metode request tidak valid
}
header("Location: index.php");
exit();
?>
