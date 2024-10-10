<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RedirectedArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insertData = array_map(
            fn ($item) => array_merge($item, ['created_at' => now(), 'updated_at' => now()]),
            config('inherited_data.redirect_table')
        );
        DB::table('redirected_archives')->insert($insertData);
    }
}
