<?php

namespace Database\Seeders;

use App\Enums\NewsStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert($this->getDate());
    }

    public function getDate(): array {
        $res = [];
        for ($i = 0; $i < 10; $i++) {
            $res[] = [
                'title'         =>  'News#' . $i,
                'author'        =>  fake()->userName(),
                'status'        =>  NewsStatus::ACTIVE->value,
                'image_url'     =>  fake()->imageUrl(),
                'description'   =>  fake()->text(100),
                'created_at'    =>  fake()->dateTime('now')
            ];
        }

        return $res;
    }
}
