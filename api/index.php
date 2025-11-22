<?php

// 1. Load Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 2. Load Aplikasi Laravel (Bootstrap)
$app = require __DIR__ . '/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Vercel Fix: Storage Path
|--------------------------------------------------------------------------
|
| Di Vercel, folder default 'storage' itu Read-Only (gak bisa ditulis).
| Kita harus pindahkan ke folder '/tmp' yang BISA ditulis.
|
*/
$storagePath = '/tmp/storage';

// Buat foldernya kalau belum ada
if (!is_dir($storagePath)) {
    mkdir($storagePath, 0777, true);
}

// Suruh Laravel pakai folder ini
$app->useStoragePath($storagePath);

/*
|--------------------------------------------------------------------------
| Jalankan Aplikasi
|--------------------------------------------------------------------------
|
| Setelah storage dipindah, baru kita jalankan kernel Laravel.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);