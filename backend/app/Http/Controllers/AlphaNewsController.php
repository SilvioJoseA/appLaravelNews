<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewYorkTimesNews;
use App\Models\GuardianNews;
use App\Models\AlphaNews;

class AlphaNewsController extends Controller
{

    private function formatNews($news, $sourceType = 'default') {
        return $news->map(function ($item) use ($sourceType) {
            $arr = $this->validator($item, $sourceType);
            $arrFilleKeys = array_fill_keys(['title', 'description', 'author', 'url', 'urlToImage', 'publishedAt', 'content', 'source_name'], ''); 
            return $arr + $arrFilleKeys;
        })->toArray();
    }
    
    private function validator($item, $sourceType) {
        return [
            'title' => $sourceType === 'nytimes' ? $item->web_url : ($sourceType === 'guardian' ? $item->web_title : $item->title),
            'description' => $sourceType === 'nytimes' ? $item->abstract : ($sourceType === 'guardian' ? $item->web_title : $item->description),
            'author' => $sourceType === 'nytimes' ? $item->byline_original : ($sourceType === 'guardian' ? "Author" : $item->author),
            'url' => $sourceType === 'nytimes' ? $item->web_url : ($sourceType === 'guardian' ? $item->web_title : $item->url),
            'urlToImage' => $sourceType === 'nytimes' ? ($item->web_url ?? ".") : ($sourceType === 'guardian' ? "." : ($item->urlToImage ?? '.')),
            'publishedAt' => $sourceType === 'nytimes' ? $item->pub_date : ($sourceType === 'guardian' ? $item->web_publication_date : $item->publishedAt),
            'content' => $sourceType === 'nytimes' ? ($item->web_title ?? 'content') : ($sourceType === 'guardian' ? ($item->web_title ?? 'content') : ($item->snippet ?? 'Default Content')),
            'source_name' => $sourceType === 'nytimes' ? 'nytimes' : ($sourceType === 'guardian' ? 'guardian' : $item->source_name),
        ];
    }

    public function getSources() {
        try {
            $rowsNews = $this->formatNews(News::getAllNews());
            $rowsNytimes = $this->formatNews(NewYorkTimesNews::getAllNews(), 'nytimes');
            $rowsGuardian = $this->formatNews(GuardianNews::getAllNews(), 'guardian');
            $combinedArray = [
                'news' => $rowsNews,
                'nytimes' => $rowsNytimes,
                'guardian' => $rowsGuardian,
            ];
            foreach ($combinedArray as $sourceType => $rows) {
                AlphaNews::insertMultiples($rows);
            }
            return response()->json(['message' => 'Datos guardados correctamente en AlphaNews'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getNewsDb(Request $request) {     
        $filterAuthor = $request->input('filter_category');
        $dateFilter = $request->input('filter_date');
        $filterKeyword = $request->input('filter_keyword');
        $filterSource = $request->input('filter_source');
    
        $filteredNewsQuery = AlphaNews::filterNews($filterAuthor, $dateFilter, $filterKeyword, $filterSource);
    
        $perPage = $request->input('per_page', 10); // Número predeterminado de elementos por página
        $page = $request->input('page', 1); // Página predeterminada
    
        // Verificar si se solicita paginación
        if ($request->has('page')) {
            $filteredNews = $filteredNewsQuery->paginate($perPage, ['*'], 'page', $page);
            return response()->json($filteredNews, 200);
        } else {
            // Si no se solicita paginación, simplemente obtener los resultados sin paginación
            $filteredNews = $filteredNewsQuery->get();
            return response()->json($filteredNews, 200);
        }
    }
}
