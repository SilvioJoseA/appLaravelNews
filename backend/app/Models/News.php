<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'url',
        'urlToImage',
        'publishedAt',
        'content',
        'source_name',
    ];
    public static function getAllNews() {
        return self::all();
    }
    public static function createFromArticle($article)
    {
        return self::create([
            'title' => $article['title'] ? $article['title'] : 'Valor Predeterminado',
            'description' => $article['description']?$article['description']:'Valor predeterminado',
            'author' => $article['author']?$article['author']:'Valor predeterminado',
            'url' => $article['url']?$article['url']:'Valor predeterminado',
            'urlToImage' => $article['urlToImage']?$article['urlToImage']:'Valor predeterminado',
            'publishedAt' =>Carbon::parse($article['publishedAt'])?Carbon::parse($article['publishedAt']):Now(),
            'content' => $article['content']?$article['content']:'Valor predeterminado',
            'source_name' => $article['source']['name']?$article['source']['name']:'Valor predeterminado',
        ]);
    }
}


