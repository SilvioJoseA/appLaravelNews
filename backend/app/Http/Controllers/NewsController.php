<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use Carbon\Carbon;

class NewsController extends Controller {
    public function getNewsApi(Request $request)    {
        $url = env('API_URL_NEWS');
        $apiKey = env('API_KEY_NEWS');
        $params = [
            'from' => $request->input('from', '2024-02-12'),
            'sortBy' => 'publishedAt',
            'apiKey' => $apiKey,
            'q' => $request->input('q','bitcoin')
        ];

        $response = Http::get($url, $params);

        $newResponse = $response->json()['articles'];
        $this->saveNewsToDatabase($newResponse);
        return response()->json($response->json(), $response->status());
    }
    private function saveNewsToDatabase($articles)  {
        if(empty(!$articles)){
            foreach ($articles as $article) {
                News::createFromArticle($article);
            }
        }
    }
    public function getNewsDb() { 
        $query = News::getAllNews();
        return response()->json($filteredNews, 200);
    }
    
}
