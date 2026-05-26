<?php

// 1. Aktifkan pelaporan error ekstrem
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Siapkan wadah temporary karena Vercel Read-Only
$tmpStorage = '/tmp/storage';
$tmpCache = '/tmp/bootstrap/cache'; // ⚡ Wadah baru untuk sistem inti Laravel

$directories = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpCache, // Daftarkan folder cache baru
];

// Buat semua folder /tmp jika belum ada
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 3. Paksa Laravel menggunakan folder /tmp untuk Storage
putenv("VIEW_COMPILED_PATH={$tmpStorage}/framework/views");
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_DRIVER=array');
putenv('LOG_CHANNEL=stderr');

// 4. ⚡ KUNCI UTAMA: Paksa Laravel menggunakan /tmp untuk Bootstrap Cache
putenv("APP_SERVICES_CACHE={$tmpCache}/services.php");
putenv("APP_PACKAGES_CACHE={$tmpCache}/packages.php");
putenv("APP_CONFIG_CACHE={$tmpCache}/config.php");
putenv("APP_ROUTES_CACHE={$tmpCache}/routes-v7.php");
putenv("APP_EVENTS_CACHE={$tmpCache}/events.php");

// 5. Cek kelengkapan Vendor
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die("<h1>🚨 ERROR FATAL: Folder Vendor Hilang!</h1><p>Vercel gagal menjalankan 'composer install'.</p>");
}

// 6. Panggil mesin utama Laravel
require __DIR__ . '/../public/index.php';