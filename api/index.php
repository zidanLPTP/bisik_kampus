<?php

// api/index.php
require __DIR__ . '/../public/index.php';

$app->useStoragePath('/tmp/storage');

// ... lanjut ke kode bawahnya
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);