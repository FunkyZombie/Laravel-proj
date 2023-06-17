<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getNews(int $id = null)
    {
        
        $news = [];
        $faker = Factory::create();
        

        if ($id) 
        {
            return [
                'id'            => $id,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'status'        => 'DRAFT',
                'description'   => $faker->text(),
                'created_at'    => now('Europe/Moscow')
            ];
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $news[] = [
                'id'            => $i,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'status'        => 'DRAFT',
                'description'   => $faker->text(),
                'created_at'    => now('Europe/Moscow')
            ];
        }

        sort($news);
        return $news;
    }
}
