<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlphaNews extends Model
{
    use HasFactory;
    protected $table = 'alphanews';
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

    public static function insertMultiple($rows)  {
        self::insert($rows);
    }
    public static function filterNews($filterAuthor, $dateFilter, $filterKeyword, $filterSource) {
        $query = self::query();
    
        if ($dateFilter) {
            $query->where('publishedAt', '>=', $dateFilter);
        }
        if ($filterSource) {
            $query->where('source_name', 'like', "%$filterSource%");
        }
        if ($filterKeyword) {
            $query->where('description', 'like', "%$filterKeyword%");
        }
        if ($filterAuthor) {
            $query->where('author', 'like', "%$filterAuthor%");
        }
    
        return $query;
    }
}
