<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewYorkTimesNews extends Model
{
    use HasFactory;
    
    protected $table = 'nytimes_articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'abstract',
        'web_url',
        'snippet',
        'lead_paragraph',
        'source',
        'url_imagen',
        'keywords',
        'pub_date',
        'document_type',
        'news_desk',
        'section_name',
        'subsection_name',
        'byline_original',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pub_date' => 'datetime',
    ];
    
    public static function getAllNews() {
        return self::all();
    }
    public static function createFromArticle($article)
    {
        return self::create([
            'abstract' => $article['abstract'] ?? '',
            'web_url' => $article['web_url'] ?? '',
            'snippet' => $article['snippet'] ?? '',
            'lead_paragraph' => $article['lead_paragraph'] ?? '',
            'source' => $article['source'] ?? '',
            'urlImagen' => '',
            'keywords' => '', 
            'pub_date' => $article['pub_date'] ?? '',
            'document_type' => $article['document_type'] ?? '',
            'news_desk' => $article['news_desk'] ?? '',
            'section_name' => $article['section_name'] ?? '',
            'subsection_name' => $article['subsection_name'] ?? '',
            'byline_original' => $article['byline']['original'] ?? '',
            
        ]);
    }
}
