<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GuardianNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'type',
        'section_id',
        'section_name',
        'web_publication_date',
        'web_title',
        'web_url',
        'api_url',
        'is_hosted',
        'pillar_id',
        'pillar_name',
    ];
    protected $table = 'guardian_articles';
    protected $casts = [
        'web_publication_date' => 'datetime',
        'is_hosted' => 'boolean',
    ];

    public static function getAllNews()
    {
        return self::all();
    }

    public static function createFromArticle($article) {
        return self::create([
            'article_id' => $article['id'] ?? null,
            'type' => $article['type'] ?? '',
            'section_id' => $article['sectionId'] ?? '',
            'section_name' => $article['sectionName'] ?? '',
            'web_publication_date' => $article['webPublicationDate'] ?? '',
            'web_title' => $article['webTitle'] ?? '',
            'web_url' => $article['webUrl'] ?? '',
            'api_url' => $article['apiUrl'] ?? '',
            'is_hosted' => $article['isHosted'] ?? '',
            'pillar_id' => $article['pillarId'] ?? '',
            'pillar_name' => $article['pillarName'] ?? ''
        ]);
    }
}
