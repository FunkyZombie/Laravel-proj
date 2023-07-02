<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert($this->getDate());
    }

    public function getDate(): array {
        $res = [];
        for ($i = 0; $i < 10; $i++) {
            $res[] = [
                'title'         => fake()->jobTitle(),
                'description'   => fake()->text(100)
            ];
        }

        return $res;
    }
}
