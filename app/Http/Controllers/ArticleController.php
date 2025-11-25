<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Journal;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
       public readonly ArticleService $articleService
    )
    {}

    public function create(Request $request, Journal $journal): View
    {
        $oldArticleData = $request->old();
        $authorsCount = $request->session()->get('authorsCount', 1);
        if (isset($oldArticleData['authors']) && is_array($oldArticleData['authors'])) {
            $authorsCount = max($authorsCount, count($oldArticleData['authors']));
        }
        return view('article.create', compact('journal', 'authorsCount'));
    }

    public function store(StoreArticleRequest $request, Journal $journal): RedirectResponse
    {
        $validated = $request->validated();
        $this->articleService->createArticle($validated, $journal->id);
        $request->session()->forget('authorsCount');
        return redirect()->route('home');
    }


    public function addAuthor(Request $request, Journal $journal): RedirectResponse
    {
        $oldAuthorsCount = $request->session()->get('authorsCount', 1);
        $newAuthorsCount = $oldAuthorsCount + 1;
        $request->session()->put('authorsCount', $newAuthorsCount);
        return redirect()->route('article.create', [$journal])->withInput();
    }

}
