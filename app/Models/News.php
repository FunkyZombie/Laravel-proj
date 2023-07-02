<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    public function getNews(bool $isJoin = false)
    {
        if ($isJoin === true ) {
            return DB::table($this->table)
                // ->select('news.*', 'categories.title as categoryTitle')
                // ->join('category_has_news', 'category_has_news.news_id', '=', 'news.id')
                // ->leftJoin('categories', 'category_has_news.category_id', '=', 'categories.id')
                ->get();
        }

        return DB::table($this->table)->get();
    }

    public function getNewsById(int $id): mixed
    {
        return DB::table($this->table)->find($id);
    }
}
