<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

DB::table('users')->insert([
    [
        'name' => 'Administrator',
        'email' => 'admin@admin.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
]);

echo "Admin user created successfully!\n";
