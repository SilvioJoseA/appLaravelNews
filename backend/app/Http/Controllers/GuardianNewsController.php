<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\GuardianNews;

class GuardianNewsController extends Controller
{
    public function getNewsApi() {
        $apiKey = env('API_KEY_GUARDIAN');
        $url = env('API_URL_GUARDIAN');
        $params = [
            'api-key' => $apiKey,
        ];
        $response = Http::get($url, $params);
        if ($response->successful()) {
            $data = $response->json();
            $articles = $data['response']['results'];
            $this->saveNewsToDatabase($articles);
            return response()->json($articles, 200);
        } else {
            return response()->json(['error' => 'Failed to fetch news.'], $response->status());
        }
    }
    private function saveNewsToDatabase ($articles) {
        foreach ($articles as $article) {
            GuardianNews::createFromArticle($article);
        }
    }
    public function getNewsDb() {
        $arrNews = GuardianNews::getAllNews();
        return response()->json($arrNews,201);
    }
}
