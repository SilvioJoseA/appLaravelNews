<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\NewYorkTimesNews;
use Carbon\Carbon;

class NewYorkTimesNewsController extends Controller
{
    public function getNewsApi(Request $request)    {
        $apiKey = env('API_KEY_NYT');
        $url = env('API_URL_NYT');
        $params = [
            'q' => $request->input('q', ''),
            'api-key' => $apiKey,
            'page' => $request->input('page', 1), 
        ];
        $response = Http::get($url, $params);
        if ($response->successful()) {
            $data = $response->json();
            $articles = $data['response']['docs'];
            $this->saveNewsToDatabase($articles);
            return response()->json($articles, 200);
        } else {
            return response()->json(['error' => 'Failed to fetch news.'], $response->status());
        }
    }

    private function saveNewsToDatabase($articles)  {
        foreach ($articles as $article) {
            NewYorkTimesNews::createFromArticle($article);
        }
    }
    private function concatKeywords ($keyword)  {
    }
    public function getNewsDb() {
        $arrNews = NytimesNews::getAllNews();
        return response()->json($arrNews,201);
    }
    
}

