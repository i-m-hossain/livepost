<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

dump(DB::connection()->getDatabaseName());
dump(DB::table('posts')->count());

$post = \App\Models\Post::first();

$data = [
    "title",
    "body",
];

collect($data)->each(function ($item, $index) use ($post) {
    dump(data_get($post, $item));
});

