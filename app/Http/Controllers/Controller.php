<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    private array $categoryNews = [
        'politics'  => [],
        'sports'    => [],
        'move'      => [],
        'games'     => [],
        'economy'   => []
    ];

    public function __construct()
    {
        $this->generateNews();
    }

    private function generateNews(): void
    {
        $faker = Factory::create();
        
        foreach($this->categoryNews as &$cat) 
        {
            for ($i = 0; $i < 5; $i++) {
                $cat[] = [
                    'title'         => $faker->jobTitle(),
                    'author'        => $faker->userName(),
                    'status'        => 'DRAFT',
                    'description'   => $faker->text(),
                    'created_at'    => now('Europe/Moscow')
                ];
            }
        }
    }

    public function getNews(int $id = null, string $prefix = null)
    {
        
        $faker = Factory::create();
        
        if (!$prefix && !$id) {
            $news = [];

            foreach ($this->categoryNews as $arr) {
                $news[] = $arr[array_rand($arr, 1)];
            }

            sort($news);
            return $news;
        }

        if ($id) 
        {
            return [
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'status'        => 'DRAFT',
                'description'   => $faker->text(),
                'created_at'    => now('Europe/Moscow')
            ];
        }

        // for ($i = 0; $i < 5; $i++) {
        //     $cat[] = [
        //         'title'         => $faker->jobTitle(),
        //         'author'        => $faker->userName(),
        //         'status'        => 'DRAFT',
        //         'description'   => $faker->text(),
        //         'created_at'    => now('Europe/Moscow')
        //     ];
        // }

        if ($prefix) {
            return $this->categoryNews[$prefix];
        }

        
    }


}
