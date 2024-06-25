<?php
// HTML yang akan diubah menjadi file PDF
$html = $_POST['html'] ?? '';

// Cek apakah HTML tidak kosong
if (!empty($html)) {
    // Kunci API pdfcrowd yang Anda dapatkan dari akun Anda
    $api_key = "ce544b6ea52a5621fb9d55f8b542d14d";

    // Endpoint pdfcrowd untuk mengonversi HTML menjadi PDF
    $url = "https://pdfcrowd.com/api/pdf/convert/html/";

    // Pengaturan permintaan POST
    $post_data = array(
        'username' => $api_key,
        'html' => $html
    );

    // Inisialisasi cURL
    $ch = curl_init();

    // Setel opsi cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    // Eksekusi permintaan
    $pdf_data = curl_exec($ch);

    // Periksa jika terjadi kesalahan
    if(curl_errno($ch)){
        echo 'Curl error: ' . curl_error($ch);
    }

    // Tutup koneksi cURL
    curl_close ($ch);

    // Menyimpan file PDF yang dihasilkan
    file_put_contents("output.pdf", $pdf_data);

    // Tampilkan pesan sukses
    echo "File PDF berhasil dibuat: output.pdf";
} else {
    echo "HTML kosong. Tidak dapat membuat PDF.";
}
?>
