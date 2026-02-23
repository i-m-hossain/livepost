<?php

namespace Database\Seeders;

use App\Models\User;
use App\Traits\SkipIfRecordExist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use SkipIfRecordExist;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->skipIfRecordExist(User::class)) {
            return;
        }
        User::factory()->count(10)->create();
    }
}
