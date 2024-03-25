<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->create([
            'name'         => 'uncategorized',
            'status'       => true,
            'is_deletable' => false
        ],
        [
            'name'         => 'Graphics',
            'status'       => true,
            'is_deletable' => false
        ],
        [
            'name'         => 'laravel',
            'status'       => true,
            'is_deletable' => false
        ],

    );
    }
}
