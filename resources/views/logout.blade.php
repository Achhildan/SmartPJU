<?php
// Lakukan tindakan logout di sini, misalnya menghapus token sesi, atau menghapus data sesi

// Contoh: Hapus token sesi
session_start();
session_destroy();

// Keluar dengan status berhasil
http_response_code(200);
?>
