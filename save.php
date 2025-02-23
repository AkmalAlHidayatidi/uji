<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    
    // Buat file users.json jika belum ada
    if (!file_exists('users.json')) {
        file_put_contents('users.json', '[]');
    }
    
    file_put_contents('users.json', $data);
    echo json_encode(["message" => "Data berhasil disimpan"]);
} else {
    echo json_encode(["message" => "Metode tidak diizinkan"]);
}
